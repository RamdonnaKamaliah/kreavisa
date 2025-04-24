<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GajiKaryawan;
use App\Models\User;
use App\Models\JabatanKaryawan;
use App\Exports\GajiKaryawanExport;
use Maatwebsite\Excel\Facades\Excel;

class AdminGajiController extends Controller
{

    public function export(Request $request) 
{
    $date = $request->date ? date('Y-m-d', strtotime($request->date)) : null;
    return Excel::download(new GajiKaryawanExport($date), 'laporan_gaji_karyawan.xlsx');
}

    /**
     * Menampilkan daftar gaji karyawan.
     */
    public function index()
    {
        // Ambil data gaji karyawan beserta relasi user dan jabatan
        $gajiKaryawan = GajiKaryawan::with(['user', 'user.jabatan'])->get();
        return view('admin.gajikaryawan.index', compact('gajiKaryawan'));
    }

    /**
     * Menampilkan form untuk membuat gaji karyawan baru.
     */
    public function create()
    {
        // Ambil data user (karyawan) dan jabatan
        $users = User::where('usertype', '!=', 'admin')->get(['id', 'nama_lengkap']);

        $jabatan = JabatanKaryawan::all();
        return view('admin.gajikaryawan.create', compact('users', 'jabatan'));
    }

    public function getGajiPokok($user_id)
    {
        $user = User::with('jabatan', 'gajiPokok')->find($user_id);
        if ($user && $user->gajiPokok) {
            return response()->json(['gaji_pokok' => $user->gajiPokok->gaji_pokok]);
        }
        return response()->json(['gaji_pokok' => 0]);
    }
    
    /**
     * Menampilkan detail gaji karyawan.
     */
    public function show($id)
    {
        // Ambil data gaji karyawan beserta relasi user dan jabatan
        $gajiKaryawan = GajiKaryawan::with(['user', 'user.jabatan'])->findOrFail($id);
        return view('admin.gajikaryawan.show', compact('gajiKaryawan'));
    }


    /**
     * Menyimpan gaji karyawan baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'tanggal' => 'required|date',
            'nomor_rekening' => 'required',
            'tipe_pembayaran' => 'required',
            'bonus' => 'nullable|numeric',
            'potongan' => 'nullable|numeric',
        ]);
    
        $user = User::with('jabatan', 'gajiPokok')->find($request->user_id);
    
        if (!$user || !$user->gajiPokok) {
            return back()->with('error', 'Gaji pokok tidak ditemukan untuk karyawan ini.');
        }
    
        $gaji_pokok = $user->gajiPokok->gaji_pokok ?? 0;
    
        // Ambil nilai bonus dan potongan langsung dalam rupiah
        $bonus = $request->bonus ?? 0;
        $potongan = $request->potongan ?? 0;
    
        $total_gaji = $gaji_pokok + $bonus - $potongan;
    
        GajiKaryawan::create([
            'user_id' => $request->user_id,
            'tanggal' => $request->tanggal,
            'nomor_rekening' => $request->nomor_rekening,
            'tipe_pembayaran' => $request->tipe_pembayaran,
            'gaji_pokok' => $gaji_pokok,
            'bonus' => $bonus,
            'potongan' => $potongan,
            'total_gaji' => $total_gaji,
        ]);
    
        return redirect()->route('gajikaryawan.index')->with('added', 'true');
    }
    
    /**
     * Menampilkan form untuk mengedit gaji karyawan.
     */
    public function edit($id)
    {
        // Ambil data gaji karyawan berdasarkan ID
        $gajiKaryawan = GajiKaryawan::findOrFail($id);
        $users = User::where('usertype', '!=', 'admin')->get();
        $jabatan = JabatanKaryawan::all();
        return view('admin.gajikaryawan.edit', compact('gajiKaryawan', 'users', 'jabatan'));
    }

    /**
     * Mengupdate data gaji karyawan di database.
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'tanggal' => 'required|date',
            'nomor_rekening' => 'required|string',
            'tipe_pembayaran' => 'required|string',
            'gaji_pokok' => 'required|numeric',
            'bonus' => 'nullable|numeric',
            'potongan' => 'nullable|numeric',
        ]);
    
        // Hitung total gaji
        $totalGaji = $request->gaji_pokok + ($request->bonus ?? 0) - ($request->potongan ?? 0);
    
        // Update data gaji karyawan
        $gajiKaryawan = GajiKaryawan::findOrFail($id);
        $gajiKaryawan->update([
            'user_id' => $request->user_id,
            'tanggal' => $request->tanggal,
            'nomor_rekening' => $request->nomor_rekening,
            'tipe_pembayaran' => $request->tipe_pembayaran,
            'gaji_pokok' => $request->gaji_pokok,
            'bonus' => $request->bonus ?? 0,
            'potongan' => $request->potongan ?? 0,
            'total_gaji' => $totalGaji,
        ]);
    
        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('gajikaryawan.index')->with('edited', 'true');
    }

    /**
     * Menghapus data gaji karyawan dari database.
     */
    public function destroy($id)
    {
        // Cari dan hapus data gaji karyawan berdasarkan ID
        $gajiKaryawan = GajiKaryawan::findOrFail($id);
        $gajiKaryawan->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('gajikaryawan.index')->with('deleted', 'true');
    }
}