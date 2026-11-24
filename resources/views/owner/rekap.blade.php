<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Rekap Parkir</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #07130f;
            color: #e8f5ef;
        }

        .container {
            width: 94%;
            max-width: 1400px;
            margin: 35px auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            gap: 15px;
        }

        .title h1 {
            margin: 0;
            font-size: 30px;
            color: #ffffff;
        }

        .title p {
            margin-top: 7px;
            color: #8fa99d;
        }

        .btn {
            border: none;
            border-radius: 10px;
            padding: 12px 18px;
            text-decoration: none;
            cursor: pointer;
            font-weight: bold;
            display: inline-block;
        }

        .btn-print {
            background: #18a558;
            color: white;
        }

        .btn-print:hover {
            background: #128344;
        }

        .card {
            background: #0c2119;
            border: 1px solid #183d2e;
            border-radius: 16px;
            padding: 22px;
            margin-bottom: 22px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.25);
        }

        .filter-form {
            display: grid;
            grid-template-columns: 1fr 1fr auto;
            gap: 15px;
            align-items: end;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #a9c0b5;
            font-size: 14px;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            border-radius: 9px;
            border: 1px solid #285541;
            background: #07130f;
            color: white;
            outline: none;
        }

        .form-group input:focus {
            border-color: #18a558;
        }

        .btn-filter {
            background: #18a558;
            color: white;
        }

        .btn-reset {
            background: #263d34;
            color: white;
            margin-left: 5px;
        }

        .summary {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 22px;
        }

        .summary-card {
            background: linear-gradient(135deg, #0d2a20, #102e23);
            border: 1px solid #1b4937;
            border-radius: 15px;
            padding: 22px;
        }

        .summary-label {
            color: #8fa99d;
            font-size: 14px;
            margin-bottom: 8px;
        }

        .summary-value {
            font-size: 28px;
            font-weight: bold;
            color: #ffffff;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #143a2b;
            color: #dff8eb;
            padding: 14px 12px;
            text-align: left;
            font-size: 13px;
        }

        td {
            padding: 14px 12px;
            border-bottom: 1px solid #183d2e;
            color: #d5e6de;
            font-size: 14px;
        }

        tr:hover td {
            background: #10291f;
        }

        .badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            background: #164d36;
            color: #75e6ad;
            font-size: 12px;
            font-weight: bold;
        }

        .empty {
            text-align: center;
            padding: 50px;
            color: #82988e;
        }

        .money {
            font-weight: bold;
            color: #67dfa1;
        }

        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                align-items: flex-start;
            }

            .filter-form {
                grid-template-columns: 1fr;
            }

            .summary {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <div class="header">

        <div class="title">
            <h1>📊 Rekap Parkir</h1>
            <p>Riwayat kendaraan yang telah selesai parkir</p>
        </div>

        <a
            href="{{ route('owner.rekap.cetak', [
                'tanggal_mulai' => $tanggalMulai,
                'tanggal_selesai' => $tanggalSelesai
            ]) }}"
            target="_blank"
            class="btn btn-print"
        >
            🖨️ Cetak Rekap
        </a>

    </div>


    {{-- FILTER --}}
    <div class="card">

        <form
            action="{{ route('owner.rekap') }}"
            method="GET"
            class="filter-form"
        >

            <div class="form-group">

                <label for="tanggal_mulai">
                    Tanggal Mulai
                </label>

                <input
                    type="date"
                    id="tanggal_mulai"
                    name="tanggal_mulai"
                    value="{{ $tanggalMulai }}"
                >

            </div>


            <div class="form-group">

                <label for="tanggal_selesai">
                    Tanggal Selesai
                </label>

                <input
                    type="date"
                    id="tanggal_selesai"
                    name="tanggal_selesai"
                    value="{{ $tanggalSelesai }}"
                >

            </div>


            <div>

                <button
                    type="submit"
                    class="btn btn-filter"
                >
                    🔍 Filter
                </button>

                <a
                    href="{{ route('owner.rekap') }}"
                    class="btn btn-reset"
                >
                    Reset
                </a>

            </div>

        </form>

    </div>


    {{-- SUMMARY --}}
    <div class="summary">

        <div class="summary-card">

            <div class="summary-label">
                Total Kendaraan
            </div>

            <div class="summary-value">
                {{ number_format($totalKendaraan, 0, ',', '.') }}
            </div>

        </div>


        <div class="summary-card">

            <div class="summary-label">
                Total Pendapatan
            </div>

            <div class="summary-value">
                Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
            </div>

        </div>

    </div>


    {{-- TABLE --}}
    <div class="card">

        <div class="table-wrapper">

            <table>

                <thead>

                <tr>
                    <th>No</th>
                    <th>Kode Tiket</th>
                    <th>Plat Nomor</th>
                    <th>Jenis</th>
                    <th>Slot</th>
                    <th>Jam Masuk</th>
                    <th>Jam Keluar</th>
                    <th>Durasi</th>
                    <th>Total Bayar</th>
                    <th>Status</th>
                </tr>

                </thead>

                <tbody>

                @forelse($parkir as $item)

                    <tr>

                        <td>
                            {{ $loop->iteration }}
                        </td>

                        <td>
                            {{ $item->kode_tiket ?? '-' }}
                        </td>

                        <td>
                            <strong>
                                {{ $item->kendaraan->plat_nomor ?? '-' }}
                            </strong>
                        </td>

                        <td>
                            {{ $item->kendaraan->jenis ?? '-' }}
                        </td>

                        <td>
                            {{ $item->slot ?? '-' }}
                        </td>

                        <td>
                            {{ $item->jam_masuk ? $item->jam_masuk->format('d/m/Y H:i') : '-' }}
                        </td>

                        <td>
                            {{ $item->jam_keluar ? $item->jam_keluar->format('d/m/Y H:i') : '-' }}
                        </td>

                        <td>
                            {{ $item->durasi ?? '-' }}
                        </td>

                        <td class="money">
                            Rp {{ number_format($item->total_bayar ?? 0, 0, ',', '.') }}
                        </td>

                        <td>
                            <span class="badge">
                                {{ ucfirst($item->status) }}
                            </span>
                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="10" class="empty">
                            📭 Belum ada data rekap parkir.
                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

</body>
</html>