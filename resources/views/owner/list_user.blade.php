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
            @foreach($akun as $a)
            <tr>
                <td>{{ $a->nama }}</td>
                <td>{{ $a->email }}</td>
                <td>{{ $a->peran }}</td>
                <td>
                    <a href="{{ route('owner.edit_user', $a->id) }}" class="btn btn-warning btn-sm">
    Edit
</a>
                    <form action="{{ route('owner.delete_user', $a->id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus akun ini?')">
        Hapus
    </button>
</form>
                </td>
            </tr>
            @endforeach
        </tbody>

    </table>

</div>
@endsection
