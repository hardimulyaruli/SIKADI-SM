@extends('layouts.app')

@section('content')
<div class="container">

    <h2 class="mb-4">📦 Laporan Distribusi</h2>

    <!-- ===================== STATISTIK CARD ===================== -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h4>{{ $total_keluar ?? 0 }}</h4>
                    <p>Total Barang Keluar</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h4>{{ $tujuan ?? 0 }}</h4>
                    <p>Total Tujuan Distribusi</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-info">
                <div class="card-body">
                    <h4>{{ $sukses ?? 0 }}</h4>
                    <p>Distribusi Sukses</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-danger">
                <div class="card-body">
                    <h4>{{ $pending ?? 0 }}</h4>
                    <p>Distribusi Pending / Gagal</p>
                </div>
            </div>
        </div>
    </div>


    <!-- ===================== GRAFIK CHART ===================== -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card p-3">
                <h5 class="text-center">Distribusi Per Bulan</h5>
                <canvas id="chartDistribusi"></canvas>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card p-3">
                <h5 class="text-center">Status Distribusi</h5>
                <canvas id="chartStatus"></canvas>
            </div>
        </div>
    </div>


    <!-- ===================== TABEL DATA ===================== -->
    <div class="card">
        <div class="card-header">
            <strong>Detail Laporan Distribusi</strong>
        </div>

        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nama Barang</th>
                        <th>Tujuan</th>
                        <th>Jumlah</th>
                        <th>Tanggal Kirim</th>
                        <th>Status</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

</div>
@endsection