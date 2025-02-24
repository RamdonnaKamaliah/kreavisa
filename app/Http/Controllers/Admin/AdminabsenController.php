<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AbsenKaryawan;
use Illuminate\Http\Request;

class AdminabsenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tanggal = $request->input('tanggal');

        // Ambil semua data jika tidak ada filter tanggal
        $query = AbsenKaryawan::with(['user', 'user.jabatan']);

        // Jika ada tanggal yang dipilih, filter berdasarkan tanggal
        if ($tanggal) {
            $query->whereDate('tanggal_absensi', $tanggal);
        }

        // Menggunakan pagination agar lebih optimal
        $absen = $query->orderBy('tanggal_absensi', 'desc')->paginate(10);

        return view('admin.absenkaryawan.index', compact('absen', 'tanggal'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.absenkaryawan.create');
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
        return view('admin.absenkaryawan.edit');
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
