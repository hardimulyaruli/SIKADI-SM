@extends('layouts.sidebar') 
@section('content')

<style>
    .container-custom {
        padding: 0;
    }

    .section-title {
        font-size: 20px;
        font-weight: 700;
        margin-bottom: 15px;
        color: #0369a1;
    }

    /* TEXTBOX STYLE */
    .textbox {
        background: #ffffff;
        border: 1px solid rgba(56, 189, 248, 0.25);
        border-radius: 10px;
        padding: 12px 16px;
        font-size: 14px;
        width: 350px;
        color: #1f2937;

        /* smooth animation */
        transition: 
            border-color 0.25s ease,
            box-shadow 0.25s ease,
            background-color 0.25s ease;
    }

    /* hover effect */
    .textbox:hover {
        border-color: #38bdf8;
    }

    /* focus effect */
    .textbox:focus {
        outline: none;
        border-color: #38bdf8;
        box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.25);
        background-color: #f8fbff;
    }

    /* SELECT FIX */
    select.textbox {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg fill='none' stroke='%230369a1' stroke-width='2' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 14px center;
        background-size: 18px;
        padding-right: 42px;
        cursor: pointer;
    }
</style>

<div class="card-glass">
    <h2 class="mb-1">Kelola Distribusi</h2>
    <p class="mb-3">Kelola data distribusi dengan mudah dan rapi.</p>

    <!-- Input Data -->
    <div class="mb-4">
        <h4 class="section-title">Input Data Distribusi</h4>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul style="margin-bottom:0;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <form action="{{ route('distribusi.barang.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-4 mb-3">
                    <input type="text"
                           name="catatan"
                           class="textbox"
                           placeholder="Nama Barang (disimpan sebagai catatan)">
                </div>

                <div class="col-md-4 mb-3">
                    <input type="number"
                           name="jumlah_produk"
                           class="textbox"
                           placeholder="Jumlah yang Dikirim (dihitung Per box)"
                           min="1">
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <input type="text"
                           name="toko_tujuan"
                           class="textbox"
                           placeholder="Toko/Alamat Tujuan">
                </div>

                <div class="col-md-4 mb-3">
                    <select name="status" class="textbox">
                        <option value="" disabled selected>Status Barang</option>
                        <option value="terkirim">Terkirim</option>
                        <option value="pending">Pending</option>
                    </select>
                </div>
            </div>

            <button type="submit" class="btn-modern btn-primary-modern">
                Simpan Data
            </button>
        </form>
    </div>

    <!-- Tabel -->
    <div>
        <h4 class="section-title">Data Pengiriman Barang</h4>

        <table class="table-modern table-bordered mb-0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Tujuan</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($distribusis as $d)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $d->catatan }}</td>
                    <td>{{ $d->jumlah_produk }}</td>
                    <td>{{ $d->toko_tujuan }}</td>
                    <td>{{ $d->tanggal }}</td>
                    <td>{{ ucfirst($d->status) }}</td>
                    <td>
                        <a href="{{ route('distribusi.edit', $d->id) }}"
                           class="btn-modern btn-secondary-modern">
                           Edit Status
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">
                        Belum ada data distribusi.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection