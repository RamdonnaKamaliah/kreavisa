<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KinerjaKaryawan;
use App\Models\User;
use App\Models\JabatanKaryawan;
use Illuminate\Http\Request;
use App\Exports\KinerjaKaryawanExport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon; // Add this line

class AdminKinerjaController extends Controller
{

    public function export(Request $request) 
{
    $date = $request->input('date');
    $month = null;
    $year = null;
    
    if ($date) {
        $dateParts = explode('-', $date);
        $year = $dateParts[0] ?? date('Y');
        $month = $dateParts[1] ?? date('m');
    }
    
    $filename = 'rekap_kinerja_' . ($month ? date('F_Y', mktime(0, 0, 0, $month, 1, $year)) : 'all') . '.xlsx';
    
    return Excel::download(new KinerjaKaryawanExport($month, $year), $filename);
}

public function index(Request $request)
{
    $query = KinerjaKaryawan::with(['user', 'jabatan']);
    
    if ($request->has('periode')) {
        $query->where('periode', 'like', '%' . $request->periode . '%');
    }
    
    if ($request->has('date')) {
        $date = Carbon::parse($request->date);
        $query->whereYear('tanggal_penilaian', $date->year)
              ->whereMonth('tanggal_penilaian', $date->month);
    }
    
    $kinerja = $query->get();
    
    return view('admin.kinerjakaryawan.index', compact('kinerja'));
}

    public function create()
    {
        $users = User::where('usertype', 'karyawan')
                    ->with('jabatan')
                    ->get();
        return view('admin.kinerjakaryawan.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id',
            'tanggal_penilaian' => 'required|date',
            'periode' => 'required|string',
            'tanggung_jawab' => 'required|integer|min:0|max:5',
            'kehadiran_ketepatan_waktu' => 'required|integer|min:0|max:5',
            'produktivitas' => 'required|integer|min:0|max:5',
            'kerja_sama_tim' => 'required|integer|min:0|max:5',
            'kemampuan_komunikasi' => 'required|integer|min:0|max:5'
        ]);

        foreach ($validated['user_ids'] as $user_id) {
            $user = User::find($user_id);
            
            $kinerja = KinerjaKaryawan::create([
                'user_id' => $user_id,
                'jabatan_id' => $user->jabatan_id,
                'tanggal_penilaian' => $validated['tanggal_penilaian'],
                'periode' => $validated['periode'],
                'tanggung_jawab' => $validated['tanggung_jawab'],
                'kehadiran_ketepatan_waktu' => $validated['kehadiran_ketepatan_waktu'],
                'produktivitas' => $validated['produktivitas'],
                'kerja_sama_tim' => $validated['kerja_sama_tim'],
                'kemampuan_komunikasi' => $validated['kemampuan_komunikasi']
            ]);

            $kinerja->calculateTotalScore();
        }

        return redirect()->route('kinerjakaryawan.index')->with('added', 'true');
    }

    public function show(KinerjaKaryawan $kinerjaKaryawan)
    {
        return view('admin.kinerjakaryawan.show', compact('kinerjaKaryawan'));
    }

    public function edit($id)
{
    $kinerjaKaryawan = KinerjaKaryawan::findOrFail($id);
    return view('admin.kinerjakaryawan.edit', compact('kinerjaKaryawan'));
}

public function update(Request $request, $id)
{
    $validated = $request->validate([
        'user_id' => 'required|exists:users,id',
        'tanggal_penilaian' => 'required|date',
        'periode' => 'required|string',
        'tanggung_jawab' => 'required|integer|min:1|max:5',
        'kehadiran_ketepatan_waktu' => 'required|integer|min:1|max:5',
        'produktivitas' => 'required|integer|min:1|max:5',
        'kerja_sama_tim' => 'required|integer|min:1|max:5',
        'kemampuan_komunikasi' => 'required|integer|min:1|max:5',
    ]);

    $kinerjaKaryawan = KinerjaKaryawan::findOrFail($id);
    $kinerjaKaryawan->update($validated);
    $kinerjaKaryawan->calculateTotalScore();

    return redirect()->route('kinerjakaryawan.index')->with('edited', 'true');
}

    public function destroy($id)
    {
        try {
            // Cari data penilaian berdasarkan ID
            $kinerjaKaryawan = KinerjaKaryawan::findOrFail($id);
            
            // Hapus data
            $kinerjaKaryawan->delete();
            
            return redirect()->route('kinerjakaryawan.index')
            ->with('deleted', 'true');
                
        } catch (\Exception $e) {
            return redirect()->route('kinerjakaryawan.index')
                ->with('error', 'Gagal menghapus penilaian kinerja: '.$e->getMessage());
        }
    }
}