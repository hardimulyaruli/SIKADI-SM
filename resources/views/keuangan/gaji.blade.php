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
            background: #ffffff;
            border: 1px solid rgba(56, 189, 248, 0.15);
            border-radius: 10px;
            padding: 12px 16px;
            color: #1f2937;
            font-size: 14px;
        }

        .form-group-custom input::placeholder,
        .form-group-custom select::placeholder {
            color: rgba(31, 41, 55, 0.45);
        }

        .form-group-custom input:focus,
        .form-group-custom select:focus {
            outline: none;
            background: #ffffff;
            border-color: #38bdf8;
            box-shadow: none;
        }

        .btn-submit {
            align-self: flex-end;
        }

        .table-wrapper {
            overflow-x: auto;
            border-radius: 20px;
            box-shadow: 0 4px 15px rgba(122, 92, 219, 0.08);
        }

        .table-modern {
            border-collapse: collapse;
            width: 100%;
        }

        .table-modern thead {
            background: linear-gradient(135deg, rgba(14, 165, 233, 0.06) 0%, rgba(3, 105, 161, 0.04) 100%);
            border-bottom: 2px solid rgba(14, 165, 233, 0.08);
        }

        .table-modern thead th {
            padding: 18px 20px;
            color: #0f172a;
            font-weight: 700;
            text-align: left;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
        }

        .table-modern tbody tr {
            border-bottom: 1px solid rgba(148, 163, 184, 0.06);
        }

        .table-modern tbody tr:hover {
            background: rgba(14, 165, 233, 0.04);
        }

        .table-modern tbody td {
            padding: 16px 20px;
            color: #374151;
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
        <p>Kelola data penggajian karyawan </p>
    </div>

    <!-- FORM INPUT GAJI -->
    <div class="card-glass" style="margin-bottom: 40px;">
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
                        @foreach (App\Models\Karyawan::all() as $karyawan)
                            <option value="{{ $karyawan->id }}">{{ $karyawan->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group-custom">
                    <label for="tunjangan">Bonus (Rp)</label>
                    <input type="number" id="tunjangan" name="tunjangan" placeholder="Masukkan nominal tunjangan"
                        min="0" step="10000">
                </div>

                <div class="form-group-custom">
                    <label for="hari_tidak_masuk">Hari Tidak Masuk</label>
                    <input type="number" id="hari_tidak_masuk" name="hari_tidak_masuk" placeholder="Jumlah hari"
                        min="0">
                </div>

                <div class="form-group-custom">
                    <label for="total_gaji_diterima">Total Gaji Diterima (Rp)</label>
                    <input type="hidden" id="total_gaji_diterima" name="total_gaji_diterima">
                    <input type="text" id="total_gaji_display" class="form-control" placeholder="Otomatis terhitung"
                        readonly
                        style="background: rgba(34, 197, 94, 0.15); border-color: rgba(34, 197, 94, 0.3); cursor: not-allowed;">
                </div>
            </div>

            <button type="submit" class="btn-modern btn-primary-modern">
                <i class="ri-save-line"></i> Simpan Penggajian
            </button>
        </form>
    </div>

    <!-- TABEL RIWAYAT PENGGAJIAN -->
    <div class="card-glass" style="padding: 0;">
        <div style="padding: 30px; border-bottom: 1px solid rgba(122, 92, 219, 0.1);">
            <h3 style="margin: 0; font-size: 18px; font-weight: 600; color: #2d2d2d;">
                <i class="fas fa-history" style="color: #7c5cdb;"></i> Riwayat Penggajian
            </h3>
        </div>

        @if ($penggajian->count() > 0)
            <div class="table-wrapper">
                <table class="table-modern">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Nama Karyawan</th>
                            <th>Bonus</th>
                            <th>Hari Tidak Masuk</th>
                            <th>Total Gaji Diterima</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (($penggajian ?? collect())->sortByDesc('created_at') as $item)
                            <tr>
                                <td>
                                    <span class="badge-custom" style="background: rgba(122, 92, 219, 0.1); color: #7c5cdb;">
                                        {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                                    </span>
                                </td>
                                <td>{{ $item->karyawan->nama }}</td>
                                <td>Rp {{ number_format($item->tunjangan, 0, ',', '.') }}</td>
                                <td>{{ $item->hari_tidak_masuk }} hari</td>
                                <td style="font-weight: 600; color: #7c5cdb;">Rp
                                    {{ number_format($item->total_gaji_diterima, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-inbox"></i>
                <p>Belum ada data penggajian</p>
                <p style="font-size: 12px; color: #b8a5d1;">Mulai dengan mengisi form di atas untuk menambahkan data
                    penggajian</p>
            </div>
        @endif
    </div>

    <script>
        const karyawanData = {
            @foreach (App\Models\Karyawan::all() as $karyawan)
                {{ $karyawan->id }}: {
                    gaji: {{ App\Models\Gaji::where('karyawan_id', $karyawan->id)->orderByDesc('tanggal')->value('jumlah_gaji') ?? 0 }},
                    pinjaman: {{ App\Models\Pinjaman::where('karyawan_id', $karyawan->id)->where('status', 'belum_lunas')->sum('jumlah_pinjaman') ?? 0 }}
                },
            @endforeach
        };

        function hitungTotalGaji() {
            var id = document.getElementById('karyawan_id').value;
            var tunjangan = parseInt(document.getElementById('tunjangan').value) || 0;
            var hariTidakMasuk = parseInt(document.getElementById('hari_tidak_masuk').value) || 0;
            var totalGaji = karyawanData[id]?.gaji || 0; // gaji bulanan terbaru
            var totalPinjaman = karyawanData[id]?.pinjaman || 0;
            var potonganAbsensi = hariTidakMasuk * 100000; // flat 100k per absen
            var totalGajiDiterima = Math.round(totalGaji - potonganAbsensi - totalPinjaman + tunjangan);
            var nilaiBulat = totalGajiDiterima >= 0 ? totalGajiDiterima : 0;
            document.getElementById('total_gaji_diterima').value = nilaiBulat;
            document.getElementById('total_gaji_display').value = formatRupiah(nilaiBulat);
        }

        function formatRupiah(angka) {
            var numberString = (angka || 0).toString();
            return 'Rp ' + numberString.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }

        // Add event listeners with animations
        ['tunjangan', 'hari_tidak_masuk', 'karyawan_id'].forEach(id => {
            document.getElementById(id)?.addEventListener('input', hitungTotalGaji);
            document.getElementById(id)?.addEventListener('change', hitungTotalGaji);
        });

        // GSAP animations disabled - prevent content from disappearing
    </script>

@endsection
