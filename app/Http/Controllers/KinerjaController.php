<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KinerjaController extends Controller
{
    public function index()
    {
        return view('karyawan.kinerja.index');
    }
}
