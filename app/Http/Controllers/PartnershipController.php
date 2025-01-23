<?php

namespace App\Http\Controllers;

use App\Models\Partnership;
use Illuminate\Http\Request;

class PartnershipController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'occupation' => 'required|string|max:255',
            'address' => 'required|string',
            'state_country' => 'required|string|max:255',
            'phone_number' => 'required|digits_between:7,15',
            'alt_phone_number' => 'nullable|digits_between:7,15',
            'email' => 'required|email|max:255',
            'monthly_pledge' => 'required|numeric|min:0',
        ]);

        Partnership::create($validated);

        return redirect()->back()->with('success', 'Partnership form submitted successfully!');
    }


    public function listPartnership(Request $request)
    {

        $query = Partnership::query();

        // Check if there is a search term
        if ($request->has('search') && $request->get('search') !== '') {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', '%' . $search . '%')
                    ->orWhere('last_name', 'like', '%' . $search . '%')
                    ->orWhere('occupation', 'like', '%' . $search . '%')
                    ->orWhere('address', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            });
        }


        // Paginate the results
        $partnerships = $query->paginate(10);


        return view('backend.pages.partnership', compact('partnerships'));
    }

}
