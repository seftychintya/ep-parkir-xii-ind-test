
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Area Parkir | E-PARKIR XII IND</title>

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
                radial-gradient(circle at 80% 10%, rgba(95,160,110,.07), transparent 35%),
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
            z-index: 100;
            padding: 28px 18px;
            background: var(--sidebar);
            border-right: 1px solid var(--border);
            overflow-y: auto;
            transition: transform .25s ease;
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
            width: 100%;
            padding: 13px 14px;
            margin-bottom: 8px;
            border: 1px solid transparent;
            border-radius: 9px;
            color: #c8d9cd;
            text-decoration: none;
            font-size: 13px;
            font-family: 'Poppins', sans-serif;
            transition: .2s;
            cursor: pointer;
        }

        .menu:hover,
        .menu.active {
            background: rgba(120,189,139,.12);
            border-color: rgba(120,189,139,.22);
            color: var(--light);
        }

        .menu-icon {
            width: 22px;
            text-align: center;
            font-size: 17px;
        }

        .logout {
            background: transparent;
            color: #e6a3a3;
            text-align: left;
        }

        .logout:hover {
            background: rgba(239,68,68,.08);
            border-color: rgba(239,68,68,.18);
            color: #f1b1b1;
        }

        /* SIDEBAR TOGGLE */

        .sidebar-toggle {
            position: fixed;
            top: 22px;
            left: 270px;
            z-index: 110;
            width: 42px;
            height: 42px;
            border: 1px solid var(--border);
            border-radius: 10px;
            background: var(--card);
            color: var(--light);
            font-size: 21px;
            cursor: pointer;
            transition: left .25s ease;
        }

        body.sidebar-closed .sidebar {
            transform: translateX(-100%);
        }

        body.sidebar-closed .sidebar-toggle {
            left: 20px;
        }

        /* CONTENT */

        .content {
            min-height: 100vh;
            margin-left: 255px;
            padding: 35px;
            transition: margin-left .25s ease;
        }

        body.sidebar-closed .content {
            margin-left: 0;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin-bottom: 32px;
            padding-left: 45px;
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

        .user-box {
            padding: 11px 17px;
            border: 1px solid var(--border);
            border-radius: 10px;
            background: rgba(120,189,139,.07);
            color: var(--light);
            font-size: 12px;
        }

        /* CARD */

        .card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 25px;
            box-shadow: 0 8px 25px rgba(0,0,0,.13);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 22px;
        }

        .card-header h2 {
            color: #d6e8da;
            font-size: 17px;
        }

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
            background: #527e60;
            color: white;
        }

        .btn-add:hover {
            background: #659673;
        }

        /* TABLE */

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 650px;
        }

        thead {
            background: rgba(120,189,139,.08);
        }

        th {
            padding: 15px;
            text-align: left;
            color: #a5c2ac;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: .5px;
        }

        td {
            padding: 16px 15px;
            border-top: 1px solid var(--border);
            color: #d5e5da;
            font-size: 12px;
        }

        tbody tr {
            transition: .2s;
        }

        tbody tr:hover {
            background: var(--card-hover);
        }

        .number {
            color: var(--muted);
        }

        .nama {
            color: #e5eee7;
            font-weight: 600;
        }

        .kapasitas {
            color: var(--light);
            font-weight: 600;
        }

        .terisi {
            color: #d9c78c;
            font-weight: 600;
        }

        /* STATUS */

        .status {
            display: inline-block;
            padding: 6px 11px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 600;
        }

        .aktif {
            background: rgba(120,189,139,.13);
            color: #a5d9b1;
            border: 1px solid rgba(120,189,139,.2);
        }

        .nonaktif {
            background: rgba(220,120,120,.10);
            color: #e6a3a3;
            border: 1px solid rgba(220,120,120,.18);
        }

        /* ACTION */

        .actions {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .btn-edit {
            background: #405f87;
            color: white;
        }

        .btn-edit:hover {
            background: #5076a5;
        }

        .btn-delete {
            background: #804b4b;
            color: white;
        }

        .btn-delete:hover {
            background: #995858;
        }

        /* ALERT */

        .alert {
            background: rgba(120,189,139,.10);
            border: 1px solid rgba(120,189,139,.22);
            color: #a5d9b1;
            padding: 13px 16px;
            border-radius: 9px;
            margin-bottom: 20px;
            font-size: 12px;
        }

        .error {
            background: rgba(220,120,120,.10);
            border: 1px solid rgba(220,120,120,.2);
            color: #e6a3a3;
            padding: 13px 16px;
            border-radius: 9px;
            margin-bottom: 20px;
            font-size: 12px;
        }

        .empty {
            text-align: center;
            padding: 40px;
            color: var(--muted);
        }

        /* RESPONSIVE */

        @media(max-width: 700px) {
            .sidebar {
                width: 255px;
            }

            .content {
                margin-left: 0;
                padding: 85px 16px 25px;
            }

            .topbar {
                align-items: flex-start;
                flex-direction: column;
                padding-left: 0;
            }

            .sidebar-toggle {
                left: 20px;
            }

            body:not(.sidebar-closed) .sidebar {
                box-shadow: 15px 0 40px rgba(0,0,0,.35);
            }

            .card {
                padding: 17px;
            }

            .card-header {
                align-items: flex-start;
                flex-direction: column;
            }
        }
    </style>
</head>

<body>

<button type="button" class="sidebar-toggle" id="sidebarToggle"
        aria-label="Buka atau tutup menu">☰</button>

<aside class="sidebar">

    <div class="logo">
        <h2>MAHZAFY-EE</h2>
        <p>PARKIR XII IND</p>
    </div>

    <div class="menu-title">MENU UTAMA</div>

    <a href="{{ route('admin.dashboard') }}" class="menu">
        <span class="menu-icon">▦</span> Dashboard
    </a>

    <a href="{{ route('admin.users.index') }}" class="menu">
        <span class="menu-icon">♙</span> Pengguna
    </a>

    <a href="{{ route('admin.kendaraan.index') }}" class="menu">
        <span class="menu-icon">▣</span> Kendaraan
    </a>

    <a href="{{ route('admin.tarif.index') }}" class="menu">
        <span class="menu-icon">Rp</span> Tarif Parkir
    </a>

    <a href="{{ route('admin.area.index') }}" class="menu active">
        <span class="menu-icon">▤</span> Area Parkir
    </a>

    <a href="{{ route('admin.log-aktifitas') }}" class="menu">
        <span class="menu-icon">☷</span> Log Aktivitas
    </a>

    <div class="menu-title">AKUN</div>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="menu logout">
            <span class="menu-icon">↪</span> Logout
        </button>
    </form>

</aside>

<main class="content">

    <div class="topbar">
        <div class="page-title">
            <h1>Area Parkir</h1>
            <p>Kelola area dan kapasitas parkir E-PARKIR XII IND</p>
        </div>

        <div class="user-box">
            ♙ {{ Auth::user()->name ?? 'Administrator' }}
        </div>
    </div>

    @if(session('success'))
        <div class="alert">
            ✓ {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="error">
            @foreach($errors->all() as $error)
                <div>• {{ $error }}</div>
            @endforeach
        </div>
    @endif

    <div class="card">

        <div class="card-header">
            <h2>Daftar Area Parkir</h2>

            <a href="{{ route('admin.area.create') }}" class="btn btn-add">
                + Tambah Area
            </a>
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Area</th>
                        <th>Kapasitas</th>
                        <th>Terisi</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($area as $item)
                        <tr>
                            <td class="number">{{ $loop->iteration }}</td>

                            <td class="nama">{{ $item->nama_area }}</td>

                            <td class="kapasitas">
                                {{ $item->kapasitas }} Slot
                            </td>

                            <td class="terisi">
                                {{ $item->terisi }} Slot
                            </td>

                            <td>
                                @if($item->status === 'aktif')
                                    <span class="status aktif">AKTIF</span>
                                @else
                                    <span class="status nonaktif">NONAKTIF</span>
                                @endif
                            </td>

                            <td>
                                <div class="actions">
                                    <a href="{{ route('admin.area.edit', $item->id) }}"
                                       class="btn btn-edit">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.area.destroy', $item->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus area ini?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-delete">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="empty">
                                Belum ada data area parkir.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

</main>

<script>
    const toggleButton = document.getElementById('sidebarToggle');

    // Baca kondisi sidebar ketika halaman dibuka.
    if (sessionStorage.getItem('adminSidebarClosed') === 'yes') {
        document.body.classList.add('sidebar-closed');
    }

    toggleButton.addEventListener('click', function () {
        document.body.classList.toggle('sidebar-closed');

        if (document.body.classList.contains('sidebar-closed')) {
            sessionStorage.setItem('adminSidebarClosed', 'yes');
        } else {
            sessionStorage.setItem('adminSidebarClosed', 'no');
        }
    });

    // Sidebar otomatis tertutup setelah menu navigasi dipilih.
    document.querySelectorAll('.sidebar a.menu').forEach(function (link) {
        link.addEventListener('click', function () {
            sessionStorage.setItem('adminSidebarClosed', 'yes');
        });
    });
</script>

</body>
</html>
