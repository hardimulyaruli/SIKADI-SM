@extends('layouts.sidebar')

@section('content')
    <div class="card card-glass mb-3">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h2 class="mb-0">📄 Dashboard Transaksi</h2>
            <div>
                <a href="{{ route('keuangan.add_pemasukan') }}" class="btn-modern btn-primary-modern me-2">➕ Tambah pemasukan</a>
                <a href="{{ route('keuangan.add_pengeluaran') }}" class="btn-modern btn-secondary-modern">➖ Tambah pengeluaran</a>
            </div>
        </div>

        <div class="card-body">
            <h4 class="mb-3">📌 Riwayat Transaksi</h4>

            @if ($transaksi->count() == 0)
                <div class="alert alert-info mt-3">Belum ada transaksi yang tercatat.</div>
            @else
                <div class="table-responsive mt-2">
                    <table class="table-modern table-bordered w-100">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tipe</th>
                                <th>Kategori</th>
                                <th>Qty</th>
                                <th>Nominal</th>
                                <th>Tanggal</th>
                                <th>Deskripsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaksi as $t)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    {{-- Tipe --}}
                                    <td>
                                        @if ($t->tipe === 'pemasukan')
                                            <span style="background:rgba(3,105,161,0.07); color:#0369a1; font-weight:600; padding:.2rem .5rem; border-radius:.4rem;">Pemasukan</span>
                                        @else
                                            <span style="background:rgba(220,38,38,0.06); color:#dc2626; font-weight:600; padding:.2rem .5rem; border-radius:.4rem;">Pengeluaran</span>
                                        @endif
                                    </td>

                                    <td>{{ $t->kategori }}</td>
                                    <td>{{ $t->qty }}</td>

                                    {{-- Format Rp --}}
                                    <td>Rp {{ number_format($t->nominal, 0, ',', '.') }}</td>

                                    {{-- Format tanggal --}}
                                    <td>{{ \Carbon\Carbon::parse($t->tanggal)->format('d/m/Y') }}</td>

                                    <td>{{ $t->deskripsi ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection
