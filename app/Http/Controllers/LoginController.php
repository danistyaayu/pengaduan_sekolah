<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    // Halaman login admin
    public function showAdminLogin()
    {
        return view('auth.login-admin');
    }

    // Proses login admin
    public function adminLogin(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('username', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Username atau password salah!');
        }

        if ($user->role !== 'admin') {
            return back()->with('error', 'Anda tidak memiliki akses sebagai admin!');
        }

        if (!$user->is_active) {
            return back()->with('error', 'Akun Anda tidak aktif!');
        }

        Auth::login($user);

        if ($user->must_change_password) {
            return redirect()->route('change-password');
        }

        return redirect()->route('admin.dashboard');
    }

    // Halaman login siswa
    public function showSiswaLogin()
    {
        return view('auth.login-siswa');
    }

    // Proses login siswa
    public function siswaLogin(Request $request)
    {
        $request->validate([
            'nis' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('nis', $request->nis)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->with('error', 'NIS atau password salah!');
        }

        if ($user->role !== 'siswa') {
            return back()->with('error', 'Anda tidak memiliki akses sebagai siswa!');
        }

        if (!$user->is_active) {
            return back()->with('error', 'Akun Anda tidak aktif!');
        }

        Auth::login($user);

        if ($user->must_change_password) {
            return redirect()->route('change-password');
        }

        return redirect()->route('siswa.dashboard');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/login/admin');
    }
}