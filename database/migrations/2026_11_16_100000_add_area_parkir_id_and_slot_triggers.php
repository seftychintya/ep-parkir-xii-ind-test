<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Hubungkan transaksi parkir dengan area parkir.
        Schema::table('parkir', function (Blueprint $table) {
            $table->unsignedBigInteger('area_parkir_id')
                ->nullable()
                ->after('kendaraan_id');

            $table->foreign('area_parkir_id')
                ->references('id')
                ->on('area_parkir')
                ->restrictOnDelete()
                ->cascadeOnUpdate();
        });

        // Semua transaksi parkir yang dikirim sebelumnya
        // berstatus keluar, jadi jumlah kendaraan aktif = 0.
        DB::table('area_parkir')->update([
            'terisi' => 0,
            'updated_at' => now(),
        ]);

        // Hapus trigger slot jika migration dibuat ulang.
        DB::unprepared('DROP TRIGGER IF EXISTS trg_parkir_area_after_insert');
        DB::unprepared('DROP TRIGGER IF EXISTS trg_parkir_area_after_update');
        DB::unprepared('DROP TRIGGER IF EXISTS trg_parkir_area_after_delete');

        // TRIGGER KENDARAAN MASUK.
        DB::unprepared("
            CREATE TRIGGER trg_parkir_area_after_insert
            AFTER INSERT ON parkir
            FOR EACH ROW
            BEGIN
                DECLARE v_rows INT DEFAULT 0;

                IF NEW.status = 'masuk' THEN

                    IF NEW.area_parkir_id IS NULL THEN
                        SIGNAL SQLSTATE '45000'
                        SET MESSAGE_TEXT = 'AREA_PARKIR_WAJIB_DIPILIH';
                    END IF;

                    UPDATE area_parkir
                    SET
                        terisi = terisi + 1,
                        updated_at = NOW()
                    WHERE id = NEW.area_parkir_id
                      AND status = 'aktif'
                      AND terisi < kapasitas;

                    SET v_rows = ROW_COUNT();

                    IF v_rows = 0 THEN
                        SIGNAL SQLSTATE '45000'
                        SET MESSAGE_TEXT = 'KAPASITAS_AREA_PENUH';
                    END IF;

                END IF;
            END
        ");

        // TRIGGER PERUBAHAN STATUS DAN AREA.
        DB::unprepared("
            CREATE TRIGGER trg_parkir_area_after_update
            AFTER UPDATE ON parkir
            FOR EACH ROW
            BEGIN
                DECLARE v_rows INT DEFAULT 0;

                -- Kendaraan keluar.
                IF OLD.status = 'masuk'
                   AND NEW.status = 'keluar' THEN

                    IF OLD.area_parkir_id IS NOT NULL THEN
                        UPDATE area_parkir
                        SET
                            terisi = GREATEST(terisi - 1, 0),
                            updated_at = NOW()
                        WHERE id = OLD.area_parkir_id;
                    END IF;

                -- Kendaraan masuk kembali.
                ELSEIF OLD.status = 'keluar'
                   AND NEW.status = 'masuk' THEN

                    IF NEW.area_parkir_id IS NULL THEN
                        SIGNAL SQLSTATE '45000'
                        SET MESSAGE_TEXT = 'AREA_PARKIR_WAJIB_DIPILIH';
                    END IF;

                    UPDATE area_parkir
                    SET
                        terisi = terisi + 1,
                        updated_at = NOW()
                    WHERE id = NEW.area_parkir_id
                      AND status = 'aktif'
                      AND terisi < kapasitas;

                    SET v_rows = ROW_COUNT();

                    IF v_rows = 0 THEN
                        SIGNAL SQLSTATE '45000'
                        SET MESSAGE_TEXT = 'KAPASITAS_AREA_PENUH';
                    END IF;

                -- Kendaraan aktif dipindahkan ke area lain.
                ELSEIF OLD.status = 'masuk'
                   AND NEW.status = 'masuk'
                   AND NOT (OLD.area_parkir_id <=> NEW.area_parkir_id) THEN

                    IF NEW.area_parkir_id IS NULL THEN
                        SIGNAL SQLSTATE '45000'
                        SET MESSAGE_TEXT = 'AREA_PARKIR_WAJIB_DIPILIH';
                    END IF;

                    UPDATE area_parkir
                    SET
                        terisi = terisi + 1,
                        updated_at = NOW()
                    WHERE id = NEW.area_parkir_id
                      AND status = 'aktif'
                      AND terisi < kapasitas;

                    SET v_rows = ROW_COUNT();

                    IF v_rows = 0 THEN
                        SIGNAL SQLSTATE '45000'
                        SET MESSAGE_TEXT = 'KAPASITAS_AREA_PENUH';
                    END IF;

                    IF OLD.area_parkir_id IS NOT NULL THEN
                        UPDATE area_parkir
                        SET
                            terisi = GREATEST(terisi - 1, 0),
                            updated_at = NOW()
                        WHERE id = OLD.area_parkir_id;
                    END IF;

                END IF;
            END
        ");

        // TRIGGER JIKA TRANSAKSI AKTIF DIHAPUS.
        DB::unprepared("
            CREATE TRIGGER trg_parkir_area_after_delete
            AFTER DELETE ON parkir
            FOR EACH ROW
            BEGIN
                IF OLD.status = 'masuk'
                   AND OLD.area_parkir_id IS NOT NULL THEN

                    UPDATE area_parkir
                    SET
                        terisi = GREATEST(terisi - 1, 0),
                        updated_at = NOW()
                    WHERE id = OLD.area_parkir_id;

                END IF;
            END
        ");
    }

    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS trg_parkir_area_after_insert');
        DB::unprepared('DROP TRIGGER IF EXISTS trg_parkir_area_after_update');
        DB::unprepared('DROP TRIGGER IF EXISTS trg_parkir_area_after_delete');

        Schema::table('parkir', function (Blueprint $table) {
            $table->dropForeign(['area_parkir_id']);
            $table->dropColumn('area_parkir_id');
        });
    }
};