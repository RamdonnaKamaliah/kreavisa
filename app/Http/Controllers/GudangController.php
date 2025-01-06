<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GudangController extends Controller
{
    /**
     * Display the gudang dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Data untuk dashboard gudang
        $data = [
            'title' => 'Gudang Dashboard',
            'message' => 'Selamat datang di halaman gudang.',
        ];

        // Return ke view gudang dashboard
        return view('gudang.dashboard', $data);
    }
}
