@extends('layouts.sidebar')

@section('content')

<style>
    .gradient-box {
        background: linear-gradient(135deg, #6a4ff7, #9656e3, #b56ad8);
        padding: 30px;
        border-radius: 20px;
        color: white;
    }

    .inner-box {
        background: linear-gradient(135deg, #8b66e8, #a26de0, #b678d8);
        border-radius: 15px;
        padding: 25px;
    }

    .white-box {
        background: #fff;
        color: #000;
        border-radius: 10px;
        padding: 20px;
    }

    .form-control {
        background: rgba(255,255,255,0.25);
        border: none;
        color: white;
    }

    .form-control::placeholder {
        color: #eee;
    }
</style>

<div class="gradient-box">
    <h2><b>📊 Laporan Keuangan</b></h2>
    <p>Ringkasan keseluruhan pemasukan, pengeluaran, dan transaksi lainnya.</p>

    <!-- FILTER -->
    <div class="inner-box mt-4">
        <h4>🔎 Filter Laporan</h4>

        <div class="row mt-3">
            <div class="col-md-4">
                <select class="form-control">
                    <option value="">Pilih Jenis Laporan</option>
                    <option value="bulanan">Bulanan</option>
                    <option value="tahunan">Tahunan</option>
                    <option value="pinjaman">Laporan Pinjaman</option>
                </select>
            </div>

            <div class="col-md-4">
                <input type="month" class="form-control" placeholder="Pilih Bulan">
            </div>

            <div class="col-md-4">
                <button class="btn btn-save w-100">Tampilkan</button>
            </div>
        </div>
    </div>

    <!-- RESULT BOX -->
    <div class="inner-box mt-4">
        <h4>📄 Hasil Laporan</h4>

        <div class="white-box mt-3" style="height: 220px; overflow:auto;">
            <p><b>Pemasukan:</b> Rp 10.000.000</p>
            <p><b>Pengeluaran:</b> Rp 6.500.000</p>
            <p><b>Total Pinjaman:</b> Rp 2.000.000</p>
            <hr>
            <p><b>Sisa Saldo:</b> Rp 1.500.000</p>
        </div>
    </div>

</div>

@endsection
