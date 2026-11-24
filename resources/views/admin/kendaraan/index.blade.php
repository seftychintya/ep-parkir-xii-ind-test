
@extends('layouts.admin')

@section('title', 'Kendaraan | E-PARKIR XII IND')

@section('content')

<style>
    .page-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 18px;
        margin-bottom: 28px;
        animation: pageEnter .5s ease both;
    }

    .page-heading h1 {
        font-family: 'Orbitron', sans-serif;
        font-size: 23px;
        color: #e5eee8;
        font-weight: 700;
    }

    .page-heading p {
        margin-top: 8px;
        color: #8b9b91;
        font-size: 12px;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        padding: 10px 15px;
        border-radius: 9px;
        text-decoration: none;
        border: 1px solid transparent;
        cursor: pointer;
        font-family: 'Poppins', sans-serif;
        font-size: 11px;
        font-weight: 600;
        transition: .25s ease;
        white-space: nowrap;
    }

    .btn-primary {
        color: #e5eee8;
        background: #146b4c;
        border-color: #208c65;
    }

    .btn-primary:hover {
        background: #18865e;
        transform: translateY(-3px);
        box-shadow: 0 7px 18px rgba(16, 168, 120, .17);
    }

    .btn-edit {
        color: #75dcb2;
        background: rgba(16, 168, 120, .12);
        border-color: rgba(80, 214, 166, .22);
    }

    .btn-edit:hover {
        background: #146b4c;
        color: white;
        transform: translateY(-2px);
    }

    .btn-delete {
        color: #efa0a0;
        background: rgba(180, 55, 55, .12);
        border-color: rgba(220, 100, 100, .2);
    }

    .btn-delete:hover {
        background: #783333;
        color: white;
        transform: translateY(-2px);
    }

    .vehicle-card {
        background: #0a1b12;
        border: 1px solid #123c29;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 12px 35px rgba(0, 0, 0, .13);
        animation: pageEnter .65s ease both;
        transition: border-color .25s ease, box-shadow .25s ease;
    }

    .vehicle-card:hover {
        border-color: #1c6547;
        box-shadow: 0 15px 38px rgba(0, 0, 0, .2);
    }

    .vehicle-card-header {
        padding: 20px 23px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        border-bottom: 1px solid #123c29;
    }

    .vehicle-card-header h2 {
        font-size: 13px;
        font-weight: 600;
        color: #e5eee8;
    }

    .total-badge {
        padding: 7px 11px;
        border-radius: 8px;
        color: #50d6a6;
        background: rgba(16, 168, 120, .1);
        border: 1px solid rgba(80, 214, 166, .2);
        font-size: 10px;
        white-space: nowrap;
    }

    .table-wrapper {
        width: 100%;
        overflow-x: auto;
    }

    .vehicle-table {
        width: 100%;
        min-width: 760px;
        border-collapse: collapse;
    }

    .vehicle-table thead {
        background: #10271a;
    }

    .vehicle-table th {
        padding: 15px 18px;
        color: #50d6a6;
        font-size: 10px;
        font-weight: 600;
        letter-spacing: .7px;
        text-align: left;
        text-transform: uppercase;
    }

    .vehicle-table td {
        padding: 15px 18px;
        border-top: 1px solid rgba(18, 60, 41, .7);
        color: #c8d7cc;
        font-size: 11px;
    }

    .vehicle-table tbody tr {
        transition: background .2s ease;
    }

    .vehicle-table tbody tr:hover {
        background: #10271a;
    }

    .plate-number {
        color: #e5eee8;
        font-weight: 700;
        letter-spacing: .7px;
    }

    .type-badge {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 20px;
        color: #75dcb2;
        background: rgba(16, 168, 120, .12);
        border: 1px solid rgba(80, 214, 166, .2);
        font-size: 10px;
    }

    .action-buttons {
        display: flex;
        align-items: center;
        gap: 7px;
    }

    .action-buttons form {
        margin: 0;
    }

    .empty-row {
        padding: 45px 20px !important;
        text-align: center;
        color: #8b9b91 !important;
    }

    @media (max-width: 650px) {
        .page-heading {
            align-items: flex-start;
            flex-direction: column;
        }

        .page-heading h1 {
            font-size: 19px;
        }

        .vehicle-card-header {
            padding: 16px;
        }
    }
</style>

<div class="page-heading">
    <div>
        <h1>Kendaraan</h1>
        <p>Kelola data kendaraan yang terdaftar pada sistem parkir.</p>
    </div>

    <a href="{{ route('admin.kendaraan.create') }}" class="btn btn-primary">
        + Tambah Kendaraan
    </a>
</div>

<div class="vehicle-card">
    <div class="vehicle-card-header">
        <h2>Daftar Kendaraan</h2>

        <span class="total-badge">
            Total: {{ $kendaraans->count() }} Kendaraan
        </span>
    </div>

    <div class="table-wrapper">
        <table class="vehicle-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Plat Nomor</th>
                    <th>Jenis</th>
                    <th>Pemilik</th>
                    <th>Terdaftar</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($kendaraans as $kendaraan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>
                            <span class="plate-number">
                                {{ $kendaraan->plat_nomor }}
                            </span>
                        </td>

                        <td>
                            <span class="type-badge">
                                {{ ucfirst($kendaraan->jenis) }}
                            </span>
                        </td>

                        <td>{{ $kendaraan->pemilik ?? '-' }}</td>

                        <td>
                            {{ $kendaraan->created_at
                                ? \Carbon\Carbon::parse($kendaraan->created_at)->format('d-m-Y')
                                : '-' }}
                        </td>

                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.kendaraan.edit', $kendaraan->id) }}"
                                   class="btn btn-edit">
                                    Edit
                                </a>

                                <form
                                    action="{{ route('admin.kendaraan.destroy', $kendaraan->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus kendaraan ini?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-delete">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="empty-row">
                            Belum ada data kendaraan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
