<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tambah Kendaraan - Sistem Parkir</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #06100b;
            color: white;
            min-height: 100vh;
        }

        .container {
            max-width: 850px;
            margin: auto;
            padding: 40px 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        h1 {
            margin: 0;
            font-size: 28px;
        }

        .subtitle {
            color: #86efac;
            margin-top: 8px;
        }

        .back {
            text-decoration: none;
            color: #bbf7d0;
            border: 1px solid #166534;
            padding: 10px 16px;
            border-radius: 10px;
        }

        .back:hover {
            background: #14532d;
            color: white;
        }

        .card {
            background: #0b1912;
            border: 1px solid #14532d;
            border-radius: 18px;
            padding: 30px;
            box-shadow: 0 15px 40px rgba(0,0,0,.35);
        }

        .form-group {
            margin-bottom: 22px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #bbf7d0;
            font-weight: bold;
        }

        input,
        select {
            width: 100%;
            padding: 13px 15px;
            background: #06100b;
            color: white;
            border: 1px solid #166534;
            border-radius: 10px;
            outline: none;
            font-size: 15px;
        }

        input:focus,
        select:focus {
            border-color: #22c55e;
            box-shadow: 0 0 0 3px rgba(34,197,94,.12);
        }

        select option {
            background: #0b1912;
            color: white;
        }

        .error {
            background: #450a0a;
            border: 1px solid #991b1b;
            color: #fecaca;
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 25px;
        }

        .error ul {
            margin: 0;
            padding-left: 20px;
        }

        .actions {
            display: flex;
            gap: 12px;
            margin-top: 30px;
        }

        button,
        .cancel {
            padding: 13px 22px;
            border-radius: 10px;
            border: none;
            font-weight: bold;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
        }

        button {
            background: #16a34a;
            color: white;
        }

        button:hover {
            background: #15803d;
        }

        .cancel {
            background: #1f2937;
            color: white;
        }

        .cancel:hover {
            background: #374151;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="header">

        <div>
            <h1>🚗 Tambah Kendaraan</h1>
            <div class="subtitle">
                Tambahkan kendaraan baru ke sistem parkir.
            </div>
        </div>

        <a
            href="{{ route('admin.kendaraan.index') }}"
            class="back"
        >
            ← Kembali
        </a>

    </div>


    <div class="card">

        @if($errors->any())

            <div class="error">

                <strong>Data belum dapat disimpan:</strong>

                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>

            </div>

        @endif


        <form
            action="{{ route('admin.kendaraan.store') }}"
            method="POST"
        >

            @csrf


            <div class="form-group">

                <label for="plat_nomor">
                    Plat Nomor
                </label>

                <input
                    type="text"
                    id="plat_nomor"
                    name="plat_nomor"
                    value="{{ old('plat_nomor') }}"
                    placeholder="Contoh: AE 1234 AB"
                    required
                >

            </div>


            <div class="form-group">

                <label for="jenis">
                    Jenis Kendaraan
                </label>

                <select
                    id="jenis"
                    name="jenis"
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

            </div>


            <div class="form-group">

                <label for="pemilik">
                    Nama Pemilik
                </label>

                <input
                    type="text"
                    id="pemilik"
                    name="pemilik"
                    value="{{ old('pemilik') }}"
                    placeholder="Masukkan nama pemilik"
                    required
                >

            </div>


            <div class="actions">

                <button type="submit">
                    💾 Simpan Kendaraan
                </button>

                <a
                    href="{{ route('admin.kendaraan.index') }}"
                    class="cancel"
                >
                    Batal
                </a>

            </div>

        </form>

    </div>

</div>

</body>
</html>