@extends('layouts.layout')

@section('title', 'Data Parkir')
@section('page-title', 'Data Parkir')

@section('content')

<div>

    <div class="welcome">

        <h2>
            Data Parkir 🅿️
        </h2>

        <p>
            Pantau seluruh aktivitas kendaraan
            yang masuk dan keluar area parkir.
        </p>

    </div>


    <div class="cards">

        <div class="card stat-card">
            <div>
                <div class="stat-label">
                    Kendaraan Masuk
                </div>
                <div class="stat-value">
                    0
                </div>
            </div>

            <div class="stat-icon">
                🚗
            </div>
        </div>


        <div class="card stat-card">
            <div>
                <div class="stat-label">
                    Sedang Parkir
                </div>
                <div class="stat-value">
                    0
                </div>
            </div>

            <div class="stat-icon">
                🅿️
            </div>
        </div>


        <div class="card stat-card">
            <div>
                <div class="stat-label">
                    Kendaraan Keluar
                </div>
                <div class="stat-value">
                    0
                </div>
            </div>

            <div class="stat-icon">
                🚙
            </div>
        </div>


        <div class="card stat-card">
            <div>
                <div class="stat-label">
                    Pendapatan
                </div>
                <div class="stat-value">
                    Rp 0
                </div>
            </div>

            <div class="stat-icon">
                💰
            </div>
        </div>

    </div>


    <div class="panel">

        <div class="panel-header">

            <div class="panel-title">
                Riwayat Parkir
            </div>

            <div class="panel-desc">
                Seluruh transaksi parkir
            </div>

        </div>


        <div class="table-wrapper">

            <table>

                <thead>

                    <tr>
                        <th>Tiket</th>
                        <th>Plat Nomor</th>
                        <th>Slot</th>
                        <th>Jam Masuk</th>
                        <th>Jam Keluar</th>
                        <th>Status</th>
                        <th>Total</th>
                    </tr>

                </thead>

                <tbody>

                    <tr>

                        <td colspan="7">

                            <div class="empty">
                                🅿️ Belum ada data parkir.
                            </div>

                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection