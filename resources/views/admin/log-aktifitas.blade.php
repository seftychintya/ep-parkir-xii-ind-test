<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Log Aktivitas - Sistem Parkir</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #06100b;
            color: white;
        }

        .page {
            max-width: 1400px;
            margin: auto;
            padding: 35px;
        }

        .header {
            margin-bottom: 25px;
        }

        h1 {
            margin: 0;
            font-size: 30px;
        }

        .subtitle {
            color: #86efac;
            margin-top: 8px;
        }

        .card {
            background: #0b1912;
            border: 1px solid #14532d;
            border-radius: 18px;
            overflow: hidden;
        }

        .card-header {
            padding: 20px 25px;
            border-bottom: 1px solid #14532d;
        }

        .card-header h2 {
            margin: 0;
            color: #dcfce7;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            padding: 16px 20px;
            background: #0f2418;
            color: #86efac;
            font-size: 13px;
        }

        td {
            padding: 16px 20px;
            border-top: 1px solid #12351f;
            color: #e5e7eb;
        }

        tbody tr:hover {
            background: #0d2116;
        }

        .badge {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 999px;
            background: #064e3b;
            color: #a7f3d0;
            font-size: 12px;
        }

        .empty {
            text-align: center;
            padding: 50px;
            color: #86efac;
        }

        .back {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 16px;
            border-radius: 8px;
            background: #14532d;
            color: white;
            text-decoration: none;
        }
    </style>
</head>

<body>

<div class="page">

    <div class="header">
        <h1>📋 Log Aktivitas</h1>

        <div class="subtitle">
            Riwayat aktivitas pengguna dalam sistem parkir.
        </div>
    </div>

    <div class="card">

        <div class="card-header">
            <h2>Riwayat Aktivitas</h2>
        </div>

        <div class="table-wrapper">

            <table>

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Waktu</th>
                        <th>Pengguna</th>
                        <th>Aktivitas</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($logs as $log)

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>

                            <td>
                                {{ $log->waktu_aktivitas
                                    ? $log->waktu_aktivitas->format('d-m-Y H:i:s')
                                    : '-' }}
                            </td>

                            <td>

                                <span class="badge">
                                    {{ $log->user->name ?? 'User #' . $log->id_user }}
                                </span>

                            </td>

                            <td>
                                {{ $log->aktivitas }}
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="4" class="empty">
                                📭 Belum ada aktivitas.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

    <a href="{{ route('admin.dashboard') }}" class="back">
        ← Kembali ke Dashboard
    </a>

</div>

</body>
</html>