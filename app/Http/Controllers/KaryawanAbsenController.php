<?php

namespace App\Http\Controllers;

class KaryawanAbsenController extends Controller
{
    public function index()
    {
        return view('karyawan.absen'); // Langsung merender view
    }
}
