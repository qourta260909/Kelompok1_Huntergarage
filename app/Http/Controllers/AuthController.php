<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan halaman form login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Memproses data yang diketik saat login
    public function prosesLogin(Request $request)
    {
        // nangkap email dan password
        $kredensial = $request->only('email', 'password');

        //  Coba cocokkan sama database
        if (Auth::attempt($kredensial)) {
            
            // klo berhasil login, cek role-nya jadi apa
            if (Auth::user()->role == 'admin') {
                return redirect('/dashboard'); // ke Dashboard Admin
            } 
            
            return redirect('/'); // ke Homepage User
        }

        // 4. Jika password salah, kembalikan ke halaman login
        return back()->with('error', 'Email atau Password salah!');
    }

    // Fitur Logout
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}