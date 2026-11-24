<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\AuthController;

// ADMIN
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\TarifController;
use App\Http\Controllers\Admin\AreaParkirController;
use App\Http\Controllers\Admin\KendaraanController;
use App\Http\Controllers\Admin\LogAktifitasController;

// PETUGAS
use App\Http\Controllers\Petugas\TransaksiController;
use App\Http\Controllers\Petugas\StrukController;

// OWNER
use App\Http\Controllers\Owner\RekapController;


/*
|--------------------------------------------------------------------------
| HALAMAN AWAL
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});


/*
|--------------------------------------------------------------------------
| LOGIN
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.process');

});


/*
|--------------------------------------------------------------------------
| USER YANG SUDAH LOGIN
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {


    /*
    |--------------------------------------------------------------------------
    | DASHBOARD UTAMA
    |--------------------------------------------------------------------------
    |
    | Setelah login, pengguna diarahkan berdasarkan role.
    |
    */

    Route::get('/dashboard', function () {

        $user = auth()->user();

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($user->role === 'petugas') {
            return redirect()->route('petugas.dashboard');
        }

        if ($user->role === 'owner') {
            return redirect()->route('owner.dashboard');
        }

        abort(403, 'Role pengguna tidak dikenali.');

    })->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | ADMIN
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:admin')
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {


            /*
            |--------------------------------------------------------------------------
            | DASHBOARD ADMIN
            |--------------------------------------------------------------------------
            */

            Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

            /*
            |--------------------------------------------------------------------------
            | CRUD PENGGUNA
            |--------------------------------------------------------------------------
            */

            Route::resource('users', UserController::class);


            /*
            |--------------------------------------------------------------------------
            | CRUD TARIF
            |--------------------------------------------------------------------------
            */

            Route::resource('tarif', TarifController::class);


            /*
            |--------------------------------------------------------------------------
            | CRUD AREA PARKIR
            |--------------------------------------------------------------------------
            */

            Route::resource('area', AreaParkirController::class);


            /*
            |--------------------------------------------------------------------------
            | CRUD KENDARAAN
            |--------------------------------------------------------------------------
            */

            Route::resource('kendaraan', KendaraanController::class);


            /*
            |--------------------------------------------------------------------------
            | LOG AKTIFITAS
            |--------------------------------------------------------------------------
            */

            Route::get('/log-aktifitas', [
                LogAktifitasController::class,
                'index'
            ])->name('log-aktifitas');

        });


    /*
    |--------------------------------------------------------------------------
    | PETUGAS
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:petugas')
        ->prefix('petugas')
        ->name('petugas.')
        ->group(function () {


            /*
            |--------------------------------------------------------------------------
            | DASHBOARD PETUGAS
            |--------------------------------------------------------------------------
            */

            Route::get('/dashboard', function () {

                $totalKendaraan = DB::table('kendaraan')->count();

                $totalTransaksi = DB::table('parkir')->count();

                $parkirAktif = DB::table('parkir')
                    ->where('status', 'masuk')
                    ->count();

                $totalPendapatan = DB::table('parkir')
                    ->where('status', 'keluar')
                    ->sum('total_bayar');

                return view('petugas.dashboard', [
                    'totalKendaraan' => $totalKendaraan,
                    'totalTransaksi' => $totalTransaksi,
                    'parkirAktif' => $parkirAktif,
                    'totalPendapatan' => $totalPendapatan,
                ]);

})->name('dashboard');

            /*
            |--------------------------------------------------------------------------
            | TRANSAKSI PARKIR
            |--------------------------------------------------------------------------
            |
            | GET     /petugas/transaksi
            | GET     /petugas/transaksi/create
            | POST    /petugas/transaksi
            | GET     /petugas/transaksi/{transaksi}
            | PUT     /petugas/transaksi/{transaksi}
            |
            */

            Route::resource('transaksi', TransaksiController::class)
                ->only([
                    'index',
                    'create',
                    'store',
                    'show',
                    'update'
                ]);


            /*
            |--------------------------------------------------------------------------
            | CETAK STRUK
            |--------------------------------------------------------------------------
            */

            Route::get('/struk/{transaksi}', [
                StrukController::class,
                'show'
            ])->name('struk');

        });


    /*
    |--------------------------------------------------------------------------
    | OWNER
    |--------------------------------------------------------------------------
    */

    Route::prefix('owner')->name('owner.')->middleware(['auth', 'role:owner'])->group(function () {

    Route::get('/dashboard', function () {
        return view('owner.dashboard');
    })->name('dashboard');

    // Rekap Parkir
    Route::get('/rekap', [\App\Http\Controllers\Owner\RekapController::class, 'index'])
        ->name('rekap');

    // Halaman khusus cetak
    Route::get('/rekap/cetak', [\App\Http\Controllers\Owner\RekapController::class, 'cetak'])
        ->name('rekap.cetak');

});


    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

});