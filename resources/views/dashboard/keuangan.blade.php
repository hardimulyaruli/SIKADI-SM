@extends('layouts.sidebar')

@section('content')

    <style>
        .page-header {
            margin-bottom: 24px;
        }

        .page-header h1 {
            font-size: 28px;
            font-weight: 700;
            color: #111827;
        }

        .page-header p {
            font-size: 13px;
            color: #6b7280;
        }

        .card-stat-modern {
            border-radius: 18px;
            padding: 18px 20px;
            background: linear-gradient(135deg, rgba(56, 189, 248, 0.1), rgba(129, 140, 248, 0.1));
            box-shadow: 0 4px 18px rgba(148, 163, 184, 0.35);
        }

        .card-stat-modern h3 {
            margin: 0;
            font-size: 22px;
            font-weight: 700;
        }

        .card-stat-modern p {
            margin: 4px 0 0;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: .08em;
            color: #6b7280;
        }

        .card-stat-modern.saldo {
            background: linear-gradient(135deg, rgba(34, 197, 94, 0.12), rgba(22, 163, 74, 0.12));
        }

        .table-wrapper {
            margin-top: 10px;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 2px 16px rgba(148, 163, 184, 0.25);
        }

        .table-modern {
            width: 100%;
            border-collapse: collapse;
        }

        .table-modern thead {
            background: linear-gradient(135deg, rgba(14, 165, 233, 0.07), rgba(191, 219, 254, 0.5));
        }

        .table-modern th {
            padding: 10px 12px;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: .06em;
            color: #0f172a;
            text-align: left;
        }

        .table-modern td {
            padding: 9px 12px;
            font-size: 13px;
            border-top: 1px solid rgba(226, 232, 240, 0.8);
            color: #374151;
        }

        .table-modern tbody tr:hover {
            background: rgba(219, 234, 254, 0.7);
        }

        .badge-tipe {
            padding: 4px 10px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 600;
        }

        .badge-tipe-pemasukan {
            background: rgba(34, 197, 94, 0.1);
            color: #16a34a;
        }

        .badge-tipe-pengeluaran {
            background: rgba(239, 68, 68, 0.1);
            color: #dc2626;
        }

        .link-mini {
            font-size: 12px;
            color: #2563eb;
            text-decoration: none;
        }

        .link-mini:hover {
            text-decoration: underline;
        }
    </style>

    <div class="page-header">
        <h1>📊 Dashboard Keuangan</h1>
        <p>Selamat datang, {{ Auth::user()->name }} — ringkasan data keuangan & transaksi terbaru.</p>
    </div>

    <div class="row mb-3">
        <div class="col-md-4 mb-3">
            <div class="card-stat-modern">
                <p>Total Pemasukan</p>
                <h3>Rp {{ number_format($total_pemasukan ?? 0, 0, ',', '.') }}</h3>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card-stat-modern">
                <p>Total Pengeluaran</p>
                <h3>Rp {{ number_format($total_pengeluaran ?? 0, 0, ',', '.') }}</h3>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card-stat-modern saldo">
                <p>Saldo</p>
                <h3>Rp {{ number_format($saldo ?? 0, 0, ',', '.') }}</h3>
            </div>
        </div>
    </div>

    <div class="card-glass" style="padding:18px 20px;">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h5 class="mb-0" style="font-weight:600; color:#111827;">Transaksi Terbaru</h5>
            <a href="{{ route('keuangan.transaksi') }}" class="link-mini">Lihat semua transaksi →</a>
        </div>

        @if (($transaksi_terbaru ?? collect())->count() > 0)
            <div class="table-wrapper">
                <table class="table-modern">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Tipe</th>
                            <th>Kategori</th>
                            <th>Nominal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaksi_terbaru as $t)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($t->tanggal)->format('d M Y') }}</td>
                                <td>
                                    @if ($t->tipe === 'pemasukan')
                                        <span class="badge-tipe badge-tipe-pemasukan">Pemasukan</span>
                                    @else
                                        <span class="badge-tipe badge-tipe-pengeluaran">Pengeluaran</span>
                                    @endif
                                </td>
                                <td>{{ $t->kategori }}</td>
                                <td style="font-weight:600; color:#7c5cdb;">Rp
                                    {{ number_format($t->nominal ?? 0, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="mb-0" style="font-size:13px; color:#9ca3af;">Belum ada transaksi tercatat.</p>
        @endif
    </div>

@endsection
