@extends('layouts.sidebar')

@section('content')
    <style>
        .page-header {
            margin-bottom: 20px;
        }

        .page-header h1 {
            font-weight: 700;
            margin-bottom: 6px;
        }

        .page-header p {
            color: #6b7280;
            margin: 0;
        }

        .card-glass {
            background: #fff;
            border-radius: 14px;
            padding: 18px 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
            max-width: 900px;
            margin: 0 auto;
        }

        .table-modern {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .table-modern th,
        .table-modern td {
            padding: 12px 10px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 13px;
        }

        .table-modern thead th {
            background: #f8fafc;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            font-size: 11px;
        }

        .btn-danger-modern {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 8px 12px;
            font-weight: 700;
            box-shadow: 0 8px 20px rgba(239, 68, 68, 0.25);
        }
    </style>

    <div class="page-header">
        <h1><i class="fas fa-user-slash"></i> Hapus Akun</h1>
        <p>Pilih akun yang akan dihapus</p>
    </div>

    <div class="card-glass">
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
                @forelse($akun as $item)
                    <tr>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ ucfirst($item->peran) }}</td>
                        <td>
                            <form action="{{ route('owner.delete_user', $item->id) }}" method="POST"
                                onsubmit="return confirm('Yakin hapus akun ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-danger-modern"><i class="fas fa-trash"></i> Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="text-align:center; color:#9ca3af; padding:14px;">Belum ada akun</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
