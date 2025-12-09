@extends('layouts.sidebar') 
@section('content')

<style>
    /* Use global card & input/table styles for consistent blue theme */
    .container-custom {
        padding: 0;
    }

    .section-title {
        font-size: 20px;
        font-weight: 700;
        margin-bottom: 15px;
        color: #0369a1;
    }

    .select-wrapper {
        position: relative;
    }

    .select-wrapper select {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        padding-right: 30px;
    }

    .select-wrapper::after {
        content: "˅";
        font-size: 18px;
        color: #0369a1;
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        pointer-events: none;
    }
</style>

    <div class="card-glass">
        <h2 class="mb-1">Kelola Distribusi</h2>
        <p class="mb-3">Kelola data distribusi dengan mudah dan rapi.</p>

        <!-- Input Pendistribusi -->
        <div class="mb-4">

            <h4 class="section-title">Input Data Distribusi</h4>

            <form action="#" method="POST">

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <input type="text" class="input-modern" placeholder="Nama Barang (Contoh: Kue Pia)">
                    </div>

                    <div class="col-md-4 mb-3">
                        <input type="number" class="input-modern" placeholder="Jumlah Barang yang Dikirim" min="0">
                    </div>
                </div>

                <div class ="row">
                    <div class="col-md-4 mb-3">
                        <input type="text" class="input-modern" placeholder="Alamat">
                    </div>

                    <div class="col-md-4 mb-3">
                        <div class="select-wrapper">
                            <select class="input-modern">
                                <option value="" disabled selected>Status Barang</option>
                                <option value="transport">Sampai Tujuan</option>
                                <option value="makan">Dalam Perjalanan</option>
                                <option value="kesehatan">Pengemasan</option>
                            </select>
                        </div>
                    </div>
                </div>

                <button type="button" class="btn-modern btn-primary-modern">Simpan Data</button>
                <button type="button" class="btn-modern btn-secondary-modern">Update status</button>
            </form>
        </div>

        <!-- Tabel Distribusi -->
        <div>
            <h4 class="section-title">Data Pengiriman Barang</h4>
            <div class="mt-3">
                <table class="table-modern table-bordered mb-0">
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
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <p class="text-sampai"></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection
