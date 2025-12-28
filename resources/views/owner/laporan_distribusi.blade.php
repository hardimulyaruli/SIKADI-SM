@extends('layouts.sidebar')

@section('content')

<div class="page-header">
    <h1>📦 Laporan Distribusi</h1>
    <p>Ringkasan kinerja distribusi dan detail pengiriman.</p>
</div>

<style>
    /* Samakan ukuran chart: status & distribusi per bulan */
    #chartStatus, #chartDistribusi { height: 220px !important; max-height: 220px !important; }
    .chart-box { padding: 12px; }
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
    // Line chart: fetch data from Owner API
    fetch('{{ route('owner.chart.distribusi') }}')
        .then(res => res.json())
        .then(({ labels, values }) => {
            const datasets = [{
                label: 'Distribusi / Bulan',
                data: values,
                borderColor: '#7c5cdb',
                backgroundColor: 'rgba(122, 92, 219, 0.15)'
            }];
            initFilledLineChart('chartDistribusi', labels, datasets);
        })
        .catch(() => {
            const datasets = [{
                label: 'Distribusi / Bulan',
                data: [0, 0, 0, 0, 0, 0],
                borderColor: '#7c5cdb',
                backgroundColor: 'rgba(122, 92, 219, 0.15)'
            }];
            initFilledLineChart('chartDistribusi', ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'], datasets);
        });

    // Doughnut chart: status distribusi
    initDoughnutChart('chartStatus',
        ['Terkirim', 'Pending'],
        [{{ $terkirimCount ?? 0 }}, {{ $pendingCount ?? 0 }}]
    );
</script>
@endpush

@endsection