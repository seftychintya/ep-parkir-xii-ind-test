
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin | E-PARKIR XII IND</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        :root {
            --bg: #07130f;
            --sidebar: #08140f;
            --card: #0d1c15;
            --border: rgba(22,135,101,.25);
            --green: #168765;
            --green-soft: #287f62;
            --green-light: #62b99a;
            --green-dark: #105c45;
            --text: #e5eee8;
            --muted: #91a69a;
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
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: var(--sidebar);
            border-right: 1px solid var(--border);
            padding: 28px 18px;
        }

        .brand {
            font-size: 19px;
            font-weight: 800;
            color: var(--green-light);
            margin-bottom: 8px;
        }

        .brand-sub {
            color: var(--muted);
            font-size: 11px;
            margin-bottom: 40px;
        }

        .menu-title {
            color: var(--muted);
            font-size: 11px;
            margin: 22px 12px 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .menu a {
            display: block;
            text-decoration: none;
            color: var(--muted);
            padding: 13px 15px;
            border-radius: 10px;
            margin-bottom: 7px;
            font-size: 13px;
            transition: .2s;
        }

        .menu a:hover,
        .menu a.active {
            background: rgba(22,135,101,.17);
            color: var(--green-light);
        }

        .main {
            margin-left: 250px;
            padding: 35px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
            gap: 15px;
        }

        .topbar h1 {
            font-size: 25px;
            font-weight: 700;
        }

        .topbar p {
            color: var(--muted);
            font-size: 12px;
            margin-top: 5px;
        }

        .admin-label {
            border: 1px solid var(--border);
            background: var(--card);
            padding: 10px 16px;
            border-radius: 12px;
            color: var(--green-light);
            font-size: 12px;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
            margin-bottom: 22px;
        }

        .stat-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 23px;
            transition: .2s;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            border-color: var(--green);
        }

        .stat-title {
            color: var(--muted);
            font-size: 12px;
        }

        .stat-value {
            font-size: 30px;
            font-weight: 700;
            margin-top: 13px;
        }

        .stat-note {
            color: var(--green-light);
            font-size: 11px;
            margin-top: 8px;
        }

        .content-grid {
            display: grid;
            grid-template-columns: 1.6fr 1fr;
            gap: 18px;
        }

        .panel {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 24px;
            min-width: 0;
        }

        .panel-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 22px;
            gap: 12px;
        }

        .panel-header h2 {
            font-size: 15px;
            font-weight: 600;
        }

        .panel-header span {
            color: var(--muted);
            font-size: 10px;
        }

        .chart-container {
            height: 280px;
            position: relative;
        }

        .trend-value {
            font-size: 35px;
            font-weight: 700;
            margin: 15px 0 5px;
        }

        .trend-label {
            color: var(--muted);
            font-size: 12px;
        }

        .trend-status {
            display: inline-block;
            margin-top: 18px;
            padding: 7px 12px;
            border-radius: 8px;
            background: rgba(22,135,101,.15);
            color: var(--green-light);
            font-size: 11px;
        }

        .footer {
            color: var(--muted);
            font-size: 10px;
            text-align: center;
            margin-top: 35px;
        }

        @media(max-width: 950px) {
            .sidebar {
                width: 200px;
            }

            .main {
                margin-left: 200px;
                padding: 25px;
            }

            .content-grid {
                grid-template-columns: 1fr;
            }
        }

        @media(max-width: 650px) {
            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
            }

            .main {
                margin-left: 0;
                padding: 20px;
            }

            .stats {
                grid-template-columns: 1fr;
            }

            .topbar {
                align-items: flex-start;
                flex-direction: column;
            }
        }
    </style>
</head>

<body>

<aside class="sidebar">
    <div class="brand">E-PARKIR XII IND</div>
    <div class="brand-sub">ADMIN MANAGEMENT SYSTEM</div>

    <div class="menu-title">Menu Utama</div>

    <nav class="menu">
        <a href="{{ route('admin.dashboard') }}" class="active">▦ Dashboard</a>
        <a href="{{ route('admin.users.index') }}">♙ Data Pengguna</a>
        <a href="{{ route('admin.tarif.index') }}">◈ Data Tarif</a>
        <a href="{{ route('admin.area.index') }}">▤ Area Parkir</a>
        <a href="{{ route('admin.kendaraan.index') }}">▣ Data Kendaraan</a>
        <a href="{{ route('admin.log-aktifitas') }}">◷ Log Aktivitas</a>
    </nav>

    <div class="menu-title">Akun</div>

    <nav class="menu">
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            ⇥ Keluar
        </a>
    </nav>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
        @csrf
    </form>
</aside>

<main class="main">

    <header class="topbar">
        <div>
            <h1>Dashboard Admin</h1>
            <p>Selamat datang di sistem pengelolaan parkir E-PARKIR XII IND.</p>
        </div>

        <div class="admin-label">ADMINISTRATOR</div>
    </header>

    <section class="stats">

        <div class="stat-card">
            <div class="stat-title">Total Kendaraan Terdaftar</div>
            <div class="stat-value">{{ number_format($totalKendaraan) }}</div>
            <div class="stat-note">Data seluruh kendaraan</div>
        </div>

        <div class="stat-card">
            <div class="stat-title">Kendaraan Sedang Parkir</div>
            <div class="stat-value">{{ number_format($parkirAktif) }}</div>
            <div class="stat-note">Kendaraan berstatus masuk</div>
        </div>

        <div class="stat-card">
            <div class="stat-title">Jenis Tarif Tersedia</div>
            <div class="stat-value">{{ number_format($totalTarif) }}</div>
            <div class="stat-note">Data tarif parkir</div>
        </div>

    </section>

    <section class="content-grid">

        <div class="panel">
            <div class="panel-header">
                <h2>Grafik Aktivitas Kendaraan</h2>
                <span>Aktivitas 1 jam terakhir</span>
            </div>

            <div class="chart-container">
                <canvas id="parkingChart"></canvas>
            </div>
        </div>

        <div class="panel">
            <div class="panel-header">
                <h2>Statistik Parkir</h2>
                <span>Perbandingan mingguan</span>
            </div>

            <div class="trend-label">Total kendaraan 7 hari terakhir</div>
            <div class="trend-value">{{ number_format($parkirMingguIni) }}</div>
            <div class="trend-label">Dibandingkan 7 hari sebelumnya</div>

            <div class="trend-status">
                @if($trenParkir === 'naik')
                    ↑ Naik {{ $persentaseParkir }}%
                @elseif($trenParkir === 'turun')
                    ↓ Turun {{ abs($persentaseParkir) }}%
                @else
                    — Tidak ada perubahan
                @endif
            </div>
        </div>

    </section>

    <div class="footer">
        © {{ date('Y') }} E-PARKIR XII IND — Admin Dashboard
    </div>

</main>

<script>
    const labels = @json($grafikLabels);
    const dataMasuk = @json($grafikMasuk);
    const dataKeluar = @json($grafikKeluar);

    const ctx = document.getElementById('parkingChart');

    new Chart(ctx, {
        type: 'line',

        data: {
            labels: labels,

            datasets: [
                {
                    label: 'Kendaraan Masuk',
                    data: dataMasuk,
                    borderColor: '#168765',
                    backgroundColor: 'rgba(22,135,101,.12)',
                    borderWidth: 3,
                    tension: 0.4,
                    fill: true,
                    pointRadius: 4,
                    pointHoverRadius: 6
                },
                {
                    label: 'Kendaraan Keluar',
                    data: dataKeluar,
                    borderColor: '#62b99a',
                    backgroundColor: 'rgba(98,185,154,.08)',
                    borderWidth: 3,
                    tension: 0.4,
                    fill: true,
                    pointRadius: 4,
                    pointHoverRadius: 6
                }
            ]
        },

        options: {
            responsive: true,
            maintainAspectRatio: false,

            interaction: {
                intersect: false,
                mode: 'index'
            },

            plugins: {
                legend: {
                    labels: {
                        color: '#91a69a',
                        usePointStyle: true,
                        padding: 20,
                        font: {
                            family: 'Poppins',
                            size: 11
                        }
                    }
                }
            },

            scales: {
                x: {
                    grid: {
                        color: 'rgba(145,166,154,.08)'
                    },
                    ticks: {
                        color: '#91a69a',
                        maxTicksLimit: 7
                    }
                },

                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0,
                        color: '#91a69a'
                    },
                    grid: {
                        color: 'rgba(145,166,154,.08)'
                    }
                }
            }
        }
    });
</script>

</body>
</html>
