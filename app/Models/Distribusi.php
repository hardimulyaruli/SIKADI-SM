<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Distribusi extends Model
{
    protected $table = 'distribusi';

    protected $fillable = [
        'pengguna_id',
        'toko_tujuan',
        'jumlah_produk',
        'tanggal',
        'status',
        'catatan',
    ];
}
