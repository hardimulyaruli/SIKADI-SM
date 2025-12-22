@extends('layouts.sidebar')

@section('content')
    <style>
        .page-header {
            margin-bottom: 18px;
        }

        .page-header h1 {
            font-weight: 800;
            font-size: 26px;
            color: #111827;
            margin-bottom: 6px;
        }

        .page-header p {
            margin: 0;
            color: #6b7280;
        }

        .btn-primary-soft {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: linear-gradient(135deg, #0ea5e9, #38bdf8);
            color: #fff;
            border: none;
            border-radius: 12px;
            padding: 12px 16px;
            font-weight: 800;
            box-shadow: 0 16px 36px rgba(56, 189, 248, 0.25);
            text-decoration: none;
            margin-bottom: 14px;
        }

        .table-card {
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 8px 24px rgba(148, 163, 184, 0.18);
            overflow: hidden;
            max-width: 1100px;
            margin: 0 auto;
        }

        .table-modern {
            width: 100%;
            border-collapse: collapse;
        }

        .table-modern thead th {
            background: #f0f9ff;
            color: #0f172a;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 14px 16px;
        }

        .table-modern tbody td {
            padding: 16px;
            border-top: 1px solid #f1f5f9;
            font-size: 14px;
            color: #0f172a;
        }

        .badge-role {
            display: inline-block;
            padding: 7px 12px;
            border-radius: 999px;
            font-weight: 700;
            font-size: 13px;
            color: #0f172a;
            background: rgba(14, 165, 233, 0.16);
            text-transform: capitalize;
        }

        .actions {
            display: flex;
            gap: 8px;
        }

        .btn-chip {
            border: none;
            border-radius: 12px;
            padding: 10px 13px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn-edit {
            background: rgba(14, 165, 233, 0.15);
            color: #0ea5e9;
        }

        .btn-delete {
            background: rgba(248, 113, 113, 0.12);
            color: #dc2626;
        }
    </style>

    <div class="page-header">
        <h1><i class="fas fa-users"></i> Daftar Akun</h1>
        <p>Kelola akun pengguna sistem</p>
    </div>

    <a href="{{ route('owner.add_user') }}" class="btn-primary-soft">
        <i class="fas fa-plus"></i> Tambah Akun
    </a>

    <div class="table-card">
        <table class="table-modern">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Peran</th>
                    <th style="width:160px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($akun as $a)
                    <tr>
                        <td>{{ $a->nama }}</td>
                        <td>{{ $a->email }}</td>
                        <td>
                            <span class="badge-role">{{ $a->peran }}</span>
                        </td>
                        <td>
                            <div class="actions">
                                <a href="{{ route('owner.edit_user', $a->id) }}" class="btn-chip btn-edit">
                                    <i class="fas fa-pen"></i> Edit
                                </a>
                                <form action="{{ route('owner.delete_user', $a->id) }}" method="POST"
                                    style="display:inline;" onsubmit="return confirm('Hapus akun ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-chip btn-delete"><i class="fas fa-trash"></i>
                                        Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
