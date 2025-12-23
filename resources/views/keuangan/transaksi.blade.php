@extends('layouts.sidebar')

@section('content')

    <style>
        .page-header {
            margin-bottom: 24px;
            animation: slideInUp 0.6s ease;
        }

        .page-header h1 {
            font-size: 28px;
            font-weight: 700;
            color: #2d2d2d;
            margin-bottom: 6px;
        }

        .page-header p {
            color: #8a7a9e;
            font-size: 13px;
        }

        .form-section {
            display: flex;
            gap: 16px;
            margin-bottom: 28px;
            flex-wrap: wrap;
        }

        .form-group-custom {
            flex: 1;
            min-width: 200px;
        }

        .form-group-custom label {
            display: block;
            color: #5a4a7a;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 13px;
            text-transform: uppercase;
        }

        .form-group-custom input,
        .form-group-custom select,
        .form-group-custom textarea {
            width: 100%;
            background: #fff;
            border: 1px solid rgba(56, 189, 248, 0.12);
            border-radius: 10px;
            padding: 10px 14px;
            color: #1f2937;
            font-size: 14px;
        }

        .form-group-custom input:focus,
        .form-group-custom select:focus,
        .form-group-custom textarea:focus {
            outline: none;
            border-color: #38bdf8;
        }

        .btn-submit {
            align-self: flex-end;
        }

        .table-wrapper {
            overflow-x: auto;
            border-radius: 16px;
            box-shadow: 0 4px 15px rgba(122, 92, 219, 0.06);
        }

        .table-modern {
            border-collapse: collapse;
            width: 100%;
        }

        .table-modern thead {
            background: linear-gradient(135deg, rgba(14, 165, 233, 0.05) 0%, rgba(3, 105, 161, 0.03) 100%);
            border-bottom: 2px solid rgba(14, 165, 233, 0.06);
        }

        .table-modern thead th {
            padding: 14px 18px;
            color: #0f172a;
            font-weight: 700;
            text-align: left;
            text-transform: uppercase;
            font-size: 12px;
        }

        .table-modern tbody tr {
            border-bottom: 1px solid rgba(148, 163, 184, 0.06);
        }

        .table-modern tbody tr:hover {
            background: rgba(14, 165, 233, 0.03);
        }

        .table-modern tbody td {
            padding: 12px 18px;
            color: #374151;
            font-size: 14px;
        }

        .badge-custom {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            background: rgba(122, 92, 219, 0.1);
            color: #7c5cdb;
        }

        .empty-state {
            text-align: center;
            padding: 48px 20px;
            color: #8a7a9e;
        }

        .empty-state i {
            font-size: 40px;
            margin-bottom: 16px;
            opacity: 0.28;
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width:768px) {
            .form-section {
                flex-direction: column;
            }

            .btn-submit {
                width: 100%;
            }
        }
    </style>

    <!-- PAGE HEADER -->
    <div class="page-header">
        <h1><i class="fas fa-receipt"></i> Kelola Transaksi Keuangan</h1>
        <p>Tambah, lihat, dan kelola transaksi pemasukan dan pengeluaran</p>
    </div>

    <!-- FORM INPUT TRANSAKSI -->
    <div class="card-glass" style="margin-bottom:28px;">
        <h3 style="margin-bottom:22px; font-size:18px; font-weight:600; color:#2d2d2d;">
            <i class="fas fa-clipboard-list" style="color:#7c5cdb;"></i> Form Input Transaksi
        </h3>

        <form action="{{ route('keuangan.transaksi.post') }}" method="POST">
            @csrf
            <div class="form-section">
                <div class="form-group-custom">
                    <label for="tipe">Tipe Transaksi</label>
                    <select name="tipe" id="tipe" required>
                        <option value="">-- Pilih Tipe --</option>
                        <option value="pemasukan" selected>Pemasukan</option>
                        <option value="pengeluaran">Pengeluaran</option>
                    </select>
                </div>

                <div class="form-group-custom">
                    <label for="kategori">Kategori</label>
                    <select id="kategori" name="kategori" required>
                        <option value="">-- Pilih Kategori --</option>
                    </select>
                </div>

                <div class="form-group-custom">
                    <label for="qty">Qty</label>
                    <input type="number" id="qty" name="qty" min="1" value="1">
                </div>

                <div class="form-group-custom">
                    <label for="harga_satuan">Harga Satuan (Rp)</label>
                    <input type="number" id="harga_satuan" name="harga_satuan" min="0" step="100"
                        value="0">
                </div>

                <div class="form-group-custom">
                    <label for="nominal">Nominal (Rp)</label>
                    <input type="hidden" id="nominal" name="nominal" min="0" step="1" required>
                    <input type="text" id="nominal_display" class="form-control" placeholder="Nominal" readonly
                        style="background: rgba(34, 197, 94, 0.08); border-color: rgba(34, 197, 94, 0.2);">
                </div>

                <div class="form-group-custom">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" id="tanggal" name="tanggal" value="{{ date('Y-m-d') }}" required>
                </div>

                <div class="form-group-custom">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea id="deskripsi" name="deskripsi" rows="1" placeholder="Keterangan tambahan (opsional)"></textarea>
                </div>
            </div>

            <button type="submit" class="btn-modern btn-primary-modern">
                <i class="ri-save-line"></i> Simpan Transaksi
            </button>
        </form>
    </div>

    <!-- TABEL RIWAYAT TRANSAKSI -->
    <div class="card-glass" style="padding:0;">
        <div style="padding:20px 30px; border-bottom:1px solid rgba(122,92,219,0.08);">
            <h3 style="margin:0; font-size:18px; font-weight:600; color:#2d2d2d;"><i class="fas fa-history"
                    style="color:#7c5cdb;"></i> Riwayat Transaksi</h3>
        </div>

        @if ($transaksi->count() > 0)
            <div class="table-wrapper">
                <table class="table-modern">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tipe</th>
                            <th>Kategori</th>
                            <th>Qty</th>
                            <th>Nominal</th>
                            <th>Tanggal</th>
                            <th>Deskripsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaksi as $t)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @if ($t->tipe === 'pemasukan')
                                        <span class="badge-custom"
                                            style="background:rgba(3,105,161,0.07); color:#0369a1;">Pemasukan</span>
                                    @else
                                        <span class="badge-custom"
                                            style="background:rgba(220,38,38,0.06); color:#dc2626;">Pengeluaran</span>
                                    @endif
                                </td>
                                <td>{{ $t->kategori }}</td>
                                <td>{{ $t->qty }}</td>
                                <td style="font-weight:600; color:#7c5cdb;">Rp {{ number_format($t->nominal, 0, ',', '.') }}
                                </td>
                                <td>{{ \Carbon\Carbon::parse($t->tanggal)->format('d M Y') }}</td>
                                <td>{{ $t->deskripsi ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-inbox"></i>
                <p>Belum ada transaksi</p>
                <p style="font-size:12px; color:#b8a5d1;">Gunakan form di atas untuk menambahkan pemasukan atau pengeluaran
                </p>
            </div>
        @endif
    </div>

@endsection

@push('scripts')
    <script>
        // Daftar kategori per tipe
        const pemasukanCategories = [{
                value: 'kue-pia',
                label: 'Kue Pia',
                price: 30000
            },
            {
                value: 'kue-kacang',
                label: 'Kue Kacang',
                price: 30000
            },
            {
                value: 'nastar',
                label: 'Nastar',
                price: 30000
            },
        ];

        // Daftar kategori pengeluaran dari DB (bahan) + operasional tetap
        const bahanCategories = @json(($barangs ?? collect())->map(fn($b) => ['value' => $b->nama_barang, 'label' => $b->nama_barang])->values());
        const operasionalCategories = [{
                value: 'gas-lpg',
                label: 'Gas LPG'
            },
            {
                value: 'bensin',
                label: 'Bensin'
            },
            {
                value: 'operasional-lain',
                label: 'Operasional Lain-lain'
            },
        ];

        const pengeluaranCategories = [...bahanCategories, ...operasionalCategories];

        const tipeSelect = document.getElementById('tipe');
        const kategoriSelect = document.getElementById('kategori');
        const qtyInput = document.getElementById('qty');
        const hargaInput = document.getElementById('harga_satuan');
        const nominalInput = document.getElementById('nominal');
        const nominalDisplay = document.getElementById('nominal_display');

        function populateKategori() {
            const tipe = tipeSelect.value;
            kategoriSelect.innerHTML = '<option value="">-- Pilih Kategori --</option>';

            const source = tipe === 'pengeluaran' ? pengeluaranCategories : pemasukanCategories;
            source.forEach(item => {
                const opt = document.createElement('option');
                opt.value = item.value;
                opt.textContent = item.label;
                kategoriSelect.appendChild(opt);
            });

            const autoNominal = true; // nominal selalu auto dari harga_satuan × qty
            nominalInput.readOnly = autoNominal;
            hargaInput.readOnly = (tipe === 'pemasukan');
            hargaInput.value = tipe === 'pengeluaran' ? 0 : '';
            nominalInput.value = '';
            nominalDisplay.value = '';
            updateNominal();
        }

        function updateNominal() {
            const tipe = tipeSelect.value;
            const qty = parseInt(qtyInput.value, 10) || 0;
            let price = 0;

            if (tipe === 'pemasukan') {
                const selected = pemasukanCategories.find(c => c.value === kategoriSelect.value);
                price = selected ? selected.price : 0;
                hargaInput.value = price;
            } else {
                price = parseFloat(hargaInput.value) || 0;
            }

            const nominal = price * qty;
            nominalInput.value = Math.round(nominal);
            nominalDisplay.value = formatRupiah(Math.round(nominal));
        }

        function validateBeforeSubmit(event) {
            const tipe = tipeSelect.value;
            const price = parseFloat(hargaInput.value) || 0;

            if (tipe === 'pengeluaran' && price <= 0) {
                event.preventDefault();
                alert('Harga satuan pengeluaran wajib diisi dan lebih dari 0');
                hargaInput.focus();
            }
        }

        function formatRupiah(angka) {
            const numberString = (angka || 0).toString();
            return 'Rp ' + numberString.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }

        // Event listeners
        tipeSelect.addEventListener('change', populateKategori);
        kategoriSelect.addEventListener('change', updateNominal);
        qtyInput.addEventListener('input', updateNominal);
        hargaInput.addEventListener('input', updateNominal);

        document.querySelector('form').addEventListener('submit', validateBeforeSubmit);

        // Init on load setelah DOM siap
        document.addEventListener('DOMContentLoaded', () => {
            populateKategori();
        });
    </script>
@endpush
