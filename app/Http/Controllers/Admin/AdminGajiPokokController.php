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

        // Cek apakah jabatan sudah memiliki gaji pokok
        if (GajiPokok::where('jabatan_id', $request->jabatan_id)->exists()) {
            return redirect()->back()->withErrors(['Gaji pokok untuk jabatan ini sudah ada.']);
        }

        GajiPokok::create([
            'jabatan_id' => $request->jabatan_id,
            'gaji_pokok' => $request->gaji_pokok * 1_000_000, // Konversi ke rupiah
        ]);

        return redirect()->route('gajipokok.index')->with('added', 'true');
    }

        public function show($id)
    {
        $gajipokok = GajiPokok::with('jabatan')->findOrFail($id);
        return view('admin.gajipokok.show', compact('gajipokok'));
    }


    // Edit Gaji Pokok
    public function edit($id)
    {
        $gajiPokok = GajiPokok::findOrFail($id);
        $jabatan = JabatanKaryawan::all();
        return view('admin.gajipokok.edit', compact('gajiPokok', 'jabatan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'gaji_pokok' => 'required|numeric',
        ]);

        $gajiPokok = GajiPokok::findOrFail($id);
        $gajiPokok->update([
            'gaji_pokok' => $request->gaji_pokok * 1_000_000, // Konversi ke rupiah
        ]);

        return redirect()->route('gajipokok.index')->with('edited', 'true');
    }


    // Hapus Gaji Pokok
    public function destroy($id)
    {
        $gajiPokok = GajiPokok::findOrFail($id);
        $gajiPokok->delete();

        return redirect()->route('gajipokok.index')->with('deleted', 'true');
    }
}
