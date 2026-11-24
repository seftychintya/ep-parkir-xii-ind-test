@extends('layouts.layout')

@section('content')

<div class="page-header">
    <div>
        <h1>Data Parkir 🅿️</h1>
        <p>Kelola kendaraan masuk dan keluar area parkir.</p>
    </div>
</div>

@if(session('success'))
    <div style="
        background:#dcfce7;
        color:#166534;
        padding:12px 16px;
        border-radius:10px;
        margin-bottom:20px;
        font-weight:600;
    ">
        {{ session('success') }}
    </div>
@endif

<div class="content-card">

    <div style="
        display:flex;
        justify-content:space-between;
        align-items:center;
        margin-bottom:20px;
    ">

        <div>
            <h2 style="margin:0;">
                Daftar Parkir
            </h2>

            <small>
                Data kendaraan yang sedang dan sudah parkir
            </small>
        </div>

        <a href="#"
           style="
                background:#16a34a;
                color:white;
                padding:10px 16px;
                border-radius:8px;
                text-decoration:none;
                font-weight:600;
           ">
            + Kendaraan Masuk
        </a>

    </div>

    <div style="overflow-x:auto;">

        <table style="width:100%; border-collapse:collapse;">

            <thead>
                <tr>
                    <th style="padding:12px; text-align:left;">NO</th>
                    <th style="padding:12px; text-align:left;">TIKET</th>
                    <th style="padding:12px; text-align:left;">PLAT NOMOR</th>
                    <th style="padding:12px; text-align:left;">SLOT</th>
                    <th style="padding:12px; text-align:left;">JAM MASUK</th>
                    <th style="padding:12px; text-align:left;">JAM KELUAR</th>
                    <th style="padding:12px; text-align:left;">STATUS</th>
                    <th style="padding:12px; text-align:left;">TOTAL BAYAR</th>
                    <th style="padding:12px; text-align:left;">AKSI</th>
                </tr>
            </thead>

            <tbody>

                @forelse($parkirs ?? [] as $parkir)

                    <tr>

                        <td style="padding:12px;">
                            {{ $loop->iteration }}
                        </td>

                        <td style="padding:12px;">
                            {{ $parkir->kode_tiket ?? '-' }}
                        </td>

                        <td style="padding:12px; font-weight:600;">
                            {{ $parkir->kendaraan->plat_nomor ?? '-' }}
                        </td>

                        <td style="padding:12px;">
                            {{ $parkir->slot ?? '-' }}
                        </td>

                        <td style="padding:12px;">
                            {{ $parkir->jam_masuk ?? '-' }}
                        </td>

                        <td style="padding:12px;">
                            {{ $parkir->jam_keluar ?? '-' }}
                        </td>

                        <td style="padding:12px;">
                            {{ ucfirst($parkir->status ?? '-') }}
                        </td>

                        <td style="padding:12px;">
                            Rp {{ number_format($parkir->total_bayar ?? 0, 0, ',', '.') }}
                        </td>

                        <td style="padding:12px;">
                            <a href="#"
                               style="
                                    background:#facc15;
                                    color:#422006;
                                    padding:6px 10px;
                                    border-radius:6px;
                                    text-decoration:none;
                               ">
                                Edit
                            </a>
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="9"
                            style="
                                padding:35px;
                                text-align:center;
                                color:#777;
                            ">
                            🅿️ Belum ada data parkir.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection