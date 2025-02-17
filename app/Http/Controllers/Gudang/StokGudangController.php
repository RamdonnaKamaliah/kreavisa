<?php

namespace App\Http\Controllers\Gudang;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StokGudangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('gudang.stok-gudang.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $type = $request->query('type'); // Ambil tipe dari query string
    
        if ($type == 'masuk') {
            return view('gudang.stok-gudang.create_stok_masuk');
        } elseif ($type == 'keluar') {
            return view('gudang.stok-gudang.create_stok_keluar');
        }
    
        return redirect()->route('stok-gudang.index')->with('error', 'Tipe tidak valid!');
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
    public function edit(Request $request, $id)
    {
        $type = $request->query('type'); // Ambil tipe dari query string
        $stokGudang = StokGudang::findOrFail($id); // Ambil data berdasarkan ID
    
        if ($type == 'masuk') {
            return view('gudang.stok-gudang.edit_stok_masuk', compact('stokGudang'));
        } elseif ($type == 'keluar') {
            return view('gudang.stok-gudang.edit_stok_keluar', compact('stokGudang'));
        }
    
        return redirect()->route('stok-gudang.index')->with('error', 'Tipe tidak valid!');
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
