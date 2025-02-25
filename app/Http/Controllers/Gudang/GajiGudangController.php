<?php

namespace App\Http\Controllers\Gudang;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\GajiKaryawan;

class GajiGudangController extends Controller
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
        return view('gudang.gaji.index', compact('gajiKaryawan'));
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
        return view('gudang.gaji.show');
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
