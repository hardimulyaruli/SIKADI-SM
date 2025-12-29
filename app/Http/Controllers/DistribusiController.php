<?php

namespace App\Http\Controllers;

use App\Models\Distribusi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class DistribusiController extends Controller
{
    public function dashboard()
    {
        $totalBarang = Distribusi::sum('jumlah_produk');
        $distribusiTerkirim = Distribusi::where('status', 'terkirim')->count();
        $riwayatDistribusi = Distribusi::orderByDesc('tanggal')->limit(5)->get();

        return view('dashboard.distribusi', compact(
            'totalBarang',
            'distribusiTerkirim',
            'riwayatDistribusi'
        ));
    }

    public function laporan(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $filteredQuery = Distribusi::query();

        if ($startDate && $endDate) {
            $filteredQuery->whereBetween('tanggal', [$startDate, $endDate]);
        } elseif ($startDate) {
            $filteredQuery->whereDate('tanggal', '>=', $startDate);
        } elseif ($endDate) {
            $filteredQuery->whereDate('tanggal', '<=', $endDate);
        }

        $totalDistribusi = (clone $filteredQuery)->count();
        $totalBarang = (clone $filteredQuery)->sum('jumlah_produk');
        $pendingCount = (clone $filteredQuery)->where('status', 'pending')->count();
        $terkirimCount = (clone $filteredQuery)->where('status', 'terkirim')->count();

        $daftarDistribusi = (clone $filteredQuery)
            ->orderByDesc('tanggal')
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        return view('distribusi.laporan', compact(
            'totalDistribusi',
            'totalBarang',
            'pendingCount',
            'terkirimCount',
            'daftarDistribusi',
            'startDate',
            'endDate'
        ));
    }

    public function exportExcel(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $rowsQuery = Distribusi::orderByDesc('tanggal')->orderByDesc('id');

        if ($startDate && $endDate) {
            $rowsQuery->whereBetween('tanggal', [$startDate, $endDate]);
        } elseif ($startDate) {
            $rowsQuery->whereDate('tanggal', '>=', $startDate);
        } elseif ($endDate) {
            $rowsQuery->whereDate('tanggal', '<=', $endDate);
        }

        $rows = $rowsQuery->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Laporan Distribusi');

        $sheet->fromArray([
            ['Laporan Distribusi'],
            [],
            ['No', 'Nama Produk', 'Jumlah', 'Tujuan', 'Tanggal', 'Status'],
        ], null, 'A1');

        $rowIndex = 4;
        foreach ($rows as $index => $row) {
            $sheet->fromArray([
                [
                    $index + 1,
                    $row->catatan,
                    $row->jumlah_produk,
                    $row->toko_tujuan,
                    $row->tanggal,
                    ucfirst($row->status),
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
        $sheet->getStyle('A4:F' . max(4, $rowIndex - 1))
            ->getBorders()->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN)
            ->getColor()->setARGB('FFE5E7EB');

        foreach (range('A', 'F') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $fileName = 'laporan_distribusi_' . now()->format('Ymd_His') . '.xlsx';

        return response()->streamDownload(function () use ($spreadsheet) {
            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
        }, $fileName, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $distribusis = Distribusi::orderByDesc('tanggal')
            ->orderByDesc('id')
            ->paginate(10);
        return view('distribusi.Barang', compact('distribusis'));
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
        $validated = $request->validate(
            [
                'toko_tujuan'    => 'required|string|max:255',
                'jumlah_produk'  => 'required|integer|min:1',
                'status'         => 'required|in:terkirim,pending',
                'catatan'        => 'nullable|string|max:255',
            ],
            [
                'toko_tujuan.required'   => 'Tujuan pengiriman wajib diisi.',
                'jumlah_produk.required' => 'Jumlah barang wajib diisi.',
                'jumlah_produk.min'      => 'Jumlah barang minimal 1.',
                'status.required'        => 'Status barang wajib dipilih.',
            ]
        );

        Distribusi::create([
            'pengguna_id'    => Auth::id(),
            'toko_tujuan'    => $validated['toko_tujuan'],
            'jumlah_produk'  => $validated['jumlah_produk'],
            'tanggal'        => now()->toDateString(),
            'status'         => $validated['status'],
            'catatan'        => $validated['catatan'] ?? null,
        ]);

        return redirect()->back()->with('success', 'Data distribusi tersimpan.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Distribusi $distribusi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $distribusi = Distribusi::findOrFail($id);
        return view('distribusi.edit', compact('distribusi'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'catatan' => 'required|string|max:255',
            'toko_tujuan' => 'required|string|max:255',
            'jumlah_produk' => 'required|integer|min:1',
            'status' => 'required|in:terkirim,pending',
        ]);

        $distribusi = Distribusi::findOrFail($id);

        $distribusi->catatan = $request->catatan;
        $distribusi->toko_tujuan = $request->toko_tujuan;
        $distribusi->jumlah_produk = $request->jumlah_produk;
        $distribusi->status = $request->status;

        $distribusi->save();

        return redirect()
            ->route('distribusi.barang')
            ->with('success', 'Data distribusi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $distribusi = Distribusi::findOrFail($id);
        $distribusi->delete();

        return redirect()
            ->route('distribusi.barang')
            ->with('success', 'Data distribusi berhasil dihapus.');
    }
}
