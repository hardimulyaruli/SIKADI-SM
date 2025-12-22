@extends('layouts.sidebar')

@section('content')
    <style>
        .card-glass-soft {
            background: #fff;
            border-radius: 16px;
            padding: 18px 20px;
            box-shadow: 0 3px 16px rgba(148, 163, 184, 0.16);
            margin-bottom: 18px;
        }

        .text-muted {
            color: #6b7280;
            font-size: 12px;
        }
    </style>

    <h1 style="font-size:22px; font-weight:700; color:#111827; margin-bottom:16px;">
        <i class="ri-edit-2-line" style="color:#0ea5e9;"></i> Edit Data Karyawan
    </h1>

    <div class="card-glass-soft">
        <form method="POST" action="{{ route('owner.karyawan.update', $karyawan->id) }}">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="text-muted">Nama *</label>
                <input type="text" name="nama" class="form-control" required value="{{ old('nama', $karyawan->nama) }}">
            </div>
            <div class="mb-3">
                <label class="text-muted">Jabatan</label>
                @php $jabatanOptions = ['produksi','keuangan','distribusi']; @endphp
                <select name="jabatan" class="form-control">
                    <option value="">-- Pilih Jabatan --</option>
                    @foreach ($jabatanOptions as $opt)
                        <option value="{{ $opt }}"
                            {{ old('jabatan', $karyawan->jabatan) === $opt ? 'selected' : '' }}>{{ ucfirst($opt) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="text-muted">No HP</label>
                <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp', $karyawan->no_hp) }}">
            </div>
            <div class="mb-3">
                <label class="text-muted">Alamat</label>
                <input type="text" name="alamat" class="form-control" value="{{ old('alamat', $karyawan->alamat) }}">
            </div>
            <div class="mb-3">
                <label class="text-muted">Gaji</label>
                <input type="number" name="gaji" class="form-control" min="0" step="1000"
                    value="{{ old('gaji', optional($latestGaji)->jumlah_gaji) }}" required>
                <small class="text-muted">Perubahan gaji akan dicatat sebagai entri baru.</small>
            </div>
            <button type="submit" class="btn-modern btn-primary-modern" style="padding:10px 18px;">Simpan
                Perubahan</button>
            <a href="{{ route('owner.karyawan') }}" class="btn btn-light" style="margin-left:8px;">Batal</a>
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
