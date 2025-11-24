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
Route::get('/keuangan/pemasukan', function () {
    return view('keuangan.pemasukan');
})->name('keuangan.pemasukan');

Route::get('/keuangan/pengeluaran', function () {
    return view('keuangan.pengeluaran');
})->name('keuangan.pengeluaran');

Route::get('/keuangan/gaji-pegawai', function () {
    return view('keuangan.gaji');
})->name('keuangan.gaji');

Route::get('/keuangan/pinjaman', function () {
    return view('keuangan.pinjaman');
})->name('keuangan.pinjaman');

Route::get('/keuangan/laporan', function () {
    return view('keuangan.laporan');

})->name('keuangan.laporan');

Route::get('/distribusi/laporan', function () {
    return view('distribusi.Laporan');
})->name('distribusi.laporan');

Route::get('/distribusi/Barang', function () {
    return view('distribusi.Barang');
})->name('distribusi.Barang');

