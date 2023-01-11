<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class AuthController extends Controller
{
    public function viewLogin(): Response
    {
        return Inertia::render('Auth/LoginPage');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required','email', 'exists:users,email'],
            'password' => ['required','min:6'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('home');
        }

        return redirect()->back();
    }
}
