@extends('layouts.admin')

@section('title', 'Data Parkir')

@section('header', 'Data Parkir')

@section('content')

<div class="page-heading">

    <div>

        <h2>Data Parkir</h2>

        <p>Kelola transaksi parkir</p>

    </div>

    <a
        href="{{ route('admin.parkir.create') }}"
        class="btn"
    >
        + Tambah Parkir
    </a>

</div>


<div class="panel">

    <div class="panel-body">

        <table>

            <thead>

                <tr>

                    <th>No</th>
                    <th>Plat</th>
                    <th>Jenis</th>
                    <th>Masuk</th>
                    <th>Keluar</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Aksi</th>

                </tr>

            </thead>


            <tbody>

                @forelse($parkirs as $parkir)

                    <tr>

                        <td>
                            {{ $loop->iteration }}
                        </td>

                        <td>
                            {{ $parkir->kendaraan->plat_nomor }}
                        </td>

                        <td>
                            {{ ucfirst($parkir->kendaraan->jenis_kendaraan) }}
                        </td>

                        <td>
                            {{ $parkir->jam_masuk->format('d/m/Y H:i') }}
                        </td>

                        <td>

                            @if($parkir->jam_keluar)

                                {{ $parkir->jam_keluar->format('d/m/Y H:i') }}

                            @else

                                -

                            @endif

                        </td>

                        <td>
                            Rp {{ number_format($parkir->total_bayar, 0, ',', '.') }}
                        </td>

                        <td>

                            @if($parkir->status === 'masuk')

                                <span class="badge badge-green">
                                    MASUK
                                </span>

                            @else

                                <span class="badge badge-red">
                                    KELUAR
                                </span>

                            @endif

                        </td>

                        <td>

                            <a
                                href="{{ route('admin.parkir.edit', $parkir) }}"
                                class="btn btn-edit"
                            >
                                Edit
                            </a>

                            <form
                                action="{{ route('admin.parkir.destroy', $parkir) }}"
                                method="POST"
                                style="display:inline"
                            >

                                @csrf
                                @method('DELETE')

                                <button
                                    class="btn btn-danger"
                                    onclick="return confirm('Hapus data parkir?')"
                                >
                                    Hapus
                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="8">
                            Belum ada data parkir.
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection