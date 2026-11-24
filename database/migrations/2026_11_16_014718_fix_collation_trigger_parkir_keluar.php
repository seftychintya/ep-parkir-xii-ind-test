
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::unprepared("DROP TRIGGER IF EXISTS hitung_parkir_keluar");

        DB::unprepared(<<<'SQL'
CREATE TRIGGER hitung_parkir_keluar
BEFORE UPDATE ON parkir
FOR EACH ROW
BEGIN
    DECLARE v_jenis VARCHAR(255)
        CHARACTER SET utf8mb4
        COLLATE utf8mb4_0900_ai_ci
        DEFAULT 'lainnya';

    DECLARE v_tarif DECIMAL(12,2) DEFAULT 0;

    IF OLD.status = 'masuk'
       AND NEW.status = 'keluar' THEN

        SET NEW.jam_keluar = COALESCE(
            NEW.jam_keluar,
            CURRENT_TIMESTAMP
        );

        SET v_jenis = COALESCE(
            (
                SELECT LOWER(jenis) COLLATE utf8mb4_0900_ai_ci
                FROM kendaraan
                WHERE id = NEW.kendaraan_id
                LIMIT 1
            ),
            'lainnya'
        );

        SET v_jenis = CASE
            WHEN v_jenis = 'motor' THEN 'motor'
            WHEN v_jenis = 'mobil' THEN 'mobil'
            ELSE 'lainnya'
        END;

        SET v_tarif = COALESCE(
            (
                SELECT tarif_per_jam
                FROM tarif
                WHERE LOWER(jenis) COLLATE utf8mb4_0900_ai_ci
                    = v_jenis COLLATE utf8mb4_0900_ai_ci
                ORDER BY id DESC
                LIMIT 1
            ),
            0
        );

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

        SET NEW.total_bayar = NEW.durasi * v_tarif;

    END IF;
END
SQL);
    }

    public function down(): void
    {
        DB::unprepared("DROP TRIGGER IF EXISTS hitung_parkir_keluar");
    }
};
