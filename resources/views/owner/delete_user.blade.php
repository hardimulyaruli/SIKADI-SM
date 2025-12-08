@extends('layouts.sidebar')

@section('content')

<style>
    .page-header {
        margin-bottom: 40px;
    }

    .page-header h1 {
        font-size: 32px;
        font-weight: 700;
        color: #2d2d2d;
        margin-bottom: 8px;
    }

    .page-header p {
        color: #8a7a9e;
        font-size: 14px;
    }

    .table-wrapper {
        background: rgba(255, 255, 255, 0.85);
        border: 1px solid rgba(122, 92, 219, 0.15);
        border-radius: 20px;
        padding: 0;
        box-shadow: 0 4px 15px rgba(122, 92, 219, 0.08);
        overflow: hidden;
    }

    .table-wrapper table {
        margin: 0;
    }

    .table-wrapper thead {
        background: linear-gradient(135deg, rgba(122, 92, 219, 0.1) 0%, rgba(147, 112, 219, 0.1) 100%);
        border-bottom: 2px solid rgba(122, 92, 219, 0.2);
    }

    .table-wrapper thead th {
        padding: 16px 20px;
        color: #5a4a7a;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 12px;
        letter-spacing: 0.5px;
        border: none;
    }

    .table-wrapper tbody tr {
        border-bottom: 1px solid rgba(122, 92, 219, 0.1);
        transition: all 0.3s ease;
    }

    .table-wrapper tbody tr:hover {
        background: rgba(122, 92, 219, 0.05);
    }

    .table-wrapper tbody td {
        padding: 16px 20px;
        color: #4a4a6a;
        font-size: 14px;
        border: none;
    }

    .btn-delete {
        background: rgba(230, 126, 126, 0.15);
        color: #e67e7e;
        border: none;
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-delete:hover {
        background: rgba(230, 126, 126, 0.3);
    }
</style>

<div class="page-header">
    <h1>❌ Hapus Akun</h1>
    <p>Pilih akun yang ingin dihapus dari sistem</p>
</div>

<div class="table-wrapper">
    <table class="table table-hover">
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
                    <span style="background: rgba(122, 92, 219, 0.1); color: #7c5cdb; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;">
                        {{ $user->peran }}
                    </span>
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
