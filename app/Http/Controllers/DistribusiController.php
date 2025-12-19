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
        $validated = $request->validate([
            'toko_tujuan' => 'required|string|max:255',
            'jumlah_produk' => 'required|integer|min:0',
            'status' => 'required|in:terkirim,pending',
            'catatan' => 'nullable|string',
        ]);

        Distribusi::create([
            'pengguna_id' => Auth::id(),
            'toko_tujuan' => $validated['toko_tujuan'],
            'jumlah_produk' => $validated['jumlah_produk'],
            'tanggal' => now()->toDateString(),
            'status' => $validated['status'],
            'catatan' => $validated['catatan'] ?? null,
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
    public function edit(Distribusi $distribusi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:terkirim,pending',
        ]);

        $row = Distribusi::findOrFail($id);
        $row->status = $request->status;
        $row->save();

        return redirect()->back()->with('success', 'Status distribusi diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Distribusi $distribusi)
    {
        //
    }
}
