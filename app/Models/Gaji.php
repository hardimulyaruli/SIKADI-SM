<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{
    protected $table = 'gaji';

    protected $fillable = [
        'pengguna_id', 'jumlah_gaji', 'tanggal', 'keterangan'
    ];

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class);
    }
}
