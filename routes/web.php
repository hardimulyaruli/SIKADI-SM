<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\DataTransaksiController;
use App\Http\Controllers\OwnerKaryawanController;
use App\Http\Controllers\LihatLaporanController;
use App\Http\Controllers\DistribusiController;


/*
|--------------------------------------------------------------------------
| ROUTE LOGIN
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login.page');
});

Route::get('/login', [UserController::class, 'loginPage'])->name('login.page');
Route::post('/login', [UserController::class, 'login'])->name('login.action');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| ROUTE DASHBOARD SEMUA ROLE
|--------------------------------------------------------------------------
*/
Route::get('/owner/dashboard', [LihatLaporanController::class, 'ownerDashboard'])->name('owner.dashboard');

Route::get('/keuangan/dashboard', function () {
    $total_pemasukan = \App\Models\Transaksi::where('tipe', 'pemasukan')->sum('nominal');
    $total_pengeluaran = \App\Models\Transaksi::where('tipe', 'pengeluaran')->sum('nominal');
    $saldo = $total_pemasukan - $total_pengeluaran;

    $transaksi_terbaru = \App\Models\Transaksi::orderByDesc('tanggal')->limit(5)->get();

    return view('dashboard.keuangan', compact('total_pemasukan', 'total_pengeluaran', 'saldo', 'transaksi_terbaru'));
})->name('keuangan.dashboard');
Route::get('/distribusi/dashboard', [DistribusiController::class, 'dashboard'])->name('distribusi.dashboard');


/*
|--------------------------------------------------------------------------
| ROUTE OWNER
|--------------------------------------------------------------------------
*/

// ⭐ LIST USER
Route::get('/owner/akun', [OwnerController::class, 'index'])->name('owner.list_user');

// ⭐ FORM TAMBAH USER
Route::get('/owner/tambah-akun', [OwnerController::class, 'create'])->name('owner.add_user');

// ⭐ SIMPAN USER BARU
Route::post('/owner/tambah-akun', [OwnerController::class, 'store'])->name('owner.store_user');

// ⭐ FORM EDIT USER
Route::get('/owner/akun/{id}/edit', [OwnerController::class, 'edit'])->name('owner.edit_user');

// ⭐ UPDATE USER
Route::put('/owner/akun/{id}', [OwnerController::class, 'update'])->name('owner.update_user');

// ⭐ HAPUS USER
Route::delete('/owner/akun/{id}', [OwnerController::class, 'destroy'])->name('owner.delete_user');

// ⭐ Data Karyawan (Owner)
Route::get('/owner/karyawan', [OwnerKaryawanController::class, 'index'])->name('owner.karyawan');
Route::post('/owner/karyawan', [OwnerKaryawanController::class, 'store'])->name('owner.karyawan.store');
Route::get('/owner/karyawan/{id}/edit', [OwnerKaryawanController::class, 'edit'])->name('owner.karyawan.edit');
Route::put('/owner/karyawan/{id}', [OwnerKaryawanController::class, 'update'])->name('owner.karyawan.update');
Route::delete('/owner/karyawan/{id}', [OwnerKaryawanController::class, 'destroy'])->name('owner.karyawan.destroy');

// ⭐ Laporan Owner
Route::get('/owner/laporan-umum', [LihatLaporanController::class, 'ownerSummary'])->name('owner.keuangan');
Route::get('/owner/laporan-distribusi', [LihatLaporanController::class, 'ownerDistribusi'])->name('owner.distribusi');
Route::get('/owner/api/chart-transaksi', [LihatLaporanController::class, 'chartTransaksi'])->name('owner.chart.transaksi');
Route::get('/owner/api/chart-distribusi', [LihatLaporanController::class, 'chartDistribusi'])->name('owner.chart.distribusi');
Route::get('/owner/api/chart-gaji-pinjaman', [LihatLaporanController::class, 'chartGajiPinjaman'])->name('owner.chart.gaji_pinjaman');


/*
|--------------------------------------------------------------------------
| ROUTE KEUANGAN
|--------------------------------------------------------------------------
*/
Route::get('/keuangan/add_pemasukan', fn() => view('keuangan.add_pemasukan'))->name('keuangan.add_pemasukan');
Route::get('/keuangan/add_pengeluaran', fn() => view('keuangan.add_pengeluaran'))->name('keuangan.add_pengeluaran');
Route::get('/keuangan/gaji-pegawai', [\App\Http\Controllers\BagianKeuanganController::class, 'index'])->name('keuangan.gaji');
Route::post('/keuangan/gaji-pegawai', [\App\Http\Controllers\BagianKeuanganController::class, 'store'])->name('keuangan.gaji.store');
Route::get('/keuangan/pinjaman', [\App\Http\Controllers\PinjamanController::class, 'index'])->name('keuangan.pinjaman');
Route::post('/keuangan/pinjaman', [\App\Http\Controllers\PinjamanController::class, 'store'])->name('keuangan.pinjaman.store');
Route::get('/keuangan/laporan', [\App\Http\Controllers\LihatLaporanController::class, 'index'])->name('keuangan.laporan');
Route::post('/keuangan/laporan/filter', [\App\Http\Controllers\LihatLaporanController::class, 'getFilteredReport'])->name('keuangan.laporan.filter');
Route::get('/keuangan/laporan/export/penggajian', [\App\Http\Controllers\LihatLaporanController::class, 'exportPenggajian'])->name('keuangan.laporan.export.penggajian');
Route::get('/keuangan/laporan/export/transaksi', [\App\Http\Controllers\LihatLaporanController::class, 'exportTransaksi'])->name('keuangan.laporan.export.transaksi');

Route::get('/keuangan/transaksi', [DataTransaksiController::class, 'index'])->name('keuangan.transaksi');
// Halaman daftar transaksi

// Simpan pemasukan
Route::get('/keuangan/transaksi', [DataTransaksiController::class, 'index'])->name('keuangan.transaksi');

Route::post('/keuangan/transaksi', [DataTransaksiController::class, 'store'])->name('keuangan.transaksi.post');

// Pengeluaran CRUD menggunakan TransaksiController
Route::get('/pengeluaran', [DataTransaksiController::class, 'pengeluaranIndex'])->name('pengeluaran.index');
Route::get('/pengeluaran/create', [DataTransaksiController::class, 'pengeluaranCreate'])->name('pengeluaran.create');
Route::post('/pengeluaran', [DataTransaksiController::class, 'pengeluaranStore'])->name('pengeluaran.store');
/*
|--------------------------------------------------------------------------
| ROUTE DISTRIBUSI
|--------------------------------------------------------------------------
*/
Route::get('/distribusi/laporan', [DistribusiController::class, 'laporan'])->name('distribusi.laporan');
Route::get('/distribusi/laporan/export', [DistribusiController::class, 'exportExcel'])->name('distribusi.laporan.export');
Route::get('/distribusi/barang', [\App\Http\Controllers\DistribusiController::class, 'index'])->name('distribusi.barang');
Route::post('/distribusi/barang', [\App\Http\Controllers\DistribusiController::class, 'store'])->name('distribusi.barang.store');
Route::get('/distribusi/barang/{id}/edit', [\App\Http\Controllers\DistribusiController::class, 'edit'])->name('distribusi.edit');
Route::patch('/distribusi/barang/{id}', [\App\Http\Controllers\DistribusiController::class, 'update'])->name('distribusi.update');
Route::delete('/distribusi/barang/{id}', [\App\Http\Controllers\DistribusiController::class, 'destroy'])->name('distribusi.destroy');
