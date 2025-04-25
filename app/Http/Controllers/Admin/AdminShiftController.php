<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShiftKaryawan;
use App\Models\JadwalKaryawan;
use App\Models\User;
use App\Models\JabatanKaryawan;
use Illuminate\Http\Request;

class AdminShiftController extends Controller
{
    // Di method index()
public function index()
{
    // Hanya tampilkan shift yang memiliki relasi user yang aktif
    $shifts = ShiftKaryawan::whereHas('user', function($query) {
        $query->whereIn('usertype', ['karyawan', 'gudang']);
    })->with(['user', 'jabatan'])->get();
    
    return view('admin.shiftkaryawan.index', compact('shifts'));
}

public function create()
{
    // Ambil hanya user yang belum memiliki shift dan aktif
    $users = User::whereIn('usertype', ['karyawan', 'gudang'])
        ->whereDoesntHave('shift')
        ->get();
        
    $jabatans = JabatanKaryawan::all();
    return view('admin.shiftkaryawan.create', compact('users', 'jabatans'));
}
    public function store(Request $request)
{
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'jabatan_id' => 'required|exists:jabatan_karyawans,id',
        'shift_1_masuk' => 'required|date_format:H:i',
        'shift_1_pulang' => 'required|date_format:H:i',
        'shift_2_masuk' => 'required|date_format:H:i',
        'shift_2_pulang' => 'required|date_format:H:i',
    ]);

    // Cek apakah sudah ada shift untuk user ini
    $existingShift = ShiftKaryawan::where('user_id', $request->user_id)->first();

    if ($existingShift) {
        // Jika sudah ada shift, kembalikan dengan pesan error
        $namaUser = User::find($request->user_id)->nama_lengkap; // Ambil nama user
        return redirect()->back()
            ->withInput()
            ->withErrors(['user_id' => 'Shift untuk ' . $namaUser . ' sudah ada.']);
    }

    ShiftKaryawan::create([
        'user_id' => $request->user_id,
        'jabatan_id' => $request->jabatan_id,
        'shift_1' => $request->shift_1_masuk . ' - ' . $request->shift_1_pulang,
        'shift_2' => $request->shift_2_masuk . ' - ' . $request->shift_2_pulang,
    ]);

    return redirect()->route('shiftkaryawan.index')->with('added', 'true');
}

// App\Http\Controllers\Admin\AdminShiftController.php

public function update(Request $request, $id)
{
    $request->validate([
        'shift_1_masuk' => 'required|date_format:H:i',
        'shift_1_pulang' => 'required|date_format:H:i',
        'shift_2_masuk' => 'required|date_format:H:i',
        'shift_2_pulang' => 'required|date_format:H:i',
    ]);

    $shift = ShiftKaryawan::findOrFail($id);
    
    $shift->update([
        'shift_1' => $request->shift_1_masuk . ' - ' . $request->shift_1_pulang,
        'shift_2' => $request->shift_2_masuk . ' - ' . $request->shift_2_pulang,
    ]);

    // Update semua jadwal yang menggunakan shift ini
    $jadwals = JadwalKaryawan::where('shift_id', $shift->id)->get();
    foreach ($jadwals as $jadwal) {
        $jadwal->updateShiftTimes();
    }

    return redirect()->route('shiftkaryawan.index')->with('edited', 'true');
}

    public function edit($id)
{
    $shift = ShiftKaryawan::with('user', 'user.jabatan')->findOrFail($id);
    return view('admin.shiftkaryawan.edit', compact('shift'));
}

public function show($id)
{
    $shift = ShiftKaryawan::with('user', 'user.jabatan')->findOrFail($id);
    return view('admin.shiftkaryawan.show', compact('shift'));
}

public function destroy($id)
{
    // First find the shift
    $shift = ShiftKaryawan::findOrFail($id);
    
    // Delete any related jadwal entries first
    JadwalKaryawan::where('shift_id', $shift->id)->delete();
    
    // Then delete the shift itself
    $shift->delete();
    
    return redirect()->route('shiftkaryawan.index')->with('deleted', 'true');
}
}