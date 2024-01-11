<?php

namespace App\Http\Controllers;

use App\Models\User;
use GrahamCampbell\ResultType\success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
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
     * Show the form for register a new resource.
     */
    public function register()
    {
        return view('register');
    }
    /**
     * Show the form for register a new resource.
     */
    public function dashboard()
    {
        if (Auth::user()) {

            return view('trello.dashboard');
        }
        return view('login');
    }
    /**
     * Store a newely created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:20',
            'email' => 'required|email|max:150|unique:users',
            'password' => 'required|min:5|confirmed',
            'password_confirmation' => 'required|same:password'
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return redirect()->route('register')->with('success', 'Registration has successful');
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
