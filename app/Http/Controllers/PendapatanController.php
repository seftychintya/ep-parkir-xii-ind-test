<?php

namespace App\Http\Controllers;

use App\Models\Parkir;

class PendapatanController extends Controller
{
    public function index()
    {
        $totalPendapatan = Parkir::where('status', 'keluar')
            ->sum('total_bayar');

        $jumlahTransaksi = Parkir::where('status', 'keluar')
            ->count();

        $pendapatans = Parkir::with('kendaraan')
            ->where('status', 'keluar')
            ->latest()
            ->get();

        return view('admin.pendapatan.index', compact(
            'totalPendapatan',
            'jumlahTransaksi',
            'pendapatans'
        ));
    }
}