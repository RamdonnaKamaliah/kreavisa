<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GajiPokok;
use App\Models\JabatanKaryawan;

class AdminGajiPokokController extends Controller
{
    // Index untuk Gaji Pokok
    public function index()
    {
        $gajiPokok = GajiPokok::with('jabatan')->get();
        return view('admin.gajipokok.index', compact('gajiPokok'));
    }

    // Create untuk Gaji Pokok
    public function create()
    {
        $jabatan = JabatanKaryawan::all();
        return view('admin.gajipokok.create', compact('jabatan'));
    }

    // Store untuk Gaji Pokok
    public function store(Request $request)
    {
        $request->validate([
            'jabatan_id' => 'required|exists:jabatan_karyawans,id',
            'gaji_pokok' => 'required|numeric',
        ]);

        GajiPokok::create([
            'jabatan_id' => $request->jabatan_id,
            'gaji_pokok' => $request->gaji_pokok * 1_000_000, // Konversi ke rupiah
        ]);        

        return redirect()->route('gajipokok.index')->with('success', 'Data gaji pokok berhasil ditambahkan.');
    }
}
