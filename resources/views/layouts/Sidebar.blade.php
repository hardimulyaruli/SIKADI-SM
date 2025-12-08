<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIKADI SM</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Dashboard Styles -->
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

    <!-- GSAP for Animations -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

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

        /* Animated background subtle */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 50%, rgba(102, 126, 234, 0.05) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(147, 112, 219, 0.05) 0%, transparent 50%);
            pointer-events: none;
            animation: gradientShift 15s ease-in-out infinite;
            z-index: 0;
        }

        @keyframes gradientShift {
            0%, 100% {
                opacity: 0.5;
                transform: translate(0, 0);
            }
            50% {
                opacity: 0.3;
                transform: translate(10px, 10px);
            }
        }

        /* ====== SIDEBAR MODERN ====== */
        .sidebar {
            width: 300px;
            height: 100vh;
            background: linear-gradient(180deg, #7c5cdb 0%, #6b4db8 100%);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-right: 1px solid rgba(255, 255, 255, 0.2);
            padding: 30px 20px;
            position: fixed;
            left: 0;
            top: 0;
            overflow-y: auto;
            z-index: 1000;
            box-shadow: 5px 0 20px rgba(0, 0, 0, 0.1);
            color: white;
            scrollbar-width: thin;
            scrollbar-color: rgba(255, 255, 255, 0.3) transparent;
        }

        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(102, 126, 234, 0.5);
            border-radius: 10px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(102, 126, 234, 0.8);
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
            background: rgba(102, 126, 234, 0.15);
            border-radius: 15px;
            border: 1px solid rgba(102, 126, 234, 0.2);
            animation: slideInDown 0.6s ease;
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
            color: rgba(255, 255, 255, 0.75);
            text-decoration: none;
            padding: 12px 16px;
            border-radius: 12px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            font-size: 14px;
            font-weight: 500;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
        }

        .sidebar a::before, .sidebar button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(102, 126, 234, 0.3), transparent);
            transition: left 0.4s ease;
            z-index: -1;
        }

        .sidebar a:hover::before, .sidebar button:hover::before {
            left: 100%;
        }

        .sidebar a:hover, .sidebar button:hover {
            color: white;
            transform: translateX(8px);
            background: rgba(102, 126, 234, 0.2);
            box-shadow: 0 8px 16px rgba(102, 126, 234, 0.15);
            border-left: 3px solid #667eea;
            padding-left: 13px;
        }

        .sidebar a i, .sidebar button i {
            width: 20px;
            text-align: center;
            font-size: 16px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
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
            background: linear-gradient(135deg, #7c5cdb 0%, #6b4db8 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(122, 92, 219, 0.3);
        }

        .btn-primary-modern:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(122, 92, 219, 0.4);
            color: white;
        }

        .btn-secondary-modern {
            background: linear-gradient(135deg, #b8a5d1 0%, #9b8bb8 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(122, 92, 219, 0.2);
        }

        .btn-secondary-modern:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(122, 92, 219, 0.3);
            color: white;
        }

        /* ====== FORM INPUTS ====== */
        .input-modern {
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(122, 92, 219, 0.2);
            border-radius: 12px;
            padding: 12px 16px;
            transition: all 0.3s ease;
            font-size: 14px;
            color: #2d2d2d;
        }

        .input-modern::placeholder {
            color: rgba(122, 92, 219, 0.5);
        }

        .input-modern:focus {
            outline: none;
            background: rgba(255, 255, 255, 1);
            border-color: #7c5cdb;
            box-shadow: 0 0 0 3px rgba(122, 92, 219, 0.1);
            transform: translateY(-2px);
            color: #2d2d2d;
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
            transition: all 0.3s ease;
            border-bottom: 1px solid rgba(122, 92, 219, 0.1);
        }

        .table-modern tbody tr:hover {
            background: rgba(122, 92, 219, 0.05);
            transform: translateX(3px);
        }

        .table-modern tbody td {
            padding: 14px 16px;
            color: #4a4a6a;
            font-size: 14px;
        }

        /* ====== ANIMATIONS ====== */
        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .animate-slide-up {
            animation: slideInUp 0.6s ease;
        }

        .animate-slide-left {
            animation: slideInLeft 0.6s ease;
        }

        .animate-fade-in {
            animation: fadeIn 0.6s ease;
        }

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
            <h3><i class="fas fa-box"></i> SIKADI</h3>
        </div>

        <!-- Navigation -->
        <div class="sidebar-nav">
            @php
                use Illuminate\Support\Facades\Auth;
            @endphp

            <!-- =============== OWNER MENU =============== -->
            @if (Auth::user() && Auth::user()->peran === 'owner')
                <div class="nav-section">
                    <div class="nav-section-title">📊 Dashboard</div>
                    <a href="{{ route('owner.dashboard') }}" class="animate-slide-left" style="animation-delay: 0.1s;">
                        <i class="fas fa-chart-line"></i>
                        <span>Dashboard</span>
                    </a>
                </div>

                <div class="nav-section">
                    <div class="nav-section-title">⚙️ Manajemen</div>
                    <a href="{{ route('owner.list_user') }}" class="animate-slide-left" style="animation-delay: 0.2s;">
                        <i class="fas fa-users"></i>
                        <span>Kelola Akun</span>
                    </a>
                </div>

                <div class="nav-section">
                    <div class="nav-section-title">📈 Laporan</div>
                    <a href="{{ route('owner.keuangan') }}" class="animate-slide-left" style="animation-delay: 0.3s;">
                        <i class="fas fa-money-bill-wave"></i>
                        <span>Laporan Keuangan</span>
                    </a>
                    <a href="{{ route('owner.distribusi') }}" class="animate-slide-left" style="animation-delay: 0.4s;">
                        <i class="fas fa-boxes"></i>
                        <span>Laporan Distribusi</span>
                    </a>
                </div>
            @endif

            <!-- =============== KEUANGAN MENU =============== -->
            @if (Auth::user() && Auth::user()->peran === 'keuangan')
                <div class="nav-section">
                    <div class="nav-section-title">📊 Dashboard</div>
                    <a href="{{ route('keuangan.dashboard') }}" class="animate-slide-left" style="animation-delay: 0.1s;">
                        <i class="fas fa-chart-pie"></i>
                        <span>Dashboard</span>
                    </a>
                </div>

                <div class="nav-section">
                    <div class="nav-section-title">💰 Penggajian</div>
                    <a href="{{ route('keuangan.gaji') }}" class="animate-slide-left" style="animation-delay: 0.2s;">
                        <i class="fas fa-money-check"></i>
                        <span>Kelola Gaji</span>
                    </a>
                    <a href="{{ route('keuangan.pinjaman') }}" class="animate-slide-left" style="animation-delay: 0.3s;">
                        <i class="fas fa-hand-holding-usd"></i>
                        <span>Kelola Pinjaman</span>
                    </a>
                </div>

                <div class="nav-section">
                    <div class="nav-section-title">📝 Transaksi</div>
                    <a href="{{ route('keuangan.transaksi') }}" class="animate-slide-left" style="animation-delay: 0.4s;">
                        <i class="fas fa-exchange-alt"></i>
                        <span>Transaksi</span>
                    </a>
                    <a href="{{ route('keuangan.laporan') }}" class="animate-slide-left" style="animation-delay: 0.5s;">
                        <i class="fas fa-file-invoice"></i>
                        <span>Laporan</span>
                    </a>
                </div>
            @endif

            <!-- =============== DISTRIBUSI MENU =============== -->
            @if (Auth::user() && Auth::user()->peran === 'distribusi')
                <div class="nav-section">
                    <div class="nav-section-title">📊 Dashboard</div>
                    <a href="{{ route('distribusi.dashboard') }}" class="animate-slide-left" style="animation-delay: 0.1s;">
                        <i class="fas fa-boxes"></i>
                        <span>Dashboard</span>
                    </a>
                </div>

                <div class="nav-section">
                    <div class="nav-section-title">📦 Manajemen</div>
                    <a href="{{ route('distribusi.Barang') }}" class="animate-slide-left" style="animation-delay: 0.2s;">
                        <i class="fas fa-clipboard-list"></i>
                        <span>Kelola Barang</span>
                    </a>
                </div>

                <div class="nav-section">
                    <div class="nav-section-title">📈 Laporan</div>
                    <a href="{{ route('distribusi.laporan') }}" class="animate-slide-left" style="animation-delay: 0.3s;">
                        <i class="fas fa-file-invoice"></i>
                        <span>Laporan Distribusi</span>
                    </a>
                </div>
            @endif

            <!-- =============== AUTH =============== -->
            @if(Auth::user())
                <hr>
                <div class="nav-section">
                    <div class="nav-section-title">👤 Akun</div>
                    <form method="POST" action="{{ route('logout') }}" style="width: 100%;">
                        @csrf
                        <button type="submit" class="animate-slide-left" style="animation-delay: 0.6s;">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            @else
                <a href="{{ route('login.page') }}" class="mt-4 animate-slide-left">
                    <i class="fas fa-sign-in-alt"></i>
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

    <script>
        // ====== GSAP ANIMATIONS ======
        gsap.registerPlugin(ScrollTrigger);

        // Sidebar animation on load
        gsap.from('.sidebar', {
            duration: 0.8,
            x: -300,
            opacity: 0,
            ease: 'power3.out'
        });

        // Card animation on scroll - disabled to prevent content from disappearing

        // Hover effect for sidebar items
        document.querySelectorAll('.sidebar a, .sidebar button').forEach(item => {
            item.addEventListener('mouseenter', function() {
                gsap.to(this, {
                    duration: 0.3,
                    backgroundColor: 'rgba(102, 126, 234, 0.2)',
                    ease: 'power2.out'
                });
            });

            item.addEventListener('mouseleave', function() {
                gsap.to(this, {
                    duration: 0.3,
                    backgroundColor: 'transparent',
                    ease: 'power2.out'
                });
            });
        });

        // Table row animation - disabled to prevent content from disappearing
    </script>

    <!-- Chart.js Library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <!-- Charts Configuration -->
    <script src="{{ asset('js/charts.js') }}"></script>
</body>

</html>
