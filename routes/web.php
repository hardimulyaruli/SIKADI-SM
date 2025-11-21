<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Redirect root ke login
Route::get('/', function () {
    return redirect()->route('login.page');
});

// Login
Route::get('/login', [AuthController::class, 'loginPage'])->name('login.page');
Route::post('/login', [AuthController::class, 'login'])->name('login.action');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard role
Route::get('/owner/dashboard', function () {
    return view('dashboard.owner');
})->name('owner.dashboard');

Route::get('/keuangan/dashboard', function () {
    return view('dashboard.keuangan');
})->name('keuangan.dashboard');

Route::get('/distribusi/dashboard', function () {
    return view('dashboard.distribusi');
})->name('distribusi.dashboard');
