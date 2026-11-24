<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tarif', function (Blueprint $table) {
            $table->id();

            $table->string('jenis');

            $table->decimal('tarif_per_jam', 12, 0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tarif');
    }
};