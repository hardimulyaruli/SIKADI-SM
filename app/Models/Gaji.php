<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{
    protected $table = 'gaji';

    protected $primaryKey = 'gaji_id';

    protected $fillable = [
        'karyawan_id', 'jumlah_gaji', 'tanggal', 'keterangan'
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'karyawan_id');
    }
}
