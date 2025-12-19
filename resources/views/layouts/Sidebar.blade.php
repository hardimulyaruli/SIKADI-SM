<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SIKADI SM</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Remix Icon (modern, clean icons) -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Dashboard Styles -->
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

    <!-- Animations intentionally removed for a static, professional UI -->

    <style>
        * {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
        }

        /* ====== GLASSMORPHISM & 3D EFFECTS ====== */
        .glassmorphism {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
        }

        .glassmorphism-dark {
            background: rgba(0, 0, 0, 0.15);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 20px;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        }

        /* ====== BODY & MAIN LAYOUT ====== */
        html, body {
            height: 100%;
            overflow: hidden;
        }

        body {
            display: flex;
            background: linear-gradient(135deg, #f8f9fc 0%, #f0f1f8 100%);
            position: relative;
        }

        /* Static subtle background accents (no animations) */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 50%, rgba(14, 165, 233, 0.04) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(3, 105, 161, 0.03) 0%, transparent 50%);
            pointer-events: none;
            z-index: 0;
        }

        /* ====== SIDEBAR MODERN ====== */
        .sidebar {
            width: 300px;
            height: 100vh;
            background: linear-gradient(180deg, #0ea5e9 0%, #0369a1 100%);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            border-right: 1px solid rgba(255, 255, 255, 0.08);
            padding: 30px 20px;
            position: fixed;
            left: 0;
            top: 0;
            overflow-y: auto;
            z-index: 1000;
            box-shadow: 6px 0 26px rgba(3, 105, 161, 0.08);
            color: white;
            scrollbar-width: thin;
            scrollbar-color: rgba(255, 255, 255, 0.35) transparent;
        }

        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(14, 165, 233, 0.6);
            border-radius: 10px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(3, 105, 161, 0.85);
        }

        .sidebar::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            pointer-events: none;
        }

        .sidebar-header {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 40px;
            padding: 20px;
            background: rgba(255, 255, 255, 0.06);
            border-radius: 15px;
            border: 1px solid rgba(255, 255, 255, 0.08);
            /* animations disabled */
        }

        .sidebar-header h3 {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
            background: linear-gradient(135deg, #667eea 0%, #f093fb 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: 2px;
        }

        .sidebar-nav {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .nav-section {
            margin-top: 24px;
        }

        .nav-section-title {
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.5);
            letter-spacing: 1.5px;
            margin: 16px 0 12px 0;
            padding: 0 12px;
        }

        .sidebar a, .sidebar button {
            display: flex;
            align-items: center;
            gap: 12px;
            color: rgba(255, 255, 255, 0.95);
            text-decoration: none;
            padding: 12px 16px;
            border-radius: 12px;
            position: relative;
            overflow: hidden;
            font-size: 15px;
            font-weight: 600;
            border: none;
            background: transparent;
            width: 100%;
            text-align: left;
            cursor: pointer;
        }

        /* no animated pseudo-element to keep UI static */
        .sidebar a::before, .sidebar button::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 0;
            height: 100%;
            background: transparent;
            z-index: -1;
        }

        .sidebar a:hover, .sidebar button:hover {
            color: white;
            background: rgba(14, 165, 233, 0.14);
            box-shadow: none;
            border-left: 3px solid rgba(56, 189, 248, 0.95);
            padding-left: 13px;
        }

        .sidebar a i, .sidebar button i {
            width: 28px;
            text-align: center;
            font-size: 20px;
            color: rgba(255,255,255,0.98);
            display: inline-block;
            line-height: 1;
        }

        .sidebar hr {
            border: none;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
            margin: 20px 0;
        }

        /* ====== MAIN CONTENT ====== */
        .main-container {
            margin-left: 300px;
            width: calc(100% - 300px);
            height: 100vh;
            display: flex;
            flex-direction: column;
            position: relative;
            z-index: 1;
        }

        .main-content {
            flex: 1;
            overflow-y: auto;
            padding: 30px;
            scrollbar-width: thin;
            scrollbar-color: rgba(255, 255, 255, 0.2) transparent;
        }

        .main-content::-webkit-scrollbar {
            width: 8px;
        }

        .main-content::-webkit-scrollbar-track {
            background: transparent;
        }

        .main-content::-webkit-scrollbar-thumb {
            background: rgba(102, 126, 234, 0.3);
            border-radius: 10px;
        }

        .main-content::-webkit-scrollbar-thumb:hover {
            background: rgba(102, 126, 234, 0.5);
        }

        /* ====== CARD GLASSMORPHISM ====== */
        .card-glass {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(122, 92, 219, 0.15);
            border-radius: 20px;
            padding: 30px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 15px rgba(122, 92, 219, 0.08);
            color: #2d2d2d;
        }

        .card-glass:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.95);
            border-color: rgba(122, 92, 219, 0.25);
            box-shadow: 0 12px 30px rgba(122, 92, 219, 0.15);
        }

        /* ====== BUTTONS ====== */
        .btn-modern {
            padding: 12px 28px;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-modern::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.2);
            transition: left 0.3s ease;
            z-index: -1;
        }

        .btn-modern:hover::before {
            left: 100%;
        }

        .btn-primary-modern {
            background: linear-gradient(135deg, #0ea5e9 0%, #0369a1 100%);
            color: white;
            box-shadow: 0 6px 20px rgba(3, 105, 161, 0.15);
        }

        .btn-primary-modern:hover {
            transform: none;
            box-shadow: 0 10px 30px rgba(3, 105, 161, 0.18);
            color: white;
        }

        .btn-secondary-modern {
            background: linear-gradient(135deg, rgba(255,255,255,0.9) 0%, rgba(248,249,250,0.9) 100%);
            color: #0f172a;
            box-shadow: 0 4px 10px rgba(2,6,23,0.06);
        }

        .btn-secondary-modern:hover {
            transform: none;
            box-shadow: 0 8px 18px rgba(2,6,23,0.08);
            color: #0f172a;
        }

        /* ====== FORM INPUTS ====== */
        .input-modern {
            background: #ffffff;
            border: 1px solid rgba(56, 189, 248, 0.15);
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 14px;
            color: #1f2937;
        }

        .input-modern::placeholder {
            color: rgba(31, 41, 55, 0.45);
        }

        .input-modern:focus {
            outline: none;
            background: #ffffff;
            border-color: #38bdf8;
            box-shadow: none;
            color: #1f2937;
        }

        .form-label {
            color: #5a4a7a;
            font-weight: 600;
            margin-bottom: 8px;
        }

        /* ====== TABLE STYLING ====== */
        .table-modern {
            border-collapse: collapse;
            width: 100%;
            color: #2d2d2d;
        }

        .table-modern thead {
            background: linear-gradient(135deg, rgba(122, 92, 219, 0.1) 0%, rgba(147, 112, 219, 0.1) 100%);
            border-bottom: 2px solid rgba(122, 92, 219, 0.2);
        }

        .table-modern thead th {
            padding: 16px;
            text-align: left;
            font-weight: 600;
            color: #5a4a7a;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
        }

        .table-modern tbody tr {
            border-bottom: 1px solid rgba(148, 163, 184, 0.08);
        }

        .table-modern tbody tr:hover {
            background: rgba(14, 165, 233, 0.04);
        }

        .table-modern tbody td {
            padding: 14px 16px;
            color: #4a4a6a;
            font-size: 14px;
        }

        /* Animations removed to keep UI static and professional */

        /* ====== BADGE STYLES ====== */
        .badge-modern {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge-success {
            background: linear-gradient(135deg, rgba(34, 197, 94, 0.2) 0%, rgba(20, 184, 166, 0.2) 100%);
            color: #86efac;
            border: 1px solid rgba(34, 197, 94, 0.4);
        }

        .badge-warning {
            background: linear-gradient(135deg, rgba(234, 179, 8, 0.2) 0%, rgba(245, 158, 11, 0.2) 100%);
            color: #fcd34d;
            border: 1px solid rgba(234, 179, 8, 0.4);
        }

        .badge-danger {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.2) 0%, rgba(249, 115, 22, 0.2) 100%);
            color: #fca5a5;
            border: 1px solid rgba(239, 68, 68, 0.4);
        }

        /* ====== RESPONSIVE ====== */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                max-height: 60vh;
                overflow-y: auto;
            }

            .main-container {
                margin-left: 0;
                width: 100%;
                flex-direction: column;
                height: auto;
            }

            .main-content {
                height: auto;
                padding: 20px;
            }

            body {
                flex-direction: column;
                height: auto;
            }

            .sidebar a {
                font-size: 13px;
                padding: 10px 12px;
            }

            .card-glass {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <!-- SIDEBAR MODERN -->
    <nav class="sidebar">
        <!-- Header -->
        <div class="sidebar-header">
            <h3><i class="ri-shopping-bag-line"></i> SIKADI</h3>
        </div>

        <!-- Navigation -->
        <div class="sidebar-nav">
            @php
                use Illuminate\Support\Facades\Auth;
            @endphp

            <!-- =============== OWNER MENU =============== -->
            @if (Auth::user() && Auth::user()->peran === 'owner')
                <div class="nav-section">
                    <div class="nav-section-title">Dashboard</div>
                    <a href="{{ route('owner.dashboard') }}">
                        <i class="ri-bar-chart-line"></i>
                        <span>Dashboard</span>
                    </a>
                </div>

                <div class="nav-section">
                    <div class="nav-section-title">Manajemen</div>
                    <a href="{{ route('owner.list_user') }}">
                        <i class="ri-user-3-line"></i>
                        <span>Kelola Akun</span>
                    </a>
                </div>

                <div class="nav-section">
                    <div class="nav-section-title">Laporan</div>
                    <a href="{{ route('owner.keuangan') }}">
                        <i class="ri-money-dollar-box-line"></i>
                        <span>Laporan Keuangan</span>
                    </a>
                    <a href="{{ route('owner.distribusi') }}">
                        <i class="ri-stack-line"></i>
                        <span>Laporan Distribusi</span>
                    </a>
                </div>
            @endif

            <!-- =============== KEUANGAN MENU =============== -->
            @if (Auth::user() && Auth::user()->peran === 'keuangan')
                <div class="nav-section">
                    <div class="nav-section-title">Dashboard</div>
                    <a href="{{ route('keuangan.dashboard') }}">
                        <i class="ri-pie-chart-line"></i>
                        <span>Dashboard</span>
                    </a>
                </div>

                <div class="nav-section">
                    <div class="nav-section-title">Penggajian</div>
                    <a href="{{ route('keuangan.gaji') }}">
                        <i class="ri-wallet-2-line"></i>
                        <span>Kelola Gaji</span>
                    </a>
                    <a href="{{ route('keuangan.pinjaman') }}">
                        <i class="ri-hand-coin-line"></i>
                        <span>Kelola Pinjaman</span>
                    </a>
                </div>

                <div class="nav-section">
                    <div class="nav-section-title">Transaksi</div>
                    <a href="{{ route('keuangan.transaksi') }}">
                        <i class="ri-exchange-line"></i>
                        <span>Transaksi</span>
                    </a>
                    <a href="{{ route('keuangan.laporan') }}">
                        <i class="ri-file-list-3-line"></i>
                        <span>Laporan</span>
                    </a>
                </div>
            @endif

            <!-- =============== DISTRIBUSI MENU =============== -->
            @if (Auth::user() && Auth::user()->peran === 'distribusi')
                <div class="nav-section">
                    <div class="nav-section-title">Dashboard</div>
                    <a href="{{ route('distribusi.dashboard') }}">
                        <i class="ri-stack-line"></i>
                        <span>Dashboard</span>
                    </a>
                </div>

                <div class="nav-section">
                    <div class="nav-section-title">Manajemen</div>
                    <a href="{{ route('distribusi.barang') }}">
                        <i class="ri-file-list-line"></i>
                        <span>Kelola Barang</span>
                    </a>
                </div>

                <div class="nav-section">
                    <div class="nav-section-title">Laporan</div>
                    <a href="{{ route('distribusi.laporan') }}">
                        <i class="ri-file-list-3-line"></i>
                        <span>Laporan Distribusi</span>
                    </a>
                </div>
            @endif

            <!-- =============== AUTH =============== -->
            @if(Auth::user())
                <hr>
                <div class="nav-section">
                    <div class="nav-section-title">Akun</div>
                    <form method="POST" action="{{ route('logout') }}" style="width: 100%;">
                        @csrf
                        <button type="submit">
                            <i class="ri-logout-box-r-line"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            @else
                <a href="{{ route('login.page') }}" class="mt-4">
                    <i class="ri-login-box-line"></i>
                    <span>Login</span>
                </a>
            @endif
        </div>
    </nav>

    <!-- MAIN CONTAINER -->
    <div class="main-container">
        <div class="main-content">
            @yield('content')
        </div>
    </div>

    <!-- Bootstrap & Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Animations removed; interactions are pure CSS without motion. -->

    <!-- Chart.js Library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <!-- Charts Configuration -->
    <script src="{{ asset('js/charts.js') }}"></script>
</body>

</html>
