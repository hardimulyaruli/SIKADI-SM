@extends('layouts.sidebar')

@section('content')
<h2>📄 Daftar Akun</h2>

<a href="{{ route('owner.add_user') }}" class="btn btn-primary mb-3">
    ➕ Tambah Akun
</a>

<div class="card p-4">

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Peran</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>Owner SIKADI</td>
                <td>owner@sikadi.com</td>
                <td>owner</td>
                <td>
                    <button class="btn btn-warning btn-sm">Edit</button>
                    <button class="btn btn-danger btn-sm">Hapus</button>
                </td>
            </tr>
        </tbody>
    </table>

</div>
@endsection
