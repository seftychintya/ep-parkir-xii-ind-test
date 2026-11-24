
@extends('layouts.petugas')

@section('title', 'Transaksi Parkir')

@section('content')

<div class="topbar">

    <div>
        <h1>Transaksi Parkir</h1>
        <p>Kelola kendaraan masuk dan keluar</p>
    </div>

    <div class="user-box">
        ◉ {{ auth()->user()->name ?? 'Petugas' }}
    </div>

</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-error">
        {{ session('error') }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-error">
        <ul style="padding-left:20px;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="transaction-card">

    <div class="card-header">
        <h3>Data Transaksi</h3>

        <a href="{{ route('petugas.transaksi.create') }}"
           class="btn btn-green">
            + Parkir Masuk
        </a>
    </div>

    @if($parkirs->count() > 0)

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
                    <th>Total</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

                @foreach($parkirs as $transaksi)

                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>
                            <strong>
                                {{ $transaksi->kode_tiket }}
                            </strong>
                        </td>

                        <td>
                            {{ $transaksi->plat_nomor ?? '-' }}
                        </td>

                        <td>
                            {{ $transaksi->jenis ?? '-' }}
                        </td>

                        <td>
                            {{ $transaksi->slot ?? '-' }}
                        </td>

                        <td>
                            {{ $transaksi->jam_masuk ?? '-' }}
                        </td>

                        <td>
                            {{ $transaksi->jam_keluar ?? '-' }}
                        </td>

                        <td>
                            Rp {{ number_format(
                                $transaksi->total_bayar ?? 0,
                                0,
                                ',',
                                '.'
                            ) }}
                        </td>

                        <td>
                            @if($transaksi->status === 'masuk')
                                <span class="badge badge-masuk">
                                    MASUK
                                </span>
                            @else
                                <span class="badge badge-keluar">
                                    KELUAR
                                </span>
                            @endif
                        </td>

                        <td>
                            <a href="{{ route('petugas.transaksi.show', $transaksi->id) }}"
                               class="btn btn-blue">
                                Detail
                            </a>
                        </td>
                    </tr>

                @endforeach

            </tbody>

        </table>

    @else

        <div class="empty">
            <p style="font-size:15px;">
                Belum ada transaksi parkir.
            </p>

            <br>

            <a href="{{ route('petugas.transaksi.create') }}"
               class="btn btn-green">
                + Buat Transaksi Pertama
            </a>
        </div>

    @endif

</div>

@endsection
