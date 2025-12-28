@extends('layouts.sidebar')

@section('content')

    <style>
        .page-header {
            margin-bottom: 40px;
            animation: slideInUp 0.6s ease;
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

        .form-section {
            display: flex;
            gap: 20px;
            margin-bottom: 40px;
            flex-wrap: wrap;
        }

        .form-group-custom {
            flex: 1;
            min-width: 250px;
        }

        .form-group-custom label {
            display: block;
            color: #5a4a7a;
            font-weight: 600;
            margin-bottom: 10px;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-group-custom input,
        .form-group-custom select {
            width: 100%;
            background: #ffffff;
            border: 1px solid rgba(56, 189, 248, 0.15);
            border-radius: 10px;
            padding: 12px 16px;
            color: #1f2937;
            font-size: 14px;
        }

        .form-group-custom input::placeholder,
        .form-group-custom select::placeholder {
            color: rgba(31, 41, 55, 0.45);
        }

        .form-group-custom input:focus,
        .form-group-custom select:focus {
            outline: none;
            background: #ffffff;
            border-color: #38bdf8;
            box-shadow: none;
        }

        .btn-submit {
            align-self: flex-end;
        }

        .table-wrapper {
            overflow-x: auto;
            border-radius: 20px;
            box-shadow: 0 4px 15px rgba(122, 92, 219, 0.08);
        }

        .table-modern {
            border-collapse: collapse;
            width: 100%;
        }

        .table-modern thead {
            background: linear-gradient(135deg, rgba(14, 165, 233, 0.06) 0%, rgba(3, 105, 161, 0.04) 100%);
            border-bottom: 2px solid rgba(14, 165, 233, 0.08);
        }

        .table-modern thead th {
            padding: 18px 20px;
            color: #0f172a;
            font-weight: 700;
            text-align: left;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
        }

        .table-modern tbody tr {
            border-bottom: 1px solid rgba(148, 163, 184, 0.06);
        }

        .table-modern tbody tr:hover {
            background: rgba(14, 165, 233, 0.04);
        }

        .table-modern tbody td {
            padding: 16px 20px;
            color: #374151;
            font-size: 14px;
        }

        .badge-modern {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge-pending {
            background: linear-gradient(135deg, rgba(218, 165, 32, 0.15) 0%, rgba(184, 165, 209, 0.15) 100%);
            color: #b8a5d1;
            border: 1px solid rgba(184, 165, 209, 0.3);
        }

        .badge-paid {
            background: linear-gradient(135deg, rgba(122, 92, 219, 0.15) 0%, rgba(147, 112, 219, 0.15) 100%);
            color: #7c5cdb;
            border: 1px solid rgba(122, 92, 219, 0.3);
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #8a7a9e;
        }

        .empty-state i {
            font-size: 48px;
            margin-bottom: 20px;
            opacity: 0.3;
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 768px) {
            .form-section {
                flex-direction: column;
            }

            .btn-submit {
                width: 100%;
            }
        }
    </style>

    <!-- PAGE HEADER -->
    <div class="page-header">
        <h1><i class="fas fa-hand-holding-usd"></i> Kelola Data Pinjaman</h1>
        <p>Kelola data pinjaman </p>
    </div>

    <!-- FORM INPUT PINJAMAN -->
    <div class="card-glass" style="margin-bottom: 40px;">
        <h3 style="margin-bottom: 30px; font-size: 18px; font-weight: 600;">
            <i class="fas fa-plus-circle"></i> Form Input Pinjaman
        </h3>

        <form action="{{ route('keuangan.pinjaman.store') }}" method="POST">
            @csrf

            <div class="form-section">
                <div class="form-group-custom">
                    <label for="karyawan_id">Pilih Karyawan</label>
                    <select name="karyawan_id" id="karyawan_id" required>
                        <option value="">-- Pilih Karyawan --</option>
                        @foreach (App\Models\Karyawan::all() as $karyawan)
                            <option value="{{ $karyawan->id }}">{{ $karyawan->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group-custom">
                    <label for="jumlah_pinjaman">Jumlah Pinjaman (Rp)</label>
                    <input type="number" id="jumlah_pinjaman" name="jumlah_pinjaman" placeholder="Masukkan nominal"
                        min="0" step="10000" required>
                </div>

                <div class="form-group-custom">
                    <label for="tanggal">Tanggal Pinjaman</label>
                    <input type="date" id="tanggal" name="tanggal" required>
                </div>

                <div class="form-group-custom">
                    <label for="keterangan">Keterangan</label>
                    <input type="text" id="keterangan" name="keterangan" placeholder="Catatan pinjaman (opsional)">
                </div>
            </div>

            <button type="submit" class="btn-modern btn-primary-modern">
                <i class="ri-add-line"></i> Tambah Pinjaman
            </button>
        </form>
    </div>

    <!-- TABEL RIWAYAT PINJAMAN -->
    <div class="card-glass" style="padding: 0;">
        <div style="padding: 30px; border-bottom: 1px solid rgba(255, 255, 255, 0.1);">
            <h3 style="margin: 0; font-size: 18px; font-weight: 600;">
                <i class="fas fa-list-check"></i> Riwayat Pinjaman
            </h3>
        </div>

        @if ($pinjaman->count() > 0)
            <div class="table-wrapper">
                <table class="table-modern">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Nama Karyawan</th>
                            <th>Jumlah Pinjaman</th>
                            <th>Keterangan</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (($pinjaman ?? collect())->sortByDesc('created_at') as $item)
                            <tr>
                                <td>
                                    <span class="badge-modern"
                                        style="background: rgba(102, 126, 234, 0.2); color: #a5b4fc;">
                                        {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                                    </span>
                                </td>
                                <td>{{ $item->karyawan?->nama ?? '-' }}</td>
                                <td style="font-weight: 600;">Rp {{ number_format($item->jumlah_pinjaman, 0, ',', '.') }}
                                </td>
                                <td style="color: rgba(255, 255, 255, 0.6); font-size: 13px;">{{ $item->keterangan ?? '-' }}
                                </td>
                                <td>
                                    @if ($item->status === 'belum_lunas')
                                        <span class="badge-modern badge-pending">
                                            <i class="fas fa-hourglass-half"></i> Belum Lunas
                                        </span>
                                    @else
                                        <span class="badge-modern badge-paid">
                                            <i class="fas fa-check-circle"></i> Lunas
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-inbox"></i>
                <p>Belum ada data pinjaman</p>
                <p style="font-size: 12px; opacity: 0.6;">Mulai dengan mengisi form di atas untuk menambahkan data pinjaman
                </p>
            </div>
        @endif
    </div>

    <script>
        // Set default date to today
        document.getElementById('tanggal').valueAsDate = new Date();

        // GSAP animations disabled - prevent content from disappearing

        // Table row animations disabled - prevent content from disappearing
    </script>

@endsection
