@extends('layouts.layout')

@section('title', 'Pengaturan')
@section('page-title', 'Pengaturan')

@section('content')

<div>

    <div class="welcome">

        <h2>
            Pengaturan Sistem ⚙️
        </h2>

        <p>
            Pengaturan informasi dan sistem PARKIRKU.
        </p>

    </div>


    <div class="panel">

        <div class="panel-header">

            <div class="panel-title">
                Informasi Sistem
            </div>

            <div class="panel-desc">
                Pengaturan dasar sistem parkir
            </div>

        </div>


        <div style="padding:25px">

            <div style="margin-bottom:20px">

                <label style="
                    display:block;
                    font-size:12px;
                    font-weight:700;
                    margin-bottom:7px;
                ">
                    Nama Sistem
                </label>

                <input
                    type="text"
                    value="PARKIRKU"
                    style="
                        width:100%;
                        padding:11px;
                        border:1px solid #dfe7e2;
                        border-radius:8px;
                    "
                >

            </div>


            <div style="margin-bottom:20px">

                <label style="
                    display:block;
                    font-size:12px;
                    font-weight:700;
                    margin-bottom:7px;
                ">
                    Deskripsi
                </label>

                <input
                    type="text"
                    value="Sistem Informasi Parkir"
                    style="
                        width:100%;
                        padding:11px;
                        border:1px solid #dfe7e2;
                        border-radius:8px;
                    "
                >

            </div>


            <button style="
                border:none;
                background:#15803d;
                color:white;
                padding:10px 18px;
                border-radius:8px;
                font-weight:700;
            ">
                Simpan Pengaturan
            </button>

        </div>

    </div>

</div>

@endsection