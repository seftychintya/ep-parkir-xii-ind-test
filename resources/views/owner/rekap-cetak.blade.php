<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Laporan Rekap Parkir</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 30px;
            font-family: Arial, Helvetica, sans-serif;
            color: #111;
            background: #fff;
        }

        .print-container {
            width: 100%;
            max-width: 1200px;
            margin: auto;
        }

        .header {
            text-align: center;
            border-bottom: 3px solid #123d2d;
            padding-bottom: 18px;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 27px;
            color: #123d2d;
            text-transform: uppercase;
        }

        .header h2 {
            margin: 5px 0;
            font-size: 18px;
        }

        .header p {
            margin: 4px 0;
            color: #555;
            font-size: 13px;
        }

        .periode {
            text-align: center;
            margin-bottom: 25px;
            font-size: 14px;
        }

        .summary {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
        }

        .summary-box {
            flex: 1;
            border: 1px solid #bbb;
            padding: 13px;
            border-radius: 6px;
        }

        .summary-box small {
            display: block;
            color: #555;
            margin-bottom: 5px;
        }

        .summary-box strong {
            font-size: 18px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
        }

        th {
            background: #dfeae5;
            color: #102d21;
            border: 1px solid #777;
            padding: 8px 6px;
            text-align: center;
        }

        td {
            border: 1px solid #999;
            padding: 7px 6px;
        }

        td.center {
            text-align: center;
        }

        td.money {
            text-align: right;
        }

        .total-row td {
            font-weight: bold;
            background: #eef4f1;
        }

        .footer {
            margin-top: 40px;
            display: flex;
            justify-content: flex-end;
        }

        .signature {
            width: 220px;
            text-align: center;
        }

        .signature-space {
            height: 70px;
        }

        .no-data {
            text-align: center;
            padding: 30px;
        }

        @media print {

            body {
                padding: 0;
            }

            .no-print {
                display: none !important;
            }

            @page {
                size: A4 landscape;
                margin: 12mm;
            }

        }

    </style>

</head>


<body>

<div class="print-container">


    {{-- HEADER --}}

    <div class="header">

        <h1>Laporan Rekap Parkir</h1>

        <h2>Sistem Parkir</h2>

        <p>
            Laporan kendaraan yang telah selesai melakukan parkir
        </p>

    </div>


    {{-- PERIODE --}}

    <div class="periode">

        <strong>Periode:</strong>

        @if($tanggalMulai && $tanggalSelesai)

            {{ \Carbon\Carbon::parse($tanggalMulai)->format('d/m/Y') }}

            &nbsp; - &nbsp;

            {{ \Carbon\Carbon::parse($tanggalSelesai)->format('d/m/Y') }}

        @elseif($tanggalMulai)

            Mulai
            {{ \Carbon\Carbon::parse($tanggalMulai)->format('d/m/Y') }}

        @elseif($tanggalSelesai)

            Sampai
            {{ \Carbon\Carbon::parse($tanggalSelesai)->format('d/m/Y') }}

        @else

            Semua Data

        @endif

    </div>


    {{-- SUMMARY --}}

    <div class="summary">

        <div class="summary-box">

            <small>Total Kendaraan</small>

            <strong>
                {{ number_format($totalKendaraan, 0, ',', '.') }}
                Kendaraan
            </strong>

        </div>


        <div class="summary-box">

            <small>Total Pendapatan</small>

            <strong>
                Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
            </strong>

        </div>

    </div>


    {{-- TABLE --}}

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

                <td class="center">
                    {{ $loop->iteration }}
                </td>

                <td>
                    {{ $item->kode_tiket ?? '-' }}
                </td>

                <td>
                    {{ $item->kendaraan->plat_nomor ?? '-' }}
                </td>

                <td>
                    {{ $item->kendaraan->jenis ?? '-' }}
                </td>

                <td class="center">
                    {{ $item->slot ?? '-' }}
                </td>

                <td class="center">

                    {{ $item->jam_masuk
                        ? $item->jam_masuk->format('d/m/Y H:i')
                        : '-'
                    }}

                </td>

                <td class="center">

                    {{ $item->jam_keluar
                        ? $item->jam_keluar->format('d/m/Y H:i')
                        : '-'
                    }}

                </td>

                <td class="center">
                    {{ $item->durasi ?? '-' }}
                </td>

                <td class="money">

                    Rp
                    {{ number_format(
                        $item->total_bayar ?? 0,
                        0,
                        ',',
                        '.'
                    ) }}

                </td>

                <td class="center">
                    {{ ucfirst($item->status) }}
                </td>

            </tr>

        @empty

            <tr>

                <td colspan="10" class="no-data">
                    Tidak ada data parkir pada periode yang dipilih.
                </td>

            </tr>

        @endforelse


        @if($parkir->count() > 0)

            <tr class="total-row">

                <td colspan="8" style="text-align:right;">
                    TOTAL PENDAPATAN
                </td>

                <td class="money">

                    Rp
                    {{ number_format(
                        $totalPendapatan,
                        0,
                        ',',
                        '.'
                    ) }}

                </td>

                <td></td>

            </tr>

        @endif

        </tbody>

    </table>


    {{-- FOOTER --}}

    <div class="footer">

        <div class="signature">

            <div>
                Madiun,
                {{ now()->format('d/m/Y') }}
            </div>

            <div class="signature-space"></div>

            <strong>
                Pemilik / Pengelola Parkir
            </strong>

        </div>

    </div>


</div>


<script>

    window.onload = function () {

        window.print();

    };

</script>

</body>

</html>