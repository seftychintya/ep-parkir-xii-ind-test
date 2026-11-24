<?php

namespace App\Http\Controllers;

use App\Models\Parkir;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = Parkir::with('kendaraan')
            ->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $parkirs = $query->get();

        $totalParkir = Parkir::count();

        $parkirMasuk = Parkir::where('status', 'masuk')->count();

        $parkirKeluar = Parkir::where('status', 'keluar')->count();

        $totalPendapatan = Parkir::where('status', 'keluar')
            ->sum('total_bayar');

        return view('admin.laporan.index', compact(
            'parkirs',
            'totalParkir',
            'parkirMasuk',
            'parkirKeluar',
            'totalPendapatan'
        ));
    }
}