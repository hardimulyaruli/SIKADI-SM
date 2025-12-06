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

    .btn-save {
        background: #00c3ff;
        color: #fff;
    }

    .btn-update {
        background: #ff8157;
        color: #fff;
    }

    .text-sampai{
        color: #07d358ff;
    }

    .text-perjalanan{
        color: #ffeb3b;
    }

    .text-diproses{
        color: #ff5e57;
    }

    .table-custom {
        background: linear-gradient(135deg, #6a5bd1, #8b46c7);
        border-radius: 15px;
        overflow: hidden;
        color: white;
    }

    .table thead {
        background: rgba(255, 255, 255, 0.2);
    }

    .table td, .table th {
        color: #020202ff;
    }

    .table-wrapper {
    background: linear-gradient(135deg, #6a5bd1, #8b46c7);
    padding: 15px;
    border-radius: 15px;
    }

    .table-wrapper table {
        background: transparent !important;
    }

    .table-wrapper th, .table-wrapper td {
        background: transparent !important;
        color: white;
    }


    .select-wrapper {
        position: relative;
    }

    .select-wrapper select {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        background: rgba(255, 255, 255, 0.2);
        color: #fff;
        padding-right: 30px;
    }

    .select-wrapper::after {
        content: "˅";
        font-size: 30px;
        color: #8b46c7;
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        pointer-events: none;
    }
</style>

<div class="container-custom">

    <h2 class="mb-1 text-warning">Kelola Distribusi</h2>
    <p>Kelola data gaji karyawan dengan mudah dan cepat.</p>

    <!-- Input Pendistribusi -->
    <div class="section-box">

        <h4 class="section-title">💼 Input Data Distribusi</h4>

        <form action="#" method="POST">

            <div class="row">
                <div class="col-md-4 mb-3">
                    <input type="text" class="form-control" placeholder="Nama Barang (Contoh: Kue Pia)">
                </div>

                <div class="col-md-4 mb-3">
                    <input type="number" class="form-control" placeholder="Jumlah Barang yang Dikirim" min="0">
                </div>
            </div>

            <div class ="row">
                <div class="col-md-4 mb-3">
                    <input type="Text" class="form-control" placeholder="Alamat">
                </div>

                <div class="col-md-4 mb-3">
                    <div class= "select-wrapper">
                        <select class="form-control">
                        <option value="" disabled selected>Status Barang</option>
                        <option value="transport">Sampai Tujuan</option>
                        <option value="makan">Dalam Perjalanan</option>
                        <option value="kesehatan">Pengemasan</option>
                    </select>
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-custom btn-save">Simpan Data</button>
            <button type="button" class="btn btn-custom btn-update">Update status</button>
        </form>
    </div>

    <!-- Tabel Distribusi -->
    <div class="section-box">
        <h4 class="section-title">🚚 Data Pengiriman Barang</h4>
        <div class="table-custom mt-4">
            <div class="table-wrapper">
                <table class="table table-bordered mb-0">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Nama Barang</th>
                            <th>Jumlah barang</th>
                            <th>Alamat</th>
                            <th>Tanggal Kirim</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>DS1001</td>
                            <td>Kue Pia</td>
                            <td>30 Kotak</td>
                            <td>Jakarta</td>
                            <td>2025-06-20</td>
                            <td>
                                <p class="text-sampai">Sampai Tujuan</p>
                            </td>
                        </tr>

                        <tr>
                            <td>DS1002</td>
                            <td>Nastar</td>
                            <td>15</td>
                            <td>Bandung</td>
                            <td>2025-06-25</td>
                            <td>
                                <p class="text-perjalanan">Dalam Perjalanan</p>
                            </td>
                        </tr>

                        <tr>
                            <td>DS1001</td>
                            <td>Kue Bulan</td>
                            <td>10</td>
                            <td>Surabaya</td>
                            <td>2025-07-01</td>
                            <td>
                                <p class="text-diproses">Sedang Diproses</p>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection
