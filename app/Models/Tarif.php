<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarif extends Model
{
    protected $table = 'tarif';

    protected $fillable = [
        'jenis',
        'tarif_per_jam',
    ];

    protected $casts = [
        'tarif_per_jam' => 'decimal:0',
    ];
}