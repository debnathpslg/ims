<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    //
    public function login()
    {
        return view('auth.login');
    }

    public function validateLogin(Request $request)
    {
        //
        if (!Auth::attempt($request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]))) {
            throw ValidationException::withMessages(['email' => 'Incorrect credential']);
        }

        $request->session()->regenerate();

        return redirect()->intended('/');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

    public function register(Request $request)
    {
        //
        return view('auth.register');
    }

    public function validateRegister(Request $request)
    {
        //
        $newUser = User::create($request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ]));


        Auth::login($newUser);

        return redirect()->route('home')->with('success', "Welcome to IMS.");
    }
}
