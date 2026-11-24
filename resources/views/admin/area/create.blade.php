<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tambah Area - Sistem Parkir</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #06100b !important;
            color: white;
        }

        .page {
            min-height: 100vh;
            padding: 35px;
        }

        .container {
            max-width: 750px;
            margin: auto;
        }

        .card {
            background: #0b1912 !important;
            border: 1px solid #153d29;
            border-radius: 18px;
            padding: 30px;
            box-shadow: 0 15px 40px rgba(0,0,0,.35);
        }

        h1 {
            margin-top: 0;
            font-size: 28px;
        }

        .subtitle {
            color: #94a3b8;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #d1fae5;
            font-weight: bold;
        }

        input,
        select {
            width: 100%;
            padding: 13px 15px;
            background: #07140c;
            border: 1px solid #285c3c;
            color: white;
            border-radius: 10px;
            outline: none;
        }

        input:focus,
        select:focus {
            border-color: #22c55e;
        }

        .buttons {
            display: flex;
            gap: 10px;
            margin-top: 25px;
        }

        .btn {
            padding: 12px 18px;
            border-radius: 10px;
            border: none;
            text-decoration: none;
            cursor: pointer;
            font-weight: bold;
        }

        .btn-green {
            background: #16a34a;
            color: white;
        }

        .btn-gray {
            background: #1f2937;
            color: white;
        }

        .error {
            background: #450a0a;
            border: 1px solid #991b1b;
            color: #fecaca;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

<div class="page">

    <div class="container">

        <div class="card">

            <h1>➕ Tambah Area Parkir</h1>

            <div class="subtitle">
                Tambahkan area parkir baru ke sistem.
            </div>

            @if($errors->any())
                <div class="error">
                    @foreach($errors->all() as $error)
                        <div>• {{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('admin.area.store') }}" method="POST">

                @csrf

                <div class="form-group">

                    <label for="nama_area">
                        Nama Area Parkir
                    </label>

                    <input
                        type="text"
                        name="nama_area"
                        id="nama_area"
                        value="{{ old('nama_area') }}"
                        placeholder="Contoh: Area A"
                        required
                    >

                </div>

                <div class="form-group">

                    <label for="kapasitas">
                        Kapasitas
                    </label>

                    <input
                        type="number"
                        name="kapasitas"
                        id="kapasitas"
                        value="{{ old('kapasitas', 0) }}"
                        min="0"
                        placeholder="Contoh: 50"
                        required
                    >

                </div>

                <div class="form-group">

                    <label for="terisi">
                        Jumlah Terisi
                    </label>

                    <input
                        type="number"
                        name="terisi"
                        id="terisi"
                        value="{{ old('terisi', 0) }}"
                        min="0"
                        placeholder="Contoh: 10"
                        required
                    >

                </div>

                <div class="form-group">

                    <label for="status">
                        Status Area
                    </label>

                    <select name="status" id="status" required>

                        <option value="aktif"
                            {{ old('status', 'aktif') == 'aktif' ? 'selected' : '' }}>
                            Aktif
                        </option>

                        <option value="nonaktif"
                            {{ old('status') == 'nonaktif' ? 'selected' : '' }}>
                            Nonaktif
                        </option>

                    </select>

                </div>

                <div class="buttons">

                    <button type="submit"
                            class="btn btn-green">
                        💾 Simpan Area
                    </button>

                    <a href="{{ route('admin.area.index') }}"
                       class="btn btn-gray">
                        ← Kembali
                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

</body>
</html>