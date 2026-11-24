<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LogAktifitas;

class LogAktifitasController extends Controller
{
    public function index()
    {
        $logs = LogAktifitas::with('user')
            ->orderBy('waktu_aktivitas', 'desc')
            ->get();

        return view(
            'admin.log-aktifitas',
            compact('logs')
        );
    }
}