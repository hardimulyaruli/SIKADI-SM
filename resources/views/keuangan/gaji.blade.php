@extends('layouts.sidebar')
@section('content')

<style>
    .page-header {
        margin-bottom: 40px;
        animation: slideInUp 0.6s ease;
    }

    .page-header h1 {
        font-size: 32px;
        font-weight: 700;
        color: #2d2d2d;
        margin-bottom: 8px;
    }

    .page-header p {
        color: #8a7a9e;
        font-size: 14px;
    }

    .form-section {
        display: flex;
        gap: 20px;
        margin-bottom: 40px;
        flex-wrap: wrap;
    }

    .form-group-custom {
        flex: 1;
        min-width: 250px;
    }

    .form-group-custom label {
        display: block;
        color: #5a4a7a;
        font-weight: 600;
        margin-bottom: 10px;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .form-group-custom input,
    .form-group-custom select {
        width: 100%;
        background: rgba(255, 255, 255, 0.9);
        border: 1px solid rgba(122, 92, 219, 0.2);
        border-radius: 12px;
        padding: 12px 16px;
        color: #2d2d2d;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    .form-group-custom input::placeholder,
    .form-group-custom select::placeholder {
        color: rgba(122, 92, 219, 0.5);
    }

    .form-group-custom input:focus,
    .form-group-custom select:focus {
        outline: none;
        background: rgba(255, 255, 255, 1);
        border-color: #7c5cdb;
        box-shadow: 0 0 0 3px rgba(122, 92, 219, 0.1);
        transform: translateY(-2px);
    }

    .btn-submit {
        background: linear-gradient(135deg, #7c5cdb 0%, #6b4db8 100%);
        color: white;
        border: none;
        padding: 14px 40px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        cursor: pointer;
        transition: all 0.3s ease;
        align-self: flex-end;
        box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
    }

    .btn-submit:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(122, 92, 219, 0.4);
        color: white;
    }

    .table-wrapper {
        overflow-x: auto;
        border-radius: 20px;
        box-shadow: 0 4px 15px rgba(122, 92, 219, 0.08);
    }

    .table-custom {
        border-collapse: collapse;
        width: 100%;
    }

    .table-custom thead {
        background: linear-gradient(135deg, rgba(122, 92, 219, 0.1) 0%, rgba(147, 112, 219, 0.1) 100%);
        border-bottom: 2px solid rgba(122, 92, 219, 0.2);
    }

    .table-custom thead th {
        padding: 18px 20px;
        color: #5a4a7a;
        font-weight: 600;
        text-align: left;
        text-transform: uppercase;
        font-size: 12px;
        letter-spacing: 0.5px;
    }

    .table-custom tbody tr {
        border-bottom: 1px solid rgba(122, 92, 219, 0.1);
        transition: all 0.3s ease;
    }

    .table-custom tbody tr:hover {
        background: rgba(122, 92, 219, 0.05);
        transform: translateX(3px);
    }

    .table-custom tbody td {
        padding: 16px 20px;
        color: #4a4a6a;
        font-size: 14px;
    }

    .badge-custom {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        background: rgba(122, 92, 219, 0.1);
        color: #7c5cdb;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #8a7a9e;
    }

    .empty-state i {
        font-size: 48px;
        margin-bottom: 20px;
        opacity: 0.3;
    }

    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 768px) {
        .form-section {
            flex-direction: column;
        }

        .btn-submit {
            width: 100%;
        }
    }
</style>

<!-- PAGE HEADER -->
<div class="page-header">
    <h1><i class="fas fa-money-check"></i> Kelola Data Gaji</h1>
    <p>Kelola data penggajian karyawan dengan mudah dan cepat</p>
</div>

<!-- FORM INPUT GAJI -->
<div class="card-glass animate-slide-up" style="margin-bottom: 40px;">
    <h3 style="margin-bottom: 30px; font-size: 18px; font-weight: 600; color: #2d2d2d;">
        <i class="fas fa-clipboard-list" style="color: #7c5cdb;"></i> Form Input Penggajian
    </h3>

    <form action="{{ route('keuangan.gaji.store') }}" method="POST">
        @csrf
        
        <div class="form-section">
            <div class="form-group-custom">
                <label for="karyawan_id">Pilih Karyawan</label>
                <select name="karyawan_id" id="karyawan_id" required>
                    <option value="">-- Pilih Karyawan --</option>
                    @foreach(App\Models\Karyawan::all() as $karyawan)
                        <option value="{{ $karyawan->id }}">{{ $karyawan->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group-custom">
                <label for="tunjangan">Tunjangan (Rp)</label>
                <input type="number" id="tunjangan" name="tunjangan" placeholder="Masukkan nominal tunjangan" min="0" step="10000">
            </div>

            <div class="form-group-custom">
                <label for="hari_tidak_masuk">Hari Tidak Masuk</label>
                <input type="number" id="hari_tidak_masuk" name="hari_tidak_masuk" placeholder="Jumlah hari" min="0">
            </div>

            <div class="form-group-custom">
                <label for="total_gaji_diterima">Total Gaji Diterima (Rp)</label>
                <input type="number" id="total_gaji_diterima" name="total_gaji_diterima" placeholder="Otomatis terhitung" readonly style="background: rgba(34, 197, 94, 0.15); border-color: rgba(34, 197, 94, 0.3); cursor: not-allowed;">
            </div>
        </div>

        <button type="submit" class="btn-submit">
            <i class="fas fa-save"></i> Simpan Penggajian
        </button>
    </form>
</div>

<!-- TABEL RIWAYAT PENGGAJIAN -->
<div class="card-glass animate-slide-up" style="padding: 0;">
    <div style="padding: 30px; border-bottom: 1px solid rgba(122, 92, 219, 0.1);">
        <h3 style="margin: 0; font-size: 18px; font-weight: 600; color: #2d2d2d;">
            <i class="fas fa-history" style="color: #7c5cdb;"></i> Riwayat Penggajian
        </h3>
    </div>

    @if($penggajian->count() > 0)
        <div class="table-wrapper">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Nama Karyawan</th>
                        <th>Tunjangan</th>
                        <th>Hari Tidak Masuk</th>
                        <th>Total Gaji Diterima</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($penggajian as $item)
                        <tr>
                            <td>
                                <span class="badge-custom" style="background: rgba(122, 92, 219, 0.1); color: #7c5cdb;">
                                    {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                                </span>
                            </td>
                            <td>{{ $item->karyawan->nama }}</td>
                            <td>Rp {{ number_format($item->tunjangan, 0, ',', '.') }}</td>
                            <td>{{ $item->hari_tidak_masuk }} hari</td>
                            <td style="font-weight: 600; color: #7c5cdb;">Rp {{ number_format($item->total_gaji_diterima, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="empty-state">
            <i class="fas fa-inbox"></i>
            <p>Belum ada data penggajian</p>
            <p style="font-size: 12px; color: #b8a5d1;">Mulai dengan mengisi form di atas untuk menambahkan data penggajian</p>
        </div>
    @endif
</div>

<script>
    const karyawanData = {
        @foreach(App\Models\Karyawan::all() as $karyawan)
            {{ $karyawan->id }}: {
                gaji: {{ App\Models\Gaji::where('karyawan_id', $karyawan->id)->sum('jumlah_gaji') ?? 0 }},
                pinjaman: {{ App\Models\Pinjaman::where('karyawan_id', $karyawan->id)->where('status', 'belum_lunas')->sum('jumlah_pinjaman') ?? 0 }}
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
        document.getElementById('total_gaji_diterima').value = totalGajiDiterima >= 0 ? totalGajiDiterima : 0;
    }

    // Add event listeners with animations
    ['tunjangan', 'hari_tidak_masuk', 'karyawan_id'].forEach(id => {
        document.getElementById(id)?.addEventListener('input', hitungTotalGaji);
        document.getElementById(id)?.addEventListener('change', hitungTotalGaji);
    });

    // GSAP animations disabled - prevent content from disappearing
</script>

@endsection
