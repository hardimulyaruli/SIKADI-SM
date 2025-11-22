<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIKADI SM</title>

    <!-- BOOTSTRAP -->
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

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h4 class="mb-4">📦 SIKADI SM</h4>

        {{-- MENU OWNER --}}
        @if(Auth::user()->peran === 'owner')
            <a href="{{ route('owner.dashboard') }}">🏠 Dashboard Owner</a>
            <a href="{{ route('owner.keuangan') }}">📊 Laporan Umum</a>
            <a href="{{ route('owner.user_management') }}">👥 Manajemen Pengguna</a>
        @endif

        {{-- MENU KEUANGAN --}}
        @if(Auth::user()->peran === 'keuangan')
            <a href="{{ route('keuangan.dashboard') }}">🏠 Dashboard Keuangan</a>
            <a href="#">💰 Gaji Pegawai</a>
            <a href="#">🏦 Pinjaman</a>
            <a href="#">📥 Pemasukan</a>
            <a href="#">📤 Pengeluaran</a>
            <a href="#">📄 Laporan Keuangan</a>
        @endif

        {{-- MENU DISTRIBUSI --}}
        @if(Auth::user()->peran === 'distribusi')
            <a href="{{ route('distribusi.dashboard') }}">🏠 Dashboard Distribusi</a>
            <a href="#">🚚 Distribusi Barang</a>
            <a href="#">📄 Laporan Distribusi</a>
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

</body>

</html>
