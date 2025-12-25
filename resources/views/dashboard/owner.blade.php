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
            background: #ffffff;
            border-radius: 16px;
            padding: 16px 18px 12px;
            box-shadow: 0 12px 32px rgba(15, 23, 42, 0.12);
            height: 100%;
            border: 1px solid #e5e7eb;
        }

        .chart-box canvas {
            width: 100% !important;
            height: 320px !important;
        }

        .chart-legend {
            display: flex;
            flex-wrap: wrap;
            gap: 10px 14px;
            margin-top: 10px;
            font-size: 12px;
            color: #475569;
            font-weight: 600;
        }

        .chart-chip {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 10px;
            border-radius: 999px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
        }

        .chart-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            display: inline-block;
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
                <div class="chart-legend">
                    <span class="chart-chip"><span class="chart-dot" style="background:#1d7ecb;"></span>Pemasukan</span>
                    <span class="chart-chip"><span class="chart-dot" style="background:#d97706;"></span>Pengeluaran</span>
                </div>
            </div>
        </div>

        <div class="col-md-5 mb-3">
            <div class="chart-box">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h5 class="mb-0"><i class="fas fa-truck-fast"></i> Grafik Distribusi</h5>
                    <small style="color:#6b7280;">6 bulan terakhir</small>
                </div>
                <canvas id="chartDistribusi"></canvas>
                <div class="chart-legend">
                    <span class="chart-chip"><span class="chart-dot" style="background:#1d7ecb;"></span>Jumlah Produk</span>
                </div>
            </div>
        </div>
    </div>

    <script>
        const shadowPlugin = {
            id: 'shadowPlugin',
            afterDatasetsDraw(chart) {
                const {
                    ctx
                } = chart;
                chart.data.datasets.forEach((dataset, idx) => {
                    const meta = chart.getDatasetMeta(idx);
                    if (!meta || meta.type !== 'line' || !meta.data) return;
                    ctx.save();
                    ctx.shadowColor = 'rgba(15,23,42,0.12)';
                    ctx.shadowBlur = 10;
                    ctx.shadowOffsetY = 8;
                    ctx.strokeStyle = dataset.borderColor;
                    ctx.lineWidth = dataset.borderWidth;
                    ctx.beginPath();
                    meta.data.forEach((point, i) => {
                        const {
                            x,
                            y
                        } = point.getProps(['x', 'y'], true);
                        if (i === 0) ctx.moveTo(x, y);
                        else ctx.lineTo(x, y);
                    });
                    ctx.stroke();
                    ctx.restore();
                });
            },
        };

        const valueLabelPlugin = {
            id: 'valueLabelPlugin',
            afterDatasetsDraw(chart) {
                if (chart.config.type !== 'bar') return;
                const {
                    ctx
                } = chart;
                chart.data.datasets.forEach((dataset, idx) => {
                    const meta = chart.getDatasetMeta(idx);
                    if (!meta || !meta.data) return;
                    meta.data.forEach((bar, i) => {
                        const value = dataset.data[i];
                        if (value === null || value === undefined) return;
                        const {
                            x,
                            y
                        } = bar.tooltipPosition();
                        ctx.save();
                        ctx.font = '600 11px "Inter", sans-serif';
                        ctx.fillStyle = '#0f172a';
                        ctx.textAlign = 'center';
                        ctx.textBaseline = 'bottom';
                        ctx.fillText(Number(value).toLocaleString('id-ID'), x, y - 6);
                        ctx.restore();
                    });
                });
            },
        };

        const chartBaseOptions = {
            responsive: true,
            maintainAspectRatio: false,
            interaction: {
                mode: 'index',
                intersect: false
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: '#0f172a',
                    padding: 10,
                    borderRadius: 10,
                    titleFont: {
                        weight: '700'
                    },
                },
            },
            scales: {
                x: {
                    grid: {
                        display: true,
                        color: 'rgba(226, 232, 240, 0.85)',
                        borderDash: [],
                        drawBorder: false
                    },
                    ticks: {
                        color: '#1f2937',
                        font: {
                            weight: '600'
                        },
                        maxRotation: 0,
                        minRotation: 0
                    },
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(226, 232, 240, 0.85)',
                        borderDash: [],
                        drawBorder: false
                    },
                    ticks: {
                        color: '#1f2937',
                        font: {
                            weight: '600'
                        }
                    },
                },
            },
            elements: {
                line: {
                    tension: 0.32,
                    borderCapStyle: 'round'
                },
                point: {
                    hoverBorderWidth: 2
                }
            },
        };

        const ctxKeuangan = document.getElementById('chartKeuangan').getContext('2d');
        const gradIn = ctxKeuangan.createLinearGradient(0, 0, 0, 320);
        gradIn.addColorStop(0, 'rgba(14, 165, 233, 0.30)');
        gradIn.addColorStop(1, 'rgba(14, 165, 233, 0.05)');
        const gradOut = ctxKeuangan.createLinearGradient(0, 0, 0, 320);
        gradOut.addColorStop(0, 'rgba(251, 146, 60, 0.28)');
        gradOut.addColorStop(1, 'rgba(251, 146, 60, 0.05)');

        fetch('{{ route('owner.chart.transaksi') }}')
            .then(res => res.json())
            .then(({
                labels,
                pemasukan,
                pengeluaran
            }) => {
                new Chart(ctxKeuangan, {
                    type: 'bar',
                    data: {
                        labels,
                        datasets: [{
                                label: 'Pemasukan',
                                data: pemasukan,
                                backgroundColor: '#1d7ecb',
                                borderColor: '#155d96',
                                borderWidth: 1.2,
                                borderRadius: 10,
                                maxBarThickness: 44,
                            },
                            {
                                label: 'Pengeluaran',
                                data: pengeluaran,
                                backgroundColor: '#d97706',
                                borderColor: '#b45309',
                                borderWidth: 1.2,
                                borderRadius: 10,
                                maxBarThickness: 44,
                            },
                        ],
                    },
                    options: {
                        ...chartBaseOptions,
                        scales: {
                            ...chartBaseOptions.scales,
                            x: {
                                ...chartBaseOptions.scales.x,
                                stacked: false,
                                ticks: {
                                    ...chartBaseOptions.scales.x.ticks,
                                    maxRotation: 0,
                                    minRotation: 0
                                }
                            },
                            y: {
                                ...chartBaseOptions.scales.y,
                                stacked: false
                            },
                        },
                    },
                    plugins: [shadowPlugin, valueLabelPlugin],
                });
                document.getElementById('chart-status').textContent = 'Data terbarui otomatis';
            })
            .catch(() => {
                document.getElementById('chart-status').textContent = 'Gagal memuat data';
            });

        const distributionCtx = document.getElementById('chartDistribusi').getContext('2d');

        fetch('{{ route('owner.chart.distribusi') }}')
            .then(res => res.json())
            .then(({
                labels,
                values
            }) => {
                new Chart(distributionCtx, {
                    type: 'bar',
                    data: {
                        labels,
                        datasets: [{
                            label: 'Distribusi / Bulan',
                            data: values,
                            backgroundColor: '#1d7ecb',
                            borderColor: '#155d96',
                            borderWidth: 1.2,
                            borderRadius: 10,
                            maxBarThickness: 44,
                        }],
                    },
                    options: {
                        ...chartBaseOptions,
                        scales: {
                            ...chartBaseOptions.scales,
                            x: {
                                ...chartBaseOptions.scales.x,
                                stacked: false
                            },
                            y: {
                                ...chartBaseOptions.scales.y,
                                stacked: false
                            },
                        },
                    },
                    plugins: [shadowPlugin, valueLabelPlugin],
                });
            })
            .catch(() => {
                new Chart(distributionCtx, {
                    type: 'bar',
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
                        datasets: [{
                            label: 'Distribusi / Bulan',
                            data: [0, 0, 0, 0, 0, 0],
                            backgroundColor: '#1d7ecb',
                            borderColor: '#155d96',
                            borderWidth: 1.2,
                            borderRadius: 10,
                            maxBarThickness: 44,
                        }],
                    },
                    options: chartBaseOptions,
                    plugins: [shadowPlugin, valueLabelPlugin],
                });
            });
    </script>
@endsection
