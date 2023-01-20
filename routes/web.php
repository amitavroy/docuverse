<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [HomeController::class, 'index']);

Route::get('/login', [AuthController::class, 'viewLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/document', [DocumentController::class, 'index'])->name('doc.index');
    Route::get('/document/add', [DocumentController::class, 'add'])->name('doc.add');
    Route::post('/document/save', [DocumentController::class, 'store'])->name('doc.store');
    Route::get('/document/view/{id}', [DocumentController::class, 'view'])->name('doc.view');
    Route::post('/document/delete', [DocumentController::class, 'delete'])->name('doc.delete');
});

