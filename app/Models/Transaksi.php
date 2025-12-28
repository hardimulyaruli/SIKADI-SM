<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi'; // <-- WAJIB supaya tidak mencari 'transaksis'

    protected $fillable = [
        'tipe',
        'kategori',
        'qty',
        'harga_satuan',
        'nominal',
        'tanggal',
        'deskripsi'
    ];

    protected $appends = [
        'jumlah',
        'tanggal_pengeluaran',
        'keperluan',
        'keterangan',
    ];

    // Kompatibilitas dengan form pengeluaran
    public function getJumlahAttribute()
    {
        return $this->nominal;
    }

    public function getTanggalPengeluaranAttribute()
    {
        return $this->tanggal;
    }

    public function getKeperluanAttribute()
    {
        return $this->kategori;
    }

    public function getKeteranganAttribute()
    {
        return $this->deskripsi;
    }
}
