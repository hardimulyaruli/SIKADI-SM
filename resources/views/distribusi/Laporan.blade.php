@extends('layouts.sidebar') 
@section('content')

<style>
    .container-custom {
        background: linear-gradient(135deg, #6a5bd1, #8b46c7);
        padding: 25px;
        border-radius: 15px;
        color: #fff;
    }

    .section-box {
        background: rgba(255, 255, 255, 0.12);
        padding: 20px;
        border-radius: 15px;
        backdrop-filter: blur(5px);
        margin-bottom: 20px;
    }

    .section-title {
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 15px;
        color: #ffeb3b;
    }

    .form-control {
        background: rgba(255, 255, 255, 0.2);
        border: none;
        color: #fff;
    }

    .form-control::placeholder {
        color: #ddd;
    }

    .btn-custom {
        border: none;
        padding: 8px 18px;
        border-radius: 8px;
        font-weight: bold;
    }

    .btn-kirim {
        background: #00c3ff;
        color: #fff;
    }


</style>

<div class="container-custom">

    <h2 class="mb-1 text-warning">Laporan Distribusi</h2>
    <p>Upload Laporan Distribusi ke Owner.</p>

    <!-- BOX FORM INPUT GAJI -->
    <div class="section-box">

        <h4 class="section-title">📄 Buat Laporan</h4>
        <p>Klik Tombol di bawah untuk Menghasilkan laporan distribusi terbaru berdasarkan data pengiriman</p>
        <form action="#" method="POST">
            <button type="button" class="btn-modern btn-primary-modern">Buat Laporan Distribusi</button>
        </form>
    </div>
</div>
@endsection
