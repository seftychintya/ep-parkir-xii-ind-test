<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        /*
        |--------------------------------------------------------------------------
        | USER
        |--------------------------------------------------------------------------
        */
        Schema::create('parkir_tb_user', function (Blueprint $table) {
            $table->increments('id_user');
            $table->string('nama_lengkap', 50);
            $table->string('username', 50)->unique();
            $table->string('password', 100);
            $table->enum('role', [
                'admin',
                'petugas',
                'owner'
            ]);
            $table->boolean('status_aktif')->default(true);
        });


        /*
        |--------------------------------------------------------------------------
        | TARIF
        |--------------------------------------------------------------------------
        */
        Schema::create('parkir_tb_tarif', function (Blueprint $table) {
            $table->increments('id_tarif');

            $table->enum('jenis_kendaraan', [
                'motor',
                'mobil',
                'lainnya'
            ]);

            $table->decimal('tarif_per_jam', 10, 0);
        });


        /*
        |--------------------------------------------------------------------------
        | AREA PARKIR
        |--------------------------------------------------------------------------
        */
        Schema::create('parkir_tb_area_parkir', function (Blueprint $table) {
            $table->increments('id_area');
            $table->string('nama_area', 50);
            $table->unsignedInteger('kapasitas');
            $table->unsignedInteger('terisi')->default(0);
        });


        /*
        |--------------------------------------------------------------------------
        | KENDARAAN
        |--------------------------------------------------------------------------
        */
        Schema::create('parkir_tb_kendaraan', function (Blueprint $table) {
            $table->increments('id_kendaraan');
            $table->string('plat_nomor', 15)->unique();
            $table->string('jenis_kendaraan', 20);
            $table->string('warna', 20);
            $table->string('pemilik', 100);

            $table->unsignedInteger('id_user');

            $table->foreign('id_user')
                ->references('id_user')
                ->on('parkir_tb_user')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
        });


        /*
        |--------------------------------------------------------------------------
        | TRANSAKSI
        |--------------------------------------------------------------------------
        */
        Schema::create('parkir_tb_transaksi', function (Blueprint $table) {
            $table->increments('id_parkir');

            $table->unsignedInteger('id_kendaraan');

            $table->dateTime('waktu_masuk');
            $table->dateTime('waktu_keluar')->nullable();

            $table->unsignedInteger('id_tarif');

            $table->unsignedInteger('durasi_jam')->nullable();

            $table->decimal('biaya_total', 10, 0)->default(0);

            $table->enum('status', [
                'masuk',
                'keluar'
            ])->default('masuk');

            $table->unsignedInteger('id_user');
            $table->unsignedInteger('id_area');

            $table->foreign('id_kendaraan')
                ->references('id_kendaraan')
                ->on('parkir_tb_kendaraan')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreign('id_tarif')
                ->references('id_tarif')
                ->on('parkir_tb_tarif')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreign('id_user')
                ->references('id_user')
                ->on('parkir_tb_user')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreign('id_area')
                ->references('id_area')
                ->on('parkir_tb_area_parkir')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
        });


        /*
        |--------------------------------------------------------------------------
        | LOG AKTIVITAS
        |--------------------------------------------------------------------------
        */
        Schema::create('parkir_tb_log_aktifitas', function (Blueprint $table) {
            $table->increments('id_log');

            $table->unsignedInteger('id_user');

            $table->string('aktivitas', 100);

            $table->dateTime('waktu_aktivitas');

            $table->foreign('id_user')
                ->references('id_user')
                ->on('parkir_tb_user')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('parkir_tb_log_aktifitas');
        Schema::dropIfExists('parkir_tb_transaksi');
        Schema::dropIfExists('parkir_tb_kendaraan');
        Schema::dropIfExists('parkir_tb_area_parkir');
        Schema::dropIfExists('parkir_tb_tarif');
        Schema::dropIfExists('parkir_tb_user');
    }
};