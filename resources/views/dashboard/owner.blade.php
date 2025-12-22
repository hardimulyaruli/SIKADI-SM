@extends('layouts.sidebar')

@section('content')
    <style>
        .page-header {
            margin-bottom: 20px;
        }

        .page-header h1 {
            font-weight: 700;
            margin-bottom: 4px;
        }

        .page-header p {
            color: #6b7280;
            margin: 0;
        }

        .card-stat {
            background: #fff;
            border-radius: 12px;
            padding: 14px 16px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.06);
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .card-stat h3 {
            margin: 0 0 6px;
            font-weight: 700;
            font-size: 20px;
            color: #111827;
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

        .icon-distribusi {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
        }

        .chart-box {
            background: #fff;
            border-radius: 12px;
            padding: 14px 16px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.06);
            height: 100%;
        }

        .chart-box canvas {
            width: 100% !important;
            height: 340px !important;
        }

        @media (max-width: 768px) {
            .chart-box canvas {
                height: 240px !important;
            }
        }
    </style>

    <div class="page-header">
        <h1><i class="fas fa-gauge-high"></i> Dashboard Owner</h1>
        <p>Ringkasan keuangan dan distribusi terbaru</p>
    </div>

    <!-- ===================== STATISTIK ===================== -->
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card-stat">
                <div class="stat-icon icon-income"><i class="fas fa-arrow-up"></i></div>
                <h3>Rp {{ number_format($total_pemasukan ?? 0, 0, ',', '.') }}</h3>
                <p>Total Pemasukan</p>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card-stat">
                <div class="stat-icon icon-outcome"><i class="fas fa-arrow-down"></i></div>
                <h3>Rp {{ number_format($total_pengeluaran ?? 0, 0, ',', '.') }}</h3>
                <p>Total Pengeluaran</p>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card-stat">
                <div class="stat-icon icon-salary"><i class="fas fa-user-tie"></i></div>
                <h3>Rp {{ number_format($gaji_pegawai ?? 0, 0, ',', '.') }}</h3>
                <p>Total Gaji Pegawai</p>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card-stat">
                <div class="stat-icon icon-loan"><i class="fas fa-hand-holding-usd"></i></div>
                <h3>Rp {{ number_format($total_pinjaman ?? 0, 0, ',', '.') }}</h3>
                <p>Total Pinjaman</p>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card-stat">
                <div class="stat-icon icon-balance"><i class="fas fa-wallet"></i></div>
                <h3>Rp {{ number_format($saldo_akhir ?? 0, 0, ',', '.') }}</h3>
                <p>Saldo Akhir</p>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card-stat">
                <div class="stat-icon icon-distribusi"><i class="fas fa-truck-moving"></i></div>
                <h3>{{ $total_distribusi ?? 0 }}</h3>
                <p>Total Distribusi Barang</p>
            </div>
        </div>
    </div>

    <!-- ===================== GRAFIK ===================== -->
    <div class="row mb-4">
        <div class="col-md-7 mb-3">
            <div class="chart-box">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h5 class="mb-0"><i class="fas fa-chart-line"></i> Pemasukan vs Pengeluaran</h5>
                    <small id="chart-status" style="color:#6b7280;">Memuat data…</small>
                </div>
                <canvas id="chartKeuangan"></canvas>
            </div>
        </div>

        <div class="col-md-5 mb-3">
            <div class="chart-box">
                <h5 class="mb-2"><i class="fas fa-truck-fast"></i> Grafik Distribusi</h5>
                <canvas id="chartDistribusi"></canvas>
            </div>
        </div>
    </div>

    <script>
        // Grafik keuangan via API agar sinkron dengan laporan
        const ctxKeuangan = document.getElementById('chartKeuangan').getContext('2d');
        const gradIn = ctxKeuangan.createLinearGradient(0, 0, 0, 320);
        gradIn.addColorStop(0, 'rgba(34,197,94,0.25)');
        gradIn.addColorStop(1, 'rgba(34,197,94,0.05)');
        const gradOut = ctxKeuangan.createLinearGradient(0, 0, 0, 320);
        gradOut.addColorStop(0, 'rgba(239,68,68,0.25)');
        gradOut.addColorStop(1, 'rgba(239,68,68,0.05)');

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
                        borderColor: '#16a34a',
                        backgroundColor: gradIn,
                        borderWidth: 2.5,
                        tension: 0.32,
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
                        tension: 0.32,
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

        const distributionDatasets = [{
            label: 'Distribusi / Bulan',
            data: [0, 0, 0, 0, 0, 0],
            borderColor: '#6366f1',
            backgroundColor: 'rgba(99, 102, 241, 0.12)',
            borderWidth: 2,
            tension: 0.32,
            pointRadius: 3,
            pointHoverRadius: 5,
            fill: true
        }];
        initFilledLineChart('chartDistribusi', ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'], distributionDatasets);
    </script>
@endsection
