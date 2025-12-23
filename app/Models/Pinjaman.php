<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pinjaman extends Model
{
    protected $table = 'pinjaman';

    // Gunakan primary key kustom sesuai migrasi
    protected $primaryKey = 'pinjaman_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'jumlah_pinjaman',
        'tanggal',
        'status',
        'keterangan',
        'karyawan_id'
    ];
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'karyawan_id');
    }
}
