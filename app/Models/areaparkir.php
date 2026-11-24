<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AreaParkir extends Model
{
    protected $table = 'area_parkir';

    protected $fillable = [
        'nama_area',
        'kapasitas',
        'terisi',
        'status',
    ];

    protected $casts = [
        'kapasitas' => 'integer',
        'terisi' => 'integer',
    ];
}