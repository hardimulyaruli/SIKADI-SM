<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Transaksi;
use App\Models\Pinjaman;
use App\Models\Penggajian;
use App\Models\Distribusi;
use Illuminate\Http\Request;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Filter tanggal penggajian & pinjaman (single date)
        // Filter rentang tanggal penggajian & pinjaman
        $pgStart = $request->input('pg_start');
        $pgEnd = $request->input('pg_end');

        $penggajianQuery = Penggajian::with('karyawan')
            ->orderByDesc('created_at')
            ->orderByDesc('tanggal');
        $pinjamanQuery = Pinjaman::with('karyawan')
            ->orderByDesc('created_at')
            ->orderByDesc('tanggal');

        if ($pgStart && $pgEnd) {
            $penggajianQuery->whereBetween('tanggal', [$pgStart, $pgEnd]);
            $pinjamanQuery->whereBetween('tanggal', [$pgStart, $pgEnd]);
        } elseif ($pgStart) {
            $penggajianQuery->whereDate('tanggal', '>=', $pgStart);
            $pinjamanQuery->whereDate('tanggal', '>=', $pgStart);
        } elseif ($pgEnd) {
            $penggajianQuery->whereDate('tanggal', '<=', $pgEnd);
            $pinjamanQuery->whereDate('tanggal', '<=', $pgEnd);
        }

        $penggajian = $penggajianQuery->get();
        $pinjaman = $pinjamanQuery->get();

        $total_gaji_diterima = $penggajian->sum('total_gaji_diterima');
        $total_pinjaman = $pinjaman->sum('jumlah_pinjaman');

        // Ringkasan transaksi keseluruhan
        $total_pemasukan = Transaksi::where('tipe', 'pemasukan')->sum('nominal');
        $total_pengeluaran = Transaksi::where('tipe', 'pengeluaran')->sum('nominal');
        $saldo_transaksi = $total_pemasukan - $total_pengeluaran;

        // Tabel 1: Penjualan (pemasukan) minggu ini (Senin-Minggu)
        $startOfWeek = Carbon::now()->startOfWeek(Carbon::MONDAY);
        $endOfWeek = Carbon::now()->endOfWeek(Carbon::SUNDAY);
        $weeklyPenjualan = Transaksi::where('tipe', 'pemasukan')
            ->whereBetween('tanggal', [$startOfWeek->toDateString(), $endOfWeek->toDateString()])
            ->orderByDesc('tanggal')
            ->get();

        // Tabel 2: Transaksi keseluruhan dengan filter satu tanggal
        // Tabel 2: Transaksi keseluruhan dengan filter rentang tanggal
        $txStart = $request->input('tx_start');
        $txEnd = $request->input('tx_end');

        $transaksiQuery = Transaksi::orderByDesc('tanggal');
        if ($txStart && $txEnd) {
            $transaksiQuery->whereBetween('tanggal', [$txStart, $txEnd]);
        } elseif ($txStart) {
            $transaksiQuery->whereDate('tanggal', '>=', $txStart);
        } elseif ($txEnd) {
            $transaksiQuery->whereDate('tanggal', '<=', $txEnd);
        }
        $transaksi = $transaksiQuery->get();

        // Tentukan tab aktif agar tetap di tab transaksi setelah filter
        $activeTab = $request->input('tab');
        if (!$activeTab && $request->filled('tx_date')) {
            $activeTab = 'transaksi';
        }
        if (!$activeTab) {
            $activeTab = 'penggajian';
        }

        return view('keuangan.laporan', compact(
            'penggajian',
            'pinjaman',
            'total_gaji_diterima',
            'total_pinjaman',
            'transaksi',
            'total_pemasukan',
            'total_pengeluaran',
            'saldo_transaksi',
            'txStart',
            'txEnd',
            'pgStart',
            'pgEnd',
            'activeTab'
        ));
    }

    /**
     * Laporan ringkas untuk Owner yang menampilkan pemasukan, pengeluaran, gaji, dan pinjaman.
     */
    public function ownerSummary()
    {
        // Gunakan tampilan laporan keuangan yang sama dengan role keuangan
        // tanpa filter tanggal bawaan (owner tetap bisa melihat tab penggajian & transaksi).

        $pgDate = null;
        $pgStart = null;
        $pgEnd = null;
        $txStart = null;
        $txEnd = null;

        $penggajian = Penggajian::with('karyawan')->orderByDesc('tanggal')->get();
        $pinjaman = Pinjaman::with('karyawan')->orderByDesc('tanggal')->get();

        $total_gaji_diterima = $penggajian->sum('total_gaji_diterima');
        $total_pinjaman = $pinjaman->sum('jumlah_pinjaman');

        $total_pemasukan = Transaksi::where('tipe', 'pemasukan')->sum('nominal');
        $total_pengeluaran = Transaksi::where('tipe', 'pengeluaran')->sum('nominal');
        $saldo_transaksi = $total_pemasukan - $total_pengeluaran;

        $transaksi = Transaksi::orderByDesc('tanggal')->get();

        // Owner default di tab penggajian
        $activeTab = 'penggajian';

        return view('keuangan.laporan', compact(
            'penggajian',
            'pinjaman',
            'total_gaji_diterima',
            'total_pinjaman',
            'transaksi',
            'total_pemasukan',
            'total_pengeluaran',
            'saldo_transaksi',
            'txStart',
            'txEnd',
            'pgStart',
            'pgEnd',
            'activeTab'
        ));
    }

    /**
     * Dashboard Owner: ringkasan cepat dan grafik.
     */
    public function ownerDashboard()
    {
        $total_pemasukan = Transaksi::where('tipe', 'pemasukan')->sum('nominal');
        $total_pengeluaran = Transaksi::where('tipe', 'pengeluaran')->sum('nominal');
        $gaji_pegawai = Penggajian::sum('total_gaji_diterima');
        $total_pinjaman = Pinjaman::sum('jumlah_pinjaman');
        $saldo_akhir = $total_pemasukan - ($total_pengeluaran + $gaji_pegawai + $total_pinjaman);

        $total_distribusi = class_exists('App\\Models\\Distribusi')
            ? \App\Models\Distribusi::count()
            : 0;

        return view('dashboard.owner', compact(
            'total_pemasukan',
            'total_pengeluaran',
            'gaji_pegawai',
            'total_pinjaman',
            'saldo_akhir',
            'total_distribusi'
        ));
    }

    /**
     * Owner: Laporan Distribusi (menyamai laporan distribusi role distribusi).
     */
    public function ownerDistribusi()
    {
        $totalDistribusi = Distribusi::count();
        $totalBarang = Distribusi::sum('jumlah_produk');
        $pendingCount = Distribusi::where('status', 'pending')->count();
        $terkirimCount = Distribusi::where('status', 'terkirim')->count();

        $daftarDistribusi = Distribusi::orderByDesc('tanggal')->orderByDesc('id')->get();

        return view('owner.laporan_distribusi', compact(
            'totalDistribusi',
            'totalBarang',
            'pendingCount',
            'terkirimCount',
            'daftarDistribusi'
        ));
    }

    /**
     * API: data grafik pemasukan vs pengeluaran (6 bulan terakhir).
     */
    public function chartTransaksi()
    {
        $labels = [];
        $pemasukan = [];
        $pengeluaran = [];

        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $labels[] = $month->format('M Y');

            $pemasukan[] = Transaksi::where('tipe', 'pemasukan')
                ->whereYear('tanggal', $month->year)
                ->whereMonth('tanggal', $month->month)
                ->sum('nominal');

            $pengeluaran[] = Transaksi::where('tipe', 'pengeluaran')
                ->whereYear('tanggal', $month->year)
                ->whereMonth('tanggal', $month->month)
                ->sum('nominal');
        }

        return response()->json([
            'labels' => $labels,
            'pemasukan' => $pemasukan,
            'pengeluaran' => $pengeluaran,
            'type' => 'bar',
        ]);
    }

    public function chartDistribusi()
    {
        // Gunakan Distribusi jika tersedia, jika tidak kembalikan nol
        $labels = [];
        $totalDistribusi = [];

        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $labels[] = $month->format('M Y');

            $jumlah = Distribusi::whereYear('tanggal', $month->year)
                ->whereMonth('tanggal', $month->month)
                ->sum('jumlah_produk');

            $totalDistribusi[] = (int) $jumlah;
        }

        return response()->json([
            'labels' => $labels,
            'values' => $totalDistribusi,
        ]);
    }

    /**
     * API: data grafik gaji vs pinjaman (total kumulatif terkini).
     */
    public function chartGajiPinjaman()
    {
        $gaji = Penggajian::sum('total_gaji_diterima');
        $pinjaman = Pinjaman::sum('jumlah_pinjaman');

        return response()->json([
            'labels' => ['Gaji Pegawai', 'Pinjaman Karyawan'],
            'values' => [
                (int) $gaji,
                (int) $pinjaman,
            ],
        ]);
    }

    /**
     * Get filtered report data
     */
    public function getFilteredReport(Request $request)
    {
        $jenis = $request->input('jenis_laporan');
        $bulan = $request->input('bulan');

        $data = [
            'pemasukan' => 0,
            'pengeluaran' => 0,
            'pinjaman' => 0,
            'saldo' => 0,
            'jenis' => $jenis,
        ];

        try {
            if ($jenis == 'bulanan' && $bulan) {
                $year = Carbon::parse($bulan)->year;
                $month = Carbon::parse($bulan)->month;

                // Pemasukan
                $pemasukan = Transaksi::where('tipe', 'pemasukan')
                    ->whereYear('tanggal', $year)
                    ->whereMonth('tanggal', $month)
                    ->sum('nominal');

                // Pengeluaran
                $pengeluaran = Transaksi::where('tipe', 'pengeluaran')
                    ->whereYear('tanggal', $year)
                    ->whereMonth('tanggal', $month)
                    ->sum('nominal');

                $data['pemasukan'] = $pemasukan;
                $data['pengeluaran'] = $pengeluaran;
                $data['saldo'] = $pemasukan - $pengeluaran;
            } elseif ($jenis == 'tahunan' && $bulan) {
                $year = Carbon::parse($bulan)->year;

                // Pemasukan tahunan
                $pemasukan = Transaksi::where('tipe', 'pemasukan')
                    ->whereYear('tanggal', $year)
                    ->sum('nominal');

                // Pengeluaran tahunan
                $pengeluaran = Transaksi::where('tipe', 'pengeluaran')
                    ->whereYear('tanggal', $year)
                    ->sum('nominal');

                $data['pemasukan'] = $pemasukan;
                $data['pengeluaran'] = $pengeluaran;
                $data['saldo'] = $pemasukan - $pengeluaran;
            } elseif ($jenis == 'pinjaman') {
                // Total pinjaman yang belum lunas
                $pinjaman_belum_lunas = Pinjaman::where('status', 'belum_lunas')->sum('jumlah_pinjaman');

                // Total pinjaman yang sudah lunas
                $pinjaman_lunas = Pinjaman::where('status', 'lunas')->sum('jumlah_pinjaman');

                $data['pinjaman'] = $pinjaman_belum_lunas;
                $data['pinjaman_lunas'] = $pinjaman_lunas;
                $data['saldo'] = -$pinjaman_belum_lunas;
            }

            return response()->json([
                'success' => true,
                'data' => $data,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Export laporan penggajian (gaji & pinjaman) ke file Excel (.xlsx) dengan format rapi.
     */
    public function exportPenggajian(Request $request)
    {
        $pgDate = $request->input('pg_date');

        $penggajianQuery = Penggajian::with('karyawan')->orderByDesc('tanggal');
        $pinjamanQuery = Pinjaman::with('karyawan')->orderByDesc('tanggal');

        if ($pgDate) {
            $penggajianQuery->whereDate('tanggal', $pgDate);
            $pinjamanQuery->whereDate('tanggal', $pgDate);
        }

        $penggajian = $penggajianQuery->get();
        $pinjaman = $pinjamanQuery->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Penggajian & Pinjaman');

        // Tabel 1: Penggajian
        $sheet->fromArray([
            ['Laporan Penggajian'],
            [],
            ['Tanggal', 'Nama Karyawan', 'Tunjangan', 'Hari Tidak Masuk', 'Total Gaji Diterima'],
        ], null, 'A1');

        $rowIndex = 4;
        foreach ($penggajian as $row) {
            $tanggal = $row->tanggal ? Carbon::parse($row->tanggal)->format('Y-m-d') : '';

            $sheet->fromArray([
                [
                    $tanggal,
                    optional($row->karyawan)->nama,
                    $row->tunjangan,
                    $row->hari_tidak_masuk,
                    $row->total_gaji_diterima,
                ],
            ], null, 'A' . $rowIndex);
            $rowIndex++;
        }

        // Header style Penggajian
        $headerStyle = [
            'font' => ['bold' => true],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FFE5E7EB'],
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'FF9CA3AF'],
                ],
            ],
        ];
        $sheet->getStyle('A3:E3')->applyFromArray($headerStyle);
        $sheet->getStyle('A4:E' . max(4, $rowIndex - 1))->getBorders()->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN)->getColor()->setARGB('FFE5E7EB');

        foreach (range('A', 'E') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Spacer dan Tabel 2: Pinjaman (masih di sheet yang sama)
        $rowIndex += 2; // satu baris kosong antar tabel
        $pinjamanHeaderRow = $rowIndex;
        $sheet->fromArray([
            ['Laporan Pinjaman'],
            [],
            ['Tanggal', 'Nama Karyawan', 'Jumlah Pinjaman', 'Status', 'Keterangan'],
        ], null, 'A' . $pinjamanHeaderRow);

        $rowIndex = $pinjamanHeaderRow + 2;
        foreach ($pinjaman as $row) {
            $tanggal = $row->tanggal ? Carbon::parse($row->tanggal)->format('Y-m-d') : '';

            $sheet->fromArray([
                [
                    $tanggal,
                    optional($row->karyawan)->nama,
                    $row->jumlah_pinjaman,
                    $row->status,
                    $row->keterangan,
                ],
            ], null, 'A' . $rowIndex);
            $rowIndex++;
        }

        $sheet->getStyle('A' . ($pinjamanHeaderRow + 2) . ':E' . ($pinjamanHeaderRow + 2))->applyFromArray($headerStyle);
        $sheet->getStyle('A' . ($pinjamanHeaderRow + 2) . ':E' . max($pinjamanHeaderRow + 2, $rowIndex - 1))->getBorders()->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN)->getColor()->setARGB('FFE5E7EB');

        foreach (range('A', 'E') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $fileName = 'laporan_penggajian_' . now()->format('Ymd_His') . '.xlsx';

        return response()->streamDownload(function () use ($spreadsheet) {
            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
        }, $fileName, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }

    /**
     * Export laporan transaksi (pemasukan & pengeluaran) ke file Excel (.xlsx) dengan format rapi.
     */
    public function exportTransaksi(Request $request)
    {
        $txDate = $request->input('tx_date');

        $transaksiQuery = Transaksi::orderByDesc('tanggal');
        if ($txDate) {
            $transaksiQuery->whereDate('tanggal', $txDate);
        }

        $transaksi = $transaksiQuery->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Transaksi');

        $sheet->fromArray([
            ['Laporan Transaksi'],
            [],
            ['Tanggal', 'Tipe', 'Kategori', 'Qty', 'Nominal', 'Deskripsi'],
        ], null, 'A1');

        $rowIndex = 4;
        foreach ($transaksi as $row) {
            $tanggal = $row->tanggal ? Carbon::parse($row->tanggal)->format('Y-m-d') : '';

            $sheet->fromArray([
                [
                    $tanggal,
                    $row->tipe,
                    $row->kategori,
                    $row->qty,
                    $row->nominal,
                    $row->deskripsi,
                ],
            ], null, 'A' . $rowIndex);
            $rowIndex++;
        }

        $headerStyle = [
            'font' => ['bold' => true],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FFE5E7EB'],
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'FF9CA3AF'],
                ],
            ],
        ];

        $sheet->getStyle('A3:F3')->applyFromArray($headerStyle);
        $sheet->getStyle('A4:F' . max(4, $rowIndex - 1))->getBorders()->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN)->getColor()->setARGB('FFE5E7EB');

        foreach (range('A', 'F') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $fileName = 'laporan_transaksi_' . now()->format('Ymd_His') . '.xlsx';

        return response()->streamDownload(function () use ($spreadsheet) {
            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
        }, $fileName, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Laporan $laporan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Laporan $laporan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Laporan $laporan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Laporan $laporan)
    {
        //
    }
}
