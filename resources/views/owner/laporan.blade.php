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

    .card-stat h4 {
        font-size: 28px;
        font-weight: 700;
        color: #7c5cdb;
        margin: 0 0 10px 0;
    }

    .card-stat p {
        margin: 0;
        font-size: 13px;
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

    .table-wrapper {
        background: rgba(255, 255, 255, 0.85);
        border: 1px solid rgba(122, 92, 219, 0.15);
        border-radius: 20px;
        padding: 0;
        box-shadow: 0 4px 15px rgba(122, 92, 219, 0.08);
        overflow: hidden;
    }

    .table-wrapper-header {
        padding: 20px 30px;
        border-bottom: 1px solid rgba(122, 92, 219, 0.15);
        color: #2d2d2d;
        font-weight: 600;
    }

    .table-wrapper table {
        margin: 0;
    }

    .table-wrapper thead {
        background: linear-gradient(135deg, rgba(122, 92, 219, 0.1) 0%, rgba(147, 112, 219, 0.1) 100%);
        border-bottom: 2px solid rgba(122, 92, 219, 0.2);
    }

    .table-wrapper thead th {
        padding: 16px 20px;
        color: #5a4a7a;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 12px;
        letter-spacing: 0.5px;
        border: none;
    }

    .table-wrapper tbody tr {
        border-bottom: 1px solid rgba(122, 92, 219, 0.1);
        transition: all 0.3s ease;
    }

    .table-wrapper tbody tr:hover {
        background: rgba(122, 92, 219, 0.05);
    }

    .table-wrapper tbody td {
        padding: 16px 20px;
        color: #4a4a6a;
        font-size: 14px;
        border: none;
    }
</style>

<div class="page-header">
    <h1>💰 Laporan Keuangan</h1>
    <p>Ringkasan dan detail laporan keuangan perusahaan</p>
</div>

<!-- ===================== STATISTIK CARD ===================== -->
<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="card-stat">
            <h4>Rp {{ number_format($total_pemasukan ?? 0, 0, ',', '.') }}</h4>
            <p>Total Pemasukan</p>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card-stat">
            <h4>Rp {{ number_format($total_pengeluaran ?? 0, 0, ',', '.') }}</h4>
            <p>Total Pengeluaran</p>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card-stat">
            <h4>Rp {{ number_format($gaji_pegawai ?? 0, 0, ',', '.') }}</h4>
            <p>Total Gaji Pegawai</p>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card-stat">
            <h4>Rp {{ number_format($saldo_akhir ?? 0, 0, ',', '.') }}</h4>
            <p>Saldo Akhir</p>
        </div>
    </div>
</div>

<!-- ===================== GRAFIK ===================== -->
<div class="row mb-4">
    <div class="col-md-6 mb-3">
        <div class="chart-box">
            <h5>📈 Pemasukan vs Pengeluaran</h5>
            <canvas id="chartKeuangan"></canvas>
        </div>
    </div>

    <div class="col-md-6 mb-3">
        <div class="chart-box">
            <h5>📊 Persentase Pengeluaran</h5>
            <canvas id="chartPersen"></canvas>
        </div>
    </div>
</div>

<!-- ===================== TABEL ===================== -->
<div class="table-wrapper">
    <div class="table-wrapper-header">Detail Transaksi Keuangan</div>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Kategori</th>
                <th>Keterangan</th>
                <th>Jumlah</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="5" style="text-align: center; color: #8a7a9e;">Belum ada data transaksi</td>
            </tr>
        </tbody>
    </table>
</div>

<!-- ===================== CHART JS ===================== -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
new Chart(document.getElementById('chartKeuangan'), {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
        datasets: [
            {
                label: 'Pemasukan',
                data: [0, 0, 0, 0, 0, 0],
                borderColor: '#7c5cdb',
                backgroundColor: 'rgba(122, 92, 219, 0.1)',
                borderWidth: 3,
                tension: 0.4,
                fill: true
            },
            {
                label: 'Pengeluaran',
                data: [0, 0, 0, 0, 0, 0],
                borderColor: '#b8a5d1',
                backgroundColor: 'rgba(184, 165, 209, 0.1)',
                borderWidth: 3,
                tension: 0.4,
                fill: true
            }
        ]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                labels: { color: '#8a7a9e' }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: { color: '#8a7a9e' },
                grid: { color: 'rgba(122, 92, 219, 0.1)' }
            },
            x: {
                ticks: { color: '#8a7a9e' },
                grid: { display: false }
            }
        }
    }
});

new Chart(document.getElementById('chartPersen'), {
    type: 'doughnut',
    data: {
        labels: ['Gaji Pegawai', 'Operasional', 'Pembelian Barang', 'Lain-lain'],
        datasets: [{
            data: [0, 0, 0, 0],
            backgroundColor: ['#7c5cdb', '#b8a5d1', '#d4c4e3', '#e8e1f0'],
            borderColor: 'rgba(255, 255, 255, 0.85)',
            borderWidth: 2
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                labels: { color: '#8a7a9e' }
            }
        }
    }
});
</script>

@endsection
