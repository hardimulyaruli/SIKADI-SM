<!DOCTYPE html>
<html>

<head>
    <title>Login SIKADI SM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: radial-gradient(circle at 20% 20%, rgba(14, 165, 233, 0.08), transparent 30%),
                radial-gradient(circle at 80% 0%, rgba(56, 189, 248, 0.12), transparent 32%),
                #f8fafc;
            color: #0f172a;
            padding: 16px;
        }

        .login-card {
            width: 400px;
            background: #ffffff;
            padding: 28px 30px;
            border-radius: 18px;
            box-shadow: 0 20px 50px rgba(15, 23, 42, 0.12);
        }

        .brand {
            text-align: center;
            margin-bottom: 18px;
        }

        .brand h3 {
            margin: 0;
            font-weight: 800;
            color: #0f172a;
        }

        .brand p {
            margin: 4px 0 0;
            color: #6b7280;
            font-size: 13px;
        }

        label {
            font-weight: 600;
            color: #0f172a;
            margin-bottom: 6px;
        }

        .form-control {
            border-radius: 12px;
            border: 1px solid #e5e7eb;
            padding: 12px 14px;
            background: #f9fafb;
        }

        .form-control:focus {
            border-color: #38bdf8;
            box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.18);
            background: #fff;
        }

        .role-btn {
            border-radius: 12px;
            font-size: 13px;
            padding: 10px 14px;
            border: 1px solid #e2e8f0;
            background: #f8fafc;
            color: #0f172a;
            font-weight: 700;
        }

        .role-btn.active {
            background: linear-gradient(135deg, #0ea5e9, #38bdf8);
            color: #fff;
            border: none;
            box-shadow: 0 12px 30px rgba(56, 189, 248, 0.25);
        }

        .btn-login {
            border-radius: 12px;
            background: linear-gradient(135deg, #0ea5e9, #38bdf8);
            border: none;
            padding: 12px;
            font-weight: 800;
            box-shadow: 0 16px 40px rgba(56, 189, 248, 0.3);
        }

        .btn-login:hover {
            filter: brightness(1.05);
        }
    </style>

    <script>
        function selectRole(role) {
            document.getElementById("role").value = role;

            document.querySelectorAll(".role-btn").forEach(btn => btn.classList.remove("active"));
            document.getElementById("btn-" + role).classList.add("active");
        }
    </script>
</head>

<body>

    <div class="login-card">

        <div class="brand">
            <h3>SIKADI SM</h3>
            <p>Sistem Keuangan & Distribusi</p>
        </div>

        <!-- ERROR -->
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- FORM LOGIN -->
        <form action="{{ route('login.action') }}" method="POST">
            @csrf

            <!-- PILIH ROLE (TIDAK MEMPENGARUHI LOGIKA LOGIN) -->
            <label class="mb-2">Pilih Role:</label>
            <div class="d-flex gap-2 mb-3 flex-wrap">
                <button type="button" id="btn-owner" class="role-btn active"
                    onclick="selectRole('owner')">Owner</button>
                <button type="button" id="btn-keuangan" class="role-btn"
                    onclick="selectRole('keuangan')">Keuangan</button>
                <button type="button" id="btn-distribusi" class="role-btn"
                    onclick="selectRole('distribusi')">Distribusi</button>
            </div>

            <!-- Hidden Role (Hanya Visual) -->
            <input type="hidden" name="selected_role" id="role" value="owner">

            <label>Username:</label>
            <input type="email" name="email" class="form-control mb-3" placeholder="Masukkan email" required
                autocomplete="off">

            <label>Password:</label>
            <input type="password" name="password" class="form-control mb-4" placeholder="Masukkan password" required>

            <button class="btn btn-login w-100">Login ke Sistem</button>
        </form>

    </div>

</body>

</html>
