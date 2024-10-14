<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    // This function is called when users log in
    public function login(Request $request)
    {
        $request->validate([
            'sNumber' => 'required',
            'password' => 'required',
        ]);

        // Attempt to log in
        if (auth()->attempt(['sNumber' => $request->sNumber, 'password' => $request->password])) {
            
            $user = auth()->user();

            if ($user) {
                if ($user->role == 'teacher') {
                    session(['role' => 'teacher']);
                } else {
                    session(['role' => 'student']);
                }
                session(['name' => $user->name]);
                session(['sNumber' => $user->sNumber]);
                return redirect()->intended('/'); // direct to home page
            }

        }

        return redirect()->back()->with('error', 'Invalid credentials!');
    }


    // This function is called when users register an account
    public function register(Request $request)
    {
        $validator = $request->validate([
            'sNumber' => 'required|max:7|unique:users|regex:/^s[0-9]{6}$/',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required'
        ]);

        User::create([
            'sNumber' => $request->sNumber,
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'student',
            'password' => bcrypt($request->password),
        ]);

        // Redirect to login page
        return redirect()->route('login')->with('message', 'Account created successfully. You can now log in.');
    }

    // This code is called when user log out
    public function logout(Request $request)
    {
        auth()->logout();
        session()->flush();
        return redirect('/login')->with('message', 'Logged out successfully!');
    }
}

