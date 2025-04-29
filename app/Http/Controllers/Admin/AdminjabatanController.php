<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JabatanKaryawan;

class AdminJabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jabatanKaryawan = JabatanKaryawan::all();
        return view('admin.jabatankaryawan.index', compact('jabatanKaryawan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.jabatankaryawan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_jabatan' => 'required|string|max:50|unique:jabatan_karyawans,nama_jabatan',
        ]);

        JabatanKaryawan::create([
            'nama_jabatan' => $request->nama_jabatan,
        ]);

        return redirect()->route('jabatankaryawan.index')->with('added', 'true');
    }


    /**
     * Display the specified resource.
     */
    public function show(JabatanKaryawan $jabatankaryawan)
    {
        return view('admin.jabatankaryawan.show', compact('jabatankaryawan'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $jabatan = JabatanKaryawan::findOrFail($id);
        return view('admin.jabatankaryawan.edit', compact('jabatan'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_jabatan' => 'required|string|max:50|unique:jabatan_karyawans,nama_jabatan,'.$id,
        ]);

        $jabatan = JabatanKaryawan::findOrFail($id);
        $jabatan->update([
            'nama_jabatan' => $request->nama_jabatan,
        ]);

        return redirect()->route('jabatankaryawan.index')->with('edited', 'true');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $jabatan = JabatanKaryawan::findOrFail($id);
        $jabatan->delete();

        return redirect()->route('jabatankaryawan.index')->with('deleted', 'true');
    }
}
