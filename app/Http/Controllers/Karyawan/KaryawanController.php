<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    /**
     * Display the karyawan dashboard.
     
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Data untuk dashboard karyawan
        $data = [
            'title' => 'Karyawan Dashboard',
            'message' => 'Selamat datang di halaman karyawan.',
        ];

        // Return ke view karyawan dashboard
        return view('karyawan.dashboard', $data);
    }
}
