@extends('layouts.layout')

@section('content')

<div class="page-header">

    <div>

        <h1>Laporan Parkir 📊</h1>

        <p>
            Rekap dan riwayat aktivitas parkir.
        </p>

    </div>

</div>


{{-- STATISTIK --}}

<div style="
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(200px,1fr));
    gap:18px;
    margin-bottom:25px;
">


    {{-- TOTAL PARKIR --}}

    <div style="
        background:white;
        border-radius:14px;
        padding:22px;
        box-shadow:0 4px 15px rgba(0,0,0,.06);
        border-left:5px solid #16a34a;
    ">

        <div style="
            font-size:13px;
            color:#6b7280;
            margin-bottom:8px;
        ">
            TOTAL PARKIR
        </div>

        <div style="
            font-size:30px;
            font-weight:800;
            color:#111827;
        ">
            {{ $totalParkir }}
        </div>

    </div>


    {{-- MASIH PARKIR --}}

    <div style="
        background:white;
        border-radius:14px;
        padding:22px;
        box-shadow:0 4px 15px rgba(0,0,0,.06);
        border-left:5px solid #22c55e;
    ">

        <div style="
            font-size:13px;
            color:#6b7280;
            margin-bottom:8px;
        ">
            MASIH PARKIR
        </div>

        <div style="
            font-size:30px;
            font-weight:800;
            color:#16a34a;
        ">
            {{ $parkirMasuk }}
        </div>

    </div>


    {{-- SUDAH KELUAR --}}

    <div style="
        background:white;
        border-radius:14px;
        padding:22px;
        box-shadow:0 4px 15px rgba(0,0,0,.06);
        border-left:5px solid #ef4444;
    ">

        <div style="
            font-size:13px;
            color:#6b7280;
            margin-bottom:8px;
        ">
            SUDAH KELUAR
        </div>

        <div style="
            font-size:30px;
            font-weight:800;
            color:#dc2626;
        ">
            {{ $parkirKeluar }}
        </div>

    </div>


    {{-- PENDAPATAN --}}

    <div style="
        background:white;
        border-radius:14px;
        padding:22px;
        box-shadow:0 4px 15px rgba(0,0,0,.06);
        border-left:5px solid #eab308;
    ">

        <div style="
            font-size:13px;
            color:#6b7280;
            margin-bottom:8px;
        ">
            TOTAL PENDAPATAN
        </div>

        <div style="
            font-size:24px;
            font-weight:800;
            color:#ca8a04;
        ">
            Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
        </div>

    </div>

</div>


{{-- FILTER --}}

<div class="content-card">

    <div style="
        display:flex;
        justify-content:space-between;
        align-items:center;
        gap:15px;
        flex-wrap:wrap;
        margin-bottom:20px;
    ">

        <div>

            <h2 style="margin:0;">
                Riwayat Parkir
            </h2>

            <small style="color:#6b7280;">
                Data aktivitas kendaraan
            </small>

        </div>


        <div style="
            display:flex;
            gap:10px;
            align-items:center;
            flex-wrap:wrap;
        ">

            <form method="GET"
                  action="{{ route('admin.laporan') }}">

                <select
                    name="status"
                    onchange="this.form.submit()"
                    style="
                        padding:10px 13px;
                        border:1px solid #d1d5db;
                        border-radius:8px;
                        background:white;
                    "
                >

                    <option value="">
                        Semua Status
                    </option>

                    <option value="masuk"
                        {{ request('status') === 'masuk' ? 'selected' : '' }}>
                        Masih Parkir
                    </option>

                    <option value="keluar"
                        {{ request('status') === 'keluar' ? 'selected' : '' }}>
                        Sudah Keluar
                    </option>

                </select>

            </form>


            <button
                onclick="window.print()"
                style="
                    background:#166534;
                    color:white;
                    border:0;
                    padding:10px 15px;
                    border-radius:8px;
                    cursor:pointer;
                    font-weight:600;
                "
            >

                🖨️ Cetak

            </button>

        </div>

    </div>


    {{-- TABEL --}}

    <div style="overflow-x:auto;">

        <table style="
            width:100%;
            border-collapse:collapse;
        ">

            <thead>

                <tr>

                    <th style="
                        padding:13px;
                        text-align:left;
                        border-bottom:2px solid #e5e7eb;
                    ">
                        No
                    </th>

                    <th style="
                        padding:13px;
                        text-align:left;
                        border-bottom:2px solid #e5e7eb;
                    ">
                        Kode Tiket
                    </th>

                    <th style="
                        padding:13px;
                        text-align:left;
                        border-bottom:2px solid #e5e7eb;
                    ">
                        Plat Nomor
                    </th>

                    <th style="
                        padding:13px;
                        text-align:left;
                        border-bottom:2px solid #e5e7eb;
                    ">
                        Jenis
                    </th>

                    <th style="
                        padding:13px;
                        text-align:left;
                        border-bottom:2px solid #e5e7eb;
                    ">
                        Slot
                    </th>

                    <th style="
                        padding:13px;
                        text-align:left;
                        border-bottom:2px solid #e5e7eb;
                    ">
                        Jam Masuk
                    </th>

                    <th style="
                        padding:13px;
                        text-align:left;
                        border-bottom:2px solid #e5e7eb;
                    ">
                        Jam Keluar
                    </th>

                    <th style="
                        padding:13px;
                        text-align:left;
                        border-bottom:2px solid #e5e7eb;
                    ">
                        Status
                    </th>

                    <th style="
                        padding:13px;
                        text-align:right;
                        border-bottom:2px solid #e5e7eb;
                    ">
                        Total Bayar
                    </th>

                </tr>

            </thead>


            <tbody>

                @forelse($parkirs as $parkir)

                    <tr>

                        <td style="
                            padding:13px;
                            border-bottom:1px solid #f1f5f9;
                        ">
                            {{ $loop->iteration }}
                        </td>


                        <td style="
                            padding:13px;
                            border-bottom:1px solid #f1f5f9;
                            font-weight:700;
                        ">
                            {{ $parkir->kode_tiket ?? '-' }}
                        </td>


                        <td style="
                            padding:13px;
                            border-bottom:1px solid #f1f5f9;
                            font-weight:600;
                        ">
                            {{ $parkir->kendaraan->plat_nomor ?? '-' }}
                        </td>


                        <td style="
                            padding:13px;
                            border-bottom:1px solid #f1f5f9;
                        ">
                            {{ ucfirst($parkir->kendaraan->jenis ?? '-') }}
                        </td>


                        <td style="
                            padding:13px;
                            border-bottom:1px solid #f1f5f9;
                        ">
                            {{ $parkir->slot ?? '-' }}
                        </td>


                        <td style="
                            padding:13px;
                            border-bottom:1px solid #f1f5f9;
                        ">
                            {{ $parkir->jam_masuk ?? '-' }}
                        </td>


                        <td style="
                            padding:13px;
                            border-bottom:1px solid #f1f5f9;
                        ">
                            {{ $parkir->jam_keluar ?? '-' }}
                        </td>


                        <td style="
                            padding:13px;
                            border-bottom:1px solid #f1f5f9;
                        ">

                            @if($parkir->status === 'masuk')

                                <span style="
                                    display:inline-block;
                                    background:#dcfce7;
                                    color:#166534;
                                    padding:6px 10px;
                                    border-radius:20px;
                                    font-size:12px;
                                    font-weight:700;
                                ">
                                    🟢 Masih Parkir
                                </span>

                            @else

                                <span style="
                                    display:inline-block;
                                    background:#fee2e2;
                                    color:#991b1b;
                                    padding:6px 10px;
                                    border-radius:20px;
                                    font-size:12px;
                                    font-weight:700;
                                ">
                                    🔴 Sudah Keluar
                                </span>

                            @endif

                        </td>


                        <td style="
                            padding:13px;
                            border-bottom:1px solid #f1f5f9;
                            text-align:right;
                            font-weight:700;
                        ">

                            @if($parkir->total_bayar)

                                Rp {{ number_format($parkir->total_bayar, 0, ',', '.') }}

                            @else

                                -

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="9"
                            style="
                                text-align:center;
                                padding:50px;
                                color:#6b7280;
                            "
                        >

                            📋 Belum ada data laporan parkir.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>


{{-- PRINT STYLE --}}

<style>

@media print {

    .sidebar,
    .topbar,
    button,
    form,
    .page-header {
        display:none !important;
    }

    body {
        background:white !important;
    }

    .content-card {
        box-shadow:none !important;
        border:none !important;
    }

}

</style>

@endsection