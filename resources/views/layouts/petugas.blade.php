
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Petugas') | E-PARKIR XII IND</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --bg: #06110c;
            --sidebar: #031009;
            --card: #0a1b12;
            --border: #123c29;
            --green: #10a878;
            --light: #50d6a6;
            --text: #e5eee8;
            --muted: #8b9b91;
        }

        body {
            min-height: 100vh;
            background:
                radial-gradient(circle at 75% 15%,
                rgba(16,168,120,.045), transparent 35%),
                var(--bg);
            color: var(--text);
            font-family: 'Poppins', sans-serif;
        }

        .layout {
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR TETAP */

        .sidebar {
            width: 255px;
            min-height: 100vh;
            padding: 28px 18px;
            background: var(--sidebar);
            border-right: 1px solid var(--border);
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
        }

        .brand {
            padding: 8px 12px 28px;
            margin-bottom: 28px;
            border-bottom: 1px solid var(--border);
        }

        .brand h2 {
            color: var(--light);
            font-family: 'Orbitron', sans-serif;
            font-size: 20px;
            letter-spacing: 2px;
        }

        .brand p {
            margin-top: 7px;
            color: var(--muted);
            font-size: 11px;
            letter-spacing: 2px;
        }

        .menu-title {
            color: #718779;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 2px;
            margin: 22px 12px 12px;
        }

        .menu {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 13px 14px;
            margin-bottom: 8px;
            width: 100%;
            border: 1px solid transparent;
            border-radius: 9px;
            color: #c6d8cc;
            background: transparent;
            text-decoration: none;
            font-family: inherit;
            font-size: 13px;
            text-align: left;
            cursor: pointer;
            transition: .2s;
        }

        .menu:hover,
        .menu.active {
            background: rgba(16,168,120,.10);
            border-color: rgba(16,168,120,.45);
            color: var(--light);
        }

        .menu span {
            width: 18px;
            text-align: center;
        }

        .account-menu {
            margin-top: auto;
        }

        .logout {
            color: #e99b9b;
        }

        .logout:hover {
            background: rgba(255,50,50,.08);
            border-color: rgba(255,80,80,.25);
        }

        /* KONTEN */

        .main {
            flex: 1;
            min-width: 0;
            padding: 35px;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 32px;
        }

        .topbar h1 {
            font-family: 'Orbitron', sans-serif;
            font-size: 23px;
            color: var(--light);
        }

        .topbar p {
            color: var(--muted);
            font-size: 12px;
            margin-top: 8px;
        }

        .user-box {
            padding: 11px 17px;
            border: 1px solid var(--border);
            border-radius: 10px;
            background: rgba(16,168,120,.07);
            color: var(--light);
            font-size: 12px;
        }

        /* DASHBOARD */

        .cards {
            display: grid;
            grid-template-columns: repeat(4, minmax(0,1fr));
            gap: 18px;
        }

        .card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 23px;
            box-shadow: 0 5px 18px rgba(0,0,0,.12);
            transition: .2s;
        }

        .card:hover {
            border-color: #24724f;
            transform: translateY(-2px);
        }

        .card-label {
            color: var(--muted);
            font-size: 12px;
        }

        .card-value {
            color: var(--light);
            font-family: 'Orbitron', sans-serif;
            font-size: 25px;
            font-weight: 700;
            margin-top: 14px;
        }

        .card-icon {
            font-size: 26px;
            margin-bottom: 15px;
        }

        .welcome {
            margin-top: 25px;
            padding: 28px;
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 14px;
            box-shadow: 0 5px 18px rgba(0,0,0,.10);
        }

        .welcome h2 {
            color: var(--light);
            font-size: 19px;
            margin-bottom: 12px;
        }

        .welcome p {
            color: var(--muted);
            font-size: 13px;
            line-height: 1.9;
        }

        .highlight {
            color: var(--light);
            font-weight: 700;
        }

        .quick-actions {
            display: grid;
            grid-template-columns: repeat(2,minmax(0,1fr));
            gap: 18px;
            margin-top: 22px;
        }

        .action {
            display: block;
            padding: 23px;
            text-decoration: none;
            color: var(--text);
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 14px;
            transition: .2s;
        }

        .action:hover {
            border-color: #24724f;
            transform: translateY(-2px);
        }

        .action h3 {
            color: var(--light);
            font-size: 15px;
            margin: 10px 0;
        }

        .action p {
            color: var(--muted);
            font-size: 12px;
        }

        /* TRANSAKSI */

        .transaction-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 22px;
            overflow-x: auto;
        }

        .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 20px;
        }

        .card-header h3 {
            color: var(--light);
            font-size: 15px;
        }

        .btn {
            display: inline-block;
            padding: 10px 14px;
            border: 1px solid transparent;
            border-radius: 8px;
            text-decoration: none;
            cursor: pointer;
            font-family: inherit;
            font-size: 12px;
            transition: .2s;
        }

        .btn-green {
            background: #087f5b;
            color: white;
        }

        .btn-green:hover {
            background: #096b4d;
        }

        .btn-blue {
            background: #123c29;
            color: #b9e5d0;
            border-color: #20563e;
        }

        .alert {
            padding: 13px 16px;
            border-radius: 9px;
            margin-bottom: 18px;
            font-size: 13px;
        }

        .alert-success {
            background: rgba(16,168,120,.09);
            border: 1px solid rgba(16,168,120,.22);
            color: #8eddbb;
        }

        .alert-error {
            background: rgba(239,68,68,.08);
            border: 1px solid rgba(239,68,68,.20);
            color: #fca5a5;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 950px;
        }

        th {
            text-align: left;
            padding: 13px 10px;
            color: #8aab96;
            font-size: 10px;
            text-transform: uppercase;
            border-bottom: 1px solid var(--border);
            white-space: nowrap;
        }

        td {
            padding: 14px 10px;
            border-bottom: 1px solid rgba(255,255,255,.045);
            color: #d4ded7;
            font-size: 11px;
            white-space: nowrap;
        }

        td strong {
            color: #b9dfca;
        }

        tr:hover td {
            background: rgba(16,168,120,.045);
        }

        .badge {
            display: inline-block;
            padding: 5px 9px;
            border-radius: 20px;
            font-size: 10px;
        }

        .badge-masuk {
            background: rgba(16,168,120,.12);
            color: #80d9b1;
        }

        .badge-keluar {
            background: rgba(59,130,246,.10);
            color: #93c5fd;
        }

        .empty {
            text-align: center;
            padding: 45px 20px;
            color: var(--muted);
        }

        /* RESPONSIVE */

        @media(max-width:1100px) {
            .cards {
                grid-template-columns: repeat(2,minmax(0,1fr));
            }
        }

        @media(max-width:700px) {
            .layout {
                display: block;
            }

            .sidebar {
                width: 100%;
                min-height: auto;
            }

            .account-menu {
                margin-top: 15px;
            }

            .main {
                padding: 22px 16px;
            }

            .topbar {
                align-items: flex-start;
                flex-direction: column;
            }

            .cards,
            .quick-actions {
                grid-template-columns: 1fr;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

<div class="layout">

    <aside class="sidebar">

        <div class="brand">
            <h2>MAHZAFY-EE</h2>
            <p>PARKIR XII IND</p>
        </div>

        <div class="menu-title">MENU UTAMA</div>

        <a href="{{ route('petugas.dashboard') }}"
           class="menu {{ request()->routeIs('petugas.dashboard') ? 'active' : '' }}">
            <span>▣</span> Dashboard
        </a>

        <a href="{{ route('petugas.transaksi.index') }}"
           class="menu {{ request()->routeIs('petugas.transaksi.index') || request()->routeIs('petugas.transaksi.show') ? 'active' : '' }}">
            <span>▤</span> Transaksi Parkir
        </a>

        <a href="{{ route('petugas.transaksi.create') }}"
           class="menu {{ request()->routeIs('petugas.transaksi.create') ? 'active' : '' }}">
            <span>＋</span> Parkir Masuk
        </a>

        <div class="account-menu">
            <div class="menu-title">AKUN</div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="menu logout">
                    <span>↪</span> Logout
                </button>
            </form>
        </div>

    </aside>

    <main class="main">
        @yield('content')
    </main>

</div>

@stack('scripts')

</body>
</html>
