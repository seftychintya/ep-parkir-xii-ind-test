<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Parkir;
use Illuminate\Http\Request;

class RekapController extends Controller
{
    /**
     * Menampilkan halaman rekap parkir
     */
    public function index(Request $request)
    {
        $tanggalMulai = $request->tanggal_mulai;
        $tanggalSelesai = $request->tanggal_selesai;

        $query = Parkir::with('kendaraan')
            ->where('status', 'keluar');

        // Filter tanggal mulai
        if ($tanggalMulai) {
            $query->whereDate('jam_masuk', '>=', $tanggalMulai);
        }

        // Filter tanggal selesai
        if ($tanggalSelesai) {
            $query->whereDate('jam_masuk', '<=', $tanggalSelesai);
        }

        $parkir = $query
            ->orderBy('jam_masuk', 'desc')
            ->get();

        $totalKendaraan = $parkir->count();

        $totalPendapatan = $parkir->sum(function ($item) {
            return (float) ($item->total_bayar ?? 0);
        });

        return view('owner.rekap', compact(
            'parkir',
            'totalKendaraan',
            'totalPendapatan',
            'tanggalMulai',
            'tanggalSelesai'
        ));
    }

    /**
     * Menampilkan halaman khusus untuk dicetak
     */
    public function cetak(Request $request)
    {
        $tanggalMulai = $request->tanggal_mulai;
        $tanggalSelesai = $request->tanggal_selesai;

        $query = Parkir::with('kendaraan')
            ->where('status', 'keluar');

        // Filter tanggal mulai
        if ($tanggalMulai) {
            $query->whereDate('jam_masuk', '>=', $tanggalMulai);
        }

        // Filter tanggal selesai
        if ($tanggalSelesai) {
            $query->whereDate('jam_masuk', '<=', $tanggalSelesai);
        }

        $parkir = $query
            ->orderBy('jam_masuk', 'asc')
            ->get();

        $totalKendaraan = $parkir->count();

        $totalPendapatan = $parkir->sum(function ($item) {
            return (float) ($item->total_bayar ?? 0);
        });

        return view('owner.rekap-cetak', compact(
            'parkir',
            'totalKendaraan',
            'totalPendapatan',
            'tanggalMulai',
            'tanggalSelesai'
        ));
    }
}