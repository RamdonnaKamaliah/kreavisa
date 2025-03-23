<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShiftKaryawan;
use App\Models\User;
use App\Models\JabatanKaryawan;
use Illuminate\Http\Request;

class AdminShiftController extends Controller
{
    public function index()
    {
        $shifts = ShiftKaryawan::with('user', 'jabatan')->get();
        return view('admin.shiftkaryawan.index', compact('shifts'));
    }

    public function create()
    {
        $users = User::whereIn('usertype', ['karyawan', 'gudang'])->get();
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

        ShiftKaryawan::create([
            'user_id' => $request->user_id,
            'jabatan_id' => $request->jabatan_id,
            'shift_1' => $request->shift_1_masuk . ' - ' . $request->shift_1_pulang,
            'shift_2' => $request->shift_2_masuk . ' - ' . $request->shift_2_pulang,
        ]);

        return redirect()->route('shiftkaryawan.index')->with('success', 'Shift berhasil ditambahkan.');
    }

    public function update(Request $request, ShiftKaryawan $shiftkaryawan)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'jabatan_id' => 'required|exists:jabatan_karyawans,id',
            'shift_1_masuk' => 'required|date_format:H:i',
            'shift_1_pulang' => 'required|date_format:H:i',
            'shift_2_masuk' => 'required|date_format:H:i',
            'shift_2_pulang' => 'required|date_format:H:i',
        ]);

        $shiftkaryawan->update([
            'user_id' => $request->user_id,
            'jabatan_id' => $request->jabatan_id,
            'shift_1' => $request->shift_1_masuk . ' - ' . $request->shift_1_pulang,
            'shift_2' => $request->shift_2_masuk . ' - ' . $request->shift_2_pulang,
        ]);

        return redirect()->route('shiftkaryawan.index')->with('success', 'Shift berhasil diperbarui.');
    }
}