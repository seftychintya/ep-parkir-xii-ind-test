<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Kendaraan - ParkirKu</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #07130f;
            color: #fff;
            min-height: 100vh;
        }

        .wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR */
        .sidebar {
            width: 250px;
            background: #0b1f18;
            border-right: 1px solid #17382b;
            padding: 25px 18px;
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
        }

        .logo {
            font-size: 25px;
            font-weight: bold;
            color: #4ade80;
            margin-bottom: 40px;
            padding-left: 12px;
        }

        .menu-title {
            color: #6b8f80;
            font-size: 12px;
            text-transform: uppercase;
            margin: 0 12px 12px;
            letter-spacing: 1px;
        }

        .menu {
            list-style: none;
        }

        .menu li {
            margin-bottom: 7px;
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: #a9c1b6;
            padding: 13px 14px;
            border-radius: 9px;
            transition: .2s;
        }

        .menu a:hover {
            background: #123426;
            color: #fff;
        }

        .menu a.active {
            background: #166534;
            color: #fff;
        }

        .icon {
            width: 22px;
            text-align: center;
        }

        /* CONTENT */
        .content {
            margin-left: 250px;
            width: calc(100% - 250px);
            padding: 30px 35px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .page-title h1 {
            font-size: 28px;
            margin-bottom: 7px;
        }

        .page-title p {
            color: #78988b;
            font-size: 14px;
        }

        .user-box {
            background: #0d251c;
            border: 1px solid #17382b;
            padding: 10px 16px;
            border-radius: 10px;
            color: #a9c1b6;
        }

        .user-box strong {
            color: #4ade80;
        }

        /* CARD */
        .card {
            max-width: 700px;
            background: #0b1f18;
            border: 1px solid #17382b;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 12px 30px rgba(0,0,0,.25);
        }

        .card h2 {
            font-size: 21px;
            margin-bottom: 25px;
        }

        /* FORM */
        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #b8cec4;
            font-size: 14px;
            font-weight: bold;
        }

        input,
        select {
            width: 100%;
            padding: 13px 14px;
            background: #07130f;
            color: #fff;
            border: 1px solid #285440;
            border-radius: 8px;
            outline: none;
            font-size: 14px;
        }

        input:focus,
        select:focus {
            border-color: #4ade80;
            box-shadow: 0 0 0 2px rgba(74,222,128,.1);
        }

        select option {
            background: #0b1f18;
            color: #fff;
        }

        .error {
            background: #450a0a;
            border: 1px solid #991b1b;
            color: #fca5a5;
            padding: 13px 16px;
            border-radius: 9px;
            margin-bottom: 20px;
        }

        /* BUTTON */
        .buttons {
            display: flex;
            gap: 10px;
            margin-top: 25px;
        }

        .btn {
            border: none;
            text-decoration: none;
            cursor: pointer;
            padding: 12px 20px;
            border-radius: 8px;
            font-weight: bold;
            font-size: 14px;
        }

        .btn-save {
            background: #16a34a;
            color: white;
        }

        .btn-save:hover {
            background: #15803d;
        }

        .btn-back {
            background: #263c33;
            color: #cbd5d1;
        }

        .btn-back:hover {
            background: #345247;
        }

        @media (max-width: 800px) {
            .sidebar {
                width: 210px;
            }

            .content {
                margin-left: 210px;
                width: calc(100% - 210px);
                padding: 20px;
            }

            .topbar {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
        }
    </style>
</head>

<body>

<div class="wrapper">

    <!-- SIDEBAR -->
    <aside class="sidebar">

        <div class="logo">
            🅿️ ParkirKu
        </div>

        <div class="menu-title">
            Menu Utama
        </div>

        <ul class="menu">

            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <span class="icon">📊</span>
                    Dashboard
                </a>
            </li>

            <li>
                <a href="{{ route('admin.kendaraan.index') }}" class="active">
                    <span class="icon">🚗</span>
                    Kendaraan
                </a>
            </li>

            <li>
                <a href="{{ route('admin.tarif.index') }}">
                    <span class="icon">💰</span>
                    Tarif
                </a>
            </li>

            <li>
                <a href="{{ route('admin.area.index') }}">
                    <span class="icon">🅿️</span>
                    Area Parkir
                </a>
            </li>

            <li>
                <a href="{{ route('admin.users.index') }}">
                    <span class="icon">👥</span>
                    Pengguna
                </a>
            </li>

        </ul>

    </aside>


    <!-- CONTENT -->
    <main class="content">

        <div class="topbar">

            <div class="page-title">
                <h1>Edit Kendaraan</h1>
                <p>Perbarui informasi kendaraan</p>
            </div>

            <div class="user-box">
                👤 <strong>{{ Auth::user()->name ?? 'Administrator' }}</strong>
            </div>

        </div>


        @if($errors->any())

            <div class="error">

                @foreach($errors->all() as $error)
                    <div>• {{ $error }}</div>
                @endforeach

            </div>

        @endif


        <div class="card">

            <h2>Form Edit Kendaraan</h2>

            <form action="{{ route('admin.kendaraan.update', $kendaraan->id) }}"
                  method="POST">

                @csrf
                @method('PUT')


                <div class="form-group">

                    <label for="plat_nomor">
                        Plat Nomor
                    </label>

                    <input
                        type="text"
                        id="plat_nomor"
                        name="plat_nomor"
                        value="{{ old('plat_nomor', $kendaraan->plat_nomor) }}"
                        placeholder="Contoh: AE 1234 AB"
                        required
                    >

                </div>


                <div class="form-group">

                    <label for="jenis">
                        Jenis Kendaraan
                    </label>

                    <select id="jenis" name="jenis" required>

                        <option value="">
                            -- Pilih Jenis Kendaraan --
                        </option>

                        <option value="Motor"
                            {{ old('jenis', $kendaraan->jenis) == 'Motor' ? 'selected' : '' }}>
                            Motor
                        </option>

                        <option value="Mobil"
                            {{ old('jenis', $kendaraan->jenis) == 'Mobil' ? 'selected' : '' }}>
                            Mobil
                        </option>

                        <option value="Truk"
                            {{ old('jenis', $kendaraan->jenis) == 'Truk' ? 'selected' : '' }}>
                            Truk
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
                        value="{{ old('pemilik', $kendaraan->pemilik) }}"
                        placeholder="Nama pemilik kendaraan"
                    >

                </div>


                <div class="buttons">

                    <button type="submit" class="btn btn-save">
                        💾 Simpan Perubahan
                    </button>

                    <a href="{{ route('admin.kendaraan.index') }}"
                       class="btn btn-back">
                        ← Kembali
                    </a>

                </div>

            </form>

        </div>

    </main>

</div>

</body>
</html>