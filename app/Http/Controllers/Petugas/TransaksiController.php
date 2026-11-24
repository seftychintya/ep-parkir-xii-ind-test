<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    /**
     * Menampilkan daftar transaksi parkir.
     */
    public function index()
    {
        $parkirs = DB::table('parkir')
            ->leftJoin('kendaraan', 'parkir.kendaraan_id', '=', 'kendaraan.id')
            ->leftJoin('area_parkir', 'parkir.area_parkir_id', '=', 'area_parkir.id')
            ->select(
                'parkir.*',
                'kendaraan.plat_nomor',
                'kendaraan.jenis',
                'area_parkir.nama_area'
            )
            ->orderByDesc('parkir.id')
            ->get();

        return view('petugas.transaksi.index', compact('parkirs'));
    }

    /**
     * Menampilkan form transaksi parkir.
     */
    public function create()
    {
        $kendaraans = DB::table('kendaraan')
            ->orderBy('plat_nomor')
            ->get();

        $areas = DB::table('area_parkir')
            ->where('status', 'aktif')
            ->orderBy('nama_area')
            ->get();

        return view('petugas.transaksi.create', compact(
            'kendaraans',
            'areas'
        ));
    }

    /**
     * Menyimpan kendaraan masuk.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kendaraan_id' => ['required', 'integer', 'exists:kendaraan,id'],
            'area_parkir_id' => ['required', 'integer', 'exists:area_parkir,id'],
            'slot' => ['required', 'string', 'max:50'],
            'jam_masuk' => ['required', 'date'],
        ]);

        $kendaraanId = (int) $validated['kendaraan_id'];
        $areaId = (int) $validated['area_parkir_id'];
        $slot = trim($validated['slot']);
        $jamMasuk = Carbon::parse($validated['jam_masuk']);

        do {
            $kodeTiket = 'TKT-' . now()->format('YmdHis') . '-' . random_int(100, 999);

            $kodeSudahAda = DB::table('parkir')
                ->where('kode_tiket', $kodeTiket)
                ->exists();

        } while ($kodeSudahAda);

        try {
            $hasil = DB::transaction(function () use (
                $kendaraanId,
                $areaId,
                $slot,
                $jamMasuk,
                $kodeTiket
            ) {
                // Kunci area agar pemeriksaan kapasitas tidak saling mendahului.
                $area = DB::table('area_parkir')
                    ->where('id', $areaId)
                    ->lockForUpdate()
                    ->first();

                if (!$area || $area->status !== 'aktif') {
                    return 'area_tidak_aktif';
                }

                if ($area->terisi >= $area->kapasitas) {
                    return 'penuh';
                }

                // Cek kendaraan yang masih parkir.
                $sudahParkir = DB::table('parkir')
                    ->where('kendaraan_id', $kendaraanId)
                    ->where('status', 'masuk')
                    ->exists();

                if ($sudahParkir) {
                    return 'kendaraan_masih_parkir';
                }

                // Cek slot yang masih digunakan.
                $slotTerpakai = DB::table('parkir')
                    ->where('slot', $slot)
                    ->where('status', 'masuk')
                    ->exists();

                if ($slotTerpakai) {
                    return 'slot_terpakai';
                }

                // Simpan transaksi.
                // Trigger MySQL akan menambah area_parkir.terisi otomatis.
                DB::table('parkir')->insert([
                    'kendaraan_id' => $kendaraanId,
                    'area_parkir_id' => $areaId,
                    'kode_tiket' => $kodeTiket,
                    'slot' => $slot,
                    'jam_masuk' => $jamMasuk,
                    'jam_keluar' => null,
                    'durasi' => 0,
                    'total_bayar' => 0,
                    'status' => 'masuk',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                return 'berhasil';
            });

            if ($hasil === 'penuh') {
                return back()->withInput()->with(
                    'error',
                    'Area parkir sudah penuh. Silakan pilih area lain.'
                );
            }

            if ($hasil === 'area_tidak_aktif') {
                return back()->withInput()->with(
                    'error',
                    'Area parkir tidak aktif atau tidak ditemukan.'
                );
            }

            if ($hasil === 'kendaraan_masih_parkir') {
                return back()->withInput()->with(
                    'error',
                    'Kendaraan tersebut masih tercatat sedang parkir.'
                );
            }

            if ($hasil === 'slot_terpakai') {
                return back()->withInput()->with(
                    'error',
                    'Slot parkir tersebut sedang digunakan.'
                );
            }

            return redirect()
                ->route('petugas.transaksi.index')
                ->with('success', 'Parkir berhasil disimpan. Kode tiket: ' . $kodeTiket);

        } catch (\Throwable $e) {
            Log::error('Gagal menyimpan transaksi parkir: ' . $e->getMessage());

            if (str_contains($e->getMessage(), 'KAPASITAS_AREA_PENUH')) {
                return back()->withInput()->with(
                    'error',
                    'Area parkir sudah penuh. Silakan pilih area lain.'
                );
            }

            return back()
                ->withInput()
                ->with('error', 'Transaksi gagal disimpan. Periksa log aplikasi.');
        }
    }

    /**
     * Menampilkan detail transaksi.
     */
    public function show($id)
    {
        $transaksi = DB::table('parkir')
            ->leftJoin('kendaraan', 'parkir.kendaraan_id', '=', 'kendaraan.id')
            ->leftJoin('area_parkir', 'parkir.area_parkir_id', '=', 'area_parkir.id')
            ->select(
                'parkir.*',
                'kendaraan.plat_nomor',
                'kendaraan.jenis',
                'area_parkir.nama_area'
            )
            ->where('parkir.id', $id)
            ->first();

        if (!$transaksi) {
            abort(404);
        }

        return view('petugas.transaksi.show', compact('transaksi'));
    }

    /**
     * Memproses kendaraan keluar.
     * Trigger MySQL menghitung biaya dan memperbarui slot.
     */
    public function update(Request $request, $id)
    {
        try {
            $hasil = DB::transaction(function () use ($id) {

                $transaksi = DB::table('parkir')
                    ->where('id', $id)
                    ->lockForUpdate()
                    ->first();

                if (!$transaksi) {
                    return 'tidak_ditemukan';
                }

                if ($transaksi->status === 'keluar') {
                    return 'sudah_keluar';
                }

                DB::table('parkir')
                    ->where('id', $id)
                    ->update([
                        'status' => 'keluar',
                        'updated_at' => now(),
                    ]);

                return 'berhasil';
            });

            if ($hasil === 'tidak_ditemukan') {
                return redirect()
                    ->route('petugas.transaksi.index')
                    ->with('error', 'Transaksi tidak ditemukan.');
            }

            if ($hasil === 'sudah_keluar') {
                return redirect()
                    ->route('petugas.transaksi.show', $id)
                    ->with('error', 'Kendaraan sudah diproses keluar.');
            }

            return redirect()
                ->route('petugas.transaksi.show', $id)
                ->with('success', 'Kendaraan keluar. Biaya dan slot parkir diperbarui otomatis.');

        } catch (\Throwable $e) {
            Log::error('Gagal memproses kendaraan keluar: ' . $e->getMessage());

            return redirect()
                ->route('petugas.transaksi.show', $id)
                ->with('error', 'Gagal memproses kendaraan keluar. Silakan periksa log aplikasi.');
        }
    }
}