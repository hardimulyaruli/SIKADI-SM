<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    use HasFactory;

    // Mengikuti nama tabel pada migrasi
    protected $table = 'pengeluarans';
    protected $primaryKey = 'pengeluaran_id'; // Penting: sesuai migrasi Anda

    protected $fillable = [
        'user_id',
        'jumlah',
        'tanggal_pengeluaran',
        'keperluan',
        'keterangan',
    ];

    // Relasi ke User (Diasumsikan model User standar Laravel)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
