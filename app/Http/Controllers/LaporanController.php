<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Transaksi;
use App\Models\Pinjaman;
use App\Models\Penggajian;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Data untuk laporan penggajian (gaji & pinjaman)
        $penggajian = Penggajian::with('karyawan')->orderByDesc('tanggal')->get();
        $pinjaman = Pinjaman::with('karyawan')->orderByDesc('tanggal')->get();

        $total_gaji_diterima = $penggajian->sum('total_gaji_diterima');
        $total_pinjaman = $pinjaman->sum('jumlah_pinjaman');

        // Data untuk laporan transaksi (pemasukan & pengeluaran)
        $transaksi = Transaksi::orderByDesc('tanggal')->get();
        $total_pemasukan = Transaksi::where('tipe', 'pemasukan')->sum('nominal');
        $total_pengeluaran = Transaksi::where('tipe', 'pengeluaran')->sum('nominal');
        $saldo_transaksi = $total_pemasukan - $total_pengeluaran;

        return view('keuangan.laporan', compact(
            'penggajian',
            'pinjaman',
            'total_gaji_diterima',
            'total_pinjaman',
            'transaksi',
            'total_pemasukan',
            'total_pengeluaran',
            'saldo_transaksi'
        ));
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
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
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
