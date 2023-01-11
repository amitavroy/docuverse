<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $data = $this->validate($request, [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:100',
        ]);
        logger($data);
    }
}
