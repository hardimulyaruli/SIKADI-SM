@extends('layouts.sidebar')

@section('content')
    <style>
        .page-header {
            margin-bottom: 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
        }

        .page-header h1 {
            font-size: 28px;
            font-weight: 700;
            margin: 0;
        }

        .page-header p {
            margin: 2px 0 0;
            color: #6b7280;
            font-size: 13px;
        }

        .card-stat {
            background: #fff;
            border-radius: 14px;
            padding: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .card-stat h4 {
            margin: 0 0 6px;
            font-weight: 700;
            color: #111827;
            font-size: 20px;
        }

        .card-stat p {
            margin: 0;
            color: #6b7280;
            font-size: 13px;
        }

        .stat-icon {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            margin-bottom: 8px;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
            font-size: 14px;
        }

        .icon-income {
            background: linear-gradient(135deg, #22c55e, #16a34a);
        }

        .icon-outcome {
            background: linear-gradient(135deg, #ef4444, #dc2626);
        }

        .icon-salary {
            background: linear-gradient(135deg, #2563eb, #4f46e5);
        }

        .icon-loan {
            background: linear-gradient(135deg, #f97316, #ea580c);
        }

        .icon-balance {
            background: linear-gradient(135deg, #0ea5e9, #0284c7);
        }

        .chart-box {
            background: #fff;
            border-radius: 14px;
            padding: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
            height: 100%;
        }

        .chart-box canvas {
            width: 100% !important;
            height: 340px !important;
        }

        .table-wrapper {
            margin-top: 12px;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
        }

        .table-wrapper-header {
            background: linear-gradient(135deg, #38bdf8, #6366f1);
            color: #fff;
            padding: 14px 16px;
            font-weight: 700;
            font-size: 14px;
        }

        .table-modern {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
        }

        .table-modern th,
        .table-modern td {
            padding: 12px 14px;
            border-top: 1px solid #e5e7eb;
            font-size: 13px;
        }

        .table-modern thead th {
            background: #f8fafc;
            text-transform: uppercase;
            font-size: 11px;
            letter-spacing: 0.04em;
        }

        .table-modern tbody tr:nth-child(every) {}

        .empty-state {
            text-align: center;
            color: #9ca3af;
            padding: 28px;
        }

        @media (max-width: 768px) {
            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .chart-box canvas {
                height: 260px !important;
            }
        }
    </style>

    <div class="page-header">
        <div>
            <h1><i class="fas fa-file-invoice-dollar"></i> Laporan Keuangan</h1>
            <p>Ringkasan dan detail laporan keuangan perusahaan</p>
        </div>
        <span class="badge bg-light text-muted"
            style="border:1px solid #e5e7eb; border-radius:999px; padding:6px 12px; font-size:12px;"><i
                class="fas fa-user-shield"></i> Owner View</span>
    </div>

    <!-- ===================== STATISTIK CARD ===================== -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card-stat">
                <div class="stat-icon icon-income"><i class="fas fa-arrow-up"></i></div>
                <h4>Rp {{ number_format($total_pemasukan ?? 0, 0, ',', '.') }}</h4>
                <p>Total Pemasukan</p>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card-stat">
                <div class="stat-icon icon-outcome"><i class="fas fa-arrow-down"></i></div>
                <h4>Rp {{ number_format($total_pengeluaran ?? 0, 0, ',', '.') }}</h4>
                <p>Total Pengeluaran</p>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card-stat">
                <div class="stat-icon icon-salary"><i class="fas fa-user-tie"></i></div>
                <h4>Rp {{ number_format($gaji_pegawai ?? 0, 0, ',', '.') }}</h4>
                <p>Total Gaji Pegawai</p>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card-stat">
                <div class="stat-icon icon-loan"><i class="fas fa-hand-holding-usd"></i></div>
                <h4>Rp {{ number_format($total_pinjaman ?? 0, 0, ',', '.') }}</h4>
                <p>Total Pinjaman Karyawan</p>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card-stat">
                <div class="stat-icon icon-balance"><i class="fas fa-wallet"></i></div>
                <h4>Rp {{ number_format($saldo_akhir ?? 0, 0, ',', '.') }}</h4>
                <p>Saldo Akhir</p>
            </div>
        </div>
    </div>

    <!-- ===================== GRAFIK ===================== -->
    <div class="row mb-4">
        <div class="col-md-8 mb-3">
            <div class="chart-box">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h5 class="mb-0"><i class="fas fa-chart-line"></i> Pemasukan vs Pengeluaran</h5>
                    <small id="chart-status" style="color:#6b7280;">Memuat data…</small>
                </div>
                <canvas id="chartKeuangan"></canvas>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="chart-box donut">
                <h5 class="mb-2"><i class="fas fa-circle-notch"></i> Gaji vs Pinjaman</h5>
                <canvas id="chartPersen"></canvas>
            </div>
        </div>
    </div>

    <!-- ===================== TABEL ===================== -->
    <div class="table-wrapper">
        <div class="table-wrapper-header">Detail Transaksi Keuangan</div>
        <table class="table-modern">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Kategori</th>
                    <th>Keterangan</th>
                    <th>Jumlah</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse (($transaksi ?? collect()) as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->kategori ?? '-' }}</td>
                        <td>{{ $item->deskripsi ?? '-' }}</td>
                        <td>Rp {{ number_format($item->nominal ?? 0, 0, ',', '.') }}</td>
                        <td>{{ $item->tanggal ? \Carbon\Carbon::parse($item->tanggal)->format('d M Y') : '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align: center; color: #8a7a9e;">Belum ada data transaksi</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <script>
        // Muat grafik pemasukan vs pengeluaran via API agar selalu realtime
        const ctxLine = document.getElementById('chartKeuangan').getContext('2d');
        const gradIn = ctxLine.createLinearGradient(0, 0, 0, 360);
        gradIn.addColorStop(0, 'rgba(37, 99, 235, 0.28)');
        gradIn.addColorStop(1, 'rgba(37, 99, 235, 0.05)');
        const gradOut = ctxLine.createLinearGradient(0, 0, 0, 360);
        gradOut.addColorStop(0, 'rgba(239, 68, 68, 0.3)');
        gradOut.addColorStop(1, 'rgba(239, 68, 68, 0.05)');

        fetch('{{ route('owner.chart.transaksi') }}')
            .then(res => res.json())
            .then(({
                labels,
                pemasukan,
                pengeluaran
            }) => {
                const datasets = [{
                        label: 'Pemasukan',
                        data: pemasukan,
                        borderColor: '#2563eb',
                        backgroundColor: gradIn,
                        borderWidth: 2.5,
                        tension: 0.35,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        fill: true
                    },
                    {
                        label: 'Pengeluaran',
                        data: pengeluaran,
                        borderColor: '#ef4444',
                        backgroundColor: gradOut,
                        borderWidth: 2.5,
                        tension: 0.35,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        fill: true
                    }
                ];
                initFilledLineChart('chartKeuangan', labels, datasets);
                document.getElementById('chart-status').textContent = 'Data terbarui otomatis';
            })
            .catch(() => {
                document.getElementById('chart-status').textContent = 'Gagal memuat data';
            });

        fetch('{{ route('owner.chart.gaji_pinjaman') }}')
            .then(res => res.json())
            .then(({
                labels,
                values
            }) => {
                initDoughnutChart('chartPersen', labels, values, {
                    backgroundColor: ['#0ea5e9', '#f97316'],
                    borderWidth: 1,
                });
            })
            .catch(() => {
                // fallback jika api gagal, tetap tidak memblok UI
            });
    </script>
@endsection
