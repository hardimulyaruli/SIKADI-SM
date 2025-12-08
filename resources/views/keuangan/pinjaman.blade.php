@extends('layouts.sidebar')

@section('content')

<style>
    .container-custom {
        background: linear-gradient(135deg, #6a5bd1, #8b46c7);
        padding: 25px;
        border-radius: 15px;
        color: #fff;
    }

    .section-box {
        background: rgba(255, 255, 255, 0.12);
        padding: 20px;
        border-radius: 15px;
        backdrop-filter: blur(5px);
        margin-bottom: 20px;
    }

    .section-title {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 15px;
        color: #ffeb3b;
    }

    .form-control {
        background: rgba(255, 255, 255, 0.2);
        border: none;
        color: #fff;
    }

    .form-control::placeholder {
        color: #ddd;
    }

    .form-label {
        font-size: 14px;
        color: #fff;
        margin-bottom: 8px;
        font-weight: 500;
    }

    .form-control:focus {
        background: rgba(255, 255, 255, 0.3);
        border-color: #00c3ff;
        color: #fff;
        box-shadow: 0 0 8px rgba(0, 195, 255, 0.3);
    }

    .btn-custom {
        border: none;
        padding: 8px 18px;
        border-radius: 8px;
        font-weight: bold;
    }

    .btn-save {
        background: #00c3ff;
        color: #fff;
    }

    .table tbody tr {
        border-bottom: 1px solid rgba(255, 255, 255, 0.15);
    }

    .table tbody tr:hover {
        background: rgba(255, 255, 255, 0.08);
    }

    .table-custom {
        background: rgba(255, 255, 255, 0.12);
        border-radius: 15px;
        overflow: hidden;
        color: white;
    }

    .table thead {
        background: rgba(255, 255, 255, 0.2);
    }

    .table td, .table th {
        color: #fff;
    }
</style>

<div class="container-custom">

    <h2 class="mb-1 text-warning">Kelola Data Pinjaman</h2>
    <p>Kelola data pinjaman karyawan dengan mudah dan cepat.</p>

    <!-- BOX FORM INPUT PINJAMAN -->
    <div class="section-box">

        <h4 class="section-title mb-4">💼 Form Input Pinjaman</h4>
        <form action="{{ route('keuangan.pinjaman.store') }}" method="POST" class="p-3 rounded shadow" style="background:rgba(255,255,255,0.08);">
            @csrf
            <div class="row g-3">
                <div class="col-md-6 mb-3">
                    <label for="karyawan_id" class="form-label">Pilih Karyawan</label>
                    <select name="karyawan_id" class="form-control" id="karyawan_id" required>
                        <option value="">-- Pilih Karyawan --</option>
                        @foreach(App\Models\Karyawan::all() as $karyawan)
                            <option value="{{ $karyawan->id }}">{{ $karyawan->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="jumlah_pinjaman" class="form-label">Jumlah Pinjaman</label>
                    <input type="number" class="form-control" id="jumlah_pinjaman" name="jumlah_pinjaman" placeholder="Masukkan jumlah pinjaman" min="0" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="tanggal" class="form-label">Tanggal Pinjaman</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan pinjaman (opsional)">
                </div>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-custom btn-save px-5">Simpan</button>
            </div>
        </form>

    </div>

    <!-- TABEL RIWAYAT PINJAMAN -->
    <div class="section-box">
        <h4 class="section-title mb-4">📋 Riwayat Pinjaman</h4>

        <div class="table-responsive">
            <table class="table table-custom table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="color: #333;">Tanggal</th>
                        <th style="color: #333;">Nama Karyawan</th>
                        <th style="color: #333;">Jumlah Pinjaman</th>
                        <th style="color: #333;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @if($pinjaman->count() > 0)
                        @foreach($pinjaman as $item)
                        <tr>
                            <td style="color: #e0e0e0;">{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                            <td style="color: #e0e0e0;">{{ $item->karyawan?->nama ?? '-' }}</td>
                            <td style="color: #e0e0e0;">Rp {{ number_format($item->jumlah_pinjaman, 0, ',', '.') }}</td>
                            <td>
                                @if($item->status === 'belum_lunas')
                                    <span class="badge bg-warning">Belum Lunas</span>
                                @else
                                    <span class="badge bg-success">Lunas</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4" style="color: #e0e0e0; text-align: center; padding: 20px;">Belum ada data pinjaman</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection
