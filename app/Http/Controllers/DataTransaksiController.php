<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Barang;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DataTransaksiController extends Controller
{
    public function index()
    {
        $startOfWeek = Carbon::now()->startOfWeek(Carbon::MONDAY);
        $endOfWeek = Carbon::now()->endOfWeek(Carbon::SUNDAY);

        $transaksi = Transaksi::whereBetween('tanggal', [$startOfWeek->toDateString(), $endOfWeek->toDateString()])
            ->orderByDesc('tanggal')
            ->orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString();

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
            // Ambil harga dari input (misal diisi via UI) atau hitung dari nominal/qty jika dikirim
            $hargaSatuan = (float) ($request->harga_satuan ?? 0);
            if ($hargaSatuan <= 0 && $request->filled('nominal') && $qty > 0) {
                $hargaSatuan = (float) $request->nominal / $qty;
            }
            // Fallback ke harga default map jika masih 0
            if ($hargaSatuan <= 0) {
                $hargaSatuan = $pemasukanPrices[strtolower($request->kategori)] ?? 0;
            }
        } else {
            $hargaSatuan = (float) $request->harga_satuan;
        }

        if ($request->tipe === 'pengeluaran' && $hargaSatuan <= 0) {
            return back()
                ->withInput()
                ->withErrors(['harga_satuan' => 'Harga satuan pengeluaran wajib diisi dan lebih dari 0']);
        }

        $nominal = $request->filled('nominal') && $request->nominal > 0
            ? (float) $request->nominal
            : $hargaSatuan * $qty;

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

    // ---------------- Pengeluaran CRUD (menggunakan tabel transaksi) ----------------
    public function pengeluaranIndex()
    {
        $pengeluarans = Transaksi::where('tipe', 'pengeluaran')
            ->orderByDesc('tanggal')
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('pengeluaran.index', compact('pengeluarans'));
    }

    public function pengeluaranCreate()
    {
        return view('pengeluaran.create');
    }

    public function pengeluaranStore(Request $request)
    {
        $data = $request->validate([
            'jumlah' => 'required|numeric|min:0',
            'tanggal_pengeluaran' => 'required|date',
            'keperluan' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        Transaksi::create([
            'tipe' => 'pengeluaran',
            'kategori' => $data['keperluan'] ?? null,
            'qty' => 1,
            'harga_satuan' => $data['jumlah'],
            'nominal' => $data['jumlah'],
            'tanggal' => $data['tanggal_pengeluaran'],
            'deskripsi' => $data['keterangan'] ?? null,
        ]);

        return redirect()->route('pengeluaran.index')
            ->with('success', 'Pengeluaran berhasil ditambahkan.');
    }
}
