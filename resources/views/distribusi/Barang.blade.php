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

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('distribusi.barang.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <input type="text" name="catatan" class="input-modern" placeholder="Nama Barang (disimpan sebagai catatan)">
                    </div>

                    <div class="col-md-4 mb-3">
                        <input type="number" name="jumlah_produk" class="input-modern" placeholder="Jumlah Barang yang Dikirim" min="0">
                    </div>
                </div>

                <div class ="row">
                    <div class="col-md-4 mb-3">
                        <input type="text" name="toko_tujuan" class="input-modern" placeholder="Toko/Alamat Tujuan">
                    </div>

                    <div class="col-md-4 mb-3">
                        <div class="select-wrapper">
                            <select name="status" class="input-modern">
                                <option value="" disabled selected>Status Barang</option>
                                <option value="terkirim">Terkirim</option>
                                <option value="pending">Pending</option>
                            </select>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn-modern btn-primary-modern">Simpan Data</button>
            </form>
        </div>

        <!-- Tabel Distribusi -->
        <div>
            <h4 class="section-title">Data Pengiriman Barang</h4>
            <div class="mt-3">
                <table class="table-modern table-bordered mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Barang (Catatan)</th>
                            <th>Jumlah</th>
                            <th>Tujuan</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse(($distribusis ?? []) as $d)
                        <tr>
                            <td>{{ $d->id }}</td>
                            <td>{{ $d->catatan }}</td>
                            <td>{{ $d->jumlah_produk }}</td>
                            <td>{{ $d->toko_tujuan }}</td>
                            <td>{{ $d->tanggal }}</td>
                            <td>{{ ucfirst($d->status) }}</td>
                            <td>
                                <form action="{{ route('distribusi.barang.updateStatus', $d->id) }}" method="POST" style="display:inline-flex; gap:8px; align-items:center;">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" class="input-modern" style="max-width:160px;">
                                        <option value="terkirim" {{ $d->status==='terkirim' ? 'selected' : '' }}>Terkirim</option>
                                        <option value="pending" {{ $d->status==='pending' ? 'selected' : '' }}>Pending</option>
                                    </select>
                                    <button type="submit" class="btn-modern btn-secondary-modern">Update status</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">Belum ada data distribusi.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection
