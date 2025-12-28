@extends('layouts.sidebar')

@section('content')
    <style>
        .hero {
            background: radial-gradient(circle at 15% 20%, rgba(14, 165, 233, 0.12), transparent 28%),
                radial-gradient(circle at 85% 10%, rgba(59, 130, 246, 0.1), transparent 26%),
                linear-gradient(135deg, #f9fbff, #f5f3ff);
            border-radius: 22px;
            padding: 20px 22px;
            margin-bottom: 16px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 12px 32px rgba(15, 23, 42, 0.08);
        }

        .hero h1 {
            font-size: 24px;
            font-weight: 800;
            color: #0b1b3a;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-card {
            background: #ffffff;
            border-radius: 18px;
            padding: 18px 20px;
            box-shadow: 0 10px 28px rgba(15, 23, 42, 0.08);
            border: 1px solid #e2e8f0;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
            gap: 12px 14px;
        }

        .field-shell {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 10px 12px;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .field-shell label {
            font-size: 12px;
            font-weight: 700;
            color: #0f172a;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            margin: 0;
        }

        .field-shell input,
        .field-shell select {
            border: none;
            background: transparent;
            padding: 0;
            height: 28px;
            font-weight: 600;
            color: #0f172a;
            box-shadow: none;
        }

        .field-shell input:focus,
        .field-shell select:focus {
            outline: none;
        }

        .actions-row {
            display: flex;
            gap: 10px;
            margin-top: 12px;
        }

        .btn-pill-primary {
            background: linear-gradient(135deg, #0ea5e9, #2563eb);
            color: #fff;
            font-weight: 700;
            border: none;
            border-radius: 12px;
            padding: 12px 18px;
            box-shadow: 0 10px 24px rgba(37, 99, 235, 0.3);
        }

        .btn-ghost {
            border-radius: 12px;
            padding: 12px 18px;
            border: 1px solid #e2e8f0;
            background: #fff;
            font-weight: 700;
            color: #0f172a;
        }

        .text-muted {
            color: #6b7280;
            font-size: 12px;
        }
    </style>

    <div class="hero">
        <h1><i class="ri-edit-2-line" style="color:#0ea5e9;"></i> Edit Data Karyawan</h1>
    </div>

    <div class="section-card">
        <form method="POST" action="{{ route('owner.karyawan.update', $karyawan->id) }}">
            @csrf
            @method('PUT')
            <div class="form-grid">
                <div class="field-shell">
                    <label>Nama *</label>
                    <input type="text" name="nama" required value="{{ old('nama', $karyawan->nama) }}">
                </div>
                <div class="field-shell">
                    <label>Jabatan</label>
                    @php $jabatanOptions = ['produksi','keuangan','distribusi']; @endphp
                    <select name="jabatan">
                        <option value="">-- Pilih Jabatan --</option>
                        @foreach ($jabatanOptions as $opt)
                            <option value="{{ $opt }}"
                                {{ old('jabatan', $karyawan->jabatan) === $opt ? 'selected' : '' }}>{{ ucfirst($opt) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="field-shell">
                    <label>No HP</label>
                    <input type="text" name="no_hp" value="{{ old('no_hp', $karyawan->no_hp) }}">
                </div>
                <div class="field-shell">
                    <label>Alamat</label>
                    <input type="text" name="alamat" value="{{ old('alamat', $karyawan->alamat) }}">
                </div>
                <div class="field-shell">
                    <label>Gaji</label>
                    <input type="number" name="gaji" min="0" step="1000"
                        value="{{ old('gaji', optional($latestGaji)->jumlah_gaji) }}" required>
                    <small class="text-muted">Perubahan gaji akan dicatat sebagai entri baru.</small>
                </div>
            </div>
            <div class="actions-row">
                <button type="submit" class="btn-pill-primary">Simpan Perubahan</button>
                <a href="{{ route('owner.karyawan') }}" class="btn-ghost">Batal</a>
            </div>
        </form>

        @if ($errors->any())
            <div class="text-danger mt-2" style="font-size:12px;">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif
        @if (session('success'))
            <div class="text-success mt-2" style="font-size:12px;">{{ session('success') }}</div>
        @endif
    </div>
@endsection
