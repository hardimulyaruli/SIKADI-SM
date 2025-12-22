<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Gaji;
use Illuminate\Http\Request;
use Carbon\Carbon;

class OwnerKaryawanController extends Controller
{
    public function index()
    {
        $karyawans = Karyawan::orderBy('nama')->get();
        $gajiMap = Gaji::select('karyawan_id', 'jumlah_gaji', 'tanggal')
            ->orderByDesc('tanggal')
            ->get()
            ->unique('karyawan_id')
            ->keyBy('karyawan_id');

        return view('owner.karyawan', compact('karyawans', 'gajiMap'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'nullable|in:produksi,distribusi,keuangan,admin,marketing,lainnya',
            'no_hp' => 'nullable|string|max:50',
            'alamat' => 'nullable|string|max:255',
            'gaji' => 'required|numeric|min:0',
        ]);

        $karyawan = Karyawan::create($validated);

        Gaji::create([
            'karyawan_id' => $karyawan->id,
            'jumlah_gaji' => $validated['gaji'],
            'tanggal' => Carbon::now()->toDateString(),
            'keterangan' => 'Set gaji awal',
        ]);

        return redirect()
            ->route('owner.karyawan')
            ->with('success', 'Karyawan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $latestGaji = Gaji::where('karyawan_id', $id)->orderByDesc('tanggal')->first();

        return view('owner.karyawan_edit', compact('karyawan', 'latestGaji'));
    }

    public function update(Request $request, $id)
    {
        $karyawan = Karyawan::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'nullable|in:produksi,distribusi,keuangan,admin,marketing,lainnya',
            'no_hp' => 'nullable|string|max:50',
            'alamat' => 'nullable|string|max:255',
            'gaji' => 'required|numeric|min:0',
        ]);

        $karyawan->update($validated);

        Gaji::create([
            'karyawan_id' => $karyawan->id,
            'jumlah_gaji' => $validated['gaji'],
            'tanggal' => Carbon::now()->toDateString(),
            'keterangan' => 'Update gaji',
        ]);

        return redirect()
            ->route('owner.karyawan')
            ->with('success', 'Data karyawan dan gaji diperbarui');
    }

    public function destroy($id)
    {
        $karyawan = Karyawan::findOrFail($id);

        // Hapus riwayat gaji karyawan ini
        Gaji::where('karyawan_id', $id)->delete();
        $karyawan->delete();

        return redirect()
            ->route('owner.karyawan')
            ->with('success', 'Karyawan berhasil dihapus');
    }
}
