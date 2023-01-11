<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [HomeController::class, 'index']);

Route::get('/login', [AuthController::class, 'viewLogin']);
Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

