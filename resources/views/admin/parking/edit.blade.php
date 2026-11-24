@extends('layouts.admin')

@section('title', 'Edit Parkir')

@section('header', 'Edit Parkir')

@section('content')

<div class="panel">

    <div class="panel-body">

        <form
            action="{{ route('admin.parkir.update', $parkir) }}"
            method="POST"
        >

            @csrf
            @method('PUT')


            <div class="form-group">

                <label>KENDARAAN</label>

                <select
                    name="kendaraan_id"
                    required
                >

                    @foreach($kendaraans as $kendaraan)

                        <option
                            value="{{ $kendaraan->id }}"
                            {{ $parkir->kendaraan_id == $kendaraan->id ? 'selected' : '' }}
                        >
                            {{ $kendaraan->plat_nomor }}
                            -
                            {{ ucfirst($kendaraan->jenis_kendaraan) }}
                        </option>

                    @endforeach

                </select>

            </div>


            <div class="form-group">

                <label>TARIF</label>

                <select
                    name="tarif_id"
                    required
                >

                    @foreach($tarifs as $tarif)

                        <option
                            value="{{ $tarif->id }}"
                            {{ $parkir->tarif_id == $tarif->id ? 'selected' : '' }}
                        >
                            {{ ucfirst($tarif->jenis_kendaraan) }}
                            -
                            Rp {{ number_format($tarif->tarif_per_jam, 0, ',', '.') }}/jam
                        </option>

                    @endforeach

                </select>

            </div>


            <div class="form-group">

                <label>JAM MASUK</label>

                <input
                    type="datetime-local"
                    name="jam_masuk"
                    value="{{ $parkir->jam_masuk->format('Y-m-d\TH:i') }}"
                    required
                >

            </div>


            <div class="form-group">

                <label>JAM KELUAR</label>

                <input
                    type="datetime-local"
                    name="jam_keluar"
                    value="{{ $parkir->jam_keluar ? $parkir->jam_keluar->format('Y-m-d\TH:i') : '' }}"
                >

            </div>


            <div class="form-group">

                <label>STATUS</label>

                <select
                    name="status"
                    required
                >

                    <option
                        value="masuk"
                        {{ $parkir->status === 'masuk' ? 'selected' : '' }}
                    >
                        Masuk
                    </option>

                    <option
                        value="keluar"
                        {{ $parkir->status === 'keluar' ? 'selected' : '' }}
                    >
                        Keluar
                    </option>

                </select>

            </div>


            <div class="form-actions">

                <button class="btn">
                    Update
                </button>

                <a
                    href="{{ route('admin.parkir.index') }}"
                    class="btn btn-danger"
                >
                    Batal
                </a>

            </div>

        </form>

    </div>

</div>

@endsection