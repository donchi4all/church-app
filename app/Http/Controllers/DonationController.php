<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Srmklive\PayPal\Services\PayPal as PayPalClient;


class DonationController extends Controller
{
    public function payWithPaystack(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'amount' => 'required|numeric|min:1',
        ]);

        // Create a donation record
        $donation = Donation::create([
            'donor_name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
            'amount' => $request->amount,
            'currency' => 'NGN',
            'payment_method' => 'paystack',
            'transaction_reference' => Str::random(12), // Unique reference
            'status' => 'pending',
        ]);

        $paystackUrl = env('PAYSTACK_PAYMENT_URL', 'https://api.paystack.co/transaction/initialize');
        $secretKey = env('PAYSTACK_SECRET_KEY');

        $response = Http::withToken($secretKey)->post($paystackUrl, [
            'email' => $request->email,
            'amount' => $request->amount * 100, // Convert to kobo
            'callback_url' => route('donate.paystack.callback'),
            'reference' => $donation->transaction_reference,
        ]);

        $responseData = $response->json();

        if ($responseData['status']) {
            return redirect($responseData['data']['authorization_url']);
        }

        return back()->with('error', 'Unable to process payment at the moment.');

    }

    public function paystackCallback(Request $request)
    {

        $reference = $request->get('reference');

        $secretKey = env('PAYSTACK_SECRET_KEY');

        // Verify payment
        $response = Http::withToken(env('PAYSTACK_SECRET_KEY'))
            ->get("https://api.paystack.co/transaction/verify/{$reference}");

        $donation = Donation::where('transaction_reference', $reference)->firstOrFail();

        if ($response->successful() && $response->json('data.status') === 'success') {
            $donation->update(['status' => 'success']);
            return redirect()->route('donation')->with('success', 'Donation successful!');
        }

        $donation->update(['status' => 'failed']);
        return redirect()->route('donation')->with('error', 'Payment failed.');

    }


    /**
     * Initialize PayPal payment.
     */
    public function payWithPayPal(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string',
            'email' => 'required|email',
            'amount' => 'required|numeric|min:1',
        ]);

        $transactionReference = Str::random(12);
        // Create a donation record
        $donation = Donation::create([
            'donor_name' => $request->first_name,
            'email' => $request->email,
            'amount' => $request->amount,
            'currency' => 'USD',
            'payment_method' => 'paypal',
            'transaction_reference' => $transactionReference, // Unique reference
            'status' => 'pending',
        ]);

        $clientId = env('PAYPAL_CLIENT_ID');
        $clientSecret = env('PAYPAL_CLIENT_SECRET');
        $url = env('PAYPAL_MODE') == 'sandbox'
            ? 'https://api-m.sandbox.paypal.com/v2/checkout/orders'
            : 'https://api-m.paypal.com/v2/checkout/orders';

        if (empty($clientId) || empty($clientSecret)) {
            return back()->with('error', 'PayPal credentials are not configured. Please check your .env file.');
        }

        // Initialize PayPal payment
        $response = Http::withBasicAuth($clientId, $clientSecret)
            ->post($url, [
                'intent' => 'CAPTURE',
                'purchase_units' => [
                    [
                        'reference' => $transactionReference, // Unique transaction reference
                        'amount' => [
                            'currency_code' => 'USD',
                            'value' => $request->amount,
                        ],
                    ],
                ],
                'application_context' => [
                    'return_url' => route('paypal.callback', ['reference' => $transactionReference]),
                    'cancel_url' => route('paypal.cancel', ['reference' => $transactionReference]),
                ],
            ]);

        if ($response->successful()) {
            $approvalUrl = collect($response->json('links'))->firstWhere('rel', 'approve')['href'];
            return redirect($approvalUrl);
        }

        // Handle initialization error
        return back()->with('error', 'Unable to initiate PayPal payment. Please try again.');

    }



    /**
     * Handle PayPal callback.
     */
    public function handlePaypalCallback(Request $request)
    {

        $token = $request->get('token');
        $reference = $request->get('reference');
        $payerID = $request->get('PayerID');

        $clientId = env('PAYPAL_CLIENT_ID');
        $clientSecret = env('PAYPAL_CLIENT_SECRET');
        $url = env('PAYPAL_MODE') == 'sandbox'
            ? 'https://api-m.sandbox.paypal.com/v2/checkout/orders'
            : 'https://api-m.paypal.com/v2/checkout/orders';


        $response = Http::withBasicAuth($clientId, $clientSecret)
            ->get($url . "/{$token}");


        $donation = Donation::where('transaction_reference', $reference)->orWhere('transaction_reference', $token)->firstOrFail();

        if ($response->successful() && ($response->json('status') === 'COMPLETED' || $response->json('status') === 'APPROVED')) {
            if ($token)
                $reference = $token;
            $donation->update(['status' => 'success', 'transaction_reference' => $reference]);
            return redirect()->route('donation')->with('success', 'Donation successful!');
        }

        if ($token)
            $reference = $token;
        $donation->update(['status' => 'failed', 'transaction_reference' => $reference]);
        return redirect()->route('donation')->with('error', 'Payment failed.');
    }


    public function paypalCancel(Request $request)
    {
        $transactionReference = $request->get('reference');

        if (!$transactionReference) {
            return redirect()->route('donation')->with('error', 'Invalid payment reference.');
        }

        // Update the donation status as canceled
        Donation::where('transaction_reference', $transactionReference)
            ->update(['status' => 'failed']);

        return redirect()->route('donation')->with('error', 'You canceled the PayPal transaction.');
    }

    public function listDonations(Request $request)
    {
        $query = Donation::query();

        // Check if there is a search term
        if ($request->has('search') && $request->get('search') !== '') {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('donor_name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            });
        }
        // Paginate the results
        $donations = $query->paginate(10);
        // Fetch donations with pagination
        // $donations = Donation::paginate(10); // 10 donations per page
        return view('backend.pages.donation', compact('donations'));
    }

}
