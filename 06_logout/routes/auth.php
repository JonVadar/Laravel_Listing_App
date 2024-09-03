<?php

use App\Http\Controllers\Auth\AuthenticateController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    //------------------- Register -------------------//
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);

    //------------------- Login -------------------//
    Route::get('/login', [AuthenticateController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticateController::class, 'store']);
});


Route::middleware('auth')->group(function () {
    //------------------- Logout -------------------//
    Route::post('/logout', [AuthenticateController::class, 'destroy'])->name('logout');
});
