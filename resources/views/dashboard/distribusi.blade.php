@extends('layouts.sidebar')

@section('content')

<div class="page-header">
    <h1>📦 Dashboard Distribusi</h1>
    <p>Selamat datang, {{ Auth::user()->name }} - Ringkasan data distribusi terbaru</p>
</div>

<div class="row">
    <div class="col-md-6 mb-4">
        <div class="card-stat">
            <h3>0</h3>
            <p>Total Barang</p>
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <div class="card-stat">
            <h3>0</h3>
            <p>Distribusi Aktif</p>
        </div>
    </div>
</div>

@endsection
