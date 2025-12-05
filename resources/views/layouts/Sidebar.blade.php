<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIKADI SM</title>

    <!-- BOOTSTRAP CSS -->
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

        .submenu a {
            padding-left: 20px !important;
            font-size: 14px;
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

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h4 class="mb-4">📦 SIKADI SM</h4>

        <!-- MENU OWNER -->
        @if(Auth::user()->peran === 'owner')
            <a href="{{ route('owner.dashboard') }}">🏠 Dashboard Owner</a>
            <a href="{{ route('owner.keuangan') }}">📊 Laporan Umum</a>
            <a href="{{ route('owner.user_management') }}">👥 Manajemen Pengguna</a>
        @endif


        <!-- === MENU UNTUK KEUANGAN === -->
        @if(Auth::user()->peran === 'keuangan')

        <!-- Dashboard -->
        <a href="{{ route('keuangan.dashboard') }}">🏠 Dashboard Keuangan</a>

        <!-- KELOLA KEUANGAN -->
        <a data-bs-toggle="collapse" href="#kelolaKeuanganMenu" role="button">
            📑 Kelola Keuangan ▼
        </a>

        <div class="collapse submenu" id="kelolaKeuanganMenu">
            <a href="{{ route('keuangan.gaji') }}">💼 Gaji Pegawai</a>
            <a href="{{ route('keuangan.pinjaman') }}">🏦 Pinjaman</a>
        </div>

        <!-- KELOLA TRANSAKSI -->
        <a data-bs-toggle="collapse" href="#kelolaTransaksiMenu" role="button">
            💰 Kelola Transaksi ▼
        </a>

        <div class="collapse submenu" id="kelolaTransaksiMenu">
            <a href="{{ route('keuangan.pemasukan') }}">📥 Pemasukan</a>
            <a href="{{ route('keuangan.pengeluaran') }}">📤 Pengeluaran</a>
        </div>

        <!-- LAPORAN -->
        <a href="{{ route('keuangan.laporan') }}">📄 Laporan Keuangan</a>

        @endif


        <!-- MENU DISTRIBUSI -->
        @if(Auth::user()->peran === 'distribusi')
            <a href="{{ route('distribusi.dashboard') }}">🏠 Dashboard Distribusi</a>
            <a href="{{ route('distribusi.Barang') }}">🚚 Distribusi Barang</a>
            <a href="{{ route('distribusi.laporan') }}">📄 Laporan Distribusi</a>
        @endif

        <hr style="border-color:white;">

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn btn-danger w-100">🚪 Logout</button>
        </form>

    </div>

    <!-- CONTENT AREA -->
    <div class="content">
        @yield('content')
    </div>

    <!-- BOOTSTRAP JS (WAJIB) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
