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
        'nominal',
        'tanggal',
        'deskripsi'
    ];
}
