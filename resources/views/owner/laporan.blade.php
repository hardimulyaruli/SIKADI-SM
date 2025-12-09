@extends('layouts.sidebar')

@section('content')

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
    <table class="table-modern">
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

<script>
const datasets = [
    {
        label: 'Pemasukan',
        data: [0, 0, 0, 0, 0, 0],
        borderColor: '#7c5cdb',
        backgroundColor: 'rgba(122, 92, 219, 0.1)'
    },
    {
        label: 'Pengeluaran',
        data: [0, 0, 0, 0, 0, 0],
        borderColor: '#b8a5d1',
        backgroundColor: 'rgba(184, 165, 209, 0.1)'
    }
];
initFilledLineChart('chartKeuangan', ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'], datasets);

initDoughnutChart('chartPersen', 
    ['Gaji Pegawai', 'Operasional', 'Pembelian Barang', 'Lain-lain'],
    [0, 0, 0, 0]
);
</script>

@endsection
