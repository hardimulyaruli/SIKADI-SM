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
        font-size: 18px;
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

    .table-custom {
        background: rgba(255, 255, 255, 0.12);
        border-radius: 15px;
        overflow: hidden;
        color: white;
    }

    .table thead {
        background: rgba(255, 255, 255, 0.2);
    }

    .table td, .table th {
        color: #fff;
    }
</style>

<div class="container-custom">

    <h2 class="mb-1 text-warning">Kelola Data Gaji</h2>
    <p>Kelola data gaji karyawan dengan mudah dan cepat.</p>

    <!-- BOX FORM INPUT GAJI -->
    <div class="section-box">

        <h4 class="section-title">💼 Form Input Gaji</h4>

        <form action="#" method="POST">

            <div class="row">
                <div class="col-md-4 mb-3">
                    <input type="text" class="form-control" placeholder="Nama Karyawan">
                </div>

                <div class="col-md-4 mb-3">
                    <input type="number" class="form-control" placeholder="Gaji Pokok">
                </div>

                <div class="col-md-4 mb-3">
                    <input type="number" class="form-control" placeholder="Tunjangan">
                </div>
            </div>

            <button type="submit" class="btn btn-custom btn-save">Simpan</button>
            <button type="button" class="btn btn-custom btn-update">Update</button>

        </form>

    </div>

    <!-- TABEL TRANSAKSI GAJI -->
    <div class="section-box">

        <h4 class="section-title">📋 Daftar Transaksi Gaji</h4>

        <div class="table-responsive table-custom">
            <table class="table table-borderless mb-0">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Nama Karyawan</th>
                        <th>Gaji Pokok</th>
                        <th>Tunjangan</th>
                        <th>Total Gaji</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>2025-06-20</td>
                        <td>Ahmad Sujadi</td>
                        <td>Rp 3.500.000</td>
                        <td>Rp 500.000</td>
                        <td><b>Rp 4.000.000</b></td>
                        <td class="text-success">Lunas</td>
                    </tr>

                    <tr>
                        <td>2025-06-22</td>
                        <td>Siti Nurhaliza</td>
                        <td>Rp 3.000.000</td>
                        <td>Rp 400.000</td>
                        <td><b>Rp 3.400.000</b></td>
                        <td class="text-success">Lunas</td>
                    </tr>
                </tbody>

            </table>
        </div>

    </div>

</div>

@endsection
