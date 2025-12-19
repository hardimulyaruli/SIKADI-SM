<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Pinjaman;
use Illuminate\Http\Request;

class PinjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pinjaman = Pinjaman::with('karyawan')->orderBy('tanggal', 'desc')->get();
        return view('keuangan.pinjaman', compact('pinjaman'));
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
            'jumlah_pinjaman' => 'required|numeric|min:0',
            'tanggal' => 'required|date',
        ]);

        Pinjaman::create([
            'karyawan_id' => $request->karyawan_id,
            'jumlah_pinjaman' => $request->jumlah_pinjaman,
            'tanggal' => $request->tanggal,
            'status' => 'belum_lunas',
            'keterangan' => $request->keterangan ?? null,
        ]);

        return redirect()->back()->with('success', 'Pinjaman berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pinjaman $pinjaman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pinjaman $pinjaman)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pinjaman $pinjaman)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pinjaman $pinjaman)
    {
        //
    }
}
