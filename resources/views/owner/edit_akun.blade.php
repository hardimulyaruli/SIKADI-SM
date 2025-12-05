@extends('layouts.sidebar')

@section('content')
<h2>✏️ Edit Akun</h2>

<div class="card p-4">

    <form action="{{ route('owner.update_user', $akun->id) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ $akun->nama }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ $akun->email }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Role / Peran</label>
            <select name="peran" class="form-control" required>
                <option value="owner" {{ $akun->peran == 'owner' ? 'selected' : '' }}>Owner</option>
                <option value="keuangan" {{ $akun->peran == 'keuangan' ? 'selected' : '' }}>Keuangan</option>
                <option value="distribusi" {{ $akun->peran == 'distribusi' ? 'selected' : '' }}>Distribusi</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Password Baru (opsional)</label>
            <input type="password" name="kata_sandi" class="form-control" placeholder="Kosongkan jika tidak diganti">
        </div>

        <button class="btn btn-primary">💾 Simpan Perubahan</button>
        <a href="{{ route('owner.list_user') }}" class="btn btn-secondary">Kembali</a>

    </form>

</div>
@endsection
