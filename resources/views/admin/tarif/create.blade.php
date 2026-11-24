<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tambah Tarif - Sistem Parkir</title>

    <style>
        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            min-height: 100%;
            background: #06100b !important;
            color: white !important;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            min-height: 100vh;
        }

        .page {
            min-height: 100vh;
            padding: 35px;
            background: #06100b !important;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
        }

        .header {
            margin-bottom: 25px;
        }

        .title {
            margin: 0;
            font-size: 32px;
            color: white;
        }

        .subtitle {
            margin-top: 8px;
            color: #86efac;
        }

        .card {
            background: #0b1912 !important;
            border: 1px solid #14532d;
            border-radius: 18px;
            padding: 30px;

            box-shadow:
                0 20px 50px rgba(0, 0, 0, .45);
        }

        .form-group {
            margin-bottom: 22px;
        }

        label {
            display: block;
            margin-bottom: 8px;

            color: #dcfce7;
            font-size: 14px;
            font-weight: bold;
        }

        input,
        select {
            width: 100%;
            padding: 13px 15px;

            border-radius: 10px;

            border: 1px solid #14532d !important;

            background: #06100b !important;
            color: white !important;

            outline: none;

            font-size: 15px;
        }

        input:focus,
        select:focus {
            border-color: #22c55e !important;

            box-shadow:
                0 0 0 3px rgba(34, 197, 94, .15);
        }

        select option {
            background: #0b1912;
            color: white;
        }

        .error {
            margin-top: 7px;
            color: #fca5a5;
            font-size: 13px;
        }

        .buttons {
            display: flex;
            gap: 12px;
            margin-top: 30px;
        }

        .btn {
            display: inline-block;

            padding: 13px 20px;

            border-radius: 10px;

            border: none;

            text-decoration: none;

            font-size: 14px;
            font-weight: bold;

            cursor: pointer;
        }

        .btn-save {
            background: #16a34a;
            color: white;
        }

        .btn-save:hover {
            background: #15803d;
        }

        .btn-back {
            background: #14532d;
            color: #bbf7d0;
        }

        .btn-back:hover {
            background: #166534;
            color: white;
        }

        .info {
            margin-top: 20px;

            padding: 15px;

            border-radius: 10px;

            background: #052e16 !important;
            border: 1px solid #166534;

            color: #bbf7d0;

            font-size: 13px;
            line-height: 1.6;
        }

        @media (max-width: 768px) {

            .page {
                padding: 20px;
            }

            .card {
                padding: 20px;
            }

            .buttons {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>

<body>

<div class="page">

    <div class="container">

        <!-- HEADER -->
        <div class="header">

            <h1 class="title">
                💰 Tambah Tarif Parkir
            </h1>

            <div class="subtitle">
                Tambahkan tarif parkir berdasarkan jenis kendaraan.
            </div>

        </div>


        <!-- CARD -->
        <div class="card">

            <form
                action="{{ route('admin.tarif.store') }}"
                method="POST"
            >

                @csrf


                <!-- JENIS KENDARAAN -->
                <div class="form-group">

                    <label for="jenis">
                        Jenis Kendaraan
                    </label>

                    <select
                        name="jenis"
                        id="jenis"
                        required
                    >

                        <option value="">
                            -- Pilih Jenis Kendaraan --
                        </option>

                        <option
                            value="motor"
                            {{ old('jenis') == 'motor' ? 'selected' : '' }}
                        >
                            Motor
                        </option>

                        <option
                            value="mobil"
                            {{ old('jenis') == 'mobil' ? 'selected' : '' }}
                        >
                            Mobil
                        </option>

                        <option
                            value="lainnya"
                            {{ old('jenis') == 'lainnya' ? 'selected' : '' }}
                        >
                            Lainnya
                        </option>

                    </select>

                    @error('jenis')
                        <div class="error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <!-- TARIF -->
                <div class="form-group">

                    <label for="tarif_per_jam">
                        Tarif Parkir per Jam
                    </label>

                    <input
                        type="number"
                        name="tarif_per_jam"
                        id="tarif_per_jam"
                        value="{{ old('tarif_per_jam') }}"
                        min="0"
                        placeholder="Contoh: 2000"
                        required
                    >

                    @error('tarif_per_jam')
                        <div class="error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <!-- INFO -->
                <div class="info">
                    💡 Masukkan tarif dalam Rupiah per jam.
                    <br>
                    Contoh: <strong>2000</strong> untuk tarif Rp 2.000/jam.
                </div>


                <!-- BUTTON -->
                <div class="buttons">

                    <button
                        type="submit"
                        class="btn btn-save"
                    >
                        💾 Simpan Tarif
                    </button>

                    <a
                        href="{{ route('admin.tarif.index') }}"
                        class="btn btn-back"
                    >
                        ← Kembali
                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

</body>
</html>