@extends('layouts.sidebar')

@section('content')

<div class="page-header">
    <h1>📊 Dashboard Keuangan</h1>
    <p>Selamat datang, {{ Auth::user()->name }} - Ringkasan data keuangan terbaru</p>
</div>

<div class="row">
    <div class="col-md-6 mb-4">
        <div class="card-stat">
            <h3>Rp 0</h3>
            <p>Total Pemasukan</p>
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <div class="card-stat">
            <h3>Rp 0</h3>
            <p>Total Pengeluaran</p>
        </div>
    </div>
</div>

@endsection
