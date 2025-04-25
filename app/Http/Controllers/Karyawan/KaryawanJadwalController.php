<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JadwalKaryawan;
use Illuminate\Support\Facades\Auth;

class KaryawanJadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $userId = Auth::id();
    
    $jadwals = JadwalKaryawan::with('shift')
        ->where('user_id', $userId)
        ->get()
        ->map(function ($jadwal) {
            // Tambahkan informasi hari untuk setiap tanggal
            for ($i = 1; $i <= 31; $i++) {
                if (!is_null($jadwal["day_$i"])) {
                    $date = \DateTime::createFromFormat('Y-m-d', $jadwal->tahun . '-' . $jadwal->bulan . '-' . $i);
                    $jadwal["is_sunday_$i"] = ($date->format('w') == 0); // 0 = Minggu
                }
            }
            return $jadwal;
        });
    
    return view('karyawan.jadwal.index', compact('jadwals'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
