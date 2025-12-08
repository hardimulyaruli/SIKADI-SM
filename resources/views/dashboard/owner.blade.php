@extends('layouts.sidebar')

@section('content')

<style>
    .page-header {
        margin-bottom: 40px;
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

    .card-stat {
        background: rgba(255, 255, 255, 0.85);
        border: 1px solid rgba(122, 92, 219, 0.15);
        border-radius: 20px;
        padding: 30px;
        text-align: center;
        box-shadow: 0 4px 15px rgba(122, 92, 219, 0.08);
        transition: all 0.3s ease;
    }

    .card-stat:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 30px rgba(122, 92, 219, 0.15);
    }

    .card-stat h3 {
        font-size: 32px;
        font-weight: 700;
        color: #7c5cdb;
        margin: 0 0 10px 0;
    }

    .card-stat p {
        margin: 0;
        font-size: 14px;
        color: #8a7a9e;
        font-weight: 500;
    }

    .chart-box {
        background: rgba(255, 255, 255, 0.85);
        padding: 30px;
        border-radius: 20px;
        border: 1px solid rgba(122, 92, 219, 0.15);
        box-shadow: 0 4px 15px rgba(122, 92, 219, 0.08);
    }

    .chart-box h5 {
        color: #2d2d2d;
        font-weight: 600;
        margin-bottom: 20px;
    }
</style>

<div class="page-header">
    <h1>📊 Dashboard Owner</h1>
    <p>Ringkasan keuangan dan distribusi terbaru</p>
</div>

<!-- ===================== STATISTIK ===================== -->
<div class="row mb-4">
    <div class="col-md-4 mb-3">
        <div class="card-stat">
            <h3>Rp {{ number_format($total_pemasukan ?? 0, 0, ',', '.') }}</h3>
            <p>Total Pemasukan</p>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="card-stat">
            <h3>Rp {{ number_format($total_pengeluaran ?? 0, 0, ',', '.') }}</h3>
            <p>Total Pengeluaran</p>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="card-stat">
            <h3>{{ $total_distribusi ?? 0 }}</h3>
            <p>Total Distribusi Barang</p>
        </div>
    </div>
</div>

<!-- ===================== GRAFIK ===================== -->
<div class="row mb-4">
    <div class="col-md-6 mb-3">
        <div class="chart-box">
            <h5>📈 Grafik Keuangan</h5>
            <canvas id="chartKeuangan"></canvas>
        </div>
    </div>

    <div class="col-md-6 mb-3">
        <div class="chart-box">
            <h5>🚚 Grafik Distribusi</h5>
            <canvas id="chartDistribusi"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
new Chart(document.getElementById('chartKeuangan'), {
    type: 'bar',
    data: {
        labels: ['Pemasukan', 'Pengeluaran'],
        datasets: [{
            label: 'Jumlah',
            data: [
                {{ $total_pemasukan ?? 0 }},
                {{ $total_pengeluaran ?? 0 }}
            ],
            backgroundColor: ['#7c5cdb', '#b8a5d1'],
            borderRadius: 10,
            borderSkipped: false
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    color: '#8a7a9e'
                },
                grid: {
                    color: 'rgba(122, 92, 219, 0.1)'
                }
            },
            x: {
                ticks: {
                    color: '#8a7a9e'
                },
                grid: {
                    display: false
                }
            }
        }
    }
});

new Chart(document.getElementById('chartDistribusi'), {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
        datasets: [{
            label: 'Distribusi / Bulan',
            data: [0, 0, 0, 0, 0, 0],
            borderColor: '#7c5cdb',
            borderWidth: 3,
            backgroundColor: 'rgba(122, 92, 219, 0.1)',
            tension: 0.4,
            fill: true
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                labels: {
                    color: '#8a7a9e'
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    color: '#8a7a9e'
                },
                grid: {
                    color: 'rgba(122, 92, 219, 0.1)'
                }
            },
            x: {
                ticks: {
                    color: '#8a7a9e'
                },
                grid: {
                    display: false
                }
            }
        }
    }
});
</script>

@endsection
