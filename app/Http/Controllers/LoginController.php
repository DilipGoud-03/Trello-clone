<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Show the form for login a new resource.
     */
    public function login()
    {
        if (Auth::user()) {
            return redirect($this->dashboard());
        }
        return view('login');
    }
    /**
     * Show user dashboard.
     */
    public function dashboard()
    {
        if (Auth::user()) {

            return view('trello.dashboard');
        }
        return view('login');
    }
    /**
     * Check Login Request.
     */
    public function loginRequest(Request $request)
    {
        $request->validate([
            'email' => 'string|required|email',
            'password' => 'string|required|confirmed'
        ]);
        $userCredential = $request->only('email', 'password');
        if (Auth::attempt($userCredential)) {
            // return response()->json(['message' => 'success']);
            return redirect()->route('dashboard')->with('success', 'Login successful');
        }
        return redirect()->route('login')->with('Error', 'Email and Password invalid');
        // return response()->json(['message' => 'Email and Password invalid']);
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'You have logout successfully');
    }
}
