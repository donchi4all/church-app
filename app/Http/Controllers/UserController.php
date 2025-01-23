<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // Fetch all users
        $users = User::with('roles')->get(); // Assuming roles relation is defined in User model
        return view('backend.pages.users', compact('users'));
    }
}
