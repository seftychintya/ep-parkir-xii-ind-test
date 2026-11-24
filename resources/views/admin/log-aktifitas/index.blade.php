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
            background: #06100b !important;
            color: #ffffff;
        }

        .page {
            min-height: 100vh;
            padding: 35px;
        }

        .container {
            max-width: 1250px;
            margin: auto;
        }

        /* HEADER */
        .header {
            margin-bottom: 30px;
        }

        .title {
            margin: 0;
            font-size: 30px;
            font-weight: bold;
        }

        .subtitle {
            margin-top: 8px;
            color: #94a3b8;
        }

        /* CARD */
        .card {
            background: #0b1912 !important;
            border: 1px solid #153d29;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 15px 40px rgba(0, 0, 0, .35);
        }

        /* TABLE */
        .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #10271a;
            color: #86efac;
            text-align: left;
            padding: 17px;
            font-size: 14px;
            white-space: nowrap;
        }

        td {
            padding: 17px;
            border-top: 1px solid #153d29;
            color: #e5e7eb;
            vertical-align: middle;
        }

        tr:hover td {
            background: #0d2116;
        }

        /* USER */
        .user-name {
            font-weight: bold;
            color: #ffffff;
        }

        .username {
            margin-top: 4px;
            font-size: 13px;
            color: #94a3b8;
        }

        /* BADGE */
        .badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: bold;
        }

        .badge-login {
            background: #064e3b;
            color: #6ee7b7;
        }

        .badge-logout {
            background: #3f1d1d;
            color: #fca5a5;
        }

        .badge-create {
            background: #172554;
            color: #93c5fd;
        }

        .badge-update {
            background: #422006;
            color: #fdba74;
        }

        .badge-delete {
            background: #450a0a;
            color: #fca5a5;
        }

        .badge-default {
            background: #1f2937;
            color: #d1d5db;
        }

        /* EMPTY */
        .empty {
            text-align: center;
            padding: 60px 20px;
            color: #94a3b8;
        }

        .empty-icon {
            font-size: 50px;
            margin-bottom: 12px;
        }

        /* TIME */
        .time {
            color: #cbd5e1;
            white-space: nowrap;
        }

        .date {
            color: #86efac;
            font-weight: bold;
        }

        @media (max-width: 700px) {

            .page {
                padding: 20px;
            }

            .title {
                font-size: 24px;
            }

            th,
            td {
                padding: 12px;
            }
        }
    </style>
</head>

<body>

<div class="page">

    <div class="container">

        <!-- HEADER -->
        <div class="header">

            <h1 class="title">
                📋 Log Aktivitas
            </h1>

            <div class="subtitle">
                Riwayat aktivitas pengguna dalam sistem parkir
            </div>

        </div>


        <!-- CARD -->
        <div class="card">

            <div class="table-wrapper">

                <table>

                    <thead>

                        <tr>
                            <th>No</th>
                            <th>Pengguna</th>
                            <th>Aktivitas</th>
                            <th>Deskripsi</th>
                            <th>Waktu</th>
                        </tr>

                    </thead>


                    <tbody>

                    @forelse($logs as $log)

                        <tr>

                            <!-- NO -->
                            <td>
                                {{ $loop->iteration }}
                            </td>


                            <!-- USER -->
                            <td>

                                @if(isset($log->user))

                                    <div class="user-name">
                                        {{ $log->user->name }}
                                    </div>

                                    @if(isset($log->user->username))
                                        <div class="username">
                                            {{ '@' . $log->user->username }}
                                        </div>
                                    @endif

                                @elseif(isset($log->username))

                                    <div class="user-name">
                                        {{ $log->username }}
                                    </div>

                                @else

                                    <span style="color:#94a3b8;">
                                        Sistem
                                    </span>

                                @endif

                            </td>


                            <!-- AKTIVITAS -->
                            <td>

                                @php
                                    $activity = strtolower(
                                        $log->aktivitas
                                        ?? $log->action
                                        ?? $log->aksi
                                        ?? '-'
                                    );
                                @endphp


                                @if(str_contains($activity, 'login'))

                                    <span class="badge badge-login">
                                        🔓 Login
                                    </span>

                                @elseif(str_contains($activity, 'logout'))

                                    <span class="badge badge-logout">
                                        🔒 Logout
                                    </span>

                                @elseif(
                                    str_contains($activity, 'tambah') ||
                                    str_contains($activity, 'create') ||
                                    str_contains($activity, 'insert')
                                )

                                    <span class="badge badge-create">
                                        ➕ Tambah
                                    </span>

                                @elseif(
                                    str_contains($activity, 'ubah') ||
                                    str_contains($activity, 'update') ||
                                    str_contains($activity, 'edit')
                                )

                                    <span class="badge badge-update">
                                        ✏️ Ubah
                                    </span>

                                @elseif(
                                    str_contains($activity, 'hapus') ||
                                    str_contains($activity, 'delete')
                                )

                                    <span class="badge badge-delete">
                                        🗑️ Hapus
                                    </span>

                                @else

                                    <span class="badge badge-default">
                                        📌 {{ $log->aktivitas ?? $log->action ?? $log->aksi ?? '-' }}
                                    </span>

                                @endif

                            </td>


                            <!-- DESKRIPSI -->
                            <td>

                                {{ $log->deskripsi
                                    ?? $log->description
                                    ?? $log->keterangan
                                    ?? '-' }}

                            </td>


                            <!-- WAKTU -->
                            <td class="time">

                                @if(isset($log->created_at))

                                    <div class="date">
                                        {{ $log->created_at->format('d/m/Y') }}
                                    </div>

                                    <div>
                                        {{ $log->created_at->format('H:i:s') }}
                                    </div>

                                @elseif(isset($log->waktu))

                                    {{ $log->waktu }}

                                @else

                                    -

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5">

                                <div class="empty">

                                    <div class="empty-icon">
                                        📋
                                    </div>

                                    <div>
                                        Belum ada aktivitas yang tercatat.
                                    </div>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

</body>

</html>