<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Show the dashboard page.
     */
    public function dashboard()
    {
        return view('backend.pages.dashboard');
    }

    /**
     * Show the dashboard page.
     */
    public function login()
    {
        return view('backend.pages.login');
    }

    /**
     * Show the settings page.
     */
    public function settings()
    {
        return view('pages.settings');
    }

    /**
     * Handle the form submission.
     */
    public function submitForm(Request $request)
    {
        // Validate form inputs
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
        ]);

        // Process the data or store it
        // Example: Save to the database
        // User::create($validated);

        return redirect()->route('dashboard')->with('success', 'Form submitted successfully.');
    }
}
