
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Data Tarif | E-PARKIR XII IND</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --bg: #08130d;
            --sidebar: #0b1911;
            --card: #102219;
            --card-hover: #142a1d;
            --border: rgba(143, 190, 155, .13);
            --green: #78bd8b;
            --light: #a5d9b1;
            --text: #e5eee7;
            --muted: #9aada0;
        }

        body {
            min-height: 100vh;
            background:
                radial-gradient(circle at 80% 10%,
                    rgba(95, 160, 110, .07),
                    transparent 35%),
                var(--bg);
            color: var(--text);
            font-family: 'Poppins', sans-serif;
        }

        /* SIDEBAR */

        .sidebar {
            width: 255px;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            padding: 28px 18px;
            background: var(--sidebar);
            border-right: 1px solid var(--border);
            overflow-y: auto;
            z-index: 100;
            transition: transform .3s ease;
        }

        .sidebar.closed {
            transform: translateX(-100%);
        }

        .logo {
            padding: 8px 12px 28px;
            margin-bottom: 28px;
            border-bottom: 1px solid var(--border);
        }

        .logo h2 {
            color: var(--green);
            font-family: 'Orbitron', sans-serif;
            font-size: 18px;
            letter-spacing: 1px;
        }

        .logo p {
            margin-top: 7px;
            color: var(--muted);
            font-size: 10px;
            letter-spacing: 2px;
        }

        .menu-title {
            color: #829b89;
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
            border: 1px solid transparent;
            border-radius: 9px;
            color: #c8d9cd;
            text-decoration: none;
            font-size: 13px;
            transition: .2s;
        }

        .menu:hover,
        .menu.active {
            background: rgba(120, 189, 139, .12);
            border-color: rgba(120, 189, 139, .22);
            color: var(--light);
        }

        .menu-icon {
            width: 22px;
            text-align: center;
            font-size: 17px;
        }

        .logout {
            width: 100%;
            background: transparent;
            text-align: left;
            cursor: pointer;
            font: inherit;
            color: #e6a3a3;
        }

        .logout:hover {
            background: rgba(239, 68, 68, .08);
            border-color: rgba(239, 68, 68, .18);
        }

        /* TOMBOL SIDEBAR */

        .toggle-btn {
            position: fixed;
            top: 18px;
            left: 270px;
            z-index: 110;
            width: 40px;
            height: 40px;
            border: 1px solid var(--border);
            border-radius: 9px;
            background: var(--card);
            color: var(--light);
            font-size: 20px;
            cursor: pointer;
            transition: left .3s ease;
        }

        .toggle-btn.closed {
            left: 18px;
        }

        /* CONTENT */

        .content {
            min-height: 100vh;
            margin-left: 255px;
            padding: 35px;
            transition: margin-left .3s ease;
        }

        .content.expanded {
            margin-left: 0;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 32px;
            padding-left: 48px;
        }

        .page-title h1 {
            font-family: 'Orbitron', sans-serif;
            font-size: 23px;
            color: #d2e9d8;
        }

        .page-title p {
            color: var(--muted);
            font-size: 12px;
            margin-top: 8px;
        }

        .user {
            padding: 11px 17px;
            border: 1px solid var(--border);
            border-radius: 10px;
            background: rgba(120, 189, 139, .07);
            color: var(--light);
            font-size: 12px;
        }

        /* CARD */

        .card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 25px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, .13);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 22px;
        }

        .card-header h2 {
            font-size: 17px;
            color: #d6e8da;
            font-weight: 600;
        }

        /* BUTTON */

        .btn {
            display: inline-block;
            text-decoration: none;
            border: none;
            cursor: pointer;
            padding: 10px 15px;
            border-radius: 8px;
            font-family: 'Poppins', sans-serif;
            font-size: 12px;
            font-weight: 600;
            transition: .2s;
        }

        .btn-add {
            background: #78bd8b;
            color: #08130d;
        }

        .btn-add:hover {
            background: #a5d9b1;
        }

        .btn-edit {
            background: #315b91;
            color: white;
        }

        .btn-edit:hover {
            background: #264a78;
        }

        .btn-delete {
            background: #8c3939;
            color: white;
        }

        .btn-delete:hover {
            background: #702d2d;
        }

        /* TABLE */

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 600px;
        }

        thead {
            background: rgba(120, 189, 139, .09);
        }

        th {
            padding: 15px;
            text-align: left;
            color: #a7c4ae;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: .5px;
        }

        td {
            padding: 16px 15px;
            border-top: 1px solid var(--border);
            color: #d5e5de;
            font-size: 13px;
        }

        tbody tr {
            transition: .2s;
        }

        tbody tr:hover {
            background: var(--card-hover);
        }

        .number {
            color: var(--muted);
            width: 70px;
        }

        .jenis {
            font-weight: 600;
            color: var(--text);
        }

        .harga {
            color: var(--light);
            font-weight: 700;
        }

        .actions {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .actions form {
            margin: 0;
        }

        /* ALERT */

        .alert {
            background: rgba(120, 189, 139, .10);
            border: 1px solid rgba(120, 189, 139, .25);
            color: var(--light);
            padding: 13px 16px;
            border-radius: 9px;
            margin-bottom: 20px;
            font-size: 13px;
        }

        .empty {
            text-align: center;
            padding: 40px;
            color: var(--muted);
        }

        /* RESPONSIVE */

        @media(max-width: 700px) {
            .content {
                margin-left: 0;
                padding: 85px 16px 22px;
            }

            .topbar {
                align-items: flex-start;
                flex-direction: column;
                padding-left: 0;
            }

            .card {
                padding: 17px;
            }

            .card-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .toggle-btn {
                left: 18px;
            }

            .toggle-btn.closed {
                left: 18px;
            }
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->

    <aside class="sidebar" id="sidebar">

        <div class="logo">
            <h2>MAHZAFY-EE</h2>
            <p>PARKIR XII IND</p>
        </div>

        <div class="menu-title">MENU UTAMA</div>

        <a href="{{ route('admin.dashboard') }}" class="menu">
            <span class="menu-icon">▦</span>
            Dashboard
        </a>

        <a href="{{ route('admin.users.index') }}" class="menu">
            <span class="menu-icon">♙</span>
            Pengguna
        </a>

        <a href="{{ route('admin.kendaraan.index') }}" class="menu">
            <span class="menu-icon">▣</span>
            Kendaraan
        </a>

        <a href="{{ route('admin.tarif.index') }}" class="menu active">
            <span class="menu-icon">Rp</span>
            Tarif Parkir
        </a>

        <a href="{{ route('admin.area.index') }}" class="menu">
            <span class="menu-icon">▤</span>
            Area Parkir
        </a>

        <a href="{{ route('admin.log-aktifitas') }}" class="menu">
            <span class="menu-icon">☷</span>
            Log Aktivitas
        </a>

        <div class="menu-title">AKUN</div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="menu logout">
                <span class="menu-icon">↪</span>
                Logout
            </button>
        </form>

    </aside>

    <!-- TOGGLE SIDEBAR -->

    <button type="button" class="toggle-btn" id="toggleBtn"
            aria-label="Buka atau tutup menu">
        ☰
    </button>

    <!-- CONTENT -->

    <main class="content" id="content">

        <div class="topbar">

            <div class="page-title">
                <h1>Data Tarif Parkir</h1>
                <p>Kelola tarif parkir kendaraan E-PARKIR XII IND</p>
            </div>

            <div class="user">
                ♙ {{ Auth::user()->name ?? 'Administrator' }}
            </div>

        </div>

        @if(session('success'))
            <div class="alert">
                ✓ {{ session('success') }}
            </div>
        @endif

        <div class="card">

            <div class="card-header">
                <h2>Daftar Tarif Parkir</h2>

                <a href="{{ route('admin.tarif.create') }}"
                   class="btn btn-add">
                    + Tambah Tarif
                </a>
            </div>

            <div class="table-wrapper">

                <table>

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Jenis Kendaraan</th>
                            <th>Tarif / Jam</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($tarif as $item)

                            <tr>
                                <td class="number">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="jenis">
                                    {{ $item->jenis }}
                                </td>

                                <td class="harga">
                                    Rp {{ number_format($item->tarif_per_jam, 0, ',', '.') }}
                                </td>

                                <td>
                                    <div class="actions">

                                        <a href="{{ route('admin.tarif.edit', $item->id) }}"
                                           class="btn btn-edit">
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.tarif.destroy', $item->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus tarif ini?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-delete">
                                                Hapus
                                            </button>

                                        </form>

                                    </div>
                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="4" class="empty">
                                    Belum ada data tarif.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </main>

    <script>
        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('content');
        const toggleBtn = document.getElementById('toggleBtn');

        function setSidebarState(closed) {
            sidebar.classList.toggle('closed', closed);
            content.classList.toggle('expanded', closed);
            toggleBtn.classList.toggle('closed', closed);

            toggleBtn.textContent = closed ? '☰' : '✕';

            localStorage.setItem('adminSidebarClosed', closed ? '1' : '0');
        }

        // Pulihkan kondisi sidebar saat halaman dibuka
        const savedState = localStorage.getItem('adminSidebarClosed');
        setSidebarState(savedState === '1');

        toggleBtn.addEventListener('click', function () {
            setSidebarState(!sidebar.classList.contains('closed'));
        });

        // Tutup sidebar setelah memilih menu
        document.querySelectorAll('.sidebar a.menu').forEach(function (link) {
            link.addEventListener('click', function () {
                setSidebarState(true);
            });
        });
    </script>

</body>
</html>
