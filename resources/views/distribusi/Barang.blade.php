@extends('layouts.sidebar')
@section('content')

    <style>
        .section-title {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 12px;
            color: #0f172a;
        }

        .card-glass {
            background: #fff;
            border-radius: 14px;
            padding: 18px 20px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.12);
        }

        .textbox {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 12px 14px;
            font-size: 14px;
            width: 100%;
            color: #0f172a;
            transition: border-color 0.25s ease, box-shadow 0.25s ease, background-color 0.25s ease;
        }

        .textbox:hover {
            border-color: #38bdf8;
        }

        .textbox:focus {
            outline: none;
            border-color: #38bdf8;
            box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.25);
            background-color: #f8fbff;
        }

        select.textbox {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg fill='none' stroke='%230f172a' stroke-width='2' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 14px center;
            background-size: 18px;
            padding-right: 42px;
            cursor: pointer;
        }

        .table-modern {
            width: 100%;
            border-collapse: collapse;
        }

        .table-modern thead th {
            background: #f0f9ff;
            color: #0f172a;
            font-size: 12px;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            padding: 12px;
            border-bottom: 1px solid #e5e7eb;
        }

        .table-modern tbody td {
            padding: 12px;
            border-top: 1px solid #e5e7eb;
            color: #0f172a;
            font-size: 14px;
        }

        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 999px;
            font-weight: 700;
            font-size: 12px;
            text-transform: capitalize;
        }

        .status-badge.terkirim {
            background: rgba(16, 185, 129, 0.14);
            color: #047857;
        }

        .status-badge.pending {
            background: rgba(234, 179, 8, 0.16);
            color: #b45309;
        }

        .btn-primary-modern {
            background: linear-gradient(135deg, #0ea5e9, #38bdf8);
            color: #fff;
            border: none;
            border-radius: 12px;
            padding: 10px 16px;
            font-weight: 700;
            box-shadow: 0 12px 30px rgba(56, 189, 248, 0.28);
        }

        .btn-secondary-modern {
            background: rgba(59, 130, 246, 0.12);
            color: #1d4ed8;
            border: none;
            border-radius: 10px;
            padding: 9px 14px;
            font-weight: 700;
        }

        .card-head {
            margin-bottom: 10px;
        }

        .card-head h2 {
            margin: 0;
            font-weight: 800;
            color: #0f172a;
        }

        .card-head p {
            margin: 4px 0 0;
            color: #6b7280;
        }
    </style>

    <div class="card-glass">
        <div class="card-head">
            <h2>Kelola Distribusi</h2>
            <p>Kelola data distribusi dengan mudah dan rapi.</p>
        </div>

        <!-- Input Data -->
        <div class="mb-4">
            <h4 class="section-title">Input Data Distribusi</h4>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul style="margin-bottom:0;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <form action="{{ route('distribusi.barang.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6 col-lg-4 mb-3">
                        <select name="catatan" class="textbox">
                            <option value="" disabled selected>Pilih Nama Produk</option>
                            <option value="Kue Pia">Kue Pia</option>
                            <option value="Nastar">Nastar</option>
                            <option value="Kremes">Kremes</option>
                        </select>
                    </div>

                    <div class="col-md-6 col-lg-4 mb-3">
                        <input type="number" name="jumlah_produk" class="textbox"
                            placeholder="Jumlah yang Dikirim (per box)" min="1">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 col-lg-4 mb-3">
                        <input type="text" name="toko_tujuan" class="textbox" placeholder="Toko/Alamat Tujuan">
                    </div>

                    <div class="col-md-6 col-lg-4 mb-3">
                        <select name="status" class="textbox">
                            <option value="" disabled selected>Status Pengiriman</option>
                            <option value="terkirim">Terkirim</option>
                            <option value="pending">Pending</option>
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn-modern btn-primary-modern">
                    Simpan Data
                </button>
            </form>
        </div>

        <!-- Tabel -->
        <div>
            <h4 class="section-title">Data Pengiriman Produk</h4>

            <table class="table-modern mb-0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Jumlah</th>
                        <th>Tujuan</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($distribusis as $index => $d)
                        <tr>
                            <td>{{ ($distribusis->firstItem() ?? 0) + $index }}</td>
                            <td>{{ $d->catatan }}</td>
                            <td>{{ $d->jumlah_produk }}</td>
                            <td>{{ $d->toko_tujuan }}</td>
                            <td>{{ $d->tanggal }}</td>
                            <td><span class="status-badge {{ $d->status ?? '' }}">{{ ucfirst($d->status) }}</span></td>
                            <td>
                                <a href="{{ route('distribusi.edit', $d->id) }}" class="btn-modern btn-secondary-modern">
                                    Edit Status
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">
                                Belum ada data distribusi.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-3">
                {{ $distribusis->links() }}
            </div>
        </div>
    </div>
@endsection
