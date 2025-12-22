@extends('layouts.sidebar')

@section('content')

    <style>
        .page-header {
            margin-bottom: 30px;
            animation: slideInUp 0.6s ease;
        }

        .page-header h1 {
            font-size: 30px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 6px;
        }

        .page-header p {
            color: #6b7280;
            font-size: 13px;
        }

        .tabs-wrapper {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .tab-btn {
            border-radius: 999px;
            padding: 8px 18px;
            border: 1px solid rgba(148, 163, 184, 0.6);
            background: #fff;
            color: #374151;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .tab-btn.active {
            background: linear-gradient(135deg, #38bdf8, #6366f1);
            color: #fff;
            border-color: transparent;
        }

        .card-glass-soft {
            background: #fff;
            border-radius: 18px;
            padding: 20px 24px;
            box-shadow: 0 4px 20px rgba(148, 163, 184, 0.16);
            margin-bottom: 22px;
        }

        .summary-badges {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .summary-pill {
            border-radius: 999px;
            padding: 10px 16px;
            background: rgba(15, 118, 110, 0.03);
            border: 1px solid rgba(148, 163, 184, 0.45);
            font-size: 12px;
            color: #111827;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .summary-label {
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .03em;
            font-size: 11px;
            color: #6b7280;
        }

        .summary-value {
            font-weight: 700;
        }

        .table-wrapper {
            overflow-x: auto;
            border-radius: 14px;
            box-shadow: 0 2px 16px rgba(148, 163, 184, 0.18);
        }

        .table-modern {
            border-collapse: collapse;
            width: 100%;
        }

        .table-modern thead {
            background: linear-gradient(135deg, rgba(14, 165, 233, 0.06) 0%, rgba(3, 105, 161, 0.03) 100%);
        }

        .table-modern th {
            padding: 12px 16px;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: .05em;
            color: #0f172a;
            text-align: left;
        }

        .table-modern td {
            padding: 11px 16px;
            font-size: 13px;
            color: #374151;
            border-top: 1px solid rgba(226, 232, 240, 0.7);
        }

        .table-modern tbody tr:hover {
            background: rgba(191, 219, 254, 0.35);
        }

        .badge-status {
            padding: 5px 10px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 600;
        }

        .badge-status-success {
            background: rgba(16, 185, 129, 0.08);
            color: #047857;
        }

        .badge-status-danger {
            background: rgba(239, 68, 68, 0.08);
            color: #b91c1c;
        }

        .empty-state {
            text-align: center;
            padding: 36px 20px;
            color: #9ca3af;
            font-size: 13px;
        }

        .empty-state i {
            font-size: 36px;
            margin-bottom: 10px;
            opacity: .35;
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media(max-width:768px) {
            .summary-badges {
                flex-direction: column;
            }
        }
    </style>

    <div class="page-header">
        <h1><i class="fas fa-chart-line"></i> Laporan Keuangan</h1>
        <p>Pantau laporan penggajian (gaji & pinjaman) dan transaksi (pemasukan & pengeluaran) dalam satu halaman.</p>
    </div>

    <div class="tabs-wrapper">
        <button class="tab-btn active" data-target="tab-penggajian">
            <i class="fas fa-user-tie"></i>
            Laporan Penggajian
        </button>
        <button class="tab-btn" data-target="tab-transaksi">
            <i class="fas fa-exchange-alt"></i>
            Laporan Transaksi
        </button>
    </div>

    {{-- TAB PENGGAJIAN: GAJI & PINJAMAN --}}
    <div id="tab-penggajian" class="tab-pane" style="display:block;">
        <div class="card-glass-soft">
            <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                <div>
                    <h5 class="mb-1" style="font-weight:600; color:#111827;">Ringkasan Penggajian</h5>
                    <p class="mb-0" style="font-size:12px; color:#6b7280;">Total gaji yang diterima karyawan dan total
                        pinjaman yang tercatat.</p>
                </div>
                <div>
                    <a href="{{ route('keuangan.laporan.export.penggajian') }}" class="btn-modern btn-primary-modern"
                        style="font-size:12px; padding:6px 14px; border-radius:999px;">
                        <i class="fas fa-file-excel"></i> Export Excel
                    </a>
                </div>
            </div>
            <form method="GET" action="{{ route('keuangan.laporan') }}" class="d-flex gap-2 flex-wrap mb-3 align-items-end">
                <div>
                    <label style="font-size:12px; color:#6b7280;">Mulai</label>
                    <input type="date" name="pg_start_date" class="form-control" value="{{ $pgStart ?? '' }}">
                </div>
                <div>
                    <label style="font-size:12px; color:#6b7280;">Selesai</label>
                    <input type="date" name="pg_end_date" class="form-control" value="{{ $pgEnd ?? '' }}">
                </div>
                <button type="submit" class="btn-modern btn-primary-modern" style="font-size:12px; padding:8px 14px;">
                    Terapkan Filter
                </button>
            </form>
            <div class="summary-badges">
                <div class="summary-pill">
                    <span class="summary-label">Total Gaji Diterima</span>
                    <span class="summary-value">Rp {{ number_format($total_gaji_diterima ?? 0, 0, ',', '.') }}</span>
                </div>
                <div class="summary-pill">
                    <span class="summary-label">Total Pinjaman</span>
                    <span class="summary-value">Rp {{ number_format($total_pinjaman ?? 0, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <div class="card-glass-soft">
            <h6 style="font-weight:600; color:#111827; margin-bottom:10px;"><i class="fas fa-money-check-alt"
                    style="color:#6366f1;"></i> Riwayat Penggajian</h6>
            @if (($penggajian ?? collect())->count() > 0)
                <div class="table-wrapper">
                    <table class="table-modern">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Nama Karyawan</th>
                                <th>Tunjangan</th>
                                <th>Hari Tidak Masuk</th>
                                <th>Total Gaji Diterima</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($penggajian as $row)
                                <tr>
                                    <td>{{ optional($row->tanggal)->format('d M Y') }}</td>
                                    <td>{{ $row->karyawan->nama ?? '-' }}</td>
                                    <td>Rp {{ number_format($row->tunjangan ?? 0, 0, ',', '.') }}</td>
                                    <td>{{ $row->hari_tidak_masuk ?? 0 }} hari</td>
                                    <td style="font-weight:600; color:#7c5cdb;">Rp
                                        {{ number_format($row->total_gaji_diterima ?? 0, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="empty-state">
                    <i class="fas fa-inbox"></i>
                    <p>Belum ada data penggajian.</p>
                </div>
            @endif
        </div>

        <div class="card-glass-soft">
            <h6 style="font-weight:600; color:#111827; margin-bottom:10px;"><i class="fas fa-hand-holding-usd"
                    style="color:#f97316;"></i> Riwayat Pinjaman</h6>
            @if (($pinjaman ?? collect())->count() > 0)
                <div class="table-wrapper">
                    <table class="table-modern">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Nama Karyawan</th>
                                <th>Jumlah Pinjaman</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pinjaman as $row)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($row->tanggal)->format('d M Y') }}</td>
                                    <td>{{ $row->karyawan->nama ?? '-' }}</td>
                                    <td>Rp {{ number_format($row->jumlah_pinjaman ?? 0, 0, ',', '.') }}</td>
                                    <td>
                                        @if (($row->status ?? '') === 'lunas')
                                            <span class="badge-status badge-status-success">Lunas</span>
                                        @else
                                            <span class="badge-status badge-status-danger">Belum Lunas</span>
                                        @endif
                                    </td>
                                    <td>{{ $row->keterangan ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="empty-state">
                    <i class="fas fa-clipboard-list"></i>
                    <p>Belum ada data pinjaman.</p>
                </div>
            @endif
        </div>
    </div>

    {{-- TAB TRANSAKSI: PEMASUKAN & PENGELUARAN --}}
    <div id="tab-transaksi" class="tab-pane" style="display:none;">
        <div class="card-glass-soft">
            <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                <div>
                    <h5 class="mb-1" style="font-weight:600; color:#111827;">Ringkasan Transaksi</h5>
                    <p class="mb-0" style="font-size:12px; color:#6b7280;">Total pemasukan, pengeluaran, dan saldo
                        keuangan.</p>
                </div>
                <div>
                    <a href="{{ route('keuangan.laporan.export.transaksi') }}" class="btn-modern btn-primary-modern"
                        style="font-size:12px; padding:6px 14px; border-radius:999px;">
                        <i class="fas fa-file-excel"></i> Export Excel
                    </a>
                </div>
            </div>
            <div class="summary-badges">
                <div class="summary-pill">
                    <span class="summary-label">Total Pemasukan</span>
                    <span class="summary-value" style="color:#16a34a;">Rp
                        {{ number_format($total_pemasukan ?? 0, 0, ',', '.') }}</span>
                </div>
                <div class="summary-pill">
                    <span class="summary-label">Total Pengeluaran</span>
                    <span class="summary-value" style="color:#dc2626;">Rp
                        {{ number_format($total_pengeluaran ?? 0, 0, ',', '.') }}</span>
                </div>
                <div class="summary-pill">
                    <span class="summary-label">Saldo</span>
                    <span class="summary-value">Rp {{ number_format($saldo_transaksi ?? 0, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <div class="card-glass-soft">
            <h6 style="font-weight:600; color:#111827; margin-bottom:10px;"><i class="fas fa-calendar-week"
                    style="color:#0ea5e9;"></i> Penjualan Minggu Ini (Senin - Minggu)</h6>
            @if (($weeklyPenjualan ?? collect())->count() > 0)
                <div class="table-wrapper">
                    <table class="table-modern">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Kategori</th>
                                <th>Qty</th>
                                <th>Harga Satuan</th>
                                <th>Nominal</th>
                                <th>Deskripsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($weeklyPenjualan as $t)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($t->tanggal)->format('d M Y') }}</td>
                                    <td>{{ $t->kategori }}</td>
                                    <td>{{ $t->qty }}</td>
                                    <td>Rp {{ number_format($t->harga_satuan ?? 0, 0, ',', '.') }}</td>
                                    <td style="font-weight:600; color:#7c5cdb;">Rp
                                        {{ number_format($t->nominal ?? 0, 0, ',', '.') }}</td>
                                    <td>{{ $t->deskripsi ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="empty-state">
                    <i class="fas fa-inbox"></i>
                    <p>Belum ada penjualan di minggu ini.</p>
                </div>
            @endif
        </div>

        <div class="card-glass-soft">
            <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                <div>
                    <h6 style="font-weight:600; color:#111827; margin-bottom:4px;"><i class="fas fa-filter"
                            style="color:#6366f1;"></i> Filter Transaksi</h6>
                    <p class="mb-0" style="font-size:12px; color:#6b7280;">Pilih rentang tanggal manual atau bulan
                        terakhir.</p>
                </div>
                <form method="GET" action="{{ route('keuangan.laporan') }}"
                    class="d-flex gap-2 flex-wrap align-items-end">
                    <div>
                        <label style="font-size:12px; color:#6b7280;">Mulai</label>
                        <input type="date" name="start_date" class="form-control" value="{{ $startDate ?? '' }}">
                    </div>
                    <div>
                        <label style="font-size:12px; color:#6b7280;">Selesai</label>
                        <input type="date" name="end_date" class="form-control" value="{{ $endDate ?? '' }}">
                    </div>
                    <button type="submit" class="btn-modern btn-primary-modern"
                        style="font-size:12px; padding:8px 14px;">
                        Terapkan
                    </button>
                </form>
            </div>

            <h6 style="font-weight:600; color:#111827; margin-bottom:10px;"><i class="fas fa-receipt"
                    style="color:#0ea5e9;"></i> Riwayat Transaksi</h6>
            @if (($transaksi ?? collect())->count() > 0)
                <div class="table-wrapper">
                    <table class="table-modern">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Tipe</th>
                                <th>Kategori</th>
                                <th>Qty</th>
                                <th>Harga Satuan</th>
                                <th>Nominal</th>
                                <th>Deskripsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaksi as $t)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($t->tanggal)->format('d M Y') }}</td>
                                    <td>
                                        @if ($t->tipe === 'pemasukan')
                                            <span class="badge-status"
                                                style="background:rgba(34,197,94,0.08); color:#16a34a;">Pemasukan</span>
                                        @else
                                            <span class="badge-status"
                                                style="background:rgba(239,68,68,0.08); color:#dc2626;">Pengeluaran</span>
                                        @endif
                                    </td>
                                    <td>{{ $t->kategori }}</td>
                                    <td>{{ $t->qty }}</td>
                                    <td>Rp {{ number_format($t->harga_satuan ?? 0, 0, ',', '.') }}</td>
                                    <td style="font-weight:600; color:#7c5cdb;">Rp
                                        {{ number_format($t->nominal ?? 0, 0, ',', '.') }}</td>
                                    <td>{{ $t->deskripsi ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="empty-state">
                    <i class="fas fa-inbox"></i>
                    <p>Belum ada transaksi tercatat.</p>
                </div>
            @endif
        </div>
    </div>

    <script>
        document.querySelectorAll('.tab-btn').forEach(function(btn) {
            btn.addEventListener('click', function() {
                const target = this.getAttribute('data-target');
                document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
                document.querySelectorAll('.tab-pane').forEach(p => p.style.display = 'none');
                this.classList.add('active');
                document.getElementById(target).style.display = 'block';
            });
        });
    </script>

@endsection
