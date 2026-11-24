@extends('layouts.layout')

@section('content')

<div class="page-header">

    <div>

        <h1>Pendapatan 💰</h1>

        <p>
            Ringkasan pendapatan parkir.
        </p>

    </div>

</div>


<div style="
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(230px,1fr));
    gap:20px;
    margin-bottom:25px;
">


    <div style="
        background:white;
        border-radius:14px;
        padding:25px;
        box-shadow:0 4px 15px rgba(0,0,0,.06);
        border-left:5px solid #16a34a;
    ">

        <div style="
            color:#6b7280;
            font-size:13px;
            margin-bottom:8px;
        ">
            TOTAL PENDAPATAN
        </div>

        <div style="
            color:#166534;
            font-size:28px;
            font-weight:800;
        ">
            Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
        </div>

    </div>


    <div style="
        background:white;
        border-radius:14px;
        padding:25px;
        box-shadow:0 4px 15px rgba(0,0,0,.06);
        border-left:5px solid #eab308;
    ">

        <div style="
            color:#6b7280;
            font-size:13px;
            margin-bottom:8px;
        ">
            JUMLAH TRANSAKSI
        </div>

        <div style="
            color:#a16207;
            font-size:28px;
            font-weight:800;
        ">
            {{ $jumlahTransaksi }}
        </div>

    </div>

</div>


<div class="content-card">

    <div style="
        display:flex;
        justify-content:space-between;
        align-items:center;
        margin-bottom:20px;
    ">

        <div>

            <h2 style="margin:0;">
                Riwayat Pendapatan
            </h2>

            <small style="color:#6b7280;">
                Transaksi kendaraan yang sudah keluar
            </small>

        </div>

        <button
            onclick="window.print()"
            style="
                background:#166534;
                color:white;
                border:0;
                padding:10px 16px;
                border-radius:8px;
                cursor:pointer;
                font-weight:600;
            "
        >
            🖨️ Cetak
        </button>

    </div>


    <div style="overflow-x:auto;">

        <table style="
            width:100%;
            border-collapse:collapse;
        ">

            <thead>

                <tr>

                    <th style="padding:13px;text-align:left;border-bottom:2px solid #e5e7eb;">
                        No
                    </th>

                    <th style="padding:13px;text-align:left;border-bottom:2px solid #e5e7eb;">
                        Tiket
                    </th>

                    <th style="padding:13px;text-align:left;border-bottom:2px solid #e5e7eb;">
                        Plat Nomor
                    </th>

                    <th style="padding:13px;text-align:left;border-bottom:2px solid #e5e7eb;">
                        Jam Masuk
                    </th>

                    <th style="padding:13px;text-align:left;border-bottom:2px solid #e5e7eb;">
                        Jam Keluar
                    </th>

                    <th style="padding:13px;text-align:right;border-bottom:2px solid #e5e7eb;">
                        Pendapatan
                    </th>

                </tr>

            </thead>


            <tbody>

                @forelse($pendapatans as $parkir)

                    <tr>

                        <td style="padding:13px;border-bottom:1px solid #f1f5f9;">
                            {{ $loop->iteration }}
                        </td>

                        <td style="padding:13px;border-bottom:1px solid #f1f5f9;font-weight:600;">
                            {{ $parkir->kode_tiket ?? '-' }}
                        </td>

                        <td style="padding:13px;border-bottom:1px solid #f1f5f9;font-weight:600;">
                            {{ $parkir->kendaraan->plat_nomor ?? '-' }}
                        </td>

                        <td style="padding:13px;border-bottom:1px solid #f1f5f9;">
                            {{ $parkir->jam_masuk ?? '-' }}
                        </td>

                        <td style="padding:13px;border-bottom:1px solid #f1f5f9;">
                            {{ $parkir->jam_keluar ?? '-' }}
                        </td>

                        <td style="
                            padding:13px;
                            border-bottom:1px solid #f1f5f9;
                            text-align:right;
                            font-weight:700;
                        ">
                            Rp {{ number_format($parkir->total_bayar ?? 0, 0, ',', '.') }}
                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="6"
                            style="
                                padding:45px;
                                text-align:center;
                                color:#6b7280;
                            "
                        >

                            💰 Belum ada transaksi pendapatan.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>


<style>

@media print {

    .sidebar,
    .topbar,
    button,
    .page-header {
        display:none !important;
    }

    body {
        background:white !important;
    }

}

</style>

@endsection