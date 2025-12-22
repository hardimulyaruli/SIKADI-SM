@extends('layouts.sidebar') 
@section('content')

<style>
    .page-shell {
        background: #f8fafc;
        border-radius: 16px;
        padding: 18px;
    }

    .card-glass {
        background: #ffffff;
        border-radius: 14px;
        padding: 18px 20px;
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.12);
    }

    .card-head h2 {
        margin: 0;
        font-weight: 800;
        color: #0f172a;
    }

    .card-head p {
        margin: 6px 0 0;
        color: #6b7280;
    }

    .section-title {
        font-size: 18px;
        font-weight: 800;
        margin: 0 0 6px;
        color: #0f172a;
    }

    .section-sub {
        margin: 0;
        color: #6b7280;
    }

    .btn-primary-modern {
        background: linear-gradient(135deg, #0ea5e9, #38bdf8);
        color: #fff;
        border: none;
        border-radius: 12px;
        padding: 10px 16px;
        font-weight: 700;
        box-shadow: 0 12px 30px rgba(56, 189, 248, 0.28);
    }
</style>

<div class="page-shell">
    <div class="card-head mb-3">
        <h2>Laporan Distribusi</h2>
        <p>Upload laporan distribusi ke owner dengan gaya yang konsisten.</p>
    </div>

    <div class="card-glass d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3">
        <div>
            <h4 class="section-title">Buat Laporan Distribusi</h4>
            <p class="section-sub">Hasilkan laporan terbaru berdasarkan data pengiriman terkini.</p>
        </div>

        <form action="#" method="POST" class="m-0">
            @csrf
            <button type="button" class="btn-primary-modern">Buat Laporan</button>
        </form>
    </div>
</div>
@endsection
