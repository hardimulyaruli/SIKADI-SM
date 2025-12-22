<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Barang;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['nama_barang' => 'Terigu', 'satuan' => 'kg', 'keterangan' => 'Bahan utama'],
            ['nama_barang' => 'Telur', 'satuan' => 'butir', 'keterangan' => 'Bahan utama'],
            ['nama_barang' => 'Gula Pasir', 'satuan' => 'kg', 'keterangan' => 'Bahan utama'],
            ['nama_barang' => 'Margarin', 'satuan' => 'kg', 'keterangan' => 'Bahan tambahan'],
            ['nama_barang' => 'Susu Bubuk', 'satuan' => 'kg', 'keterangan' => 'Bahan tambahan'],
            ['nama_barang' => 'Cokelat Bubuk', 'satuan' => 'kg', 'keterangan' => 'Bahan tambahan'],
            ['nama_barang' => 'Keju', 'satuan' => 'kg', 'keterangan' => 'Topping'],
            ['nama_barang' => 'Gas LPG', 'satuan' => 'tabung', 'keterangan' => 'Operasional dapur'],
            ['nama_barang' => 'Plastik Kemasan', 'satuan' => 'pack', 'keterangan' => 'Bahan kemas'],
        ];

        foreach ($items as $item) {
            Barang::updateOrCreate(
                ['nama_barang' => $item['nama_barang']],
                ['satuan' => $item['satuan'], 'keterangan' => $item['keterangan']]
            );
        }
    }
}
