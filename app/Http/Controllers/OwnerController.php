<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class OwnerController extends Controller
{
    public function index()
    {
        $akun = Pengguna::all();
        return view('owner.list_user', compact('akun'));
    }

    public function create()
    {
        return redirect()->route('owner.list_user');
    }

    public function edit($id)
    {
        $akun = Pengguna::findOrFail($id);
        return view('owner.edit_akun', compact('akun'));
    }

    public function update(Request $request, $id)
    {
        $akun = Pengguna::findOrFail($id);

        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:pengguna,email,' . $id,
            'peran' => 'required',
            'kata_sandi' => 'nullable|min:6'
        ]);

        $akun->nama = $request->nama;
        $akun->email = $request->email;
        $akun->peran = $request->peran;

        if ($request->filled('kata_sandi')) {
            $akun->kata_sandi = Hash::make($request->kata_sandi);
        }

        $akun->save();

        return redirect()->route('owner.list_user')->with('success', 'Akun berhasil diubah!');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:pengguna',
            'kata_sandi' => 'required|min:6',
            'peran' => 'required'
        ]);

        Pengguna::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'kata_sandi' => Hash::make($request->kata_sandi),
            'peran' => $request->peran
        ]);

        return redirect()->route('owner.list_user')->with('success', 'Akun berhasil ditambahkan');
    }

    public function destroy($id)
    {
        Pengguna::findOrFail($id)->delete();

        return redirect()->route('owner.list_user')->with('success', 'Akun berhasil dihapus');
    }
}
