@extends('layouts.sidebar')

@section('content')
<h1>Tambah Akun</h1>

<form action="#" method="POST">
    @csrf
    <div class="mb-3">
        <label for="nama" class="form-label">Nama</label>
        <input type="text" class="form-control" id="nama" name="nama">
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email">
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Kata Sandi</label>
        <input type="password" class="form-control" id="password" name="password">
    </div>

    <div class="mb-3">
        <label for="peran" class="form-label">Peran</label>
        <select class="form-control" name="peran">
            <option value="owner">Owner</option>
            <option value="keuangan">Keuangan</option>
            <option value="distribusi">Distribusi</option>
        </select>
    </div>

    <button class="btn btn-primary">Simpan</button>
</form>
@endsection
