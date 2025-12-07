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
    .form-control {
        background: rgba(255,255,255,0.25);
        border: none;
        color: white;
    }
    .form-control::placeholder {
        color: #eee;
    }
    .btn-save { background: #00c0ff; color:white; }
    .btn-update { background: #ff835c; color:white; }
</style>

<div class="gradient-box">
    <h2><b>Kelola Pengeluaran</b></h2>
    <p>Catat pengeluaran keuangan perusahaan.</p>

    <div class="inner-box mt-4">
        <h4>📤 Form Input Pengeluaran</h4>

        <div class="row mt-3">
            <div class="col-md-6">
                <input class="form-control" placeholder="Keperluan">
            </div>
            <div class="col-md-6">
                <input type="number" class="form-control" placeholder="Jumlah">
            </div>
        </div>

        <div class="mt-3">
            <button class="btn btn-save">Simpan</button>
            <button class="btn btn-update">Update</button>
        </div>
    </div>

    <div class="inner-box mt-4">
        <h4>📄 Daftar Pengeluaran</h4>

        <div class="bg-white text-dark rounded p-3 mt-3" style="height:200px;">
            <p>(Data)</p>
        </div>
    </div>

</div>

@endsection
