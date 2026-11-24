<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AreaParkir;
use Illuminate\Http\Request;

class AreaParkirController extends Controller
{
    /**
     * Menampilkan semua area parkir
     */
    public function index()
    {
        $area = AreaParkir::latest()->get();

        return view('admin.area.index', compact('area'));
    }

    /**
     * Form tambah area
     */
    public function create()
    {
        return view('admin.area.create');
    }

    /**
     * Simpan area baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_area' => 'required|string|max:100',
            'kapasitas' => 'required|integer|min:1',
            'terisi' => 'required|integer|min:0',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        if ($request->terisi > $request->kapasitas) {
            return back()
                ->withInput()
                ->withErrors([
                    'terisi' => 'Jumlah terisi tidak boleh melebihi kapasitas.'
                ]);
        }

        AreaParkir::create([
            'nama_area' => $request->nama_area,
            'kapasitas' => $request->kapasitas,
            'terisi' => $request->terisi,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('admin.area.index')
            ->with('success', 'Area parkir berhasil ditambahkan.');
    }

    /**
     * Detail area
     */
    public function show(string $id)
    {
        $area = AreaParkir::findOrFail($id);

        return view('admin.area.show', compact('area'));
    }

    /**
     * Form edit
     */
    public function edit(string $id)
    {
        $area = AreaParkir::findOrFail($id);

        return view('admin.area.edit', compact('area'));
    }

    /**
     * Update area
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_area' => 'required|string|max:100',
            'kapasitas' => 'required|integer|min:1',
            'terisi' => 'required|integer|min:0',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        if ($request->terisi > $request->kapasitas) {
            return back()
                ->withInput()
                ->withErrors([
                    'terisi' => 'Jumlah terisi tidak boleh melebihi kapasitas.'
                ]);
        }

        $area = AreaParkir::findOrFail($id);

        $area->update([
            'nama_area' => $request->nama_area,
            'kapasitas' => $request->kapasitas,
            'terisi' => $request->terisi,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('admin.area.index')
            ->with('success', 'Area parkir berhasil diperbarui.');
    }

    /**
     * Hapus area
     */
    public function destroy(string $id)
    {
        $area = AreaParkir::findOrFail($id);

        $area->delete();

        return redirect()
            ->route('admin.area.index')
            ->with('success', 'Area parkir berhasil dihapus.');
    }
}