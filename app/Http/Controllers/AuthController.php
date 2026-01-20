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

    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
