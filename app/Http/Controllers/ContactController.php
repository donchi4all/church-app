<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        // Display all contact messages (if needed)
        $contacts = Contact::all();
        // return view('contacts.index', compact('contacts'));
    }

    public function store(Request $request)
    {
        // Validate the form inputs
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        // Store the contact message
        Contact::create($validated);

        // Redirect back with a success message
        return back()->with('success', 'Your message has been sent successfully.');
    }


    public function listContacts(Request $request)
    {
        $search = $request->input('search');

        $contacts = Contact::query()
            ->when($search, function ($query, $search) {
                return $query->where('first_name', 'like', '%' . $search . '%')
                    ->orWhere('last_name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('message', 'like', '%' . $search . '%');
            })
            ->paginate(10);

        return view('backend.pages.contact', compact('contacts'));
    }
}
