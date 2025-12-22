@extends('layouts.sidebar')

@section('content')
    <style>
        .page-header {
            margin-bottom: 24px;
        }

        .table-wrapper {
            overflow-x: auto;
            border-radius: 14px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.05);
        }

        .table-modern {
            width: 100%;
            border-collapse: collapse;
        }

        .table-modern th {
            padding: 12px 14px;
            text-align: left;
            background: rgba(14, 165, 233, 0.08);
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: .03em;
        }

        .table-modern td {
            padding: 11px 14px;
            border-top: 1px solid rgba(226, 232, 240, 0.7);
            font-size: 13px;
        }

        .card-glass-soft {
            background: #fff;
            border-radius: 16px;
            padding: 18px 20px;
            box-shadow: 0 3px 16px rgba(148, 163, 184, 0.16);
            margin-bottom: 18px;
        }

        .form-inline {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .form-inline .form-group {
            flex: 1;
            min-width: 180px;
        }

        .form-inline input,
        .form-inline textarea {
            width: 100%;
        }

        .text-muted {
            color: #6b7280;
            font-size: 12px;
        }
    </style>

    <div class="page-header">
        <h1 style="font-size:24px; font-weight:700; color:#111827;"><i class="ri-team-line" style="color:#0ea5e9;"></i> Data
            Karyawan</h1>
        <p class="text-muted">Kelola daftar karyawan dan tambah karyawan baru.</p>
    </div>

    <div class="card-glass-soft">
        <h5 style="font-weight:600; color:#0f172a; margin-bottom:12px;">Tambah Karyawan Baru</h5>
        <form action="{{ route('owner.karyawan.store') }}" method="POST" class="form-inline">
            @csrf
            <div class="form-group">
                <label class="text-muted">Nama *</label>
                <input type="text" name="nama" class="form-control" required placeholder="Nama karyawan"
                    value="{{ old('nama') }}">
            </div>
            <div class="form-group">
                <label class="text-muted">Jabatan</label>
                <select name="jabatan" class="form-control">
                    <option value="">-- Pilih Jabatan --</option>
                    @php $jabatanOptions = ['produksi','keuangan','distribusi']; @endphp
                    @foreach ($jabatanOptions as $opt)
                        <option value="{{ $opt }}" {{ old('jabatan') === $opt ? 'selected' : '' }}>
                            {{ ucfirst($opt) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="text-muted">No HP</label>
                <input type="text" name="no_hp" class="form-control" placeholder="No HP" value="{{ old('no_hp') }}">
            </div>
            <div class="form-group">
                <label class="text-muted">Alamat</label>
                <input type="text" name="alamat" class="form-control" placeholder="Alamat" value="{{ old('alamat') }}">
            </div>
            <div class="form-group">
                <label class="text-muted">Gaji</label>
                <input type="number" name="gaji" class="form-control" min="0" step="1000" placeholder="Gaji"
                    value="{{ old('gaji') }}" required>
            </div>
            <div class="form-group" style="align-self:flex-end;">
                <button type="submit" class="btn-modern btn-primary-modern" style="padding:10px 18px;">Simpan</button>
            </div>
        </form>
        @if ($errors->any())
            <div class="text-danger mt-2" style="font-size:12px;">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif
        @if (session('success'))
            <div class="text-success mt-2" style="font-size:12px;">{{ session('success') }}</div>
        @endif
    </div>

    <div class="card-glass-soft">
        <h5 style="font-weight:600; color:#0f172a; margin-bottom:12px;">Daftar Karyawan</h5>
        @if (($karyawans ?? collect())->count() > 0)
            <div class="table-wrapper">
                <table class="table-modern">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>No HP</th>
                            <th>Alamat</th>
                            <th>Gaji Terbaru</th>
                            <th>Aksi</th>
                            <th>Dibuat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($karyawans as $k)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $k->nama }}</td>
                                <td>{{ $k->jabatan ?? '-' }}</td>
                                <td>{{ $k->no_hp ?? '-' }}</td>
                                <td>{{ $k->alamat ?? '-' }}</td>
                                <td>
                                    @php $g = $gajiMap[$k->id] ?? null; @endphp
                                    {{ $g ? 'Rp ' . number_format($g->jumlah_gaji, 0, ',', '.') : '-' }}
                                </td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('owner.karyawan.edit', $k->id) }}"
                                            class="btn btn-sm btn-outline-primary">Edit</a>
                                        <form action="{{ route('owner.karyawan.destroy', $k->id) }}" method="POST"
                                            onsubmit="return confirm('Hapus karyawan ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                                <td>{{ optional($k->created_at)->format('d M Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-muted">Belum ada data karyawan.</p>
        @endif
    </div>
@endsection
