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

    .btn-add {
        background: linear-gradient(135deg, #7c5cdb 0%, #6b4db8 100%);
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(122, 92, 219, 0.3);
        text-decoration: none;
        display: inline-block;
        margin-bottom: 30px;
    }

    .btn-add:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(122, 92, 219, 0.4);
        color: white;
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

    .btn-action {
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        cursor: pointer;
        transition: all 0.3s ease;
        border: none;
        text-decoration: none;
        display: inline-block;
    }

    .btn-edit {
        background: rgba(122, 92, 219, 0.15);
        color: #7c5cdb;
        margin-right: 8px;
    }

    .btn-edit:hover {
        background: rgba(122, 92, 219, 0.3);
    }

    .btn-delete {
        background: rgba(230, 126, 126, 0.15);
        color: #e67e7e;
    }

    .btn-delete:hover {
        background: rgba(230, 126, 126, 0.3);
    }
</style>

<div class="page-header">
    <h1>👥 Daftar Akun</h1>
    <p>Kelola akun pengguna sistem</p>
</div>

<a href="{{ route('owner.add_user') }}" class="btn-add">
    ➕ Tambah Akun
</a>

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
            @foreach($akun as $a)
            <tr>
                <td>{{ $a->nama }}</td>
                <td>{{ $a->email }}</td>
                <td>
                    <span style="background: rgba(122, 92, 219, 0.1); color: #7c5cdb; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;">
                        {{ $a->peran }}
                    </span>
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
