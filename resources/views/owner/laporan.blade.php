@extends('layouts.sidebar')

@section('content')
<div class="container">

    <h2 class="mb-4">💰 Laporan Keuangan</h2>

    <!-- ===================== STATISTIK CARD ===================== -->
    <div class="row mb-4">

        <div class="col-md-3">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h4>{{ $total_pemasukan ?? 0 }}</h4>
                    <p>Total Pemasukan</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-danger">
                <div class="card-body">
                    <h4>{{ $total_pengeluaran ?? 0 }}</h4>
                    <p>Total Pengeluaran</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h4>{{ $gaji_pegawai ?? 0 }}</h4>
                    <p>Total Gaji Pegawai</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-info">
                <div class="card-body">
                    <h4>{{ $saldo_akhir ?? 0 }}</h4>
                    <p>Saldo Akhir</p>
                </div>
            </div>
        </div>

    </div>

    <!-- ===================== GRAFIK ===================== -->
    <div class="row mb-4">

        <div class="col-md-6">
            <div class="card p-3">
                <h5 class="text-center"> 📈 Pemasukan vs Pengeluaran</h5>
                <canvas id="chartKeuangan"></canvas>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card p-3">
                <h5 class="text-center">Persentase Pengeluaran</h5>
                <canvas id="chartPersen"></canvas>
            </div>
        </div>

    </div>

    <!-- ===================== TABEL ===================== -->
    <div class="card">
        <div class="card-header">
            <strong>Detail Transaksi Keuangan</strong>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
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
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>

            </table>
        </div>
    </div>

</div>

<!-- ===================== CHART JS ===================== -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
var ctx = document.getElementById('chartKeuangan');
new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
        datasets: [
            {
                label: 'Pemasukan',
                data: [0, 0, 0, 0, 0, 0],
                borderWidth: 2
            },
            {
                label: 'Pengeluaran',
                data: [0, 0, 0, 0, 0, 0],
                borderWidth: 2
            }
        ]
    }
});

var ctx2 = document.getElementById('chartPersen');
new Chart(ctx2, {
    type: 'doughnut',
    data: {
        labels: ['Gaji Pegawai', 'Operasional', 'Pembelian Barang', 'Lain-lain'],
        datasets: [{
            data: [0, 0, 0, 0]
        }]
    }
});
</script>

@endsection
