<?php

namespace App\Http\Controllers;

use App\Models\Parkir;
use App\Models\Kendaraan;
use App\Models\Tarif;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ParkirController extends Controller
{
    public function index()
    {
        $parkirs = Parkir::with([
            'kendaraan',
            'tarif'
        ])
        ->latest()
        ->get();

        return view(
            'admin.parkir.index',
            compact('parkirs')
        );
    }

    public function create()
    {
        $kendaraans = Kendaraan::orderBy(
            'plat_nomor'
        )->get();

        $tarifs = Tarif::orderBy(
            'jenis_kendaraan'
        )->get();

        return view(
            'admin.parkir.create',
            compact(
                'kendaraans',
                'tarifs'
            )
        );
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'kendaraan_id' => 'required|exists:kendaraans,id',
            'tarif_id' => 'required|exists:tarifs,id',
            'jam_masuk' => 'required|date',
        ]);

        $data['status'] = 'masuk';

        $data['total_bayar'] = 0;

        Parkir::create($data);

        return redirect()
            ->route('admin.parkir.index')
            ->with('success', 'Data parkir berhasil ditambahkan.');
    }

    public function edit(Parkir $parkir)
    {
        $kendaraans = Kendaraan::orderBy(
            'plat_nomor'
        )->get();

        $tarifs = Tarif::orderBy(
            'jenis_kendaraan'
        )->get();

        return view(
            'admin.parkir.edit',
            compact(
                'parkir',
                'kendaraans',
                'tarifs'
            )
        );
    }

    public function update(Request $request, Parkir $parkir)
    {
        $data = $request->validate([
            'kendaraan_id' => 'required|exists:kendaraans,id',
            'tarif_id' => 'required|exists:tarifs,id',
            'jam_masuk' => 'required|date',
            'jam_keluar' => 'nullable|date|after_or_equal:jam_masuk',
            'status' => 'required|in:masuk,keluar',
        ]);

        if ($data['status'] === 'keluar') {

            if (empty($data['jam_keluar'])) {
                $data['jam_keluar'] = now();
            }

            $masuk = Carbon::parse(
                $data['jam_masuk']
            );

            $keluar = Carbon::parse(
                $data['jam_keluar']
            );

            $jam = max(
                1,
                $masuk->diffInHours($keluar)
            );

            $tarif = Tarif::find(
                $data['tarif_id']
            );

            $data['total_bayar'] =
                $jam * $tarif->tarif_per_jam;
        } else {

            $data['jam_keluar'] = null;
            $data['total_bayar'] = 0;
        }

        $parkir->update($data);

        return redirect()
            ->route('admin.parkir.index')
            ->with('success', 'Data parkir berhasil diperbarui.');
    }

    public function destroy(Parkir $parkir)
    {
        $parkir->delete();

        return redirect()
            ->route('admin.parkir.index')
            ->with('success', 'Data parkir berhasil dihapus.');
    }
}