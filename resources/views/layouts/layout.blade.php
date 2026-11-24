<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Sistem Parkir')
    </title>


    <style>

        * {
            box-sizing: border-box;
        }


        html,
        body {
            margin: 0;
            padding: 0;
            min-height: 100%;
        }


        body {
            font-family:
                "Segoe UI",
                Arial,
                sans-serif;

            background: #f4f7f5;
            color: #1f2937;
        }


        a {
            text-decoration: none;
        }


        /* =====================================================
           LAYOUT UTAMA
        ===================================================== */

        .app {
            min-height: 100vh;
            display: flex;
        }


        /* =====================================================
           SIDEBAR
        ===================================================== */

        .sidebar {

            width: 260px;
            min-height: 100vh;

            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;

            background:
                linear-gradient(
                    180deg,
                    #061b10 0%,
                    #082516 50%,
                    #04140c 100%
                );

            color: white;

            z-index: 1000;

            overflow-y: auto;

            box-shadow:
                5px 0 20px rgba(0, 0, 0, .12);
        }


        /* LOGO */

        .brand {

            height: 75px;

            display: flex;
            align-items: center;

            padding: 0 22px;

            border-bottom:
                1px solid rgba(255,255,255,.08);
        }


        .brand-icon {

            width: 42px;
            height: 42px;

            border-radius: 12px;

            display: flex;
            align-items: center;
            justify-content: center;

            background: #16a34a;

            font-size: 22px;

            margin-right: 12px;

            box-shadow:
                0 5px 15px rgba(22,163,74,.25);
        }


        .brand-text {
            display: flex;
            flex-direction: column;
        }


        .brand-title {

            font-size: 17px;
            font-weight: 800;

            color: white;

            letter-spacing: .3px;
        }


        .brand-subtitle {

            font-size: 11px;

            color: #86efac;

            margin-top: 2px;
        }


        /* =====================================================
           PROFILE SIDEBAR
        ===================================================== */

        .sidebar-profile {

            padding: 20px;

            border-bottom:
                1px solid rgba(255,255,255,.07);
        }


        .profile-box {

            display: flex;
            align-items: center;

            gap: 12px;
        }


        .profile-avatar {

            width: 42px;
            height: 42px;

            border-radius: 50%;

            background: #16a34a;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 18px;
            font-weight: 800;

            color: white;
        }


        .profile-info {
            min-width: 0;
        }


        .profile-name {

            color: white;

            font-size: 14px;

            font-weight: 700;

            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }


        .profile-role {

            color: #86efac;

            font-size: 11px;

            margin-top: 3px;

            text-transform: capitalize;
        }


        /* =====================================================
           MENU
        ===================================================== */

        .sidebar-menu {

            padding: 18px 13px 30px;
        }


        .menu-title {

            color: #6ee7b7;

            font-size: 10px;

            font-weight: 800;

            text-transform: uppercase;

            letter-spacing: 1.2px;

            padding:
                12px 13px 8px;

            margin-top: 5px;
        }


        .menu {

            display: flex;

            flex-direction: column;

            gap: 4px;
        }


        .menu a {

            position: relative;

            display: flex;

            align-items: center;

            gap: 12px;

            padding:
                11px 13px;

            border-radius: 9px;

            color: #cbd5d1;

            font-size: 14px;

            font-weight: 500;

            transition:
                background .2s ease,
                color .2s ease,
                transform .2s ease;
        }


        .menu a:hover {

            background:
                rgba(34,197,94,.13);

            color: white;

            transform:
                translateX(2px);
        }


        .menu a.active {

            background:
                linear-gradient(
                    90deg,
                    #16a34a,
                    #15803d
                );

            color: white;

            font-weight: 700;

            box-shadow:
                0 5px 15px
                rgba(22,163,74,.18);
        }


        .menu-icon {

            width: 22px;

            display: flex;

            align-items: center;
            justify-content: center;

            font-size: 17px;

            flex-shrink: 0;
        }


        .menu-text {
            flex: 1;
        }


        /* =====================================================
           LOGOUT
        ===================================================== */

        .logout-wrapper {

            margin-top: 18px;

            padding-top: 15px;

            border-top:
                1px solid rgba(255,255,255,.07);
        }


        .logout-button {

            width: 100%;

            border: 0;

            cursor: pointer;

            display: flex;

            align-items: center;

            gap: 12px;

            padding: 11px 13px;

            border-radius: 9px;

            background:
                rgba(239,68,68,.08);

            color: #fca5a5;

            font-family: inherit;

            font-size: 14px;

            font-weight: 600;

            transition: .2s;
        }


        .logout-button:hover {

            background:
                rgba(239,68,68,.16);

            color: #fecaca;
        }


        /* =====================================================
           MAIN CONTENT
        ===================================================== */

        .main {

            width: calc(100% - 260px);

            margin-left: 260px;

            min-height: 100vh;
        }


        /* =====================================================
           TOPBAR
        ===================================================== */

        .topbar {

            height: 75px;

            background: white;

            display: flex;

            align-items: center;

            justify-content: space-between;

            padding:
                0 30px;

            border-bottom:
                1px solid #e5e7eb;

            position: sticky;

            top: 0;

            z-index: 900;

            box-shadow:
                0 2px 10px rgba(0,0,0,.03);
        }


        .topbar-left {

            display: flex;
            align-items: center;

            gap: 15px;
        }


        .mobile-menu {

            display: none;

            border: 0;

            background: #f0fdf4;

            color: #166534;

            width: 40px;
            height: 40px;

            border-radius: 8px;

            cursor: pointer;

            font-size: 20px;
        }


        .topbar-title {

            font-size: 18px;

            font-weight: 800;

            color: #111827;
        }


        .topbar-subtitle {

            color: #6b7280;

            font-size: 12px;

            margin-top: 2px;
        }


        .topbar-right {

            display: flex;

            align-items: center;

            gap: 12px;
        }


        .topbar-user {

            display: flex;

            align-items: center;

            gap: 10px;
        }


        .topbar-avatar {

            width: 38px;
            height: 38px;

            border-radius: 50%;

            background: #dcfce7;

            color: #166534;

            display: flex;

            align-items: center;
            justify-content: center;

            font-weight: 800;
        }


        .topbar-user-info {

            display: flex;

            flex-direction: column;

            align-items: flex-end;
        }


        .topbar-user-name {

            color: #111827;

            font-size: 13px;

            font-weight: 700;
        }


        .topbar-user-role {

            color: #16a34a;

            font-size: 11px;

            text-transform: capitalize;
        }


        /* =====================================================
           CONTENT
        ===================================================== */

        .content {

            padding: 30px;
        }


        /* =====================================================
           PAGE HEADER
        ===================================================== */

        .page-header {

            display: flex;

            justify-content: space-between;

            align-items: center;

            gap: 20px;

            margin-bottom: 25px;
        }


        .page-header h1 {

            margin: 0;

            font-size: 27px;

            color: #111827;

            font-weight: 800;
        }


        .page-header p {

            margin:
                7px 0 0;

            color: #6b7280;

            font-size: 14px;
        }


        /* =====================================================
           CONTENT CARD
        ===================================================== */

        .content-card {

            background: white;

            border-radius: 14px;

            padding: 24px;

            border:
                1px solid #e5e7eb;

            box-shadow:
                0 4px 18px
                rgba(0,0,0,.04);

            margin-bottom: 22px;
        }


        .content-card h2 {

            color: #111827;

            font-size: 18px;
        }


        /* =====================================================
           DASHBOARD STAT CARD
        ===================================================== */

        .stat-grid {

            display: grid;

            grid-template-columns:
                repeat(4, 1fr);

            gap: 18px;

            margin-bottom: 25px;
        }


        .stat-card {

            background: white;

            border:
                1px solid #e5e7eb;

            border-radius: 14px;

            padding: 21px;

            display: flex;

            align-items: center;

            gap: 15px;

            box-shadow:
                0 4px 18px
                rgba(0,0,0,.04);
        }


        .stat-icon {

            width: 52px;
            height: 52px;

            border-radius: 12px;

            display: flex;

            align-items: center;
            justify-content: center;

            background: #dcfce7;

            font-size: 23px;

            flex-shrink: 0;
        }


        .stat-label {

            color: #6b7280;

            font-size: 12px;

            margin-bottom: 4px;
        }


        .stat-value {

            color: #111827;

            font-size: 25px;

            font-weight: 800;
        }


        /* =====================================================
           TABLE
        ===================================================== */

        .table-wrapper {

            overflow-x: auto;
        }


        table {

            width: 100%;

            border-collapse: collapse;
        }


        th {

            background: #f8faf9;

            color: #4b5563;

            font-size: 12px;

            font-weight: 700;

            text-align: left;

            padding: 13px;

            border-bottom:
                1px solid #e5e7eb;
        }


        td {

            padding: 13px;

            font-size: 13px;

            color: #374151;

            border-bottom:
                1px solid #f1f5f9;
        }


        tbody tr:hover {

            background: #f8faf9;
        }


        /* =====================================================
           BADGE
        ===================================================== */

        .badge {

            display: inline-flex;

            align-items: center;

            padding:
                5px 10px;

            border-radius: 20px;

            font-size: 11px;

            font-weight: 700;
        }


        .badge-success {

            background: #dcfce7;

            color: #166534;
        }


        .badge-danger {

            background: #fee2e2;

            color: #991b1b;
        }


        .badge-warning {

            background: #fef3c7;

            color: #92400e;
        }


        /* =====================================================
           BUTTON
        ===================================================== */

        .btn {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 7px;

            padding:
                10px 15px;

            border: 0;

            border-radius: 8px;

            cursor: pointer;

            font-family: inherit;

            font-size: 13px;

            font-weight: 700;

            transition: .2s;
        }


        .btn-primary {

            background: #16a34a;

            color: white;
        }


        .btn-primary:hover {

            background: #15803d;
        }


        .btn-warning {

            background: #facc15;

            color: #422006;
        }


        .btn-danger {

            background: #ef4444;

            color: white;
        }


        .btn-secondary {

            background: #e5e7eb;

            color: #374151;
        }


        /* =====================================================
           ALERT
        ===================================================== */

        .alert {

            padding: 13px 16px;

            border-radius: 9px;

            margin-bottom: 20px;

            font-size: 13px;

            font-weight: 600;
        }


        .alert-success {

            background: #dcfce7;

            color: #166534;

            border:
                1px solid #bbf7d0;
        }


        .alert-danger {

            background: #fee2e2;

            color: #991b1b;

            border:
                1px solid #fecaca;
        }


        /* =====================================================
           FOOTER
        ===================================================== */

        .footer {

            padding:
                20px 30px;

            color: #9ca3af;

            font-size: 12px;

            text-align: center;
        }


        /* =====================================================
           OVERLAY MOBILE
        ===================================================== */

        .sidebar-overlay {

            display: none;

            position: fixed;

            inset: 0;

            background:
                rgba(0,0,0,.45);

            z-index: 999;
        }


        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (max-width: 1100px) {

            .stat-grid {

                grid-template-columns:
                    repeat(2, 1fr);
            }

        }


        @media (max-width: 800px) {

            .sidebar {

                transform:
                    translateX(-100%);

                transition:
                    transform .25s ease;
            }


            .sidebar.open {

                transform:
                    translateX(0);
            }


            .sidebar-overlay.open {

                display: block;
            }


            .main {

                width: 100%;

                margin-left: 0;
            }


            .mobile-menu {

                display: flex;

                align-items: center;

                justify-content: center;
            }


            .topbar {

                padding:
                    0 18px;
            }


            .content {

                padding: 20px;
            }


            .topbar-user-info {

                display: none;
            }

        }


        @media (max-width: 600px) {

            .stat-grid {

                grid-template-columns:
                    1fr;
            }


            .content {

                padding: 15px;
            }


            .page-header {

                align-items: flex-start;

                flex-direction: column;
            }


            .page-header h1 {

                font-size: 23px;
            }


            .content-card {

                padding: 17px;
            }

        }

    </style>

</head>


<body>


<div class="app">


    {{-- =====================================================
         SIDEBAR
    ====================================================== --}}

    <aside class="sidebar" id="sidebar">


        {{-- LOGO --}}

        <div class="brand">

            <div class="brand-icon">
                🅿️
            </div>

            <div class="brand-text">

                <div class="brand-title">
                    PARKIRKU
                </div>

                <div class="brand-subtitle">
                    Sistem Parkir
                </div>

            </div>

        </div>


        {{-- PROFILE --}}

        @auth

            <div class="sidebar-profile">

                <div class="profile-box">

                    <div class="profile-avatar">

                        {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}

                    </div>


                    <div class="profile-info">

                        <div class="profile-name">

                            {{ auth()->user()->name }}

                        </div>

                        <div class="profile-role">

                            {{ auth()->user()->role }}

                        </div>

                    </div>

                </div>

            </div>

        @endauth


        {{-- MENU --}}

        <div class="sidebar-menu">


            {{-- =================================================
                 SEMUA ROLE
            ================================================== --}}

            <div class="menu-title">
                Menu Utama
            </div>


            <div class="menu">

                <a
                    href="{{ route('dashboard') }}"
                    class="{{ request()->routeIs('dashboard') ? 'active' : '' }}"
                >

                    <span class="menu-icon">
                        🏠
                    </span>

                    <span class="menu-text">
                        Dashboard
                    </span>

                </a>

            </div>


            {{-- =================================================
                 ADMIN
            ================================================== --}}

            @if(auth()->check() && auth()->user()->role === 'admin')

                <div class="menu-title">
                    Pengelolaan
                </div>


                <div class="menu">


                    <a
                        href="{{ route('admin.kendaraan') }}"
                        class="{{ request()->routeIs('admin.kendaraan*') ? 'active' : '' }}"
                    >

                        <span class="menu-icon">
                            🚗
                        </span>

                        <span class="menu-text">
                            Kendaraan
                        </span>

                    </a>


                    <a
                        href="{{ route('admin.parkir') }}"
                        class="{{ request()->routeIs('admin.parkir') ? 'active' : '' }}"
                    >

                        <span class="menu-icon">
                            🅿️
                        </span>

                        <span class="menu-text">
                            Data Parkir
                        </span>

                    </a>


                    <a
                        href="{{ route('admin.tarif') }}"
                        class="{{ request()->routeIs('admin.tarif') ? 'active' : '' }}"
                    >

                        <span class="menu-icon">
                            💰
                        </span>

                        <span class="menu-text">
                            Tarif Parkir
                        </span>

                    </a>

                </div>


                <div class="menu-title">
                    Laporan
                </div>


                <div class="menu">

                    <a
                        href="{{ route('admin.laporan') }}"
                        class="{{ request()->routeIs('admin.laporan') ? 'active' : '' }}"
                    >

                        <span class="menu-icon">
                            📊
                        </span>

                        <span class="menu-text">
                            Laporan Parkir
                        </span>

                    </a>

                </div>


                <div class="menu-title">
                    Sistem
                </div>


                <div class="menu">

                    <a
                        href="{{ route('admin.pengguna') }}"
                        class="{{ request()->routeIs('admin.pengguna') ? 'active' : '' }}"
                    >

                        <span class="menu-icon">
                            👥
                        </span>

                        <span class="menu-text">
                            Pengguna
                        </span>

                    </a>


                    <a
                        href="{{ route('admin.pengaturan') }}"
                        class="{{ request()->routeIs('admin.pengaturan') ? 'active' : '' }}"
                    >

                        <span class="menu-icon">
                            ⚙️
                        </span>

                        <span class="menu-text">
                            Pengaturan
                        </span>

                    </a>

                </div>

            @endif


            {{-- =================================================
                 PETUGAS
            ================================================== --}}

            @if(auth()->check() && auth()->user()->role === 'petugas')

                <div class="menu-title">
                    Operasional
                </div>


                <div class="menu">


                    <a
                        href="{{ route('petugas.kendaraan') }}"
                        class="{{ request()->routeIs('petugas.kendaraan') ? 'active' : '' }}"
                    >

                        <span class="menu-icon">
                            🚗
                        </span>

                        <span class="menu-text">
                            Kendaraan
                        </span>

                    </a>


                    <a
                        href="{{ route('petugas.parkir') }}"
                        class="{{ request()->routeIs('petugas.parkir') ? 'active' : '' }}"
                    >

                        <span class="menu-icon">
                            🅿️
                        </span>

                        <span class="menu-text">
                            Data Parkir
                        </span>

                    </a>


                    <a
                        href="{{ route('petugas.tarif') }}"
                        class="{{ request()->routeIs('petugas.tarif') ? 'active' : '' }}"
                    >

                        <span class="menu-icon">
                            💰
                        </span>

                        <span class="menu-text">
                            Tarif Parkir
                        </span>

                    </a>

                </div>


                <div class="menu-title">
                    Laporan
                </div>


                <div class="menu">

                    <a
                        href="{{ route('petugas.laporan') }}"
                        class="{{ request()->routeIs('petugas.laporan') ? 'active' : '' }}"
                    >

                        <span class="menu-icon">
                            📊
                        </span>

                        <span class="menu-text">
                            Laporan Parkir
                        </span>

                    </a>

                </div>

            @endif


            {{-- =================================================
                 OWNER
            ================================================== --}}

            @if(auth()->check() && auth()->user()->role === 'owner')

                <div class="menu-title">
                    Monitoring
                </div>


                <div class="menu">

                    <a
                        href="{{ route('owner.laporan') }}"
                        class="{{ request()->routeIs('owner.laporan') ? 'active' : '' }}"
                    >

                        <span class="menu-icon">
                            📊
                        </span>

                        <span class="menu-text">
                            Laporan Parkir
                        </span>

                    </a>


                    <a
                        href="{{ route('owner.pendapatan') }}"
                        class="{{ request()->routeIs('owner.pendapatan') ? 'active' : '' }}"
                    >

                        <span class="menu-icon">
                            💰
                        </span>

                        <span class="menu-text">
                            Pendapatan
                        </span>

                    </a>

                </div>

            @endif


            {{-- =================================================
                 LOGOUT
            ================================================== --}}

            @auth

                <div class="logout-wrapper">

                    <form
                        method="POST"
                        action="{{ route('logout') }}"
                    >

                        @csrf

                        <button
                            type="submit"
                            class="logout-button"
                        >

                            <span class="menu-icon">
                                🚪
                            </span>

                            <span class="menu-text">
                                Logout
                            </span>

                        </button>

                    </form>

                </div>

            @endauth


        </div>

    </aside>


    {{-- MOBILE OVERLAY --}}

    <div
        class="sidebar-overlay"
        id="sidebarOverlay"
        onclick="closeSidebar()"
    ></div>


    {{-- =====================================================
         MAIN
    ====================================================== --}}

    <main class="main">


        {{-- TOPBAR --}}

        <header class="topbar">


            <div class="topbar-left">


                <button
                    class="mobile-menu"
                    onclick="openSidebar()"
                    type="button"
                >
                    ☰
                </button>


                <div>

                    <div class="topbar-title">

                        @yield('page-title', 'Dashboard')

                    </div>

                    <div class="topbar-subtitle">

                        Sistem Informasi Parkir

                    </div>

                </div>

            </div>


            {{-- USER --}}

            @auth

                <div class="topbar-right">

                    <div class="topbar-user">


                        <div class="topbar-user-info">

                            <div class="topbar-user-name">

                                {{ auth()->user()->name }}

                            </div>

                            <div class="topbar-user-role">

                                {{ auth()->user()->role }}

                            </div>

                        </div>


                        <div class="topbar-avatar">

                            {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}

                        </div>


                    </div>

                </div>

            @endauth


        </header>


        {{-- =================================================
             CONTENT
        ================================================== --}}

        <section class="content">


            {{-- SUCCESS MESSAGE --}}

            @if(session('success'))

                <div class="alert alert-success">

                    ✓ {{ session('success') }}

                </div>

            @endif


            {{-- ERROR MESSAGE --}}

            @if(session('error'))

                <div class="alert alert-danger">

                    {{ session('error') }}

                </div>

            @endif


            {{-- VALIDATION ERRORS --}}

            @if($errors->any())

                <div class="alert alert-danger">

                    <strong>
                        Terjadi kesalahan:
                    </strong>


                    <ul style="
                        margin: 7px 0 0 20px;
                        padding: 0;
                    ">

                        @foreach($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif


            {{-- ISI HALAMAN --}}

            @yield('content')


        </section>


        {{-- FOOTER --}}

        <footer class="footer">

            © {{ date('Y') }} Sistem Parkir —
            ParkirKu

        </footer>


    </main>

</div>


{{-- =========================================================
     JAVASCRIPT SIDEBAR MOBILE
========================================================= --}}

<script>

    function openSidebar() {

        const sidebar =
            document.getElementById('sidebar');

        const overlay =
            document.getElementById('sidebarOverlay');

        sidebar.classList.add('open');

        overlay.classList.add('open');

    }


    function closeSidebar() {

        const sidebar =
            document.getElementById('sidebar');

        const overlay =
            document.getElementById('sidebarOverlay');

        sidebar.classList.remove('open');

        overlay.classList.remove('open');

    }


    window.addEventListener('resize', function () {

        if (window.innerWidth > 800) {

            closeSidebar();

        }

    });

</script>


</body>

</html>