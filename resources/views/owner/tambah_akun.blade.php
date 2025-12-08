@extends('layouts.sidebar')

@section('content')

<style>
    .page-header {
        margin-bottom: 40px;
    }

    .page-header h1 {
        font-size: 32px;
        font-weight: 700;
        color: #2d2d2d;
        margin-bottom: 8px;
    }

    .card-form {
        background: rgba(255, 255, 255, 0.85);
        border: 1px solid rgba(122, 92, 219, 0.15);
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 4px 15px rgba(122, 92, 219, 0.08);
    }

    .form-group-custom label {
        display: block;
        color: #5a4a7a;
        font-weight: 600;
        margin-bottom: 10px;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .form-group-custom input,
    .form-group-custom select {
        width: 100%;
        background: rgba(255, 255, 255, 0.9);
        border: 1px solid rgba(122, 92, 219, 0.2);
        border-radius: 12px;
        padding: 12px 16px;
        color: #2d2d2d;
        font-size: 14px;
        margin-bottom: 20px;
        transition: all 0.3s ease;
    }

    .form-group-custom input::placeholder,
    .form-group-custom select::placeholder {
        color: rgba(122, 92, 219, 0.5);
    }

    .form-group-custom input:focus,
    .form-group-custom select:focus {
        outline: none;
        background: rgba(255, 255, 255, 1);
        border-color: #7c5cdb;
        box-shadow: 0 0 0 3px rgba(122, 92, 219, 0.1);
    }

    .btn-submit {
        background: linear-gradient(135deg, #7c5cdb 0%, #6b4db8 100%);
        color: white;
        border: none;
        padding: 14px 40px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(122, 92, 219, 0.3);
    }

    .btn-submit:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(122, 92, 219, 0.4);
        color: white;
    }
</style>

<div class="page-header">
    <h1>➕ Tambah Akun</h1>
    <p>Buat akun pengguna baru dalam sistem</p>
</div>

<div class="card-form" style="max-width: 600px;">
    <form action="{{ route('owner.store_user') }}" method="POST">
        @csrf

        <div class="form-group-custom">
            <label for="nama">Nama</label>
            <input type="text" id="nama" name="nama" placeholder="Masukkan nama lengkap" required>
        </div>

        <div class="form-group-custom">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Masukkan email" required>
        </div>

        <div class="form-group-custom">
            <label for="password">Password</label>
            <input type="password" id="password" name="kata_sandi" placeholder="Masukkan password" required>
        </div>

        <div class="form-group-custom">
            <label for="peran">Peran</label>
            <select id="peran" name="peran" required>
                <option value="">-- Pilih Peran --</option>
                <option value="owner">Owner</option>
                <option value="keuangan">Keuangan</option>
                <option value="distribusi">Distribusi</option>
            </select>
        </div>

        <button type="submit" class="btn-submit">
            💾 Simpan Akun
        </button>
    </form>
</div>

@endsection
