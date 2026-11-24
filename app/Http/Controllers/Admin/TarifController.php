<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tarif;
use Illuminate\Http\Request;

class TarifController extends Controller
{
    /**
     * Menampilkan semua tarif
     */
    public function index()
    {
        $tarif = Tarif::latest()->get();

        return view('admin.tarif.index', compact('tarif'));
    }

    /**
     * Menampilkan form tambah tarif
     */
    public function create()
    {
        return view('admin.tarif.create');
    }

    /**
     * Menyimpan tarif baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'jenis' => 'required|string|max:100',
            'tarif_per_jam' => 'required|numeric|min:0',
        ], [
            'jenis.required' => 'Jenis kendaraan wajib diisi.',
            'tarif_per_jam.required' => 'Tarif per jam wajib diisi.',
            'tarif_per_jam.numeric' => 'Tarif harus berupa angka.',
            'tarif_per_jam.min' => 'Tarif tidak boleh kurang dari 0.',
        ]);

        Tarif::create([
            'jenis' => $request->jenis,
            'tarif_per_jam' => $request->tarif_per_jam,
        ]);

        return redirect()
            ->route('admin.tarif.index')
            ->with('success', 'Tarif berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail tarif
     */
    public function show(string $id)
    {
        $tarif = Tarif::findOrFail($id);

        return view('admin.tarif.show', compact('tarif'));
    }

    /**
     * Menampilkan form edit tarif
     */
    public function edit(string $id)
    {
        $tarif = Tarif::findOrFail($id);

        return view('admin.tarif.edit', compact('tarif'));
    }

    /**
     * Mengupdate tarif
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'jenis' => 'required|string|max:100',
            'tarif_per_jam' => 'required|numeric|min:0',
        ], [
            'jenis.required' => 'Jenis kendaraan wajib diisi.',
            'tarif_per_jam.required' => 'Tarif per jam wajib diisi.',
            'tarif_per_jam.numeric' => 'Tarif harus berupa angka.',
            'tarif_per_jam.min' => 'Tarif tidak boleh kurang dari 0.',
        ]);

        $tarif = Tarif::findOrFail($id);

        $tarif->update([
            'jenis' => $request->jenis,
            'tarif_per_jam' => $request->tarif_per_jam,
        ]);

        return redirect()
            ->route('admin.tarif.index')
            ->with('success', 'Tarif berhasil diperbarui.');
    }

    /**
     * Menghapus tarif
     */
    public function destroy(string $id)
    {
        $tarif = Tarif::findOrFail($id);

        $tarif->delete();

        return redirect()
            ->route('admin.tarif.index')
            ->with('success', 'Tarif berhasil dihapus.');
    }
}