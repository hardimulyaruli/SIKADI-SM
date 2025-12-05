@extends('layouts.sidebar')

@section('content')
<h2>➕ Tambah Akun</h2>

<div class="card p-4">
    <form>
        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Peran</label>
            <select class="form-control">
                <option value="owner">Owner</option>
                <option value="keuangan">Keuangan</option>
                <option value="distribusi">Distribusi</option>
            </select>
        </div>

        <button class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
