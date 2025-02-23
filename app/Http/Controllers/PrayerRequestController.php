<?php

namespace App\Http\Controllers;

use App\Models\PrayerRequest;
use Illuminate\Http\Request;

class PrayerRequestController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'email' => 'required|email',
            'phone' => ['required', 'regex:/^\+?[0-9]{7,15}$/'],
            'last_name' => 'required|string|max:255',
            'state_country' => 'required|string|max:255',
            'request' => 'required|string',
        ]);

        // Save the prayer request
        PrayerRequest::create($validated);

        return back()->with('success', 'Your prayer request has been submitted successfully!');
    }



    public function listPrayerRequest(Request $request)
    {
        $query = PrayerRequest::query();

        // Check if there is a search term
        if ($request->has('search') && $request->get('search') !== '') {
            $search = $request->get('search');

            $query = PrayerRequest::query()
                ->when($search, function ($query, $search) {
                    return $query->where('first_name', 'like', '%' . $search . '%')
                        ->orWhere('last_name', 'like', '%' . $search . '%')
                        ->orWhere('request', 'like', '%' . $search . '%');
                })
                ->paginate(10); // You can adjust the pagination limit as needed
        }
        // Paginate the results
        $prayerRequests = $query->orderByDesc('created_at')->paginate(10);
        // Fetch donations with pagination
        // $donations = Donation::paginate(10); // 10 donations per page
        return view('backend.pages.prayer-request', compact('prayerRequests'));
    }

}
