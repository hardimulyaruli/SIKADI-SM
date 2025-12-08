@extends('layouts.sidebar')

@section('content')

<div class="page-header">
    <h1>📦 Laporan Distribusi</h1>
    <p>Ringkasan dan detail laporan distribusi barang</p>
</div>

<!-- ===================== STATISTIK CARD ===================== -->
<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="card-stat">
            <h4>{{ $total_keluar ?? 0 }}</h4>
            <p>Total Barang Keluar</p>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card-stat">
            <h4>{{ $tujuan ?? 0 }}</h4>
            <p>Total Tujuan Distribusi</p>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card-stat">
            <h4>{{ $sukses ?? 0 }}</h4>
            <p>Distribusi Sukses</p>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card-stat">
            <h4>{{ $pending ?? 0 }}</h4>
            <p>Distribusi Pending / Gagal</p>
        </div>
    </div>
</div>

<!-- ===================== GRAFIK CHART ===================== -->
<div class="row mb-4">
    <div class="col-md-6 mb-3">
        <div class="chart-box">
            <h5>📊 Distribusi Per Bulan</h5>
            <canvas id="chartDistribusi"></canvas>
        </div>
    </div>

    <div class="col-md-6 mb-3">
        <div class="chart-box">
            <h5>📈 Status Distribusi</h5>
            <canvas id="chartStatus"></canvas>
        </div>
    </div>
</div>

<!-- ===================== TABEL DATA ===================== -->
<div class="table-wrapper">
    <div class="table-wrapper-header">Detail Laporan Distribusi</div>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Barang</th>
                <th>Tujuan</th>
                <th>Jumlah</th>
                <th>Tanggal Kirim</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <!-- Data will be populated here -->
        </tbody>
    </table>
</div>

<script>
const distributionDatasets = [{
    label: 'Barang Terdistribusi',
    data: [0, 0, 0, 0, 0, 0],
    borderColor: '#7c5cdb',
    backgroundColor: 'rgba(122, 92, 219, 0.1)'
}];
initFilledLineChart('chartDistribusi', ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'], distributionDatasets);

initDoughnutChart('chartStatus', 
    ['Sukses', 'Pending'],
    [{{ $sukses ?? 0 }}, {{ $pending ?? 0 }}]
);
</script>

@endsection