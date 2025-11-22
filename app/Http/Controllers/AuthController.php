<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginPage()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
            'selected_role' => 'required'
        ]);

        // Cari user berdasarkan email
        $user = User::where('email', $request->email)->first();

        // Jika user tidak ditemukan atau password salah
        if (!$user || !Hash::check($request->password, $user->kata_sandi)) {
            return back()->with('error', 'Email atau password salah!');
        }

        // Validasi role sesuai akun
        if ($request->selected_role !== $user->peran) {
            return back()->with('error', 'Role tidak sesuai dengan akun!');
        }

        // Login manual
        Auth::login($user);

        // Redirect sesuai perannya
        return match($user->peran) {
            'owner' => redirect()->route('owner.dashboard'),
            'keuangan' => redirect()->route('keuangan.dashboard'),
            'distribusi' => redirect()->route('distribusi.dashboard'),
            default => redirect()->route('login.page')
        };
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.page');
    }
}
