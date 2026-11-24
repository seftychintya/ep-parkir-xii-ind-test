<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Parkir;

class StrukController extends Controller
{
    public function show(Parkir $transaksi)
    {
        $transaksi->load('kendaraan');

        return view('petugas.struk', compact('transaksi'));
    }
}