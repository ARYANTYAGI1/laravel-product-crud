<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Validate registration fields
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
    
        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    
        // Redirect to login with a success message
        return redirect()->route('login')->with('success', 'Registration successful! Please log in.');
    }
    
    public function login(Request $request)
{
    // Validate email and password
    $credentials = $request->only('email', 'password');

    // Attempt to authenticate the user
    if (auth()->attempt($credentials)) {
        // If authentication is successful, redirect to the product index page
        return redirect()->route('products.index');
    } else {
        // If authentication fails, redirect back with an error message
        return back()->with('error', 'Invalid email or password. Please try again.');
    }
}


    public function logout()
    {
        auth()->logout();
        session()->flush();
        return redirect()->route('login')->with('success', 'Logged out successfully!');
    }
}
