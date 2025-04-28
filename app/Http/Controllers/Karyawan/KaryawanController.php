<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AbsenKaryawan;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class KaryawanController extends Controller
{
    /**
     * Display the karyawan dashboard.
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Ambil tanggal awal dan akhir minggu ini
        $startOfWeek = Carbon::now()->startOfWeek(); // Senin minggu ini
        $endOfWeek = Carbon::now()->endOfWeek();     // Minggu minggu ini

        // Ambil data absensi hanya untuk minggu ini
        $absen = AbsenKaryawan::with(['user', 'user.jabatan'])
                            ->where('user_id', Auth::id())
                            ->whereBetween('tanggal_absensi', [$startOfWeek, $endOfWeek])
                            ->latest()
                            ->get();

        // Hitung statistik absen untuk minggu ini
        $totalHadir = AbsenKaryawan::where('user_id', Auth::id())
                                  ->where('status', 'hadir')
                                  ->whereBetween('tanggal_absensi', [$startOfWeek, $endOfWeek])
                                  ->count();
        
        $totalIzinSakit = AbsenKaryawan::where('user_id', Auth::id())
                                     ->whereIn('status', ['izin', 'sakit'])
                                     ->whereBetween('tanggal_absensi', [$startOfWeek, $endOfWeek])
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
            'absenHariIni' => $absenHariIni ? $absenHariIni->status : 'Belum absen',
            'startOfWeek' => $startOfWeek->format('Y-m-d'),
            'endOfWeek' => $endOfWeek->format('Y-m-d')
        ];

        return view('karyawan.dashboard', $data);
    }
}