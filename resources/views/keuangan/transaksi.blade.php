@extends('layouts.sidebar')

@section('content')
    <h2>📄 Dashboard Transaksi</h2>

    {{-- Button Pemasukan --}}
    <a href="{{ route('keuangan.add_pemasukan') }}" class="btn btn-primary mb-3">
        ➕ Tambah pemasukan
    </a>

    {{-- Button Pengeluaran --}}
    <a href="{{ route('keuangan.add_pengeluaran') }}" class="btn btn-danger mb-3 ms-2">
        ➖ Tambah pengeluaran
    </a>

    <hr>

    <h4 class="mt-4">📌 Riwayat Transaksi</h4>

    @if ($transaksi->count() == 0)
        <div class="alert alert-info mt-3">
            Belum ada transaksi yang tercatat.
        </div>
    @else
        <div class="table-responsive mt-3">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
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
                                    <span class="badge bg-success">Pemasukan</span>
                                @else
                                    <span class="badge bg-danger">Pengeluaran</span>
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
@endsection
