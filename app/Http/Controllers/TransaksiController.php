<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Barang;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $startOfWeek = Carbon::now()->startOfWeek(Carbon::MONDAY);
        $endOfWeek = Carbon::now()->endOfWeek(Carbon::SUNDAY);

        $transaksi = Transaksi::whereBetween('tanggal', [$startOfWeek->toDateString(), $endOfWeek->toDateString()])
            ->orderBy('tanggal', 'desc')
            ->get();

        $barangs = Barang::orderBy('nama_barang')->get();

        return view('keuangan.transaksi', compact('transaksi', 'barangs'));
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
            'harga_satuan' => 'nullable|numeric|min:0',
            'nominal'   => 'nullable|numeric|min:0',
            'tanggal'   => 'required|date',
            'deskripsi' => 'nullable|string'
        ]);

        $pemasukanPrices = [
            'nastar' => 5000,
            'bapia' => 5000,
            'kremes' => 5000,
        ];

        $qty = (int) $request->qty;

        if ($request->tipe === 'pemasukan') {
            $hargaSatuan = $pemasukanPrices[$request->kategori] ?? 0;
        } else {
            $hargaSatuan = (float) $request->harga_satuan;
        }

        if ($request->tipe === 'pengeluaran' && $hargaSatuan <= 0) {
            return back()
                ->withInput()
                ->withErrors(['harga_satuan' => 'Harga satuan pengeluaran wajib diisi dan lebih dari 0']);
        }

        $nominal = $hargaSatuan * $qty;

        Transaksi::create([
            'tipe'      => $request->tipe,
            'kategori'  => $request->kategori,
            'qty'       => $request->qty,
            'harga_satuan' => $hargaSatuan,
            'nominal'   => $nominal,
            'tanggal'   => $request->tanggal,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()
            ->route('keuangan.transaksi')
            ->with('success', 'Transaksi berhasil ditambahkan!');
    }
}
