<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * 1. Menampilkan halaman formulir login
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * 2. Memproses validasi dan submit login
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Mengarahkan ke rute dashboard admin
            return redirect()->route('admin.dashboard');
        }

        // Jika login gagal, kembali dengan error di input email
        return back()->withErrors([
            'email' => 'Email atau Password yang Anda berikan tidak terdaftar di database kami.',
        ]);
    }

    /**
     * 3. Memproses Log Out (Keluar)
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
