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
    
        $jadwals = JadwalKaryawan::with(['shift', 'user', 'jabatan'])
        ->where('bulan', $bulan)
        ->where('tahun', $tahun)
        ->get()
        ->keyBy('user_id');

    return view('admin.jadwalkaryawan.index', compact('karyawans', 'jadwals', 'bulan', 'tahun'));
    }
    

    /**
     * Menampilkan form untuk membuat jadwal baru.
     */
    
     public function create()
{
    // Ambil hanya karyawan yang sudah memiliki shift
    $usersWithShifts = User::whereIn('usertype', ['Gudang', 'Karyawan'])
        ->whereHas('shifts') // Hanya yang punya relasi shifts
        ->with('jabatan')
        ->get();

    $jabatans = JabatanKaryawan::all();
    $shifts = ShiftKaryawan::all();
    
    return view('admin.jadwalkaryawan.create', compact('usersWithShifts', 'jabatans', 'shifts'));
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
    ], [
        'tahun.min' => 'Tahun harus minimal :min.',
        'tahun.max' => 'Tahun harus maksimal :max.',
        'bulan.*.integer' => 'Bulan harus berupa angka.',
        'bulan.*.min' => 'Bulan harus minimal :min.',
        'bulan.*.max' => 'Bulan harus maksimal :max.',
    ]);

    // Ambil shift yang dipilih
    $shift = ShiftKaryawan::find($request->shift_id);
    $shiftValue = ($request->shift_type == 1) ? $shift->shift_1 : $shift->shift_2;

    // Simpan data jadwal untuk setiap bulan yang dipilih
    foreach ($request->bulan as $bulan) {
        // Cek apakah sudah ada jadwal di bulan yang sama untuk user ini
        $existingJadwal = JadwalKaryawan::where('user_id', $request->user_id)
            ->where('bulan', $bulan)
            ->where('tahun', $request->tahun)
            ->first();

            if ($existingJadwal) {
                // Jika sudah ada jadwal, kembalikan dengan pesan error
                $namaBulan = \DateTime::createFromFormat('!m', $bulan)->format('F'); // Ambil nama bulan
                $namaTahun = $request->tahun; // Ambil tahun dari request
            
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['bulan' => 'Jadwal untuk bulan ' . $namaBulan . ' di tahun ' . $namaTahun . ' sudah ada.']);
            }

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
    public function show($id)
    {
        $jadwal = JadwalKaryawan::with(['user', 'jabatan', 'shift'])->findOrFail($id);
        return view('admin.jadwalkaryawan.show', compact('jadwal'));
    }

    /**
     * Menampilkan form edit jadwal.
     */
    public function edit($id)
    {
        $jadwal = JadwalKaryawan::findOrFail($id);
        $users = User::whereIn('usertype', ['Gudang', 'Karyawan'])->get();
        $jabatans = JabatanKaryawan::all();
        $shifts = ShiftKaryawan::where('user_id', $jadwal->user_id)->get();
        
        return view('admin.jadwalkaryawan.edit', compact('jadwal', 'users', 'jabatans', 'shifts'));
    }

    public function update(Request $request, $id)
{
    $jadwal = JadwalKaryawan::findOrFail($id);
    $shift = ShiftKaryawan::find($jadwal->shift_id);
    
    // Validasi input
    $request->validate([
        'bulan' => 'required|integer|min:1|max:12',
        'tahun' => 'required|integer|min:2000|max:2100',
    ]);
    
    // Pastikan hanya mengedit jadwal untuk bulan dan tahun yang sesuai
    $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $jadwal->bulan, $jadwal->tahun);
    
    // Update setiap hari dalam bulan tersebut
    for ($i = 1; $i <= $daysInMonth; $i++) {
        $shiftType = $request->input("shift_type_$i", $jadwal->shift_type);
        $shiftValue = $shiftType == 1 ? $shift->shift_1 : $shift->shift_2;
        $jadwal->{"day_$i"} = $shiftValue;
    }
    
    // Set hari di luar jumlah hari bulan ini ke null
    for ($i = $daysInMonth + 1; $i <= 31; $i++) {
        $jadwal->{"day_$i"} = null;
    }
    
    $jadwal->save();

    return redirect()->route('jadwalkaryawan.index', [
        'bulan' => $jadwal->bulan,
        'tahun' => $jadwal->tahun
    ])->with('success', 'Jadwal untuk bulan ' . \DateTime::createFromFormat('!m', $jadwal->bulan)->format('F') . ' berhasil diperbarui.');
}
    /**
     * Menghapus jadwal dari database.
     */
    public function destroy($id)
    {
        $jadwal = JadwalKaryawan::findOrFail($id); // Tambahkan ini
        $jadwal->delete();
        return redirect()->route('jadwalkaryawan.index')->with('deleted', 'true');
    }

}
