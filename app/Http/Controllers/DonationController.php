<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Srmklive\PayPal\Services\PayPal as PayPalClient;


class DonationController extends Controller
{
    public function payWithPaystack(Request $request)
    {
        try {
            $validated = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email',
                'phone' => ['required', 'regex:/^\+?[0-9]{7,15}$/'],
                'amount' => 'required|numeric|min:1',
            ]);

            // Create a donation record
            $donation = Donation::create([
                'donor_name' => $validated['first_name'] . ' ' . $validated['last_name'],
                'email' => $validated['email'],
                'amount' => $validated['amount'],
                'phone' => $validated['phone'],
                'currency' => 'NGN',
                'payment_method' => 'paystack',
                'transaction_reference' => Str::random(12),
                'status' => 'pending',
            ]);

            $paystackUrl = config('services.paystack.public_url', 'https://api.paystack.co/transaction/initialize');
            $secretKey = config('services.paystack.secret_key');

            // Ensure the secret key is not empty
            if (empty($secretKey)) {
                Log::error('Paystack Secret Key is missing.');
                return back()->with('error', 'Payment gateway configuration error.');
            }

            // Send the request with the correct Authorization header format
            $response = Http::withHeaders([
                'Authorization' => "Bearer {$secretKey}", // ✅ Correct format
                'Content-Type' => 'application/json',
            ])->post($paystackUrl, [
                        'email' => $validated['email'],
                        'amount' => $validated['amount'] * 100, // Convert to kobo
                        'callback_url' => route('donate.paystack.callback'),
                        'reference' => $donation->transaction_reference,
                    ]);

            $responseData = $response->json();

            // Log the Paystack response for debugging
            Log::info('Paystack Response:', ['response' => $responseData]);

            if ($responseData['status'] ?? false) {
                return redirect($responseData['data']['authorization_url']);
            }

            // Log the failure reason
            Log::error('Paystack Payment Failed', ['response' => $responseData]);
            return back()->with('error', $responseData['message'] ?? 'Unable to process payment at the moment.');

        } catch (\Exception $e) {
            Log::error('Paystack Payment Exception:', ['error' => $e->getMessage()]);
            return back()->with('error', 'An unexpected error occurred. Please try again.');
        }
    }

    public function paystackCallback(Request $request)
    {
        $reference = $request->get('reference');

        if (!$reference) {
            return redirect()->route('donation')->with('error', 'Invalid payment reference.');
        }

        // Fetch the donation record
        $donation = Donation::where('transaction_reference', $reference)->first();

        if (!$donation) {
            return redirect()->route('donation')->with('error', 'Donation not found.');
        }

        $paystackUrl = "https://api.paystack.co/transaction/verify/{$reference}";
        $secretKey = config('services.paystack.secret_key');

        // Verify payment status
        $response = Http::withHeaders([
            'Authorization' => "Bearer {$secretKey}",
            'Content-Type' => 'application/json',
        ])->get($paystackUrl);

        $responseData = $response->json();

        Log::info('Paystack Verification Response:', ['response' => $responseData]);

        if ($responseData['status'] && isset($responseData['data']['status']) && $responseData['data']['status'] === 'success') {
            // Mark donation as successful
            $donation->update(['status' => 'success']);
            return redirect()->route('donation')->with('success', 'Donation successful!');
        }

        // If transaction is not successful, mark it as failed
        $donation->update(['status' => 'failed']);
        return redirect()->route('donation')->with('error', 'Payment verification failed.');
    }


    // public function paystackCallback(Request $request)
    // {

    //     $reference = $request->get('reference');

    //     $secretKey = env('PAYSTACK_SECRET_KEY');

    //     // Verify payment
    //     $response = Http::withToken(env('PAYSTACK_SECRET_KEY'))
    //         ->get("https://api.paystack.co/transaction/verify/{$reference}");

    //     $donation = Donation::where('transaction_reference', $reference)->firstOrFail();

    //     if ($response->successful() && $response->json('data.status') === 'success') {
    //         $donation->update(['status' => 'success']);
    //         return redirect()->route('donation')->with('success', 'Donation successful!');
    //     }

    //     $donation->update(['status' => 'failed']);
    //     return redirect()->route('donation')->with('error', 'Payment failed.');

    // }


    /**
     * Initialize PayPal payment.
     */
    public function payWithPayPal(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string',
            'email' => 'required|email',
            'phone' => ['required', 'regex:/^\+?[0-9]{7,15}$/'],
            'amount' => 'required|numeric|min:1',
        ]);

        $transactionReference = Str::random(12);
        // Create a donation record
        $donation = Donation::create([
            'donor_name' => $request->first_name,
            'email' => $request->email,
            'amount' => $request->amount,
            'phone' => $request->phone,
            'currency' => 'USD',
            'payment_method' => 'paypal',
            'transaction_reference' => $transactionReference, // Unique reference
            'status' => 'pending',
        ]);

        $clientId = config('services.paypal.client_id');
        $clientSecret = config('services.paypal.client_secret');
        $url = config('services.paypal.mode') == 'sandbox'
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
        try {
            $orderId = $request->get('token'); // PayPal Order ID
            $reference = $request->get('reference');
            $payerID = $request->get('PayerID');

            // $clientId = env('PAYPAL_CLIENT_ID');
            // $clientSecret = env('PAYPAL_CLIENT_SECRET');

            $clientId = config('services.paypal.client_id');
            $clientSecret = config('services.paypal.client_secret');

            // Determine PayPal API URL
            $url = config('services.paypal.mode') == 'sandbox'
                ? "https://api-m.sandbox.paypal.com/v2/checkout/orders/{$orderId}"
                : "https://api-m.paypal.com/v2/checkout/orders/{$orderId}";

            // Make request to PayPal API
            $response = Http::withBasicAuth($clientId, $clientSecret)->get($url);

            if (!$response->successful()) {
                return redirect()->route('donation')->with('error', 'Failed to verify payment.');
            }

            $orderStatus = $response->json('status'); // Get payment status

            // Find the donation record
            $donation = Donation::where('transaction_reference', $reference)
                ->orWhere('transaction_reference', $orderId)
                ->first();

            if (!$donation) {
                return redirect()->route('donation')->with('error', 'Donation record not found.');
            }

            // Check if the order is completed
            if (in_array($orderStatus, ['COMPLETED', 'APPROVED'])) {
                $donation->update([
                    'status' => 'success',
                    'transaction_reference' => $orderId ?? $reference,
                ]);

                return redirect()->route('donation')->with('success', 'Donation successful!');
            }

            // If payment fails, update status
            $donation->update([
                'status' => 'failed',
                'transaction_reference' => $orderId ?? $reference,
            ]);

            return redirect()->route('donation')->with('error', 'Payment failed.');
        } catch (\Exception $e) {
            Log::error('PayPal Callback Error: ' . $e->getMessage());
            return redirect()->route('donation')->with('error', 'An error occurred while processing payment.');
        }
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

        // Apply search filter
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('donor_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Fetch donations sorted by latest (newest first) and paginate
        $donations = $query->orderByDesc('created_at')->paginate(10);

        return view('backend.pages.donation', compact('donations'));
    }


}
