
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Hapus trigger lama
        DB::unprepared("
            DROP TRIGGER IF EXISTS hitung_parkir_keluar
        ");

        // Buat trigger baru
        DB::unprepared("
            CREATE TRIGGER hitung_parkir_keluar
            BEFORE UPDATE ON parkir
            FOR EACH ROW
            BEGIN
                DECLARE v_jenis VARCHAR(255) DEFAULT 'lainnya';
                DECLARE v_tarif DECIMAL(12,2) DEFAULT 0;

                IF OLD.status = 'masuk'
                   AND NEW.status = 'keluar' THEN

                    -- Mengisi waktu keluar otomatis
                    SET NEW.jam_keluar =
                        COALESCE(
                            NEW.jam_keluar,
                            CURRENT_TIMESTAMP
                        );

                    -- Mengambil jenis kendaraan
                    SET v_jenis = COALESCE(
                        (
                            SELECT LOWER(jenis)
                            FROM kendaraan
                            WHERE id = NEW.kendaraan_id
                            LIMIT 1
                        ),
                        'lainnya'
                    );

                    -- Menyesuaikan kategori kendaraan
                    SET v_jenis = CASE
                        WHEN v_jenis = 'motor' THEN 'motor'
                        WHEN v_jenis = 'mobil' THEN 'mobil'
                        ELSE 'lainnya'
                    END;

                    -- Mengambil tarif sesuai jenis kendaraan
                    -- ID terbaru dipilih untuk kategori lainnya
                    SET v_tarif = COALESCE(
                        (
                            SELECT tarif_per_jam
                            FROM tarif
                            WHERE LOWER(jenis) = v_jenis
                            ORDER BY id DESC
                            LIMIT 1
                        ),
                        0
                    );

                    -- Menghitung durasi parkir
                    -- Minimal 1 jam, dibulatkan ke atas
                    SET NEW.durasi = GREATEST(
                        1,
                        CEIL(
                            GREATEST(
                                0,
                                TIMESTAMPDIFF(
                                    MINUTE,
                                    NEW.jam_masuk,
                                    NEW.jam_keluar
                                )
                            ) / 60
                        )
                    );

                    -- Menghitung total pembayaran
                    SET NEW.total_bayar =
                        NEW.durasi * v_tarif;

                END IF;
            END
        ");
    }

    public function down(): void
    {
        DB::unprepared("
            DROP TRIGGER IF EXISTS hitung_parkir_keluar
        ");
    }
};
