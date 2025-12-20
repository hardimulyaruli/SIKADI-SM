@extends('layouts.sidebar')
@section('content')

<style>
    /* TEXTBOX STYLE */
    .textbox {
        background: #ffffff;
        border: 1px solid rgba(56, 189, 248, 0.25);
        border-radius: 10px;
        padding: 12px 16px;
        font-size: 14px;
        width: 350px;
        color: #1f2937;

        /* smooth animation */
        transition: 
            border-color 0.25s ease,
            box-shadow 0.25s ease,
            background-color 0.25s ease;
    }

    /* hover effect */
    .textbox:hover {
        border-color: #38bdf8;
    }

    /* focus effect */
    .textbox:focus {
        outline: none;
        border-color: #38bdf8;
        box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.25);
        background-color: #f8fbff;
    }

    /* SELECT FIX */
    select.textbox {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg fill='none' stroke='%230369a1' stroke-width='2' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 14px center;
        background-size: 18px;
        padding-right: 42px;
        cursor: pointer;
    }
</style>

<div class="page-header">
    <h1>✏️ Edit Distribusi</h1>
    <p>Ubah data distribusi barang</p>
</div>

<div class="card-form" style="max-width: 600px;">

    {{-- FORM UPDATE --}}
    <form action="{{ route('distribusi.update', $distribusi->id) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="form-group-custom">
            <label for="catatan">Nama Barang</label>
            <input type="text"
                   id="catatan"
                   name="catatan"
                   class="textbox"
                   value="{{ old('catatan', $distribusi->catatan) }}"
                   required>
        </div>

        <div class="form-group-custom">
            <label for="jumlah_produk">Jumlah Barang</label>
            <input type="number"
                   id="jumlah_produk"
                   name="jumlah_produk"
                   class="textbox"
                   min="1"
                   value="{{ old('jumlah_produk', $distribusi->jumlah_produk) }}"
                   required>
        </div>

        <div class="form-group-custom">
            <label for="toko_tujuan">Tujuan</label>
            <input type="text"
                   id="toko_tujuan"
                   name="toko_tujuan"
                   class="textbox"
                   value="{{ old('toko_tujuan', $distribusi->toko_tujuan) }}"
                   required>
        </div>

        <div class="form-group-custom">
            <label for="status">Status</label>
            <select id="status"
                    name="status"
                    class="textbox"
                    required>
                <option value="terkirim" {{ $distribusi->status == 'terkirim' ? 'selected' : '' }}>
                    Terkirim
                </option>
                <option value="pending" {{ $distribusi->status == 'pending' ? 'selected' : '' }}>
                    Pending
                </option>
            </select>
        </div>

        <button type="submit" class="btn-modern btn-primary-modern">
            💾 Simpan Perubahan
        </button>

        <a href="{{ route('distribusi.barang') }}" class="btn-modern">
            Kembali
        </a>
    </form>

    {{-- FORM HAPUS --}}
    <form action="{{ route('distribusi.destroy', $distribusi->id) }}"
          method="POST"
          onsubmit="return confirm('Yakin ingin menghapus data distribusi ini?')"
          style="margin-top:16px;">
        @csrf
        @method('DELETE')

        <button type="submit" class="btn-modern btn-danger-modern">
            🗑️ Hapus Data
        </button>
    </form>

</div>

@endsection