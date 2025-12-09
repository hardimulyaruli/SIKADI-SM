<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::orderBy('tanggal', 'desc')->get();
        return view('keuangan.transaksi', compact('transaksi'));
    }

    // ==========================
    // SIMPAN PEMASUKAN
    // ==========================
    public function store(Request $request)
    {
        $request->validate([
            'tipe'      => 'required|in:pemasukan,pengeluaran',
            'kategori'  => 'required',
            'qty'       => 'required|integer|min:1',
            'nominal'   => 'required|integer|min:0',
            'tanggal'   => 'required|date',
            'deskripsi' => 'nullable|string'
        ]);

        Transaksi::create([
            'tipe'      => $request->tipe,
            'kategori'  => $request->kategori,
            'qty'       => $request->qty,
            'nominal'   => $request->nominal,
            'tanggal'   => $request->tanggal,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()
            ->route('keuangan.transaksi')
            ->with('success', 'Transaksi berhasil ditambahkan!');
    }
}
