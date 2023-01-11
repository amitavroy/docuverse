<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function() {
    return Inertia::render('Auth/Login');
});

Route::post('/login', [AuthController::class, 'login']);
