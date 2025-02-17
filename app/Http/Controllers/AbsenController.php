<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AbsenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view ('karyawan.absen-karyawan.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('karyawan.absen-karyawan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Foto bisa nullable jika menggunakan foto_base64
            'jenis' => 'required|string',
            'latitude' => 'required',
            'longitude' => 'required',
            'foto_base64' => 'nullable|string', // Tambahkan validasi untuk foto_base64
        ]);
    
        // Handle foto (base64 atau file upload)
        if ($request->jenis === 'Hadir') {
            if ($request->foto_base64) {
                // Jika menggunakan foto_base64 (ambil foto dari kamera)
                $image = $request->foto_base64;
                $image_parts = explode(";base64,", $image);
                $image_base64 = base64_decode($image_parts[1]);
                $fileName = 'absen_foto/' . uniqid() . '.jpg';
                Storage::disk('public')->put($fileName, $image_base64);
                $fotoPath = $fileName;
            } elseif ($request->file('foto')) {
                // Jika menggunakan file upload
                $fotoPath = $request->file('foto')->store('absen_foto', 'public');
            } else {
                // Jika tidak ada foto yang diupload atau diambil dari kamera
                return redirect()->back()->with('error', 'Foto wajib diisi untuk absen hadir.');
            }
        } else {
            $fotoPath = null;
        }
    
        // Simpan data ke database
        Absen::create([
            'nama_karyawan' => auth()->user()->name,
            'jabatan' => auth()->user()->jabatan,
            'jenis' => $request->jenis,
            'foto' => $fotoPath,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'tanggal' => now(),
        ]);
    
        // Redirect dengan pesan sukses
        return redirect()->route('karyawan.absen-karyawan.index')->with('success', 'Absen berhasil disimpan');
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
        return view ('karyawan.absen-karyawan.edit');
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
