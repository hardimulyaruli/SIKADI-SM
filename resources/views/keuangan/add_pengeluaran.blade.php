@extends('layouts.sidebar')

@section('content')
    <style>
        /* Full width form area */
        .form-wrapper {
            width: 100%;
            padding-right: 20px;
        }

        /* Membuat card lebih pendek (compact) */
        .card-body {
            padding: 15px !important;
        }

        .card-header {
            padding: 10px 15px !important;
        }

        /* Mengurangi jarak antar elemen */
        .mb-3 {
            margin-bottom: 10px !important;
        }
    </style>

    <div class="container-fluid mt-3 form-wrapper">

        <div class="card shadow-sm w-100">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Tambah Transaksi Pengeluaran</h5>
            </div>

            <div class="card-body">

                <form action="{{ route('keuangan.transaksi.post') }}" method="POST">
                    @csrf

                    {{-- Tipe --}}
                    <input type="hidden" name="tipe" value="pengeluaran">

                    {{-- Kategori --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Kategori</label>
                        <select id="kategori" name="kategori" class="form-control">
                            <option value="Bahan" data-harga="2000">Bahan</option>
                            <option value="Operasional" data-harga="5000">Operasional</option>
                            <option value="Lain-lain" data-harga="1000">Lain-lain</option>
                        </select>
                    </div>

                    {{-- Qty --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Qty</label>
                        <input type="number" id="qty" name="qty" class="form-control" min="1"
                            value="1">
                    </div>

                    {{-- Nominal --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nominal</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input id="nominal" type="text" name="nominal" class="form-control" readonly
                                value="2000">
                        </div>
                    </div>

                    {{-- Tanggal --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control"
                            value="{{ old('tanggal', date('Y-m-d')) }}">
                    </div>

                    {{-- Deskripsi --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="2"></textarea>
                    </div>

                    {{-- Tombol --}}
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('keuangan.transaksi') }}" class="btn btn-secondary">Kembali</a>

                </form>

            </div>
        </div>

    </div>

    {{-- Script Hitung Nominal --}}
    <script>
        function hitungNominal() {
            const kategori = document.querySelector('#kategori');
            const harga = kategori.options[kategori.selectedIndex].getAttribute('data-harga');
            const qty = document.querySelector('#qty').value;

            document.querySelector('#nominal').value = harga * qty;
        }

        document.querySelector('#kategori').addEventListener('change', hitungNominal);
        document.querySelector('#qty').addEventListener('input', hitungNominal);
    </script>
@endsection
