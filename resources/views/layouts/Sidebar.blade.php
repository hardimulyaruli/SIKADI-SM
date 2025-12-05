<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIKADI SM</title>

    <!-- =============== BOOTSTRAP CSS (TARUH DI <head>) =============== -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <style>
        body {
            display: flex;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            background: #343a40;
            color: #fff;
            padding: 20px;
        }

        .sidebar a {
            display: block;
            color: #fff;
            padding: 10px 0;
            text-decoration: none;
            margin: 8px 0;
        }

        .sidebar a:hover {
            background: rgba(255, 255, 255, 0.2);
            padding-left: 10px;
            transition: 0.3s;
        }

        .content {
            flex: 1;
            padding: 30px;
            background: #f8f9fa;
        }
    </style>

</head>

<body>
@php
    use Illuminate\Support\Facades\Auth;
@endphp

    <!-- ======================= SIDEBAR ======================= -->
    <div class="sidebar">
        <h4 class="mb-4">📦 SIKADI SM</h4>

        <!-- ======================= MENU OWNER ======================= -->
        @if(Auth::user()->peran === 'owner')

            <a href="{{ route('owner.dashboard') }}">🏠 Dashboard Owner</a>
            <!-- K E L O L A   A K U N -->
            <a data-bs-toggle="collapse" href="#kelolaAkun" role="button">
                👥 Kelola Akun
            </a>
            <div class="collapse ps-3" id="kelolaAkun">
                <a href="{{ route('owner.list_user') }}">📄 Daftar Akun</a>
            </div>

            <!-- L A P O R A N   K E S E L U R U H A N -->
            <a data-bs-toggle="collapse" href="#laporanKeseluruhan" role="button">
                📊 Laporan Keseluruhan
            </a>
            <div class="collapse ps-3" id="laporanKeseluruhan">
                <a href="{{ route('owner.keuangan') }}">💰 Laporan Keuangan</a>
                <a href="{{ route('owner.distribusi') }}">🚚 Laporan Distribusi</a>

            </div>

        @endif
        <!-- =================== END MENU OWNER =================== -->



        <!-- ======================= MENU KEUANGAN ======================= -->
        @if(Auth::user()->peran === 'keuangan')
            <a href="{{ route('keuangan.dashboard') }}">🏠 Dashboard Keuangan</a>

            <a data-bs-toggle="collapse" href="#kelolaKeuangan" role="button">🧾 Kelola Keuangan</a>
            <div class="collapse ps-3" id="kelolaKeuangan">
                <a href="{{ route('keuangan.gaji') }}">💰 Gaji Pegawai</a>
                <a href="{{ route('keuangan.pinjaman') }}">🏦 Pinjaman</a>
            </div>

            <a data-bs-toggle="collapse" href="#kelolaTransaksi" role="button">💵 Kelola Transaksi</a>
            <div class="collapse ps-3" id="kelolaTransaksi">
                <a href="{{ route('transaksi.pemasukan') }}">📥 Pemasukan</a>
                <a href="{{ route('transaksi.pengeluaran') }}">📤 Pengeluaran</a>
            </div>

            <a href="{{ route('keuangan.laporan') }}">📄 Laporan Keuangan</a>
        @endif



        <!-- ======================= MENU DISTRIBUSI ======================= -->
        @if(Auth::user()->peran === 'distribusi')
            <a href="{{ route('distribusi.dashboard') }}">🏠 Dashboard Distribusi</a>
            <a href="{{ route('distribusi.Barang') }}">🚚 Distribusi Barang</a>
            <a href="{{ route('distribusi.laporan') }}">📄 Laporan Distribusi</a>
        @endif



        <hr style="border-color:white;">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn btn-danger w-100 mt-3">🚪 Logout</button>
        </form>

    </div>
    <!-- ======================= END SIDEBAR ======================= -->


    <!-- CONTENT AREA -->
    <div class="content">
        @yield('content')
    </div>


    <!-- =============== BOOTSTRAP JS (TARUH DI SEBELUM </body>) =============== -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
