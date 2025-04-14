<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AbsenKaryawan;
use Illuminate\Support\Facades\Auth;

class KaryawanController extends Controller
{
    /**
     * Display the karyawan dashboard.
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Ambil data absensi hanya untuk user yang login beserta relasi user dan jabatan
        $absen = AbsenKaryawan::with(['user', 'user.jabatan'])
                            ->where('user_id', Auth::id())
                            ->latest()
                            ->get();

        // Hitung statistik absen
        $totalHadir = AbsenKaryawan::where('user_id', Auth::id())
                                  ->where('status', 'hadir')
                                  ->count();
        
        $totalIzinSakit = AbsenKaryawan::where('user_id', Auth::id())
                                     ->whereIn('status', ['izin', 'sakit'])
                                     ->count();
        
        $absenHariIni = AbsenKaryawan::where('user_id', Auth::id())
                                   ->whereDate('tanggal_absensi', now()->toDateString())
                                   ->first();

        // Data untuk dashboard
        $data = [
            'title' => 'Dashboard Karyawan',
            'absen' => $absen,
            'totalHadir' => $totalHadir,
            'totalIzinSakit' => $totalIzinSakit,
            'absenHariIni' => $absenHariIni ? $absenHariIni->status : 'Belum absen'
        ];

        return view('karyawan.dashboard', $data);
    }
}