<?php

namespace App\Http\Controllers\Karyawan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\GajiKaryawan;
use Barryvdh\DomPDF\Facade\Pdf;


class KaryawanGajiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gajiKaryawan = GajiKaryawan::with(['user', 'user.jabatan'])
    ->where('user_id', auth('web')->id()) // Gunakan 'web' atau guard yang sesuai
    ->get();



        // Kirim data ke view gudang.gaji.index
        return view('karyawan.gaji.index', compact('gajiKaryawan'));
    }

    public function downloadPdf($id)
{
    // Ambil data gaji
    $gaji = GajiKaryawan::with(['user', 'user.jabatan'])
                ->where('id', $id)
                ->where('user_id', auth('web')->id())
                ->firstOrFail();

    // Generate PDF
    $pdf = Pdf::loadView('karyawan.gaji.pdf', compact('gaji'));
    
    // Download PDF dengan nama file spesifik
    return $pdf->download('rekap-gaji-'.$gaji->user->nama_lengkap.'-'.$gaji->tanggal.'.pdf');
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
        // Ambil data gaji berdasarkan ID dengan relasi user dan jabatan
        $gaji = GajiKaryawan::with(['user', 'user.jabatan'])
                    ->where('id', $id)
                    ->where('user_id', auth('web')->id()) // Pastikan hanya pemilik gaji yang bisa melihat
                    ->firstOrFail();

        return view('karyawan.gaji.show', compact('gaji'));
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
