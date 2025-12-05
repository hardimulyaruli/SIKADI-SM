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
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

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

// OWNER MENU
Route::get('/owner/laporan-umum', function () {
    return view('owner.laporan');
})->name('owner.keuangan');

Route::get('/owner/manajemen-pengguna', function () {
    return view('owner.user-management');
})->name('owner.user_management');

// MENU KEUANGAN
// DASHBOARD
Route::get('/keuangan/dashboard', fn() => view('dashboard.keuangan'))->name('keuangan.dashboard');

// KELOLA KEUANGAN
Route::get('/keuangan/gaji', fn() => view('keuangan.gaji'))->name('keuangan.gaji');
Route::get('/keuangan/pinjaman', fn() => view('keuangan.pinjaman'))->name('keuangan.pinjaman');

// TRANSAKSI
Route::get('/keaungan/pemasukan', fn() => view('keuangan.pemasukan'))->name('keuangan.pemasukan');
Route::get('/keuangan/pengeluaran', fn() => view('keuangan.pengeluaran'))->name('keuangan.pengeluaran');

// LAPORAN
Route::get('/keuangan/laporan', fn() => view('keuangan.laporan'))->name('keuangan.laporan');


