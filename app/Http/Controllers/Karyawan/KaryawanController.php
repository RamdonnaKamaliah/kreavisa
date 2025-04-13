<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\absenkaryawan;

class KaryawanController extends Controller
{
    /**
     * Display the karyawan dashboard.
     
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Ambil semua data absensi beserta relasi user dan jabatan
        $absen = absenkaryawan::with(['user', 'user.jabatan'])->latest()->get();

        // Data tambahan untuk dashboard
        $data = [
            'title' => 'Karyawan Dashboard',
            'message' => 'Selamat datang di halaman karyawan.',
            'absen' => $absen, 
        ];

        // Return ke view karyawan.dashboard
        return view('karyawan.dashboard', $data);
    }
}
