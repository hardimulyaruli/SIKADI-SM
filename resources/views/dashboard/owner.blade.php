@extends('layouts.sidebar')

@section('content')

<style>
    .card-stat {
        border-radius: 10px;
        padding: 20px;
        background: #ffffff;
        border: 1px solid #e3e3e3;
        text-align: center;
        box-shadow: 0 3px 7px rgba(0,0,0,0.06);
    }
    .card-stat h3 {
        font-size: 28px;
        font-weight: bold;
        margin: 0;
    }
    .card-stat p {
        margin: 0;
        font-size: 16px;
        color: #555;
    }

    .chart-box {
        background: #ffffff;
        padding: 20px;
        border-radius: 10px;
        border: 1px solid #e3e3e3;
        box-shadow: 0 3px 7px rgba(0,0,0,0.06);
    }
</style>

<h2 class="mb-4">📊 Dashboard Owner</h2>
<p>Ringkasan keuangan dan distribusi terbaru.</p>

<!-- ===================== STATISTIK ===================== -->
<div class="row mt-4">

    <div class="col-md-4 mb-3">
        <div class="card-stat">
            <h3>{{ $total_pemasukan ?? 0 }}</h3>
            <p>Total Pemasukan</p>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="card-stat">
            <h3>{{ $total_pengeluaran ?? 0 }}</h3>
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
<div class="row mt-4">

    <div class="col-md-6 mb-3">
        <div class="chart-box">
            <h5 class="text-center">📈 Grafik Keuangan</h5>
            <canvas id="chartKeuangan"></canvas>
        </div>
    </div>

    <div class="col-md-6 mb-3">
        <div class="chart-box">
            <h5 class="text-center">🚚 Grafik Distribusi</h5>
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
            backgroundColor: ['#4ad991', '#ff5f5f']
        }]
    }
});

new Chart(document.getElementById('chartDistribusi'), {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
        datasets: [{
            label: 'Distribusi / Bulan',
            data: [0, 0, 0, 0, 0, 0],
            borderColor: '#3b82f6',
            borderWidth: 3
        }]
    }
});
</script>

@endsection
