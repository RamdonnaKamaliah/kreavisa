<?php

namespace App\Http\Controllers\Karyawan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KinerjaKaryawan;
use Illuminate\Support\Facades\Auth;

class KaryawanKinerjaController extends Controller
{
    public function index()
    {
        // Get the currently logged-in user
        $user = Auth::user();
        
        // Get all performance data for this user, ordered by latest first
        $kinerja = KinerjaKaryawan::where('user_id', $user->id)
                    ->with(['jabatan'])
                    ->orderBy('tanggal_penilaian', 'desc')
                    ->get();
        
        // Calculate averages for each category
        $averages = [
            'tanggung_jawab' => $kinerja->avg('tanggung_jawab'),
            'kehadiran_ketepatan_waktu' => $kinerja->avg('kehadiran_ketepatan_waktu'),
            'produktivitas' => $kinerja->avg('produktivitas'),
            'kerja_sama_tim' => $kinerja->avg('kerja_sama_tim'),
            'kemampuan_komunikasi' => $kinerja->avg('kemampuan_komunikasi'),
            'total_skor' => $kinerja->avg('total_skor')
        ];
        
        return view('karyawan.kinerja.index', compact('kinerja', 'averages'));
    }
}