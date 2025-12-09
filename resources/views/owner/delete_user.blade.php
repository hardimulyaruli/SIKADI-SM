@extends('layouts.sidebar')

@section('content')

<div class="page-header">
    <h1>❌ Hapus Akun</h1>
    <p>Pilih akun yang ingin dihapus dari sistem</p>
</div>

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
            @foreach($users ?? [] as $user)
            <tr>
                <td>{{ $user->nama }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <span class="badge-custom">{{ $user->peran }}</span>
                </td>
                <td>
                    <form method="POST" action="{{ route('owner.delete_user_action', $user->id) }}" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete" onclick="return confirm('Hapus akun ini secara permanen?')">
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
