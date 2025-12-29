@extends('layouts.sidebar')
@section('content')
    <style>
        .page-shell {
            background: #f8fafc;
            border-radius: 16px;
            padding: 18px;
        }

        .card-glass {
            background: #ffffff;
            border-radius: 14px;
            padding: 18px 20px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.12);
        }

        .filter-bar {
            background: linear-gradient(135deg, rgba(14, 165, 233, 0.05), rgba(99, 102, 241, 0.05));
            border: 1px solid rgba(148, 163, 184, 0.35);
            border-radius: 14px;
            padding: 14px 16px;
            margin-bottom: 12px;
        }

        .card-head h2 {
            margin: 0;
            font-weight: 800;
            color: #0f172a;
        }

        .card-head p {
            margin: 6px 0 0;
            color: #6b7280;
        }

        .section-title {
            font-size: 18px;
            font-weight: 800;
            margin: 0 0 6px;
            color: #0f172a;
        }

        .section-sub {
            margin: 0;
            color: #6b7280;
        }

        .btn-primary-modern {
            background: linear-gradient(135deg, #0ea5e9, #38bdf8);
            color: #fff;
            border: none;
            border-radius: 12px;
            padding: 10px 16px;
            font-weight: 700;
            box-shadow: 0 12px 30px rgba(56, 189, 248, 0.28);
        }

        .stat-card {
            background: #ffffff;
            border-radius: 14px;
            padding: 14px 16px;
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.08);
        }

        .stat-card h3 {
            margin: 0;
            font-weight: 800;
            color: #0f172a;
        }

        .stat-card p {
            margin: 4px 0 0;
            color: #6b7280;
            font-weight: 600;
        }

        .table-modern {
            width: 100%;
            border-collapse: collapse;
        }

        .table-modern thead th {
            background: #f0f9ff;
            color: #0f172a;
            font-size: 12px;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            padding: 10px;
            border-bottom: 1px solid #e5e7eb;
        }

        .table-modern tbody td {
            padding: 10px;
            border-top: 1px solid #e5e7eb;
            color: #0f172a;
            font-size: 14px;
        }

        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 999px;
            font-weight: 700;
            font-size: 12px;
            text-transform: capitalize;
        }

        .status-badge.terkirim {
            background: rgba(16, 185, 129, 0.14);
            color: #047857;
        }

        .status-badge.pending {
            background: rgba(234, 179, 8, 0.16);
            color: #b45309;
        }
    </style>

    <div class="page-shell">
        <div class="card-head mb-3">
            <h2>Laporan Distribusi</h2>
            <p>Ringkasan kinerja distribusi dan detail pengiriman.</p>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-md-3 col-6">
                <div class="stat-card">
                    <p>Total Distribusi</p>
                    <h3>{{ number_format($totalDistribusi ?? 0) }}</h3>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-card">
                    <p>Total Barang</p>
                    <h3>{{ number_format($totalBarang ?? 0) }}</h3>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-card">
                    <p>Terkirim</p>
                    <h3>{{ number_format($terkirimCount ?? 0) }}</h3>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-card">
                    <p>Pending</p>
                    <h3>{{ number_format($pendingCount ?? 0) }}</h3>
                </div>
            </div>
        </div>

        <div class="card-glass">
            <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-2 mb-2">
                <div>
                    <h4 class="section-title mb-1">Detail Distribusi</h4>
                    <p class="section-sub">Selaraskan tampilan dengan laporan keuangan: filter rentang tanggal dan export.</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('distribusi.laporan.export', ['start_date' => request('start_date'), 'end_date' => request('end_date')]) }}"
                        class="btn btn-sm btn-primary-modern">Export Excel (.xlsx)</a>
                </div>
            </div>

            <div class="filter-bar">
                <form method="GET" action="{{ route('distribusi.laporan') }}" class="row g-2 align-items-end mb-0">
                    <div class="col-md-4">
                        <label class="form-label" style="font-size:12px; color:#6b7280;">Tanggal Awal</label>
                        <input type="date" name="start_date" class="form-control"
                            value="{{ request('start_date', $startDate ?? '') }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" style="font-size:12px; color:#6b7280;">Tanggal Akhir</label>
                        <input type="date" name="end_date" class="form-control"
                            value="{{ request('end_date', $endDate ?? '') }}">
                    </div>
                    <div class="col-md-4 d-flex gap-2">
                        <button type="submit" class="btn btn-primary-modern" style="align-self:flex-end;">Terapkan Filter</button>
                        <a href="{{ route('distribusi.laporan') }}" class="btn btn-outline-secondary" style="align-self:flex-end;">Reset</a>
                    </div>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table-modern">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Jumlah</th>
                            <th>Tujuan</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($daftarDistribusi as $index => $d)
                            <tr>
                                <td>{{ ($daftarDistribusi->firstItem() ?? 0) + $index }}</td>
                                <td>{{ $d->catatan }}</td>
                                <td>{{ $d->jumlah_produk }}</td>
                                <td>{{ $d->toko_tujuan }}</td>
                                <td>{{ $d->tanggal }}</td>
                                <td><span class="status-badge {{ $d->status }}">{{ ucfirst($d->status) }}</span></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Belum ada data distribusi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $daftarDistribusi->links() }}
            </div>
        </div>
    </div>
@endsection
