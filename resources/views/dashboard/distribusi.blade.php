@extends('layouts.sidebar')

@section('content')
    <div class="page-header">
        <h1>📦 Dashboard Distribusi</h1>
        <p>Selamat datang, {{ Auth::user()->name }} - Ringkasan data distribusi terbaru</p>
    </div>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card-stat">
                <h3>{{ number_format($totalBarang ?? 0) }}</h3>
                <p>Total Barang Terkirim</p>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card-stat">
                <h3>{{ number_format($distribusiTerkirim ?? 0) }}</h3>
                <p>Distribusi Selesai</p>
            </div>
        </div>
    </div>

    <div class="card-stat p-3">
        <h4 class="mb-3">Distribusi Terbaru</h4>
        <div class="table-responsive">
            <table class="table table-bordered mb-0">
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
                    @forelse ($riwayatDistribusi ?? [] as $d)
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
    </div>
@endsection
