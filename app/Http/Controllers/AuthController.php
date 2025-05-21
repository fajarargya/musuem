<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Logout method
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login'); // Atau ke halaman utama jika mau
    }

    // Menampilkan form registrasi
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Menyimpan data registrasi pengguna baru
    public function register(Request $request)
    {
        // Validasi data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Membuat user baru
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'user', // Set role default user
        ]);
        // Redirect atau beri respons setelah registrasi berhasil
        return redirect('/login')->with('success', 'Registrasi berhasil, silakan login');
    }

    // Menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        // Validasi data login
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Cek kredensial
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            // Login berhasil, arahkan ke halaman index museum
            return redirect()->route('museum.index');
        } else {
            // Jika login gagal
            return back()->withErrors([
                'email' => 'Email atau password salah',
            ]);
        }
    }
}
