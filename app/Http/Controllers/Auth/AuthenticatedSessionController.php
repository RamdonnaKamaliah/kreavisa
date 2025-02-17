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
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
{
    // Autentikasi hanya untuk karyawan atau gudang
    if (!Auth::attempt($request->only('email', 'password'))) {
        return back()->withErrors(['email' => 'Email atau password salah']);
    }

    $request->session()->regenerate();

    $user = Auth::user();

    // Redirect berdasarkan usertype
    if ($user->usertype === 'admin') {
        return redirect('/admin/dashboard');
    }

    Auth::logout();
    return redirect('/login')->withErrors(['email' => 'Anda tidak memiliki akses']);
}

   
     
     public function storeKaryawanGudang(LoginRequest $request): RedirectResponse
{
    // Autentikasi hanya untuk karyawan atau gudang
    if (!Auth::attempt($request->only('email', 'password'))) {
        return back()->withErrors(['email' => 'Email atau password salah']);
    }

    $request->session()->regenerate();

    $user = Auth::user();

    // Redirect berdasarkan usertype
    if ($user->usertype === 'karyawan') {
        return redirect('/karyawan/dashboard');
    }

    if ($user->usertype === 'gudang') {
        return redirect('/gudang/dashboard');
    }

    Auth::logout();
    return redirect('/login-karyawan-gudang')->withErrors(['email' => 'Anda tidak memiliki akses']);
}


    public function createKaryawanGudang(): View
    {
        return view('auth.login-karyawan');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $user = Auth::user();
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        if ($user && $user->usertype === 'admin') {
            return redirect('/');
        }
    
        return redirect('/');
    }
    
}
