<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengeluaranController extends Controller
{
    // Menampilkan daftar pengeluaran
    public function index()
    {
        // Mengambil data milik user yang sedang login saja, diurutkan dari terbaru
        $pengeluarans = Pengeluaran::where('user_id', Auth::id())
            ->orderBy('tanggal_pengeluaran', 'desc')
            ->paginate(10);

        return view('pengeluaran.index', compact('pengeluarans'));
    }

    // Form tambah data
    public function create()
    {
        return view('pengeluaran.create');
    }

    // Proses simpan data
    public function store(Request $request)
    {
        $request->validate([
            'jumlah' => 'required|numeric|min:0',
            'tanggal_pengeluaran' => 'required|date',
            'keperluan' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        Pengeluaran::create([
            'user_id' => Auth::id(), // Otomatis ambil ID user login
            'jumlah' => $request->jumlah,
            'tanggal_pengeluaran' => $request->tanggal_pengeluaran,
            'keperluan' => $request->keperluan,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('pengeluaran.index')
            ->with('success', 'Pengeluaran berhasil ditambahkan.');
    }

    // Form edit data
    public function edit(Pengeluaran $pengeluaran)
    {
        // Keamanan: Pastikan user hanya bisa edit datanya sendiri
        if ($pengeluaran->user_id !== Auth::id()) {
            abort(403);
        }

        return view('pengeluaran.edit', compact('pengeluaran'));
    }

    // Proses update data
    public function update(Request $request, Pengeluaran $pengeluaran)
    {
        if ($pengeluaran->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'jumlah' => 'required|numeric|min:0',
            'tanggal_pengeluaran' => 'required|date',
            'keperluan' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $pengeluaran->update($request->all());

        return redirect()->route('pengeluaran.index')
            ->with('success', 'Pengeluaran berhasil diperbarui.');
    }

    // Hapus data
    public function destroy(Pengeluaran $pengeluaran)
    {
        if ($pengeluaran->user_id !== Auth::id()) {
            abort(403);
        }

        $pengeluaran->delete();

        return redirect()->route('pengeluaran.index')
            ->with('success', 'Pengeluaran berhasil dihapus.');
    }
}
