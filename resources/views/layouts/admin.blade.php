
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Admin Panel | E-PARKIR XII IND')</title>

    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
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

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            overflow-x: hidden;
        }

        .parkir-wrapper {
            min-height: 100vh;
        }

        /* SIDEBAR */
        .sidebar {
            width: 255px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            padding: 25px 18px;
            background: var(--sidebar);
            border-right: 1px solid var(--border);
            overflow-y: auto;
            transition: transform .3s ease;
        }

        .sidebar-logo {
            text-align: center;
            padding: 12px 5px 35px;
        }

        .sidebar-logo h2 {
            font-family: 'Orbitron', sans-serif;
            font-size: 17px;
            font-weight: 800;
            letter-spacing: 1px;
            color: var(--light);
        }

        .sidebar-logo span {
            display: block;
            margin-top: 7px;
            color: var(--muted);
            font-size: 10px;
            letter-spacing: 3px;
        }

        .menu-title {
            margin: 18px 12px 12px;
            color: #718b7b;
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 2px;
        }

        .sidebar-menu {
            list-style: none;
        }

        .sidebar-menu li {
            margin-bottom: 7px;
        }

        .sidebar-menu a,
        .logout-button {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 14px;
            border: 0;
            border-radius: 10px;
            background: transparent;
            color: #aabbb0;
            text-decoration: none;
            font-family: 'Poppins', sans-serif;
            font-size: 12px;
            text-align: left;
            cursor: pointer;
            transition: background .25s ease, color .25s ease, transform .25s ease;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background: #193323;
            color: var(--light);
            box-shadow: inset 3px 0 var(--green);
            transform: translateX(3px);
        }

        .logout-button {
            margin-top: 25px;
            border: 1px solid rgba(239, 120, 120, .2);
            background: rgba(120, 35, 35, .12);
            color: #e9a4a4;
        }

        .logout-button:hover {
            background: rgba(150, 40, 40, .25);
            transform: translateY(-2px);
        }

        /* AREA KANAN */
        .main-content {
            min-height: 100vh;
            margin-left: 255px;
            display: flex;
            flex-direction: column;
            transition: margin-left .3s ease;
        }

        .topbar {
            min-height: 75px;
            padding: 12px 30px;
            display: flex;
            align-items: center;
            gap: 16px;
            background: #0b1911;
            border-bottom: 1px solid var(--border);
        }

        .toggle-btn {
            width: 42px;
            height: 42px;
            border: 1px solid var(--border);
            border-radius: 10px;
            background: #193323;
            color: var(--light);
            font-size: 20px;
            cursor: pointer;
            transition: .25s ease;
        }

        .toggle-btn:hover {
            background: #245139;
            transform: scale(1.05);
        }

        .topbar-title {
            font-family: 'Orbitron', sans-serif;
            color: var(--light);
            font-size: 12px;
            letter-spacing: 1px;
        }

        .topbar-right {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .online-status {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--light);
            font-size: 11px;
        }

        .online-status span {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #36d399;
            box-shadow: 0 0 10px rgba(54, 211, 153, .6);
        }

        .top-user {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .top-avatar,
        .admin-avatar {
            width: 36px;
            height: 36px;
            display: grid;
            place-items: center;
            border-radius: 50%;
            background: #193d2b;
            border: 1px solid var(--border);
            color: var(--light);
            font-weight: 700;
        }

        .top-user strong,
        .admin-mini strong {
            display: block;
            font-size: 11px;
            color: var(--text);
        }

        .top-user small,
        .admin-mini small {
            display: block;
            color: var(--muted);
            font-size: 10px;
        }

        .sidebar-bottom {
            margin-top: 35px;
            padding-top: 18px;
            border-top: 1px solid var(--border);
        }

        .admin-mini {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* CONTENT */
        .content {
            width: 100%;
            max-width: 1550px;
            margin: 0 auto;
            padding: 32px;
            flex: 1;
            animation: pageEnter .55s ease both;
        }

        @keyframes pageEnter {
            from {
                opacity: 0;
                transform: translateY(12px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .footer {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            padding: 18px 32px;
            border-top: 1px solid var(--border);
            color: var(--muted);
            font-size: 10px;
        }

        /* ALERT */
        .alert {
            padding: 13px 17px;
            margin-bottom: 20px;
            border-radius: 10px;
            font-size: 12px;
            animation: pageEnter .35s ease both;
        }

        .alert.success {
            color: #8de7bd;
            background: rgba(16, 168, 120, .12);
            border: 1px solid rgba(16, 168, 120, .3);
        }

        .alert.error {
            color: #f0a0a0;
            background: rgba(180, 55, 55, .12);
            border: 1px solid rgba(220, 100, 100, .25);
        }

        /* SIDEBAR COLLAPSE */
        body.sidebar-closed .sidebar {
            transform: translateX(-100%);
        }

        body.sidebar-closed .main-content {
            margin-left: 0;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .sidebar {
                box-shadow: 10px 0 30px rgba(0, 0, 0, .35);
            }

            .main-content {
                margin-left: 0;
            }

            body:not(.sidebar-closed) .main-content {
                margin-left: 0;
            }

            .topbar {
                padding: 12px 17px;
            }

            .content {
                padding: 22px 16px;
            }

            .topbar-right {
                gap: 10px;
            }

            .online-status {
                display: none;
            }

            .footer {
                padding: 16px;
                flex-wrap: wrap;
            }
        }
    </style>

    @stack('styles')
</head>

<body>
<div class="parkir-wrapper">

    <aside class="sidebar">
        <div class="sidebar-logo">
            <h2>E-PARKIR</h2>
            <span>XII IND</span>
        </div>

        <div class="menu-title">MENU UTAMA</div>

        <ul class="sidebar-menu">
            <li>
                <a href="{{ route('admin.dashboard') }}"
                   class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <span>⌂</span>
                    <span>Dashboard</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.users.index') }}"
                   class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <span>♙</span>
                    <span>Pengguna</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.kendaraan.index') }}"
                   class="{{ request()->routeIs('admin.kendaraan.*') ? 'active' : '' }}">
                    <span>▣</span>
                    <span>Kendaraan</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.tarif.index') }}"
                   class="{{ request()->routeIs('admin.tarif.*') ? 'active' : '' }}">
                    <span>◇</span>
                    <span>Tarif Parkir</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.area.index') }}"
                   class="{{ request()->routeIs('admin.area.*') ? 'active' : '' }}">
                    <span>▦</span>
                    <span>Area Parkir</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.log-aktifitas') }}"
                   class="{{ request()->routeIs('admin.log-aktifitas*') ? 'active' : '' }}">
                    <span>▤</span>
                    <span>Log Aktivitas</span>
                </a>
            </li>
        </ul>

        <div class="menu-title">SISTEM</div>

        <ul class="sidebar-menu">
            <li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout-button">
                        <span>↪</span>
                        <span>Keluar</span>
                    </button>
                </form>
            </li>
        </ul>

        <div class="sidebar-bottom">
            <div class="admin-mini">
                <div class="admin-avatar">
                    {{ strtoupper(substr(Auth::user()->username ?? 'A', 0, 1)) }}
                </div>
                <div>
                    <strong>{{ Auth::user()->username ?? 'Admin' }}</strong>
                    <small>Administrator</small>
                </div>
            </div>
        </div>
    </aside>

    <main class="main-content">
        <header class="topbar">
            <button class="toggle-btn" id="toggleSidebar" type="button"
                    aria-label="Buka atau tutup sidebar">☰</button>

            <div class="topbar-title">ADMIN PANEL</div>

            <div class="topbar-right">
                <div class="online-status">
                    <span></span>
                    Online
                </div>

                <div class="top-user">
                    <div class="top-avatar">
                        {{ strtoupper(substr(Auth::user()->username ?? 'A', 0, 1)) }}
                    </div>
                    <div>
                        <strong>{{ Auth::user()->username ?? 'Admin' }}</strong>
                        <small>Administrator</small>
                    </div>
                </div>
            </div>
        </header>

        <section class="content">
            @if(session('success'))
                <div class="alert success">✓ {{ session('success') }}</div>
            @endif

            @if(session('error'))
                <div class="alert error">✕ {{ session('error') }}</div>
            @endif

            @yield('content')
        </section>

        <footer class="footer">
            <span>© {{ date('Y') }} E-PARKIR XII IND</span>
            <span>Sistem Informasi Parkir</span>
        </footer>
    </main>
</div>

<script>
    const toggleButton = document.getElementById('toggleSidebar');

    toggleButton.addEventListener('click', function () {
        document.body.classList.toggle('sidebar-closed');
    });

    document.querySelectorAll('.sidebar a').forEach(function (link) {
        link.addEventListener('click', function () {
            if (window.innerWidth <= 768) {
                document.body.classList.add('sidebar-closed');
            }
        });
    });

    document.addEventListener('click', function (event) {
        const sidebar = document.querySelector('.sidebar');

        if (
            window.innerWidth <= 768 &&
            !sidebar.contains(event.target) &&
            !toggleButton.contains(event.target)
        ) {
            document.body.classList.add('sidebar-closed');
        }
    });
</script>

@stack('scripts')
</body>
</html>
