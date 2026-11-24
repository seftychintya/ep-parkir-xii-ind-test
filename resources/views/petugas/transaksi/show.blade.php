<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Detail Transaksi - ParkirKu
    </title>

    <style>

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            background: #06100b;
            color: white;
            min-height: 100vh;
        }

        .container {
            max-width: 900px;
            margin: auto;
            padding: 40px 20px;
        }

        .header {
            margin-bottom: 25px;
        }

        .header h1 {
            font-size: 28px;
            margin-bottom: 8px;
        }

        .header p {
            color: #789181;
        }

        .card {
            background: #0b1912;
            border: 1px solid rgba(34,197,94,.15);
            border-radius: 16px;
            padding: 28px;
        }

        .ticket {
            text-align: center;
            padding-bottom: 25px;
            margin-bottom: 25px;
            border-bottom: 1px solid rgba(255,255,255,.08);
        }

        .ticket h2 {
            color: #4ade80;
            font-size: 25px;
            margin-bottom: 8px;
        }

        .ticket p {
            color: #86a98f;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 18px;
        }

        .item {
            background: #08150d;
            border: 1px solid rgba(34,197,94,.1);
            border-radius: 10px;
            padding: 16px;
        }

        .label {
            color: #71907d;
            font-size: 12px;
            margin-bottom: 7px;
        }

        .value {
            color: #e2e8e4;
            font-size: 15px;
            font-weight: bold;
        }

        .total {
            margin-top: 20px;
            padding: 20px;
            background: rgba(34,197,94,.08);
            border: 1px solid rgba(34,197,94,.15);
            border-radius: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .total span:first-child {
            color: #86a98f;
        }

        .total strong {
            color: #4ade80;
            font-size: 24px;
        }

        .badge {
            display: inline-block;
            padding: 7px 12px;
            border-radius: 20px;
            font-size: 12px;
        }

        .masuk {
            background: rgba(34,197,94,.12);
            color: #4ade80;
        }

        .keluar {
            background: rgba(59,130,246,.12);
            color: #93c5fd;
        }

        .actions {
            margin-top: 25px;
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-block;
            text-decoration: none;
            border: none;
            border-radius: 9px;
            padding: 12px 18px;
            cursor: pointer;
            font-size: 13px;
        }

        .btn-green {
            background: #16a34a;
            color: white;
        }

        .btn-blue {
            background: #166534;
            color: white;
        }

        .btn-gray {
            background: #1f2937;
            color: #d1d5db;
        }

        @media(max-width:650px) {

            .grid {
                grid-template-columns: 1fr;
            }

            .total {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

        }

    </style>

</head>


<body>

<div class="container">

    <div class="header">

        <h1>
            Detail Transaksi
        </h1>

        <p>
            Informasi transaksi parkir
        </p>

    </div>


    @if(session('success'))

        <div
            style="
                background:rgba(34,197,94,.1);
                border:1px solid rgba(34,197,94,.2);
                color:#86efac;
                padding:13px 16px;
                border-radius:10px;
                margin-bottom:18px;
            "
        >
            {{ session('success') }}
        </div>

    @endif


    @if(session('error'))

        <div
            style="
                background:rgba(239,68,68,.1);
                border:1px solid rgba(239,68,68,.2);
                color:#fca5a5;
                padding:13px 16px;
                border-radius:10px;
                margin-bottom:18px;
            "
        >
            {{ session('error') }}
        </div>

    @endif


    <div class="card">

        <div class="ticket">

            <h2>
                {{ $transaksi->kode_tiket }}
            </h2>

            <p>
                Tiket Parkir
            </p>

        </div>


        <div class="grid">

            <div class="item">

                <div class="label">
                    Plat Nomor
                </div>

                <div class="value">
                    {{ $transaksi->plat_nomor ?? '-' }}
                </div>

            </div>


            <div class="item">

                <div class="label">
                    Jenis Kendaraan
                </div>

                <div class="value">
                    {{ $transaksi->jenis ?? '-' }}
                </div>

            </div>


            <div class="item">

                <div class="label">
                    Slot Parkir
                </div>

                <div class="value">
                    {{ $transaksi->slot ?? '-' }}
                </div>

            </div>


            <div class="item">

                <div class="label">
                    Status
                </div>

                <div class="value">

                    @if($transaksi->status === 'masuk')

                        <span class="badge masuk">
                            MASIH PARKIR
                        </span>

                    @else

                        <span class="badge keluar">
                            SUDAH KELUAR
                        </span>

                    @endif

                </div>

            </div>


            <div class="item">

                <div class="label">
                    Jam Masuk
                </div>

                <div class="value">
                    {{ $transaksi->jam_masuk ?? '-' }}
                </div>

            </div>


            <div class="item">

                <div class="label">
                    Jam Keluar
                </div>

                <div class="value">
                    {{ $transaksi->jam_keluar ?? '-' }}
                </div>

            </div>


            <div class="item">

                <div class="label">
                    Durasi
                </div>

                <div class="value">
                    {{ $transaksi->durasi ?? 0 }} jam
                </div>

            </div>

        </div>


        <div class="total">

            <span>
                Total Pembayaran
            </span>

            <strong>
                Rp
                {{ number_format(
                    $transaksi->total_bayar ?? 0,
                    0,
                    ',',
                    '.'
                ) }}
            </strong>

        </div>


        <div class="actions">

            <a
                href="{{ route('petugas.transaksi.index') }}"
                class="btn btn-gray"
            >
                ← Kembali
            </a>


            @if($transaksi->status === 'masuk')

                <form
                    method="POST"
                    action="{{ route(
                        'petugas.transaksi.update',
                        $transaksi->id
                    ) }}"
                >

                    @csrf

                    @method('PUT')

                    <button
                        type="submit"
                        class="btn btn-green"
                    >
                        🚗 Proses Kendaraan Keluar
                    </button>

                </form>

            @else

                <a
                    href="{{ route(
                        'petugas.struk',
                        $transaksi->id
                    ) }}"
                    class="btn btn-blue"
                >
                    🧾 Cetak Struk
                </a>

            @endif

        </div>

    </div>

</div>

</body>

</html>