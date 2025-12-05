@extends('layouts.sidebar')

@section('content')
<h2>📄 Daftar Akun</h2>

<a href="{{ route('akun.create') }}" class="btn btn-primary mb-3">+ Tambah Akun</a>

<div class="card p-4">
    <table class="table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Peran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($akun as $a)
                <tr>
                    <td>{{ $a->name }}</td>
                    <td>{{ $a->email }}</td>
                    <td>{{ $a->role ?? '-' }}</td>
                    <td>
                        <a href="{{ route('akun.edit', $a->id) }}" class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('akun.destroy', $a->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Tidak ada data akun</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
