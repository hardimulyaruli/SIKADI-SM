@extends('layouts.sidebar')

@section('content')

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

<script>
initBarChart('chartKeuangan', ['Pemasukan', 'Pengeluaran'], [
    {{ $total_pemasukan ?? 0 }},
    {{ $total_pengeluaran ?? 0 }}
]);

const distributionDatasets = [{
    label: 'Distribusi / Bulan',
    data: [0, 0, 0, 0, 0, 0],
    borderColor: '#7c5cdb',
    backgroundColor: 'rgba(122, 92, 219, 0.1)'
}];
initFilledLineChart('chartDistribusi', ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'], distributionDatasets);
</script>

@endsection
