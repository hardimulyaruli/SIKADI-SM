@extends('layouts.sidebar')

@section('content')
<h2>❌ Hapus Akun</h2>
<p>Pilih akun yang ingin dihapus.</p>

<table class="table table-bordered mt-3">
    <thead class="table-dark">
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
            <td>{{ $user->peran }}</td>
            <td>
                <form method="POST" action="{{ route('owner.delete_user_action', $user->id) }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
