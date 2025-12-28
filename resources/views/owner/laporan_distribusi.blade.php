@extends('layouts.sidebar')

@section('content')
    <div class="page-header">
        <h1>📦 Laporan Distribusi</h1>
        <p>Ringkasan kinerja distribusi dan detail pengiriman.</p>
    </div>

    <style>
        /* Ukuran chart distribusi */
        #chartDistribusi {
            height: 240px !important;
            max-height: 240px !important;
        }

        .chart-box {
            padding: 12px;
        }
    </style>

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
                        <td>{{ $loop->iteration }}</td>
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
