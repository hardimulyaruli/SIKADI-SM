@extends('layouts.sidebar')

@section('content')

    <div class="container-fluid mt-3">

        <div class="card card-glass shadow-sm w-100">
            <div class="card-header border-0 bg-transparent">
                <div class="d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Tambah Transaksi Pengeluaran</h5>
                </div>
            </div>

            <div class="card-body">

                <form action="{{ route('keuangan.transaksi.post') }}" method="POST">
                    @csrf

                    {{-- Tipe --}}
                    <input type="hidden" name="tipe" value="pengeluaran">

                    {{-- Kategori --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Kategori</label>
                        <select id="kategori" name="kategori" class="input-modern">
                            <option value="Bahan" data-harga="2000">Bahan</option>
                            <option value="Operasional" data-harga="5000">Operasional</option>
                            <option value="Lain-lain" data-harga="1000">Lain-lain</option>
                        </select>
                    </div>

                    {{-- Qty --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Qty</label>
                        <input type="number" id="qty" name="qty" class="input-modern" min="1"
                            value="1">
                    </div>

                    {{-- Nominal --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nominal</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input id="nominal" type="text" name="nominal" class="input-modern" readonly
                                value="2000">
                        </div>
                    </div>

                    {{-- Tanggal --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Tanggal</label>
                        <input type="date" name="tanggal" class="input-modern"
                            value="{{ old('tanggal', date('Y-m-d')) }}">
                    </div>

                    {{-- Deskripsi --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Deskripsi</label>
                        <textarea name="deskripsi" class="input-modern" rows="2"></textarea>
                    </div>

                    {{-- Tombol --}}
                    <div class="d-flex justify-content-end mt-3">
                        <button type="submit" class="btn-modern btn-primary-modern">Simpan</button>
                        <a href="{{ route('keuangan.transaksi') }}" class="btn-modern btn-secondary-modern ms-2">Kembali</a>
                    </div>

                </form>

            </div>
        </div>

    </div>

    {{-- Script Hitung Nominal --}}
    <script>
        function hitungNominal() {
            const kategori = document.querySelector('#kategori');
            const qtyEl = document.querySelector('#qty');
            const nominalEl = document.querySelector('#nominal');
            if (!kategori || !qtyEl || !nominalEl) return;
            const opt = kategori.options[kategori.selectedIndex];
            const harga = parseFloat(opt?.getAttribute('data-harga')) || 0;
            const qty = parseFloat(qtyEl.value) || 0;
            nominalEl.value = harga * qty;
        }

        const kategoriEl = document.querySelector('#kategori');
        const qtyEl = document.querySelector('#qty');
        if (kategoriEl) kategoriEl.addEventListener('change', hitungNominal);
        if (qtyEl) qtyEl.addEventListener('input', hitungNominal);
        document.addEventListener('DOMContentLoaded', hitungNominal);
    </script>
@endsection
