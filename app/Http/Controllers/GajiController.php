<?php

namespace App\Http\Controllers;

use App\Models\Gaji;
use App\Models\Karyawan;
use App\Models\Penggajian;
use App\Models\Pinjaman;
use Illuminate\Http\Request;

class GajiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penggajian = \App\Models\Penggajian::with('karyawan')->orderBy('tanggal', 'desc')->get();
        return view('keuangan.gaji', compact('penggajian'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:karyawans,id',
            'tunjangan' => 'required|numeric',
            'hari_tidak_masuk' => 'required|integer|min:0',
        ]);

        $karyawanId = $request->karyawan_id;
        $tunjangan = $request->tunjangan;
        $hariTidakMasuk = $request->hari_tidak_masuk;

        // Total gaji dari tabel gaji (gaji pokok karyawan)
        $gajiPokok = Gaji::where('karyawan_id', $karyawanId)->sum('jumlah_gaji');

        // Total pinjaman yang belum lunas
        $pinjamanBelumLunas = Pinjaman::where('karyawan_id', $karyawanId)
            ->where('status', 'belum_lunas')->get();
        $totalPinjaman = $pinjamanBelumLunas->sum('jumlah_pinjaman');

        // Potongan hari tidak masuk
        $potonganAbsensi = $hariTidakMasuk * 100000;

        // Hitung total gaji diterima
        $totalGajiDiterima = $gajiPokok - $potonganAbsensi - $totalPinjaman + $tunjangan;

        // Simpan data penggajian
        Penggajian::create([
            'karyawan_id' => $karyawanId,
            'tunjangan' => $tunjangan,
            'hari_tidak_masuk' => $hariTidakMasuk,
            'total_gaji_diterima' => $totalGajiDiterima,
            'tanggal' => now(),
            'keterangan' => 'Penggajian bulan ' . now()->format('F Y'),
        ]);

        // Update status pinjaman menjadi lunas setelah dipotong
        foreach ($pinjamanBelumLunas as $pinjaman) {
            $pinjaman->status = 'lunas';
            $pinjaman->save();
        }

        return redirect()->back()->with('success', 'Penggajian berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Gaji $gaji)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gaji $gaji)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gaji $gaji)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gaji $gaji)
    {
        //
    }
}
