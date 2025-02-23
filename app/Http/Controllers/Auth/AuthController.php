<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login'); // Ensure you have a login view
    }

public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Check if the user is attempting to log in with the provided credentials
    if (Auth::attempt($credentials)) {
        $user = Auth::user(); // Get the authenticated user

        // Check if the user role is 'student' after successful authentication
        if ($user->role == 'student') {
            Auth::logout(); // Log out the user if they are a student
            return redirect()->back()->with('error', 'You do not have permission to log in.');
        }

        // Regenerate the session for the authenticated user
        $request->session()->regenerate();

        return redirect()->route('dashboard')->with('success', 'You are logged in!'); // Redirect to dashboard
    }

    return back()->withErrors([
        'email' => 'Invalid credentials.',
    ]);
}

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'You were logged out!'); // Redirect to login page
    }
}
