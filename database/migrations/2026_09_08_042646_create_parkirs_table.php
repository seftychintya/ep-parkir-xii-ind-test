<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('parkir', function (Blueprint $table) {
            $table->id();

            $table->foreignId('kendaraan_id')
                  ->constrained('kendaraan')
                  ->cascadeOnDelete();

            $table->string('kode_tiket')->unique();

            $table->string('slot');

            $table->dateTime('jam_masuk');

            $table->dateTime('jam_keluar')->nullable();

            $table->integer('durasi')->nullable();

            $table->decimal('total_bayar', 12, 0)
                  ->default(0);

            $table->enum('status', [
                'masuk',
                'keluar'
            ])->default('masuk');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('parkir');
    }
};