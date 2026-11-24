<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parkir extends Model
{
    protected $table = 'parkir';

    protected $fillable = [
        'kendaraan_id',
        'kode_tiket',
        'slot',
        'jam_masuk',
        'jam_keluar',
        'durasi',
        'total_bayar',
        'status',
    ];

    protected $casts = [
        'jam_masuk' => 'datetime',
        'jam_keluar' => 'datetime',
        'total_bayar' => 'decimal:0',
    ];

    /**
     * Relasi ke kendaraan
     */
    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class, 'kendaraan_id');
    }
}