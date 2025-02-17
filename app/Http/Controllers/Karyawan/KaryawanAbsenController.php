<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KaryawanAbsenController extends Controller
{
    public function index()
    {
        return view('karyawan.absen'); // Langsung merender view
    }

    //*absen store

    public function store(Request $request)
    {
       
    }
    }

