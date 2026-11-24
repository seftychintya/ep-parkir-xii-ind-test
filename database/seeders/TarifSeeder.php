<?php

namespace Database\Seeders;

use App\Models\Tarif;
use Illuminate\Database\Seeder;

class TarifSeeder extends Seeder
{
    public function run(): void
    {
        Tarif::create([
            'jenis' => 'motor',
            'tarif_per_jam' => 2000,
        ]);

        Tarif::create([
            'jenis' => 'mobil',
            'tarif_per_jam' => 5000,
        ]);
    }
}
