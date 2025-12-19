@extends('layouts.sidebar')

@section('content')

<style>
    .gradient-box {
        background: linear-gradient(135deg, #6a4ff7, #9656e3, #b56ad8);
        padding: 30px;
        border-radius: 20px;
        color: white;
    }

    .inner-box {
        background: linear-gradient(135deg, #8b66e8, #a26de0, #b678d8);
        border-radius: 15px;
        padding: 25px;
    }

    .white-box {
        background: #fff;
        color: #000;
        border-radius: 10px;
        padding: 20px;
    }

    .form-control {
        background: rgba(255,255,255,0.25);
        border: none;
        color: white;
    }

    .form-control::placeholder {
        color: #eee;
    }

    .input-modern {
        background: rgba(255,255,255,0.25);
        border: none;
        color: white;
        padding: 10px 15px;
        border-radius: 8px;
        width: 100%;
    }

    .input-modern::placeholder {
        color: #eee;
    }

    .btn-modern {
        padding: 10px 20px;
        border-radius: 8px;
        border: none;
        font-weight: bold;
        cursor: pointer;
    }

    .btn-primary-modern {
        background: #4CAF50;
        color: white;
    }

    .btn-primary-modern:hover {
        background: #45a049;
    }

    .loading {
        display: none;
        text-align: center;
        padding: 20px;
    }

    .error-message {
        color: #ff6b6b;
        display: none;
        padding: 10px;
        margin-top: 10px;
    }
</style>

<div class="gradient-box">
    <h2><b>📊 Laporan Keuangan</b></h2>
    <p>Ringkasan keseluruhan pemasukan, pengeluaran, dan transaksi lainnya.</p>

    <!-- FILTER -->
    <div class="inner-box mt-4">
        <h4>🔎 Filter Laporan</h4>

        <div class="row mt-3">
            <div class="col-md-4">
                <select class="input-modern" id="jenis_laporan">
                    <option value="">Pilih Jenis Laporan</option>
                    <option value="bulanan">Bulanan</option>
                    <option value="tahunan">Tahunan</option>
                    <option value="pinjaman">Laporan Pinjaman</option>
                </select>
            </div>

            <div class="col-md-4">
                <input type="month" class="input-modern" id="bulan_filter" placeholder="Pilih Bulan">
            </div>

            <div class="col-md-4">
                <button class="btn-modern btn-primary-modern w-100" id="btn_tampilkan">Tampilkan</button>
            </div>
        </div>

        <div class="error-message" id="error_message"></div>
    </div>

    <!-- RESULT BOX -->
    <div class="inner-box mt-4">
        <h4>📄 Hasil Laporan</h4>

        <div class="loading" id="loading">
            <p>Memuat data...</p>
        </div>

        <div class="white-box mt-3" style="height: 220px; overflow:auto;" id="result_box">
            <p><b>Pemasukan:</b> <span id="pemasukan_value">Rp 0</span></p>
            <p><b>Pengeluaran:</b> <span id="pengeluaran_value">Rp 0</span></p>
            <p><b>Total Pinjaman:</b> <span id="pinjaman_value">Rp 0</span></p>
            <hr>
            <p><b>Sisa Saldo:</b> <span id="saldo_value">Rp 0</span></p>
        </div>
    </div>

</div>

<script>
    // Format Rupiah
    function formatRupiah(value) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR'
        }).format(value);
    }

    // Button click handler
    document.getElementById('btn_tampilkan').addEventListener('click', function() {
        const jenis = document.getElementById('jenis_laporan').value;
        const bulan = document.getElementById('bulan_filter').value;
        const errorMsg = document.getElementById('error_message');
        const loading = document.getElementById('loading');

        // Validasi
        errorMsg.style.display = 'none';
        if (!jenis) {
            errorMsg.textContent = 'Silakan pilih jenis laporan';
            errorMsg.style.display = 'block';
            return;
        }

        if (jenis !== 'pinjaman' && !bulan) {
            errorMsg.textContent = 'Silakan pilih bulan';
            errorMsg.style.display = 'block';
            return;
        }

        // Show loading
        loading.style.display = 'block';

        // Fetch data
        fetch('{{ route("keuangan.laporan.filter") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                jenis_laporan: jenis,
                bulan: bulan
            })
        })
        .then(response => {
            // Check if response is ok
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.text(); // Get text first to debug
        })
        .then(text => {
            // Try to parse JSON
            try {
                const data = JSON.parse(text);
                loading.style.display = 'none';
                
                if (data.success) {
                    const result = data.data;

                    if (result.jenis === 'pinjaman') {
                        document.getElementById('pemasukan_value').textContent = formatRupiah(0);
                        document.getElementById('pengeluaran_value').textContent = formatRupiah(0);
                        document.getElementById('pinjaman_value').textContent = formatRupiah(result.pinjaman || 0);
                        document.getElementById('saldo_value').textContent = formatRupiah(result.saldo || 0);
                    } else {
                        document.getElementById('pemasukan_value').textContent = formatRupiah(result.pemasukan || 0);
                        document.getElementById('pengeluaran_value').textContent = formatRupiah(result.pengeluaran || 0);
                        document.getElementById('pinjaman_value').textContent = formatRupiah(0);
                        document.getElementById('saldo_value').textContent = formatRupiah(result.saldo || 0);
                    }
                } else {
                    errorMsg.textContent = data.message || 'Terjadi kesalahan';
                    errorMsg.style.display = 'block';
                }
            } catch (e) {
                loading.style.display = 'none';
                console.error('JSON Parse Error:', e);
                console.error('Response text:', text);
                errorMsg.textContent = 'Error: Response bukan JSON. Cek console untuk detail.';
                errorMsg.style.display = 'block';
            }
        })
        .catch(error => {
            loading.style.display = 'none';
            console.error('Fetch Error:', error);
            errorMsg.textContent = 'Error: ' + error.message;
            errorMsg.style.display = 'block';
        });
    });

    // Clear bulan input if pinjaman is selected
    document.getElementById('jenis_laporan').addEventListener('change', function() {
        if (this.value === 'pinjaman') {
            document.getElementById('bulan_filter').style.display = 'none';
        } else {
            document.getElementById('bulan_filter').style.display = 'block';
        }
    });
</script>

@endsection
