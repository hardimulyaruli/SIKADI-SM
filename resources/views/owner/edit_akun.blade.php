@extends('layouts.sidebar')

@section('content')

<div class="page-header">
    <h1>✏️ Edit Akun</h1>
    <p>Ubah informasi akun pengguna</p>
</div>

<div class="card-form" style="max-width: 600px;">
    <form action="{{ route('owner.update_user', $akun->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group-custom">
            <label for="nama">Nama</label>
            <input type="text" id="nama" name="nama" value="{{ $akun->nama }}" required>
        </div>

        <div class="form-group-custom">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ $akun->email }}" required>
        </div>

        <div class="form-group-custom">
            <label for="peran">Peran</label>
            <select id="peran" name="peran" required>
                <option value="owner" {{ $akun->peran == 'owner' ? 'selected' : '' }}>Owner</option>
                <option value="keuangan" {{ $akun->peran == 'keuangan' ? 'selected' : '' }}>Keuangan</option>
                <option value="distribusi" {{ $akun->peran == 'distribusi' ? 'selected' : '' }}>Distribusi</option>
            </select>
        </div>

        <div class="form-group-custom">
            <label for="password">Password Baru (Opsional)</label>
            <input type="password" id="password" name="kata_sandi" placeholder="Kosongkan jika tidak ingin mengganti">
            <div class="form-text">Hanya isi jika ingin mengganti password</div>
        </div>

        <button type="submit" class="btn-submit">💾 Simpan Perubahan</button>
    </form>
</div>

@endsection
