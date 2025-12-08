@extends('layouts.sidebar')

@section('content')

<style>
    .page-header {
        margin-bottom: 40px;
    }

    .page-header h1 {
        font-size: 32px;
        font-weight: 700;
        color: #2d2d2d;
        margin-bottom: 8px;
    }

    .page-header p {
        color: #8a7a9e;
        font-size: 14px;
    }

    .card-stat {
        background: rgba(255, 255, 255, 0.85);
        border: 1px solid rgba(122, 92, 219, 0.15);
        border-radius: 20px;
        padding: 30px;
        text-align: center;
        box-shadow: 0 4px 15px rgba(122, 92, 219, 0.08);
        transition: all 0.3s ease;
    }

    .card-stat:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 30px rgba(122, 92, 219, 0.15);
    }

    .card-stat h3 {
        font-size: 32px;
        font-weight: 700;
        color: #7c5cdb;
        margin: 0 0 10px 0;
    }

    .card-stat p {
        margin: 0;
        font-size: 14px;
        color: #8a7a9e;
        font-weight: 500;
    }
</style>

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
