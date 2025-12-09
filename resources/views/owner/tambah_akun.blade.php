@extends('layouts.sidebar')

@section('content')

<div class="page-header">
    <h1>➕ Tambah Akun</h1>
    <p>Buat akun pengguna baru dalam sistem</p>
</div>

<div class="card-form" style="max-width: 600px;">
    <form action="{{ route('owner.store_user') }}" method="POST">
        @csrf

        <div class="form-group-custom">
            <label for="nama">Nama</label>
            <input type="text" id="nama" name="nama" class="input-modern" placeholder="Masukkan nama lengkap" required>
        </div>

        <div class="form-group-custom">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="input-modern" placeholder="Masukkan email" required>
        </div>

        <div class="form-group-custom">
            <label for="password">Password</label>
            <input type="password" id="password" name="kata_sandi" class="input-modern" placeholder="Masukkan password" required>
        </div>

        <div class="form-group-custom">
            <label for="peran">Peran</label>
            <select id="peran" name="peran" class="input-modern" required>
                <option value="">-- Pilih Peran --</option>
                <option value="owner">Owner</option>
                <option value="keuangan">Keuangan</option>
                <option value="distribusi">Distribusi</option>
            </select>
        </div>

        <button type="submit" class="btn-modern btn-primary-modern">
            <i class="ri-save-line"></i> Simpan Akun
        </button>
    </form>
</div>

@endsection
