<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view for admin.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle admin login.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return back()->withErrors(['email' => 'Email atau password salah']);
        }

        $request->session()->regenerate();
        $user = Auth::user();

        if ($user->usertype === 'admin') {
            return redirect('/admin/dashboard');
        }

        Auth::logout();
        return redirect('/login')->withErrors(['email' => 'Hanya admin yang bisa login di sini']);
    }

    /**
     * Display the login view for all karyawan (including ex-gudang).
     */
    public function createKaryawanGudang(): View
    {
        return view('auth.login-karyawan');
    }

    /**
     * Handle login for all karyawan (including ex-gudang).
     */
    public function storeKaryawanGudang(LoginRequest $request): RedirectResponse
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return back()->withErrors(['email' => 'Email atau password salah']);
        }

        $request->session()->regenerate();
        $user = Auth::user();

        // Redirect semua karyawan (termasuk yang usertype gudang) ke dashboard karyawan
        if ($user->usertype === 'karyawan' || $user->usertype === 'gudang') {
            return redirect('/karyawan/dashboard');
        }

        Auth::logout();
        return redirect('/login-karyawan-gudang')->withErrors(['email' => 'Hanya karyawan yang bisa login di sini']);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}