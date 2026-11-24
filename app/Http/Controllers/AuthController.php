<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\LogAktifitas;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | TAMPILKAN LOGIN
    |--------------------------------------------------------------------------
    */

    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('login');
    }


    /*
    |--------------------------------------------------------------------------
    | PROSES LOGIN
    |--------------------------------------------------------------------------
    */

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        /*
        |--------------------------------------------------------------------------
        | CEK LOGIN
        |--------------------------------------------------------------------------
        */

        if (!Auth::attempt([
            'username' => $credentials['username'],
            'password' => $credentials['password'],
        ])) {

            return back()
                ->withErrors([
                    'username' => 'Username atau password salah.',
                ])
                ->withInput(
                    $request->only('username')
                );
        }

        /*
        |--------------------------------------------------------------------------
        | REGENERATE SESSION
        |--------------------------------------------------------------------------
        */

        $request->session()->regenerate();

        $user = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | SIMPAN ROLE
        |--------------------------------------------------------------------------
        */

        $request->session()->put('role', $user->role);

        /*
        |--------------------------------------------------------------------------
        | SIMPAN LOG AKTIVITAS LOGIN
        |--------------------------------------------------------------------------
        */

        LogAktifitas::create([
            'id_user' => $user->id,
            'aktivitas' => 'Login ke sistem',
            'waktu_aktivitas' => now(),
        ]);

        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect()->route('dashboard');
    }


    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */

    public function logout(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | SIMPAN DATA USER SEBELUM LOGOUT
        |--------------------------------------------------------------------------
        */

        $user = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | SIMPAN LOG AKTIVITAS LOGOUT
        |--------------------------------------------------------------------------
        */

        if ($user) {
            LogAktifitas::create([
                'id_user' => $user->id,
                'aktivitas' => 'Logout dari sistem',
                'waktu_aktivitas' => now(),
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | LOGOUT
        |--------------------------------------------------------------------------
        */

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}