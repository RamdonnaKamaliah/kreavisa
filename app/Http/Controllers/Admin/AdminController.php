<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Data untuk dashboard admin
        $data = [
            'title' => 'Admin Dashboard',
            'message' => 'Selamat datang di halaman admin.',
        ];

        // Return ke view admin dashboard
        return view('admin.dashboard', $data);
    }
}
