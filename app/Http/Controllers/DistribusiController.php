<?php

namespace App\Http\Controllers;

use App\Models\Distribusi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class DistribusiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $distribusis = Distribusi::orderBy('tanggal', 'desc')->get();
        return view('distribusi.Barang', compact('distribusis'));
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
        $validated = $request->validate(
            [
                'toko_tujuan'    => 'required|string|max:255',
                'jumlah_produk'  => 'required|integer|min:1',
                'status'         => 'required|in:terkirim,pending',
                'catatan'        => 'nullable|string|max:255',
            ],
            [
                'toko_tujuan.required'   => 'Tujuan pengiriman wajib diisi.',
                'jumlah_produk.required' => 'Jumlah barang wajib diisi.',
                'jumlah_produk.min'      => 'Jumlah barang minimal 1.',
                'status.required'        => 'Status barang wajib dipilih.',
            ]
        );

        Distribusi::create([
            'pengguna_id'    => Auth::id(),
            'toko_tujuan'    => $validated['toko_tujuan'],
            'jumlah_produk'  => $validated['jumlah_produk'],
            'tanggal'        => now()->toDateString(),
            'status'         => $validated['status'],
            'catatan'        => $validated['catatan'] ?? null,
        ]);

        return redirect()->back()->with('success', 'Data distribusi tersimpan.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Distribusi $distribusi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $distribusi = Distribusi::findOrFail($id);
        return view('distribusi.edit', compact('distribusi'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'catatan' => 'required|string|max:255',
            'toko_tujuan' => 'required|string|max:255',
            'jumlah_produk' => 'required|integer|min:1',
            'status' => 'required|in:terkirim,pending',
        ]);

        $distribusi = Distribusi::findOrFail($id);

        $distribusi->catatan = $request->catatan;
        $distribusi->toko_tujuan = $request->toko_tujuan;
        $distribusi->jumlah_produk = $request->jumlah_produk;
        $distribusi->status = $request->status;

        $distribusi->save();

        return redirect()
        ->route('distribusi.barang')
        ->with('success', 'Data distribusi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $distribusi = Distribusi::findOrFail($id);
        $distribusi->delete();

        return redirect()
        ->route('distribusi.barang')
        ->with('success', 'Data distribusi berhasil dihapus.');
    }
}