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

    .form-label {
        font-size: 14px;
        color: #fff;
        margin-bottom: 8px;
        font-weight: 500;
    }

    .form-control:focus {
        background: rgba(255, 255, 255, 0.3);
        border-color: #00c3ff;
        color: #fff;
        box-shadow: 0 0 8px rgba(0, 195, 255, 0.3);
    }

    .table tbody tr {
        border-bottom: 1px solid rgba(255, 255, 255, 0.15);
    }

    .table tbody tr:hover {
        background: rgba(255, 255, 255, 0.08);
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

        <h4 class="section-title mb-4">💼 Form Input Gaji</h4>
        <form action="{{ route('keuangan.gaji.store') }}" method="POST" class="p-3 rounded shadow" style="background:rgba(255,255,255,0.08);">
            @csrf
            <div class="row g-3">
                <div class="col-md-6 mb-3">
                    <label for="karyawan_id" class="form-label">Pilih Karyawan</label>
                    <select name="karyawan_id" class="form-control" id="karyawan_id">
                        <option value="">-- Pilih Karyawan --</option>
                        @foreach(App\Models\Karyawan::all() as $karyawan)
                            <option value="{{ $karyawan->id }}">{{ $karyawan->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="tunjangan" class="form-label">Tunjangan</label>
                    <input type="number" class="form-control" id="tunjangan" name="tunjangan" placeholder="Masukkan tunjangan" min="0">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="hari_tidak_masuk" class="form-label">Hari Tidak Masuk</label>
                    <input type="number" class="form-control" id="hari_tidak_masuk" name="hari_tidak_masuk" placeholder="Jumlah hari tidak masuk" min="0">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="total_gaji_diterima" class="form-label">Total Gaji Diterima</label>
                    <input type="number" class="form-control bg-success text-white fw-bold" id="total_gaji_diterima" name="total_gaji_diterima" placeholder="Total gaji diterima" readonly>
                </div>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-custom btn-save px-5">Simpan</button>
            </div>
        </form>

    </div>

    <script>
        const karyawanData = {
            @foreach(App\Models\Karyawan::all() as $karyawan)
                {{ $karyawan->id }}: {
                    gaji: {{ App\Models\Gaji::where('karyawan_id', $karyawan->id)->sum('jumlah_gaji') ?? 0 }},
                    pinjaman: {{ App\Models\Pinjaman::where('pengguna_id', $karyawan->id)->where('status', 'belum_lunas')->sum('jumlah_pinjaman') ?? 0 }}
                },
            @endforeach
        };

        function hitungTotalGaji() {
            var id = document.getElementById('karyawan_id').value;
            var tunjangan = parseInt(document.getElementById('tunjangan').value) || 0;
            var hariTidakMasuk = parseInt(document.getElementById('hari_tidak_masuk').value) || 0;
            var totalGaji = karyawanData[id]?.gaji || 0;
            var totalPinjaman = karyawanData[id]?.pinjaman || 0;
            var potonganAbsensi = hariTidakMasuk * 100000;
            var totalGajiDiterima = totalGaji - potonganAbsensi - totalPinjaman + tunjangan;
            document.getElementById('total_gaji_diterima').value = totalGajiDiterima;
        }

        document.getElementById('tunjangan').addEventListener('input', hitungTotalGaji);
        document.getElementById('hari_tidak_masuk').addEventListener('input', hitungTotalGaji);
        document.getElementById('karyawan_id').addEventListener('change', hitungTotalGaji);
    </script>

    </div>

    <!-- TABEL TRANSAKSI GAJI -->
    <div class="section-box">
        <h4 class="section-title mb-4">📋 Daftar Transaksi Gaji</h4>

        <div class="table-responsive">
            <table class="table table-custom table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="color: #333;">Tanggal</th>
                        <th style="color: #333;">Nama Karyawan</th>
                        <th style="color: #333;">Tunjangan</th>
                        <th style="color: #333;">Hari Tidak Masuk</th>
                        <th style="color: #333;">Total Gaji Diterima</th>
                        <th style="color: #333;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="color: #e0e0e0;">2025-06-20</td>
                        <td style="color: #e0e0e0;">Ahmad Sujadi</td>
                        <td style="color: #e0e0e0;">Rp 500.000</td>
                        <td style="color: #e0e0e0;">0</td>
                        <td style="color: #fff; font-weight: bold;">Rp 4.000.000</td>
                        <td><span class="badge bg-success">Lunas</span></td>
                    </tr>
                    <tr>
                        <td style="color: #e0e0e0;">2025-06-22</td>
                        <td style="color: #e0e0e0;">Siti Nurhaliza</td>
                        <td style="color: #e0e0e0;">Rp 400.000</td>
                        <td style="color: #e0e0e0;">0</td>
                        <td style="color: #fff; font-weight: bold;">Rp 3.400.000</td>
                        <td><span class="badge bg-success">Lunas</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection
