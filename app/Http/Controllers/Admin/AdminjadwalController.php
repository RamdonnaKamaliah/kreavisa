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

    $bulan = $request->input('bulan', date('m'));
    $tahun = $request->input('tahun', date('Y'));

    $karyawans = User::whereIn('usertype', ['Gudang', 'Karyawan'])
                    ->with('jabatan')
                    ->get();

    $jadwals = JadwalKaryawan::with(['shift', 'user', 'jabatan'])
                ->where('bulan', $bulan)
                ->where('tahun', $tahun)
                ->get()
                ->mapWithKeys(function ($item) {
                    return [$item->user_id => $item];
                });

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
        'shift_type' => 'required|in:1,2',
        'bulan' => 'required|array',
        'bulan.*' => 'integer|min:1|max:12',
        'tahun' => 'required|integer|digits:4|min:' . date('Y') . '|max:' . (date('Y') + 5),
    ], [
        'tahun.min' => 'Tahun harus minimal :min.',
        'tahun.max' => 'Tahun harus maksimal :max.',
        'bulan.*.integer' => 'Bulan harus berupa angka.',
        'bulan.*.min' => 'Bulan harus minimal :min.',
        'bulan.*.max' => 'Bulan harus maksimal :max.',
    ]);

    $shift = ShiftKaryawan::find($request->shift_id);
    $shiftValue = ($request->shift_type == 1) ? $shift->shift_1 : $shift->shift_2;

    foreach ($request->bulan as $bulan) {
        $existingJadwal = JadwalKaryawan::where('user_id', $request->user_id)
            ->where('bulan', $bulan)
            ->where('tahun', $request->tahun)
            ->first();

        if ($existingJadwal) {
            $namaBulan = \DateTime::createFromFormat('!m', $bulan)->format('F');
            $namaTahun = $request->tahun;
            
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

        // Hitung jumlah hari dalam bulan
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $bulan, $request->tahun);

        for ($i = 1; $i <= $daysInMonth; $i++) {
            // Cek apakah hari ini Minggu (0 = Minggu dalam format date('w'))
            $date = \DateTime::createFromFormat('Y-m-d', $request->tahun . '-' . $bulan . '-' . $i);
            if ($date->format('w') == 0) { // Hari Minggu
                $jadwalData["day_$i"] = null; // Kosongkan shift untuk hari Minggu
            } else {
                $jadwalData["day_$i"] = $shiftValue;
            }
        }

        // Set hari di luar jumlah hari bulan ini ke null
        for ($i = $daysInMonth + 1; $i <= 31; $i++) {
            $jadwalData["day_$i"] = null;
        }

        JadwalKaryawan::create($jadwalData);
    }

    return redirect()->route('jadwalkaryawan.index')->with('added', 'true');
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
    ])->with('edited', 'true' . \DateTime::createFromFormat('!m', $jadwal->bulan)->format('F') . ' berhasil diperbarui.');
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
