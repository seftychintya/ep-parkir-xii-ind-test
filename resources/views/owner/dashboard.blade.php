
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Owner | E-PARKIR XII IND</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --bg: #020604;
            --sidebar: rgba(0, 12, 6, .97);
            --card: rgba(0, 25, 12, .72);
            --border: rgba(0, 255, 102, .35);
            --green: #00ff66;
            --light: #aaffc5;
            --text: #e5ffed;
            --muted: #9bb7a4;
        }

        body {
            min-height: 100vh;
            background:
                radial-gradient(circle at 75% 15%, rgba(0, 255, 102, .09), transparent 35%),
                var(--bg);
            color: var(--text);
            font-family: 'Poppins', sans-serif;
        }

        .layout {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            min-height: 100vh;
            background: var(--sidebar);
            border-right: 1px solid var(--border);
            padding: 27px 18px;
            position: fixed;
            inset: 0 auto 0 0;
            box-shadow: 5px 0 25px rgba(0, 255, 102, .06);
        }

        .brand {
            padding: 10px 12px 27px;
            border-bottom: 1px solid var(--border);
            margin-bottom: 25px;
        }

        .brand-title {
            font-family: 'Orbitron', sans-serif;
            font-size: 19px;
            font-weight: 800;
            color: var(--green);
            letter-spacing: 1px;
            text-shadow: 0 0 12px rgba(0, 255, 102, .5);
        }

        .brand-subtitle {
            color: var(--muted);
            font-size: 11px;
            letter-spacing: 2px;
            margin-top: 8px;
        }

        .menu-title {
            color: #668875;
            font-size: 10px;
            font-weight: bold;
            letter-spacing: 2px;
            margin: 20px 12px 12px;
        }

        .menu {
            display: block;
            padding: 13px 14px;
            margin-bottom: 7px;
            border: 1px solid transparent;
            border-radius: 9px;
            color: #c6e6d1;
            text-decoration: none;
            font-size: 13px;
            transition: .25s;
        }

        .menu:hover,
        .menu.active {
            background: rgba(0, 255, 102, .12);
            border-color: rgba(0, 255, 102, .55);
            color: var(--green);
            box-shadow: 0 0 13px rgba(0, 255, 102, .09);
        }

        .main {
            margin-left: 250px;
            width: calc(100% - 250px);
            min-height: 100vh;
            padding: 32px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin-bottom: 30px;
        }

        .welcome h1 {
            font-family: 'Orbitron', sans-serif;
            font-size: 23px;
            color: var(--light);
            text-shadow: 0 0 12px rgba(0, 255, 102, .2);
        }

        .welcome p {
            margin-top: 9px;
            color: var(--muted);
            font-size: 12px;
        }

        .user-box {
            display: flex;
            align-items: center;
            gap: 12px;
            background: rgba(0, 255, 102, .06);
            border: 1px solid var(--border);
            padding: 10px 15px;
            border-radius: 12px;
        }

        .avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: rgba(0, 255, 102, .16);
            border: 1px solid var(--green);
            color: var(--green);
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
        }

        .user-name {
            font-size: 13px;
            font-weight: bold;
            color: var(--light);
        }

        .user-role {
            color: var(--green);
            font-size: 10px;
            margin-top: 3px;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 20px;
            margin-bottom: 27px;
        }

        .card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 15px;
            padding: 23px;
            box-shadow: 0 12px 30px rgba(0, 0, 0, .2);
            transition: .25s;
        }

        .card:hover,
        .rekap-card:hover {
            border-color: var(--green);
            box-shadow: 0 0 18px rgba(0, 255, 102, .12);
        }

        .card-label {
            color: var(--muted);
            font-size: 13px;
        }

        .card-value {
            font-family: 'Orbitron', sans-serif;
            font-size: 27px;
            font-weight: bold;
            color: var(--green);
            margin-top: 13px;
            text-shadow: 0 0 12px rgba(0, 255, 102, .25);
        }

        .card-info {
            margin-top: 8px;
            color: #718c7a;
            font-size: 11px;
        }

        .section-title {
            font-size: 18px;
            color: var(--light);
            margin: 0 0 15px;
        }

        .rekap-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 15px;
            padding: 25px;
            transition: .25s;
        }

        .rekap-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            padding: 17px 0;
            border-bottom: 1px solid rgba(0, 255, 102, .15);
        }

        .rekap-row:last-child {
            border-bottom: none;
        }

        .rekap-label {
            color: #c6e6d1;
            font-size: 13px;
        }

        .rekap-value {
            color: var(--green);
            font-weight: bold;
            font-size: 13px;
        }

        .btn {
            display: inline-block;
            padding: 11px 16px;
            border-radius: 9px;
            text-decoration: none;
            font-size: 12px;
            font-weight: bold;
            border: 1px solid var(--green);
            cursor: pointer;
            transition: .25s;
        }

        .btn-green {
            background: rgba(0, 255, 102, .12);
            color: var(--light);
        }

        .btn-green:hover {
            background: rgba(0, 255, 102, .25);
            color: white;
            box-shadow: 0 0 15px rgba(0, 255, 102, .2);
        }

        .logout {
            width: 100%;
            margin-top: 22px;
            background: transparent;
            color: #ff9999;
            padding: 12px;
            border: 1px solid rgba(255, 80, 80, .35);
            border-radius: 9px;
            cursor: pointer;
            font-family: inherit;
            font-weight: bold;
            transition: .25s;
        }

        .logout:hover {
            background: rgba(255, 50, 50, .12);
            border-color: #ff6666;
        }

        @media (max-width: 900px) {
            .sidebar {
                width: 215px;
            }

            .main {
                margin-left: 215px;
                width: calc(100% - 215px);
                padding: 22px;
            }

            .cards {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 650px) {
            .layout {
                display: block;
            }

            .sidebar {
                position: relative;
                width: 100%;
                min-height: auto;
            }

            .main {
                margin-left: 0;
                width: 100%;
                padding: 20px;
            }

            .topbar {
                align-items: flex-start;
                flex-direction: column;
            }
        }
    </style>
</head>

<body>

<div class="layout">

    <aside class="sidebar">

        <div class="brand">
            <div class="brand-title">MAHZAFY-EE</div>
            <div class="brand-subtitle">PARKIR XII IND</div>
        </div>

        <div class="menu-title">MENU UTAMA</div>

        <a href="{{ route('owner.dashboard') }}" class="menu active">
            ▣ &nbsp; Dashboard
        </a>

        <a href="{{ route('owner.rekap') }}" class="menu">
            ▤ &nbsp; Rekap Parkir
        </a>

        <div class="menu-title">AKUN</div>

        <form action="{{ route('logout') }}" method="POST">
            @csrf

            <button type="submit" class="logout">
                ↪ &nbsp; Keluar
            </button>
        </form>

    </aside>

    <main class="main">

        <div class="topbar">

            <div class="welcome">
                <h1>Dashboard Owner</h1>
                <p>Selamat datang kembali di E-PARKIR XII IND.</p>
            </div>

            <div class="user-box">

                <div class="avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>

                <div>
                    <div class="user-name">
                        {{ auth()->user()->name }}
                    </div>

                    <div class="user-role">OWNER</div>
                </div>

            </div>

        </div>

        <div class="cards">

            <div class="card">
                <div class="card-label">🚗 Total Kendaraan</div>
                <div class="card-value">-</div>
                <div class="card-info">Data kendaraan terdaftar</div>
            </div>

            <div class="card">
                <div class="card-label">🅿️ Parkir Aktif</div>
                <div class="card-value">-</div>
                <div class="card-info">Kendaraan sedang parkir</div>
            </div>

            <div class="card">
                <div class="card-label">💰 Pendapatan</div>
                <div class="card-value">-</div>
                <div class="card-info">Total pendapatan parkir</div>
            </div>

        </div>

        <h2 class="section-title">▤ Ringkasan Pengelolaan</h2>

        <div class="rekap-card">

            <div class="rekap-row">
                <div class="rekap-label">Status Sistem Parkir</div>
                <div class="rekap-value">● Aktif</div>
            </div>

            <div class="rekap-row">
                <div class="rekap-label">Akses Pengguna</div>
                <div class="rekap-value">Owner</div>
            </div>

            <div class="rekap-row">
                <div class="rekap-label">Laporan Parkir</div>

                <div>
                    <a href="{{ route('owner.rekap') }}" class="btn btn-green">
                        ▤ Lihat Rekap
                    </a>
                </div>
            </div>

        </div>

    </main>

</div>

</body>
</html>
