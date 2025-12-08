<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\TransaksiController;


/*
|--------------------------------------------------------------------------
| ROUTE LOGIN
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login.page');
});

Route::get('/login', [AuthController::class, 'loginPage'])->name('login.page');
Route::post('/login', [AuthController::class, 'login'])->name('login.action');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| ROUTE DASHBOARD SEMUA ROLE
|--------------------------------------------------------------------------
*/
Route::get('/owner/dashboard', fn() => view('dashboard.owner'))->name('owner.dashboard');
Route::get('/keuangan/dashboard', fn() => view('dashboard.keuangan'))->name('keuangan.dashboard');
Route::get('/distribusi/dashboard', fn() => view('dashboard.distribusi'))->name('distribusi.dashboard');


/*
|--------------------------------------------------------------------------
| ROUTE OWNER
|--------------------------------------------------------------------------
*/

// ⭐ LIST USER
Route::get('/owner/akun', [PenggunaController::class, 'index'])->name('owner.list_user');

// ⭐ FORM TAMBAH USER
Route::get('/owner/tambah-akun', [PenggunaController::class, 'create'])->name('owner.add_user');

// ⭐ SIMPAN USER BARU
Route::post('/owner/tambah-akun', [PenggunaController::class, 'store'])->name('owner.store_user');

// ⭐ FORM EDIT USER
Route::get('/owner/akun/{id}/edit', [PenggunaController::class, 'edit'])->name('owner.edit_user');

// ⭐ UPDATE USER
Route::put('/owner/akun/{id}', [PenggunaController::class, 'update'])->name('owner.update_user');

// ⭐ HAPUS USER
Route::delete('/owner/akun/{id}', [PenggunaController::class, 'destroy'])->name('owner.delete_user');

// ⭐ Laporan Owner
Route::get('/owner/laporan-umum', fn() => view('owner.laporan'))->name('owner.keuangan');
Route::get('/owner/laporan-distribusi', fn() => view('owner.laporan_distribusi'))->name('owner.distribusi');


/*
|--------------------------------------------------------------------------
| ROUTE KEUANGAN
|--------------------------------------------------------------------------
*/
Route::get('/keuangan/add_pemasukan', fn() => view('keuangan.add_pemasukan'))->name('keuangan.add_pemasukan');
Route::get('/keuangan/add_pengeluaran', fn() => view('keuangan.add_pengeluaran'))->name('keuangan.add_pengeluaran');
Route::get('/keuangan/gaji-pegawai', [\App\Http\Controllers\GajiController::class, 'index'])->name('keuangan.gaji');
Route::post('/keuangan/gaji-pegawai', [\App\Http\Controllers\GajiController::class, 'store'])->name('keuangan.gaji.store');
Route::get('/keuangan/pinjaman', fn() => view('keuangan.pinjaman'))->name('keuangan.pinjaman');
Route::get('/keuangan/laporan', fn() => view('keuangan.laporan'))->name('keuangan.laporan');

Route::get('/keuangan/transaksi', [TransaksiController::class, 'index'])->name('keuangan.transaksi');
// Halaman daftar transaksi

// Simpan pemasukan
Route::get('/keuangan/transaksi', [TransaksiController::class, 'index'])->name('keuangan.transaksi');

Route::post('/keuangan/transaksi', [TransaksiController::class, 'store'])->name('keuangan.transaksi.post');
/*
|--------------------------------------------------------------------------
| ROUTE DISTRIBUSI
|--------------------------------------------------------------------------
*/
Route::get('/distribusi/laporan', fn() => view('distribusi.laporan'))->name('distribusi.laporan');
Route::get('/distribusi/Barang', fn() => view('distribusi.Barang'))->name('distribusi.Barang');
