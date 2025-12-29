<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Barang;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['nama_barang' => 'Terigu', 'satuan' => 'karung', 'keterangan' => 'Bahan baku utama'],
            ['nama_barang' => 'Gula', 'satuan' => 'karung', 'keterangan' => 'Bahan baku utama'],
            ['nama_barang' => 'Minyak', 'satuan' => 'kg', 'keterangan' => 'Bahan pendukung'],
            ['nama_barang' => 'Margarin', 'satuan' => 'dus', 'keterangan' => 'Bahan pendukung'],
            ['nama_barang' => 'Kacang Hijau', 'satuan' => 'karung', 'keterangan' => 'Bahan isi'],
            ['nama_barang' => 'Toples', 'satuan' => 'lusin', 'keterangan' => 'Kemasan'],
            ['nama_barang' => 'Telor', 'satuan' => 'kg', 'keterangan' => 'Bahan baku utama'],
            ['nama_barang' => 'Vaneli Cair', 'satuan' => 'lusin', 'keterangan' => 'Perisa'],
            ['nama_barang' => 'Pewarna Makanan', 'satuan' => 'lusin', 'keterangan' => 'Perisa'],
            ['nama_barang' => 'Kacang Tanah', 'satuan' => 'kg', 'keterangan' => 'Bahan isi'],
        ];

        foreach ($items as $item) {
            Barang::updateOrCreate(
                ['nama_barang' => $item['nama_barang']],
                ['satuan' => $item['satuan'], 'keterangan' => $item['keterangan']]
            );
        }
    }
}
