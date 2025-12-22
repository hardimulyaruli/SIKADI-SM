@extends('layouts.sidebar')

@section('content')
    <style>
        .page-header {
            margin-bottom: 20px;
        }

        .page-header h1 {
            font-weight: 700;
            margin-bottom: 6px;
        }

        .page-header p {
            color: #6b7280;
            margin: 0;
        }

        .card-glass {
            background: #fff;
            border-radius: 14px;
            padding: 18px 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
            max-width: 720px;
            margin: 0 auto;
        }

        .form-group-custom {
            margin-bottom: 14px;
        }

        .form-group-custom label {
            font-weight: 600;
            color: #374151;
            margin-bottom: 6px;
            display: block;
        }

        .input-modern {
            width: 100%;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            padding: 12px 14px;
            font-size: 14px;
            color: #111827;
            background: #f9fafb;
        }

        .input-modern:focus {
            outline: none;
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15);
            background: #fff;
        }

        .btn-primary-modern {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: #fff;
            border: none;
            border-radius: 12px;
            padding: 12px 16px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 10px 24px rgba(99, 102, 241, 0.28);
        }

        .btn-primary-modern:hover {
            filter: brightness(1.05);
        }

        .form-text {
            color: #9ca3af;
            font-size: 12px;
            margin-top: 4px;
        }
    </style>

    <div class="page-header">
        <h1><i class="fas fa-user-pen"></i> Edit Akun</h1>
        <p>Ubah informasi akun pengguna</p>
    </div>

    <div class="card-glass">
        <form action="{{ route('owner.update_user', $akun->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group-custom">
                <label for="nama">Nama</label>
                <input type="text" id="nama" name="nama" class="input-modern" value="{{ $akun->nama }}" required>
            </div>

            <div class="form-group-custom">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="input-modern" value="{{ $akun->email }}"
                    required>
            </div>

            <div class="form-group-custom">
                <label for="peran">Peran</label>
                <select id="peran" name="peran" class="input-modern" required>
                    <option value="owner" {{ $akun->peran == 'owner' ? 'selected' : '' }}>Owner</option>
                    <option value="keuangan" {{ $akun->peran == 'keuangan' ? 'selected' : '' }}>Keuangan</option>
                    <option value="distribusi" {{ $akun->peran == 'distribusi' ? 'selected' : '' }}>Distribusi</option>
                </select>
            </div>

            <div class="form-group-custom">
                <label for="password">Password Baru (Opsional)</label>
                <input type="password" id="password" name="kata_sandi" class="input-modern"
                    placeholder="Kosongkan jika tidak ingin mengganti">
                <div class="form-text">Hanya isi jika ingin mengganti password</div>
            </div>

            <button type="submit" class="btn-primary-modern"><i class="fas fa-save"></i> Simpan Perubahan</button>
        </form>
    </div>
@endsection
