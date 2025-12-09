@extends('layouts.sidebar')

@section('content')

<div class="page-header">
    <h1>👥 Daftar Akun</h1>
    <p>Kelola akun pengguna sistem</p>
</div>

<a href="{{ route('owner.add_user') }}" class="btn-add">
    ➕ Tambah Akun
</a>

<div class="table-wrapper">
    <table class="table-modern">
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
                <td>
                    <span class="badge-custom">{{ $a->peran }}</span>
                </td>
                <td>
                    <a href="{{ route('owner.edit_user', $a->id) }}" class="btn-action btn-edit">
                        ✏️ Edit
                    </a>
                    <form action="{{ route('owner.delete_user', $a->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-action btn-delete" onclick="return confirm('Hapus akun ini?')">
                            🗑️ Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
