@extends('layouts.sidebar')

@section('content')
<h2>➕ Tambah Akun</h2>

<div class="card p-4">
    <form action="{{ route('owner.store_user') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="kata_sandi" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Peran</label>
            <select name="peran" class="form-control" required>
                <option value="owner">Owner</option>
                <option value="keuangan">Keuangan</option>
                <option value="distribusi">Distribusi</option>
            </select>
        </div>

        <button class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
