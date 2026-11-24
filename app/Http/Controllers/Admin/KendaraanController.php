<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KendaraanController extends Controller
{
    /**
     * Menampilkan daftar kendaraan.
     */
    public function index()
    {
        $kendaraans = DB::table('kendaraan')
            ->orderByDesc('id')
            ->get();

        return view('admin.kendaraan.index', compact('kendaraans'));
    }

    /**
     * Menampilkan form tambah kendaraan.
     */
    public function create()
    {
        return view('admin.kendaraan.create');
    }

    /**
     * Menyimpan kendaraan baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'plat_nomor' => 'required|string|max:20|unique:kendaraan,plat_nomor',
            'jenis'      => 'required|string|max:50',
        ], [
            'plat_nomor.required' => 'Plat nomor wajib diisi.',
            'plat_nomor.unique'   => 'Plat nomor sudah terdaftar.',
            'jenis.required'      => 'Jenis kendaraan wajib diisi.',
        ]);

        DB::table('kendaraan')->insert([
            'plat_nomor' => strtoupper($request->plat_nomor),
            'jenis'      => $request->jenis,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()
            ->route('admin.kendaraan.index')
            ->with('success', 'Kendaraan berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail kendaraan.
     */
    public function show($id)
    {
        $kendaraan = DB::table('kendaraan')
            ->where('id', $id)
            ->first();

        if (!$kendaraan) {
            abort(404);
        }

        return view('admin.kendaraan.show', compact('kendaraan'));
    }

    /**
     * Menampilkan form edit kendaraan.
     */
    public function edit(string $id)
    {
        $kendaraan = Kendaraan::findOrFail($id);

        return view('admin.kendaraan.edit', compact('kendaraan'));
    }

    /**
     * Mengupdate kendaraan.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'plat_nomor' => 'required|string|max:20',
            'jenis'      => 'required|string|max:50',
            'pemilik'    => 'nullable|string|max:100',
        ]);

        $kendaraan = Kendaraan::findOrFail($id);

        $kendaraan->update([
            'plat_nomor' => strtoupper($request->plat_nomor),
            'jenis'      => $request->jenis,
            'pemilik'    => $request->pemilik,
        ]);

        return redirect()
            ->route('admin.kendaraan.index')
            ->with('success', 'Data kendaraan berhasil diperbarui.');
    }

    /**
     * Menghapus kendaraan.
     */
    public function destroy(string $id)
    {
        $kendaraan = Kendaraan::findOrFail($id);

        // Cek apakah kendaraan sudah memiliki transaksi parkir
        $adaTransaksi = DB::table('parkir')
            ->where('kendaraan_id', $id)
            ->exists();

        if ($adaTransaksi) {
            return redirect()
                ->route('admin.kendaraan.index')
                ->with(
                    'error',
                    'Kendaraan tidak bisa dihapus karena sudah memiliki transaksi parkir.'
                );
        }

        // Hapus kendaraan
        $kendaraan->delete();

        return redirect()
            ->route('admin.kendaraan.index')
            ->with('success', 'Kendaraan berhasil dihapus.');
    }
}