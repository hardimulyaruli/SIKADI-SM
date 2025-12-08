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

        <form action="{{ route('keuangan.gaji.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-3 mb-3">
                    <select name="karyawan_id" class="form-control" id="karyawan_id" onchange="updateNamaKaryawan()">
                        <option value="">Pilih ID Karyawan</option>
                        @foreach(App\Models\Karyawan::all() as $karyawan)
                            <option value="{{ $karyawan->id }}">{{ $karyawan->id }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <input type="text" class="form-control" id="nama_karyawan" placeholder="Nama Karyawan" readonly>
                </div>
                </script>
                <script>
                    const karyawanData = {
                        @foreach(App\Models\Karyawan::all() as $karyawan)
                            {{ $karyawan->id }}: {
                                nama: "{{ $karyawan->nama }}",
                                gaji: {{ App\Models\Gaji::where('karyawan_id', $karyawan->id)->sum('jumlah_gaji') ?? 0 }},
                                pinjaman: {{ App\Models\Pinjaman::where('pengguna_id', $karyawan->id)->where('status', 'belum_lunas')->sum('jumlah_pinjaman') ?? 0 }}
                            },
                        @endforeach
                    };

                    function updateNamaKaryawan() {
                        var id = document.getElementById('karyawan_id').value;
                        document.getElementById('nama_karyawan').value = karyawanData[id]?.nama || '';
                        hitungTotalGaji();
                    }

                    function hitungTotalGaji() {
                        var id = document.getElementById('karyawan_id').value;
                        var tunjangan = parseInt(document.querySelector('input[placeholder="Tunjangan"]').value) || 0;
                        var hariTidakMasuk = parseInt(document.querySelector('input[placeholder="Hari Tidak Masuk"]').value) || 0;
                        var totalGaji = karyawanData[id]?.gaji || 0;
                        var totalPinjaman = karyawanData[id]?.pinjaman || 0;
                        var potonganAbsensi = hariTidakMasuk * 100000;
                        var totalGajiDiterima = totalGaji - potonganAbsensi - totalPinjaman + tunjangan;
                        document.querySelector('input[placeholder="Total Gaji Diterima"]').value = totalGajiDiterima > 0 ? totalGajiDiterima : 0;
                    }

                    document.querySelector('input[placeholder="Tunjangan"]').addEventListener('input', hitungTotalGaji);
                    document.querySelector('input[placeholder="Hari Tidak Masuk"]').addEventListener('input', hitungTotalGaji);
                    document.getElementById('karyawan_id').addEventListener('change', updateNamaKaryawan);
                </script>
                <div class="col-md-3 mb-3">
                    <input type="number" class="form-control" placeholder="Tunjangan">
                </div>
                <div class="col-md-3 mb-3">
                    <input type="number" class="form-control" placeholder="Hari Tidak Masuk">
                </div>
                <div class="col-md-3 mb-3">
                    <input type="number" class="form-control" placeholder="Total Gaji Diterima" readonly>
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
                        <th>Tunjangan</th>
                        <th>Hari Tidak Masuk</th>
                        <th>Total Gaji Diterima</th>
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
