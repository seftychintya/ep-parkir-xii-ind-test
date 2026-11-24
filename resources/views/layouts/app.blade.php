<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'PARKIRKU')
    </title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f1f5f2;
            color: #1f2937;
        }

        /* SIDEBAR */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 250px;
            height: 100vh;
            background: #102a1d;
            color: white;
            padding: 20px 15px;
            display: flex;
            flex-direction: column;
            z-index: 1000;
        }

        .brand {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            padding: 15px 10px 25px;
            color: #8fd694;
            letter-spacing: 2px;
        }

        .user-box {
            background: #173b29;
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .user-name {
            font-weight: bold;
            font-size: 15px;
        }

        .user-role {
            margin-top: 5px;
            color: #9fc5aa;
            font-size: 13px;
            text-transform: uppercase;
        }

        .menu {
            flex: 1;
            overflow-y: auto;
        }

        .menu-title {
            font-size: 11px;
            color: #7fa88b;
            margin: 15px 10px 8px;
            text-transform: uppercase;
            font-weight: bold;
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: #dce9df;
            padding: 12px 14px;
            margin-bottom: 5px;
            border-radius: 9px;
            transition: 0.2s;
        }

        .menu a:hover {
            background: #1d4d35;
            color: white;
        }

        .menu a.active {
            background: #2d6a4f;
            color: white;
        }

        .menu-icon {
            width: 24px;
            text-align: center;
        }

        /* LOGOUT */
        .logout-wrapper {
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #2b4d3a;
        }

        .logout-button {
            width: 100%;
            border: none;
            border-radius: 9px;
            padding: 12px 14px;
            background: #8b1e1e;
            color: white;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 15px;
            font-weight: bold;
            text-align: left;
        }

        .logout-button:hover {
            background: #b52b2b;
        }

        /* CONTENT */
        .main {
            margin-left: 250px;
            min-height: 100vh;
        }

        .topbar {
            height: 70px;
            background: white;
            border-bottom: 1px solid #ddd;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
        }

        .topbar-title {
            font-size: 20px;
            font-weight: bold;
            color: #173b29;
        }

        .topbar-user {
            font-size: 14px;
            color: #555;
        }

        .content {
            padding: 30px;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 220px;
            }

            .main {
                margin-left: 220px;
            }

            .content {
                padding: 20px;
            }
        }
    </style>
</head>

<body>

    {{-- SIDEBAR --}}
    <aside class="sidebar">

        <div class="brand">
            PARKIRKU
        </div>

        @auth
            <div class="user-box">
                <div class="user-name">
                    {{ auth()->user()->name ?? 'User' }}
                </div>

                <div class="user-role">
                    {{ auth()->user()->role ?? 'User' }}
                </div>
            </div>
        @endauth


        <div class="menu">

            {{-- DASHBOARD --}}
            <div class="menu-title">
                Menu Utama
            </div>

            <a href="{{ route('dashboard') }}">
                <span class="menu-icon">🏠</span>
                <span>Dashboard</span>
            </a>


            {{-- MENU ADMIN --}}
            @if(auth()->check() && auth()->user()->role === 'admin')

                <div class="menu-title">
                    Administrasi
                </div>

                <a href="{{ route('admin.kendaraan.index') }}">
                    <span class="menu-icon">🚗</span>
                    <span>Kendaraan</span>
                </a>

                <a href="{{ route('admin.tarif.index') }}">
                    <span class="menu-icon">💰</span>
                    <span>Tarif</span>
                </a>

                <a href="{{ route('admin.area.index') }}">
                    <span class="menu-icon">🅿️</span>
                    <span>Area Parkir</span>
                </a>

                <a href="{{ route('admin.users.index') }}">
                    <span class="menu-icon">👥</span>
                    <span>Pengguna</span>
                </a>

            @endif


            {{-- MENU PETUGAS --}}
            @if(auth()->check() && auth()->user()->role === 'petugas')

                <div class="menu-title">
                    Petugas
                </div>

                <a href="{{ route('petugas.transaksi.index') }}">
                    <span class="menu-icon">🚙</span>
                    <span>Transaksi Parkir</span>
                </a>

            @endif


            {{-- MENU OWNER --}}
            @if(auth()->check() && auth()->user()->role === 'owner')

                <div class="menu-title">
                    Owner
                </div>

                @if(Route::has('owner.rekap'))
                    <a href="{{ route('owner.rekap') }}">
                        <span class="menu-icon">📊</span>
                        <span>Rekap</span>
                    </a>
                @endif

            @endif

        </div>


        {{-- LOGOUT --}}
        @auth
            <div class="logout-wrapper">

                <form method="POST" action="{{ route('logout') }}">

                    @csrf

                    <button type="submit" class="logout-button">
                        <span class="menu-icon">🚪</span>
                        <span>Logout</span>
                    </button>

                </form>

            </div>
        @endauth

    </aside>


    {{-- MAIN --}}
    <main class="main">

        <header class="topbar">

            <div class="topbar-title">
                @yield('title', 'Dashboard')
            </div>

            @auth
                <div class="topbar-user">
                    👤 {{ auth()->user()->name ?? 'User' }}
                </div>
            @endauth

        </header>


        <section class="content">

            @if(session('success'))
                <div style="
                    background:#d1fae5;
                    color:#065f46;
                    padding:14px;
                    border-radius:8px;
                    margin-bottom:20px;
                ">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div style="
                    background:#fee2e2;
                    color:#991b1b;
                    padding:14px;
                    border-radius:8px;
                    margin-bottom:20px;
                ">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')

        </section>

    </main>

</body>
</html>