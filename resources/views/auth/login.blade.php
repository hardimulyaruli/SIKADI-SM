<!DOCTYPE html>
<html>
<head>
    <title>Login SIKADI SM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
        }

        .role-btn {
            border-radius: 20px;
            font-size: 14px;
            padding: 6px 15px;
            border: 1px solid white;
            background: transparent;
            color: white;
        }

        .role-btn.active {
            background: #00eaff;
            color: #000;
            border: none;
        }

        .login-card {
            width: 380px;
            background: rgba(255,255,255,0.1);
            padding: 30px;
            border-radius: 20px;
            backdrop-filter: blur(10px);
        }

        input {
            border-radius: 10px !important;
        }

        .btn-login {
            border-radius: 30px;
            background: linear-gradient(to right, #ff512f, #f09819);
            border: none;
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

    <h3 class="text-center mb-1">SIKADI SM</h3>
    <p class="text-center mb-4">Sistem Keuangan & Distribusi</p>

    <!-- ERROR -->
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- FORM LOGIN -->
    <form action="{{ route('login.action') }}" method="POST">
        @csrf

        <!-- PILIH ROLE (TIDAK MEMPENGARUHI LOGIKA LOGIN) -->
        <label class="mb-2">Pilih Role:</label>
        <div class="d-flex gap-2 mb-3">
            <button type="button" id="btn-owner" class="role-btn active" onclick="selectRole('owner')">Owner</button>
            <button type="button" id="btn-keuangan" class="role-btn" onclick="selectRole('keuangan')">Keuangan</button>
            <button type="button" id="btn-distribusi" class="role-btn" onclick="selectRole('distribusi')">Distribusi</button>
        </div>

        <!-- Hidden Role (Hanya Visual) -->
        <input type="hidden" name="selected_role" id="role" value="owner">

        <label>Username:</label>
        <input type="email" name="email" class="form-control mb-3" placeholder="Masukkan email" required>

        <label>Password:</label>
        <input type="password" name="password" class="form-control mb-3" placeholder="Masukkan password" required>

        <button class="btn btn-login w-100">Login ke Sistem</button>
    </form>

</div>

</body>
</html>
