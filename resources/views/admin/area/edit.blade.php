<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Area - Sistem Parkir</title>

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

        .info {
            background: #052e16;
            border: 1px solid #166534;
            color: #bbf7d0;
            padding: 14px;
            border-radius: 10px;
            margin-bottom: 25px;
        }
    </style>
</head>

<body>

<div class="page">

    <div class="container">

        <div class="card">

            <h1>✏️ Edit Area Parkir</h1>

            <div class="subtitle">
                Perbarui informasi area parkir.
            </div>

            <div class="info">
                📍 Area yang sedang diedit:
                <strong>{{ $area->nama_area }}</strong>
            </div>

            @if($errors->any())
                <div class="error">
                    @foreach($errors->all() as $error)
                        <div>• {{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('admin.area.update', $area) }}"
                  method="POST">

                @csrf
                @method('PUT')

                <div class="form-group">

                    <label for="nama_area">
                        Nama Area Parkir
                    </label>

                    <input
                        type="text"
                        name="nama_area"
                        id="nama_area"
                        value="{{ old('nama_area', $area->nama_area) }}"
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
                        value="{{ old('kapasitas', $area->kapasitas) }}"
                        min="0"
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
                        value="{{ old('terisi', $area->terisi) }}"
                        min="0"
                        required
                    >

                </div>

                <div class="form-group">

                    <label for="status">
                        Status Area
                    </label>

                    <select name="status" id="status" required>

                        <option value="aktif"
                            {{ old('status', $area->status) == 'aktif' ? 'selected' : '' }}>
                            Aktif
                        </option>

                        <option value="nonaktif"
                            {{ old('status', $area->status) == 'nonaktif' ? 'selected' : '' }}>
                            Nonaktif
                        </option>

                    </select>

                </div>

                <div class="buttons">

                    <button type="submit"
                            class="btn btn-green">
                        💾 Simpan Perubahan
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