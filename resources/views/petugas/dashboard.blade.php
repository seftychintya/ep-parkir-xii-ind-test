
@extends('layouts.petugas')

@section('title', 'Dashboard Petugas')

@section('content')

<div class="topbar">
    <div>
        <h1>Dashboard Petugas</h1>
        <p>Selamat datang di E-PARKIR XII IND</p>
    </div>

    <div class="user-box">
        ◉ {{ auth()->user()->name ?? 'Petugas' }}
    </div>
</div>

<div class="cards">

    <div class="card">
        <div class="card-icon">🚗</div>
        <div class="card-label">Total Kendaraan</div>
        <div class="card-value">
            {{ $totalKendaraan ?? 0 }}
        </div>
    </div>

    <div class="card">
        <div class="card-icon">🎫</div>
        <div class="card-label">Total Transaksi</div>
        <div class="card-value">
            {{ $totalTransaksi ?? 0 }}
        </div>
    </div>

    <div class="card">
        <div class="card-icon">🅿️</div>
        <div class="card-label">Parkir Aktif</div>
        <div class="card-value">
            {{ $parkirAktif ?? 0 }}
        </div>
    </div>

    <div class="card">
        <div class="card-icon">💰</div>
        <div class="card-label">Total Pendapatan</div>
        <div class="card-value" style="font-size:19px;">
            Rp {{ number_format($totalPendapatan ?? 0, 0, ',', '.') }}
        </div>
    </div>

</div>

<div class="welcome">
    <h2>
        Halo, {{ auth()->user()->name ?? 'Petugas' }} 👋
    </h2>

    <p>
        Kamu login sebagai
        <span class="highlight">PETUGAS</span>.
        Gunakan menu di sebelah kiri untuk mencatat kendaraan
        masuk, memproses kendaraan keluar, dan mencetak struk.
    </p>
</div>

<div class="quick-actions">

    <a href="{{ route('petugas.transaksi.create') }}" class="action">
        <div class="card-icon">🚘</div>
        <h3>Catat Parkir Masuk</h3>
        <p>Masukkan kendaraan yang baru masuk area parkir.</p>
    </a>

    <a href="{{ route('petugas.transaksi.index') }}" class="action">
        <div class="card-icon">📋</div>
        <h3>Lihat Transaksi</h3>
        <p>Lihat daftar kendaraan dan proses kendaraan keluar.</p>
    </a>

</div>

@endsection
