<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik utama
        $totalKendaraan = DB::table('kendaraan')->count();

        $parkirAktif = DB::table('parkir')
            ->where('status', 'masuk')
            ->count();

        $totalTarif = DB::table('tarif')->count();

        // Statistik parkir 7 hari terakhir
        $tanggalMulai = Carbon::today()->subDays(6);
        $tanggalAkhir = Carbon::today();

        $parkirMingguIni = DB::table('parkir')
            ->whereBetween('jam_masuk', [
                $tanggalMulai,
                $tanggalAkhir->copy()->endOfDay()
            ])
            ->count();

        $parkirMingguLalu = DB::table('parkir')
            ->whereBetween('jam_masuk', [
                $tanggalMulai->copy()->subDays(7),
                $tanggalMulai->copy()->subSecond()
            ])
            ->count();

        $persentaseParkir = $parkirMingguLalu > 0
            ? round(
                (($parkirMingguIni - $parkirMingguLalu)
                / $parkirMingguLalu) * 100,
                1
            )
            : ($parkirMingguIni > 0 ? 100 : 0);

        $trenParkir = $parkirMingguIni > $parkirMingguLalu
            ? 'naik'
            : ($parkirMingguIni < $parkirMingguLalu ? 'turun' : 'sama');

        // Grafik aktivitas kendaraan 1 jam terakhir
        $grafikLabels = [];
        $grafikMasuk = [];
        $grafikKeluar = [];

        $waktuAkhir = Carbon::now();
        $waktuMulai = $waktuAkhir->copy()->subHour();

        for ($i = 0; $i < 12; $i++) {
            $awal = $waktuMulai->copy()->addMinutes($i * 5);
            $akhir = $awal->copy()->addMinutes(5);

            if ($akhir->gt($waktuAkhir)) {
                $akhir = $waktuAkhir->copy();
            }

            $grafikLabels[] = $awal->format('H:i');

            $grafikMasuk[] = DB::table('parkir')
                ->where('jam_masuk', '>=', $awal)
                ->where('jam_masuk', '<', $akhir)
                ->count();

            $grafikKeluar[] = DB::table('parkir')
                ->whereNotNull('jam_keluar')
                ->where('jam_keluar', '>=', $awal)
                ->where('jam_keluar', '<', $akhir)
                ->count();
        }

        return view('admin.dashboard', compact(
            'totalKendaraan',
            'parkirAktif',
            'totalTarif',
            'parkirMingguIni',
            'persentaseParkir',
            'trenParkir',
            'grafikLabels',
            'grafikMasuk',
            'grafikKeluar'
        ));
    }
}
