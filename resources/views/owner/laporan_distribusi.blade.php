@extends('layouts.sidebar')

@section('content')
    <div class="page-header">
        <h1>📦 Laporan Distribusi</h1>
        <p>Ringkasan kinerja distribusi dan detail pengiriman.</p>
    </div>

    <style>
        .page-shell {
            background: #f8fafc;
            border-radius: 16px;
            padding: 18px;
        }

        .card-shell {
            background: #ffffff;
            border-radius: 18px;
            padding: 18px 20px;
            box-shadow: 0 4px 20px rgba(148, 163, 184, 0.18);
        }

        .filter-bar {
            background: linear-gradient(135deg, rgba(14, 165, 233, 0.05), rgba(99, 102, 241, 0.05));
            border: 1px solid rgba(148, 163, 184, 0.35);
            border-radius: 14px;
            padding: 14px 16px;
        }

        .btn-primary-modern {
            background: linear-gradient(135deg, #0ea5e9, #6366f1);
            color: #fff;
            border: none;
            border-radius: 999px;
            padding: 8px 14px;
            font-weight: 700;
            box-shadow: 0 10px 24px rgba(99, 102, 241, 0.22);
        }

        .btn-outline-soft {
            border-radius: 999px;
            border: 1px solid rgba(148, 163, 184, 0.6);
            background: #fff;
            color: #374151;
            padding: 8px 14px;
            font-weight: 600;
        }

        /* Ukuran chart distribusi */
        #chartDistribusi {
            height: 240px !important;
            max-height: 240px !important;
        }

        .chart-box {
            padding: 12px;
        }
    </style>

    <div class="page-shell">
        <!-- ===================== STATISTIK CARD ===================== -->
        <div class="row mb-4">
            <div class="col-md-3 mb-3">
                <div class="card-stat">
                    <h4>{{ number_format($totalDistribusi ?? 0) }}</h4>
                    <p>Total Distribusi</p>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="card-stat">
                    <h4>{{ number_format($totalBarang ?? 0) }}</h4>
                    <p>Total Barang</p>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="card-stat">
                    <h4>{{ number_format($terkirimCount ?? 0) }}</h4>
                    <p>Terkirim</p>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="card-stat">
                    <h4>{{ number_format($pendingCount ?? 0) }}</h4>
                    <p>Pending</p>
                </div>
            </div>
        </div>

        <!-- ===================== FILTER & EXPORT ===================== -->
        <div class="card-shell mb-4">
            <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-2 mb-2">
                <div>
                    <h5 class="mb-1"><i class="fas fa-filter"></i> Filter Distribusi</h5>
                    <p class="mb-0" style="color:#6b7280; font-size:13px;">Selaraskan dengan tampilan laporan keuangan: pilih rentang tanggal lalu export.</p>
                </div>
                <a href="{{ route('owner.distribusi.export', ['start_date' => request('start_date'), 'end_date' => request('end_date')]) }}"
                    class="btn btn-sm btn-primary-modern"><i class="fas fa-file-excel"></i> Export Excel</a>
            </div>
            <div class="filter-bar">
                <form method="GET" action="{{ route('owner.distribusi') }}" class="row g-2 align-items-end mb-0">
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
                        <a href="{{ route('owner.distribusi') }}" class="btn btn-outline-soft" style="align-self:flex-end;">Reset</a>
                    </div>
                </form>
            </div>
        </div>

        <!-- ===================== GRAFIK CHART ===================== -->
        <div class="row mb-4">
            <div class="col-md-12 mb-3">
                <div class="chart-box">
                    <h5>📊 Distribusi Per Bulan</h5>
                    <canvas id="chartDistribusi"></canvas>
                </div>
            </div>
        </div>

        <!-- ===================== TABEL DATA ===================== -->
        <div class="table-wrapper">
            <div class="table-wrapper-header">Detail Distribusi</div>
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
                    @forelse ($daftarDistribusi ?? [] as $d)
                        <tr>
                            <td>{{ ($daftarDistribusi->firstItem() ?? 0) + $loop->index }}</td>
                            <td>{{ $d->catatan }}</td>
                            <td>{{ $d->jumlah_produk }}</td>
                            <td>{{ $d->toko_tujuan }}</td>
                            <td>{{ $d->tanggal }}</td>
                            <td>{{ ucfirst($d->status) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada data distribusi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            @if (method_exists($daftarDistribusi ?? null, 'links'))
                <div style="padding:12px 14px; background:#fff;">
                    {{ $daftarDistribusi->links() }}
                </div>
            @endif
        </div>
    </div>

    @push('scripts')
        <script>
            // Bar chart distribusi per bulan
            const distribusiCtx = document.getElementById('chartDistribusi').getContext('2d');

            fetch('{{ route('owner.chart.distribusi') }}')
                .then(res => res.json())
                .then(({
                    labels,
                    values
                }) => {
                    new Chart(distribusiCtx, {
                        type: 'bar',
                        data: {
                            labels,
                            datasets: [{
                                label: 'Distribusi / Bulan',
                                data: values,
                                backgroundColor: 'rgba(122, 92, 219, 0.7)',
                                borderColor: '#7c5cdb',
                                borderWidth: 1.2,
                                borderRadius: 8,
                                maxBarThickness: 44,
                            }],
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                x: {
                                    grid: {
                                        display: false
                                    },
                                },
                                y: {
                                    beginAtZero: true,
                                    grid: {
                                        color: 'rgba(226,232,240,0.6)'
                                    },
                                }
                            },
                            plugins: {
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    backgroundColor: '#0f172a'
                                }
                            }
                        }
                    });
                })
                .catch(() => {
                    new Chart(distribusiCtx, {
                        type: 'bar',
                        data: {
                            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
                            datasets: [{
                                label: 'Distribusi / Bulan',
                                data: [0, 0, 0, 0, 0, 0],
                                backgroundColor: 'rgba(122, 92, 219, 0.7)',
                                borderColor: '#7c5cdb',
                                borderWidth: 1.2,
                                borderRadius: 8,
                                maxBarThickness: 44,
                            }],
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                x: {
                                    grid: {
                                        display: false
                                    }
                                },
                                y: {
                                    beginAtZero: true,
                                    grid: {
                                        color: 'rgba(226,232,240,0.6)'
                                    }
                                }
                            },
                            plugins: {
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    backgroundColor: '#0f172a'
                                }
                            }
                        }
                    });
                });
        </script>
    @endpush
@endsection
