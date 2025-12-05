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
//laporan umum
Route::get('/owner/laporan-umum', function () {
    return view('owner.laporan');
})->name('owner.keuangan');

//akun
Route::get('/owner/akun', function () {
    return view('owner.list_user');
})->name('owner.list_user');

// MANAGEMEN AKUN
Route::get('/owner/manajemen-pengguna', function () {
    return view('owner.user-management');
})->name('owner.user_management');

// TAMBAH AKUN
Route::get('/owner/tambah-akun', function () {
    return view('owner.tambah_akun');
})->name('owner.add_user');

// DAFTAR AKUN
Route::get('/owner/daftar-akun', function () {
    return view('owner.list_user');
})->name('owner.list_user');

// HAPUS AKUN
Route::get('/owner/hapus-akun', function () {
    return view('owner.delete_user');
})->name('owner.delete_user');

// Laporan Keuangan
Route::get('/owner/laporan-umum', function () {
    return view('owner.laporan');
})->name('owner.keuangan');

// Laporan Distribusi
Route::get('/owner/laporan-distribusi', function () {
    return view('owner.laporan_distribusi');
})->name('owner.distribusi');

// MENU KEUANGAN
Route::get('/keuangan/pemasukan', function () {
    return view('keuangan.pemasukan');
})->name('transaksi.pemasukan');

Route::get('/keuangan/pengeluaran', function () {
    return view('keuangan.pengeluaran');
})->name('transaksi.pengeluaran');

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


