<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('backend.pages.login'); // Create a Blade file specifically for the admin login
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Attempt login using the 'admin' guard
        if (Auth::guard('admin')->attempt($credentials, $request->filled('remember'))) {
            $user = Auth::guard('admin')->user();

            // Ensure the user is an admin
            if (!$user->isAdmin()) {
                Auth::guard('admin')->logout(); // Log them out if not admin
                return back()->withErrors(['email' => 'Unauthorized access.']);
            }

            return redirect()->route('admin.dashboard'); // Redirect to admin dashboard
        }

        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ]);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login'); // Redirect to admin login page
    }
}
