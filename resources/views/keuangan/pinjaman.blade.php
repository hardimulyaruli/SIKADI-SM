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

    .btn-save {
        background: #00c0ff;
        color: white;
    }

    .btn-update {
        background: #ff835c;
        color: white;
    }

    .status-lunas {
        color: rgb(0, 133, 106);
        font-weight: bold;
    }
</style>


<div class="gradient-box">
    <h2><b>Kelola Data Pinjaman</b></h2>
    <p>Kelola pinjaman pegawai dengan mudah dan cepat.</p>

    <div class="inner-box mt-4">

        <!-- FORM INPUT -->
        <h4>💼 Form Input Pinjaman</h4>

        <div class="row mt-3">
            <div class="col-md-4">
                <input type="text" class="form-control" placeholder="Nama Pegawai">
            </div>

            <div class="col-md-4">
                <input type="number" class="form-control" placeholder="Jumlah Pinjaman">
            </div>

            <div class="col-md-4">
                <input type="date" class="form-control">
            </div>
        </div>

        <div class="mt-3">
            <button class="btn btn-save">Simpan</button>
            <button class="btn btn-update">Update</button>
        </div>
    </div>


    <!-- LIST DATA -->
    <div class="inner-box mt-4">
        <h4>📄 Daftar Pinjaman</h4>
        <div class="mt-3 p-3 bg-white text-dark rounded" style="height: 200px;">
            <p class="status-lunas">Lunas</p>
            <p class="status-lunas">Lunas</p>
        </div>
    </div>

</div>

@endsection
