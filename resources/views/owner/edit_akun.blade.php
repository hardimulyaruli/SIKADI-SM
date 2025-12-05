@extends('layouts.sidebar')

@section('content')
<h2>✏️ Edit Akun</h2>

<div class="card p-4">

    <form action="{{ route('owner.update_user', $akun->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Nama</label>
        <input type="text" name="nama" value="{{ $akun->nama }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" value="{{ $akun->email }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Peran</label>
        <select name="peran" class="form-control" required>
            <option value="owner" {{ $akun->peran == 'owner' ? 'selected' : '' }}>Owner</option>
            <option value="keuangan" {{ $akun->peran == 'keuangan' ? 'selected' : '' }}>Keuangan</option>
            <option value="distribusi" {{ $akun->peran == 'distribusi' ? 'selected' : '' }}>Distribusi</option>
        </select>
    </div>

    <div class="mb-3">
        <label>Password Baru (Opsional)</label>
        <input type="password" name="kata_sandi" class="form-control">
        <small>Kosongkan jika tidak ingin mengganti password.</small>
    </div>

    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
</form>

</div>
@endsection
