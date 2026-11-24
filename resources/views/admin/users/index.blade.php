
@extends('layouts.admin')

@section('title', 'Pengguna | E-PARKIR XII IND')

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
        box-shadow: 0 7px 18px rgba(16, 168, 120, .15);
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

    .user-card {
        background: #0a1b12;
        border: 1px solid #123c29;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 12px 35px rgba(0, 0, 0, .13);
        animation: pageEnter .65s ease both;
        transition: border-color .25s ease, box-shadow .25s ease;
    }

    .user-card:hover {
        border-color: #1c6547;
        box-shadow: 0 15px 38px rgba(0, 0, 0, .2);
    }

    .user-card-header {
        padding: 20px 23px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        border-bottom: 1px solid #123c29;
    }

    .user-card-header h2 {
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
    }

    .table-wrapper {
        width: 100%;
        overflow-x: auto;
    }

    .user-table {
        width: 100%;
        min-width: 650px;
        border-collapse: collapse;
    }

    .user-table thead {
        background: #10271a;
    }

    .user-table th {
        padding: 15px 18px;
        color: #50d6a6;
        font-size: 10px;
        font-weight: 600;
        letter-spacing: .7px;
        text-align: left;
        text-transform: uppercase;
    }

    .user-table td {
        padding: 15px 18px;
        border-top: 1px solid rgba(18, 60, 41, .7);
        color: #c8d7cc;
        font-size: 11px;
    }

    .user-table tbody tr {
        transition: background .2s ease;
    }

    .user-table tbody tr:hover {
        background: #10271a;
    }

    .user-name {
        color: #e5eee8;
        font-weight: 600;
    }

    .username {
        color: #aabbb0;
    }

    .role-badge {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 20px;
        color: #75dcb2;
        background: rgba(16, 168, 120, .12);
        border: 1px solid rgba(80, 214, 166, .2);
        font-size: 10px;
        font-weight: 600;
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

    .validation-error {
        padding: 14px 18px;
        margin-bottom: 20px;
        border-radius: 10px;
        color: #efa0a0;
        background: rgba(180, 55, 55, .12);
        border: 1px solid rgba(220, 100, 100, .2);
        font-size: 12px;
    }

    .validation-error div + div {
        margin-top: 5px;
    }

    @media (max-width: 650px) {
        .page-heading {
            align-items: flex-start;
            flex-direction: column;
        }

        .page-heading h1 {
            font-size: 19px;
        }

        .user-card-header {
            padding: 16px;
        }
    }
</style>

<div class="page-heading">
    <div>
        <h1>Pengguna</h1>
        <p>Kelola akun Admin, Petugas, dan Owner pada sistem parkir.</p>
    </div>

    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
        + Tambah Pengguna
    </a>
</div>

@if($errors->any())
    <div class="validation-error">
        @foreach($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif

<div class="user-card">

    <div class="user-card-header">
        <h2>Daftar Pengguna</h2>

        <span class="total-badge">
            Total: {{ $users->count() }} Pengguna
        </span>
    </div>

    <div class="table-wrapper">
        <table class="user-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>
                            <span class="user-name">
                                {{ $user->name }}
                            </span>
                        </td>

                        <td>
                            <span class="username">
                                {{ $user->username }}
                            </span>
                        </td>

                        <td>
                            <span class="role-badge">
                                {{ strtoupper($user->role) }}
                            </span>
                        </td>

                        <td>
                            <div class="action-buttons">

                                <a href="{{ route('admin.users.edit', $user) }}"
                                   class="btn btn-edit">
                                    Edit
                                </a>

                                <form
                                    action="{{ route('admin.users.destroy', $user) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus pengguna ini?')">

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
                        <td colspan="5" class="empty-row">
                            Belum ada pengguna.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection
