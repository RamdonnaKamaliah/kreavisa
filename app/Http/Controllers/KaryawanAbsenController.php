<?php

namespace App\Http\Controllers;

use App\Models\Absen; // Import model Absen

class KaryawanAbsenController extends Controller
{
    public function index()
    {
        $absen = Absen::all(); // Ambil semua data absensi
        return view('karyawan.absen', compact('absen')); // Kirimkan data ke view
    }
}
