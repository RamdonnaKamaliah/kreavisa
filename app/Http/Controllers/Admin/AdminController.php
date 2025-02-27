<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\absenkaryawan;
use App\Models\StokMasuk;
use App\Models\StokKeluar;
use Carbon\Carbon;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Ambil semua karyawan yang bukan admin
        $datakaryawan = User::where('usertype', '!=', 'admin')->get();

        // Ambil data absensi karyawan hanya untuk minggu ini
        $absenkaryawan = AbsenKaryawan::whereBetween('tanggal_absensi', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->get()
            ->groupBy(function ($item) {
                return Carbon::parse($item->tanggal_absensi)->locale('id')->translatedFormat('l'); // Mengubah tanggal ke nama hari
            })
            ->map->count();

        // Ambil data stok masuk
        $stokmasuk = StokMasuk::all();

        // Ambil data stok keluar
        $stokkeluar = StokKeluar::all();

        // Return ke view admin dashboard
        return view('admin.dashboard', compact('datakaryawan', 'absenkaryawan', 'stokmasuk', 'stokkeluar'));
    }
}
