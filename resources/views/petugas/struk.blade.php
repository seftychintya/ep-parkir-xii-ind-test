<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Struk Parkir - ParkirKu</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 30px;
            background: #0b1710;
            color: #e5f5e9;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 500px;
            margin: auto;
        }

        .actions {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .btn {
            flex: 1;
            padding: 12px;
            border-radius: 10px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-weight: bold;
            text-align: center;
        }

        .btn-back {
            background: #1d3524;
            color: #d7f5df;
        }

        .btn-print {
            background: #22c55e;
            color: #06240f;
        }

        .struk {
            background: white;
            color: #111;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 15px 40px rgba(0,0,0,.35);
        }

        .header {
            text-align: center;
            border-bottom: 1px dashed #777;
            padding-bottom: 18px;
            margin-bottom: 18px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .header p {
            margin: 6px 0 0;
            color: #555;
        }

        .row {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            padding: 7px 0;
        }

        .label {
            color: #666;
        }

        .value {
            font-weight: bold;
            text-align: right;
        }

        .total {
            border-top: 1px dashed #777;
            margin-top: 15px;
            padding-top: 15px;
            display: flex;
            justify-content: space-between;
            font-size: 20px;
            font-weight: bold;
        }

        .footer {
            text-align: center;
            border-top: 1px dashed #777;
            margin-top: 20px;
            padding-top: 15px;
            color: #555;
        }

        @media print {
            body {
                background: white;
                padding: 0;
            }

            .actions {
                display: none;
            }

            .container {
                max-width: 100%;
            }

            .struk {
                box-shadow: none;
                border-radius: 0;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <div class="actions">
        <a href="{{ route('petugas.transaksi.index') }}" class="btn btn-back">
            ← Kembali
        </a>

        <button onclick="window.print()" class="btn btn-print">
            🖨 Cetak Struk
        </button>
    </div>

    <div class="struk">

        <div class="header">
            <h1>PARKIRKU</h1>
            <p>Struk Parkir Kendaraan</p>
        </div>

        <div class="row">
            <span class="label">Kode Tiket</span>
            <span class="value">
                {{ $transaksi->kode_tiket }}
            </span>
        </div>

        <div class="row">
            <span class="label">Plat Nomor</span>
            <span class="value">
                {{ $transaksi->kendaraan->plat_nomor ?? '-' }}
            </span>
        </div>

        <div class="row">
            <span class="label">Jenis</span>
            <span class="value">
                {{ ucfirst($transaksi->kendaraan->jenis ?? '-') }}
            </span>
        </div>

        <div class="row">
            <span class="label">Pemilik</span>
            <span class="value">
                {{ $transaksi->kendaraan->pemilik ?? '-' }}
            </span>
        </div>

        <div class="row">
            <span class="label">Slot</span>
            <span class="value">
                {{ $transaksi->slot ?? '-' }}
            </span>
        </div>

        <div class="row">
            <span class="label">Jam Masuk</span>
            <span class="value">
                {{ $transaksi->jam_masuk?->format('d-m-Y H:i') ?? '-' }}
            </span>
        </div>

        <div class="row">
            <span class="label">Jam Keluar</span>
            <span class="value">
                {{ $transaksi->jam_keluar?->format('d-m-Y H:i') ?? '-' }}
            </span>
        </div>

        <div class="row">
            <span class="label">Durasi</span>
            <span class="value">
                {{ $transaksi->durasi ?? 0 }} jam
            </span>
        </div>

        <div class="total">
            <span>TOTAL</span>

            <span>
                Rp {{ number_format($transaksi->total_bayar ?? 0, 0, ',', '.') }}
            </span>
        </div>

        <div class="footer">
            Terima kasih telah menggunakan ParkirKu
        </div>

    </div>

</div>

</body>
</html>