@extends('layouts.layout')

@section('title', 'Pengguna')
@section('page-title', 'Pengguna')

@section('content')

<div>

    <div class="welcome">

        <h2>
            Manajemen Pengguna 👥
        </h2>

        <p>
            Admin dapat memantau dan mengelola
            pengguna sistem PARKIRKU.
        </p>

    </div>


    <div class="panel">

        <div class="panel-header">

            <div class="panel-title">
                Daftar Pengguna
            </div>

            <div class="panel-desc">
                Owner, Admin, dan Petugas
            </div>

        </div>


        <div style="padding:20px">

            <button style="
                border:none;
                background:#15803d;
                color:white;
                padding:10px 16px;
                border-radius:8px;
                font-weight:700;
                cursor:pointer;
            ">
                + Tambah Pengguna
            </button>

        </div>


        <div class="table-wrapper">

            <table>

                <thead>

                    <tr>

                        <th>No</th>

                        <th>Nama</th>

                        <th>Username</th>

                        <th>Role</th>

                        <th>Status</th>

                        <th>Aksi</th>

                    </tr>

                </thead>


                <tbody>

                    <tr>

                        <td>1</td>

                        <td>Owner</td>

                        <td>owner</td>

                        <td>

                            <span class="badge badge-green">
                                OWNER
                            </span>

                        </td>

                        <td>
                            Aktif
                        </td>

                        <td>
                            Edit &nbsp; Hapus
                        </td>

                    </tr>


                    <tr>

                        <td>2</td>

                        <td>Admin</td>

                        <td>admin</td>

                        <td>

                            <span class="badge badge-green">
                                ADMIN
                            </span>

                        </td>

                        <td>
                            Aktif
                        </td>

                        <td>
                            Edit &nbsp; Hapus
                        </td>

                    </tr>


                    <tr>

                        <td>3</td>

                        <td>Petugas</td>

                        <td>petugas</td>

                        <td>

                            <span class="badge badge-orange">
                                PETUGAS
                            </span>

                        </td>

                        <td>
                            Aktif
                        </td>

                        <td>
                            Edit &nbsp; Hapus
                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection