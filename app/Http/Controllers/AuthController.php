<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    // Show login page
    public function showLogin()
    {
        // If already logged in, redirect based on role
        if (Session::has('user_id')) {
            $role = Session::get('user_role');
            if ($role === 'admin') {
                return redirect()->route('admin.list');
            } else {
                return redirect()->route('feedback.index');
            }
        }
        
        return view('login');
    }

    // Handle login
    public function login(Request $request)
    {
        // Validate input
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Check user using Query Builder
        $user = DB::table('feedback_users')
            ->where('username', $request->username)
            ->first();

        // Check if user exists and password matches
        if ($user && Hash::check($request->password, $user->password)) {
            // Set session
            Session::put('user_id', $user->id);
            Session::put('username', $user->username);
            Session::put('user_role', $user->role);

            // Redirect based on role
            if ($user->role === 'admin') {
                return redirect()->route('admin.list')->with('success', 'Welcome, Admin!');
            } else {
                return redirect()->route('feedback.index')->with('success', 'Welcome!');
            }
        }

        // Invalid credentials
        return redirect()->back()->with('error', 'Invalid username or password.');
    }

    // Handle logout
    public function logout()
    {
        Session::flush();
        return redirect()->route('login')->with('success', 'Logged out successfully.');
    }
}
