<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JadwalKaryawan;
use App\Models\User;
use App\Models\JabatanKaryawan;
use App\Models\ShiftKaryawan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminjadwalController extends Controller
{


    public function index(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }
    
        $user = Auth::user();
    
        if (!$user) {
            abort(403, 'User tidak ditemukan');
        }
    
        // Ambil nilai bulan dan tahun dari request
        $bulan = $request->input('bulan', date('m')); // Default: bulan saat ini
        $tahun = $request->input('tahun', date('Y')); // Default: tahun saat ini
    
        // Ambil semua karyawan
        $karyawans = User::whereIn('usertype', ['Gudang', 'Karyawan'])->with('jabatan')->get();
    
        // Ambil data jadwal berdasarkan bulan dan tahun yang dipilih
        $jadwals = JadwalKaryawan::with(['shift', 'user', 'jabatan'])
            ->where('bulan', $bulan)
            ->where('tahun', $tahun)
            ->get()
            ->keyBy('user_id'); // Gunakan user_id sebagai key untuk memudahkan pencarian
    
        return view('admin.jadwalkaryawan.index', compact('karyawans', 'jadwals', 'bulan', 'tahun'));
    }
    

    /**
     * Menampilkan form untuk membuat jadwal baru.
     */
    
     public function create()
     {
         $users = User::whereIn('usertype', ['Gudang', 'Karyawan'])->get(); // Filter user
         $jabatans = JabatanKaryawan::all();
         $shifts = ShiftKaryawan::all();
         
         return view('admin.jadwalkaryawan.create', compact('users', 'jabatans', 'shifts'));
     }
     

    /**
     * Menyimpan jadwal baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'jabatan_id' => 'required|exists:jabatan_karyawans,id',
            'shift_id' => 'required|exists:shift_karyawans,id',
            'shift_type' => 'required|in:1,2', // Validasi shift_type (1 atau 2)
            'bulan' => 'required|array', // Bulan sekarang berupa array
            'bulan.*' => 'integer|min:1|max:12', // Validasi setiap bulan
            'tahun' => 'required|integer|digits:4|min:' . date('Y') . '|max:' . (date('Y') + 5), // Validasi tahun 4 digit
        ]);
    
        // Ambil shift yang dipilih
        $shift = ShiftKaryawan::find($request->shift_id);
        $shiftValue = ($request->shift_type == 1) ? $shift->shift_1 : $shift->shift_2;
    
        // Simpan data jadwal untuk setiap bulan yang dipilih
        foreach ($request->bulan as $bulan) {
            $jadwalData = [
                'user_id' => $request->user_id,
                'jabatan_id' => $request->jabatan_id,
                'shift_id' => $request->shift_id,
                'shift_type' => $request->shift_type,
                'bulan' => $bulan,
                'tahun' => $request->tahun,
            ];
    
            // Isi semua hari dengan shift yang dipilih
            for ($i = 1; $i <= 31; $i++) {
                $jadwalData["day_$i"] = $shiftValue;
            }
    
            JadwalKaryawan::create($jadwalData);
        }
    
        return redirect()->route('jadwalkaryawan.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail jadwal karyawan.
     */
    public function show(JadwalKaryawan $jadwal)
    {
        return view('admin.jadwalkaryawan.show', compact('jadwal'));
    }

    /**
     * Menampilkan form edit jadwal.
     */
    public function edit(JadwalKaryawan $jadwal)
    {
        $users = User::all();
        $jabatans = JabatanKaryawan::all();
        $shifts = ShiftKaryawan::all();
        return view('admin.jadwalkaryawan.edit', compact('jadwal', 'users', 'jabatans', 'shifts'));
    }

    /**
     * Mengupdate data jadwal.
     */
    public function update(Request $request, JadwalKaryawan $jadwal)
{
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'jabatan_id' => 'required|exists:jabatan_karyawans,id',
        'shift_id' => 'required|exists:shift_karyawans,id',
        'bulan' => 'required|integer|min:1|max:12',
        'tahun' => 'required|integer|min:' . date('Y') . '|max:' . (date('Y') + 5),
    ]);

    $jadwal->update($request->all());

    return redirect()->route('jadwalkaryawan.index')->with('success', 'Jadwal berhasil diperbarui.');
}

    /**
     * Menghapus jadwal dari database.
     */
    public function destroy(JadwalKaryawan $jadwal)
    {
        $jadwal->delete();
        return redirect()->route('admin.jadwalkaryawan.index')->with('success', 'Jadwal berhasil dihapus');
    }

}
