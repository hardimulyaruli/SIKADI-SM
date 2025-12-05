<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIKADI SM</title>

    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <style>
        body { display: flex; }

        .sidebar {
            width: 250px;
            height: 100vh;
            background: #343a40;
            color: #fff;
            padding: 20px;
            position: fixed;
            left: 0;
            top: 0;
        }

        .content {
            margin-left: 250px;
            padding: 30px;
            width: calc(100% - 250px);
            background: #f8f9fa;
            min-height: 100vh;
        }

        .sidebar a {
            display: block;
            color: #fff;
            padding: 10px 0;
            text-decoration: none;
            margin: 8px 0;
        }

        .sidebar a:hover {
            background: rgba(255,255,255,0.2);
            padding-left: 10px;
            transition: .3s;
        }
    </style>
</head>
<body>

@php use Illuminate\Support\Facades\Auth; @endphp

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h4 class="mb-4">📦 SIKADI SM</h4>

        @if(Auth::user()->peran === 'owner')
            <a href="{{ route('owner.dashboard') }}">🏠 Dashboard Owner</a>
            <a data-bs-toggle="collapse" href="#kelolaAkun">👥 Kelola Akun</a>
            <div class="collapse ps-3" id="kelolaAkun">
                <a href="{{ route('owner.list_user') }}">📄 Daftar Akun</a>
            </div>

            <a data-bs-toggle="collapse" href="#laporanK">📊 Laporan Keseluruhan</a>
            <div class="collapse ps-3" id="laporanK">
                <a href="{{ route('owner.keuangan') }}">💰 Laporan Keuangan</a>
                <a href="{{ route('owner.distribusi') }}">🚚 Laporan Distribusi</a>
            </div>
        @endif

        @if(Auth::user()->peran === 'keuangan')
            <a href="{{ route('keuangan.dashboard') }}">🏠 Dashboard Keuangan</a>
            <a href="{{ route('keuangan.gaji') }}">💰 Gaji Pegawai</a>
            <a href="{{ route('keuangan.pinjaman') }}">🏦 Pinjaman</a>
            <a href="{{ route('keuangan.laporan') }}">📄 Laporan Keuangan</a>
        @endif

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

    <!-- CONTENT -->
    <div class="content">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
