<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AbsenKaryawan;
use App\Models\LokasiAbsen;
use Illuminate\Support\Facades\Auth;

class KaryawanAbsenController extends Controller
{
    public function index()
    {
        // Set timezone ke Asia/Jakarta
        date_default_timezone_set('Asia/Jakarta');
        
        $now = now();
        $currentDate = $now->toDateString();
        
        // Cek absen hari ini
        $todayAbsen = AbsenKaryawan::where('user_id', Auth::id())
                        ->whereDate('tanggal_absensi', $currentDate)
                        ->first();
        
        // Tentukan apakah tombol absen harus ditampilkan
        $showAbsenButton = !$todayAbsen;
        
        return view('karyawan.absen.index', [
            'absen' => AbsenKaryawan::where('user_id', Auth::id())->orderBy('tanggal_absensi', 'desc')->get(),
            'todayAbsen' => $todayAbsen,
            'currentHour' => $now->hour,
            'showAbsenButton' => $showAbsenButton
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil data lokasi absen dari database
        $lokasiAbsen = LokasiAbsen::first();
        
        if (!$lokasiAbsen) {
            return redirect()->route('karyawan.absen.index')
                ->with('error', 'Lokasi absen belum ditentukan oleh admin');
        }

        return view('karyawan.absen.create', [
            'lokasiAbsen' => $lokasiAbsen
        ]);
    }


    public function store(Request $request)
    {
        // Set timezone ke Asia/Jakarta
        date_default_timezone_set('Asia/Jakarta');
        
       // Validasi jam absen (00:01 - 23:59 WIB)
        $currentHour = now()->hour;
        $currentMinute = now()->minute;
        if ($currentHour == 0 && $currentMinute < 1) {
            return back()->withErrors(['error' => 'Absen hanya bisa dilakukan mulai jam 00:01 WIB']);
        }

        // Validasi sudah absen hari ini
        $todayAbsen = AbsenKaryawan::where('user_id', Auth::id())
                        ->whereDate('tanggal_absensi', now()->toDateString())
                        ->first();
                        
        if ($todayAbsen) {
            return back()->withErrors(['error' => 'Anda sudah absen hari ini']);
        }

        // Validasi input
        $request->validate([
            'foto' => 'required',
            'lokasi' => 'required|string',
        ]);
        
        // Ambil koordinat pengguna dari input lokasi hidden
        list($userLat, $userLng) = explode(',', $request->lokasi);
        $userLat = floatval(trim($userLat));
        $userLng = floatval(trim($userLng));

        // Ambil lokasi absen yang ditentukan admin
        $lokasiAbsen = \App\Models\LokasiAbsen::first();
        
        if (!$lokasiAbsen) {
            return redirect()->back()
                ->withErrors(['error' => 'Lokasi absen belum ditentukan oleh admin']);
        }

        // Hitung jarak dari lokasi absen
        $jarak = $this->hitungJarak(
            $userLat, 
            $userLng, 
            $lokasiAbsen->latitude, 
            $lokasiAbsen->longitude
        );

        // Validasi radius
        if ($jarak > $lokasiAbsen->radius) {
            return redirect()->back()
                ->withErrors([
                    'error' => "Anda berada di luar area absen. Jarak Anda: " . 
                    round($jarak, 2) . " meter dari titik absen (maksimal " . 
                    $lokasiAbsen->radius . " meter)"
                ]);
        }

        // Decode Base64 menjadi file gambar
        $imageData = $request->foto;
        $image = str_replace('data:image/png;base64,', '', $imageData);
        $image = str_replace(' ', '+', $image);
        $imageName = 'absen_' . Auth::id() . '_' . time() . '.png';
        $imagePath = 'uploads/absenfoto/' . $imageName;

        // Buat folder jika belum ada
        if (!file_exists(public_path('uploads/absenfoto'))) {
            mkdir(public_path('uploads/absenfoto'), 0775, true);
        }

        // Simpan gambar
        file_put_contents(public_path($imagePath), base64_decode($image));

        // Simpan ke database
        try {
            AbsenKaryawan::create([
                'user_id' => Auth::id(),
                'jabatan_id' => Auth::user()->jabatan_id,
                'lokasi' => $request->lokasi,
                'foto' => $imagePath,
                'status' => 'hadir',
                'tanggal_absensi' => now(),
                'jam_absensi' => now(),
                'jarak_dari_titik' => round($jarak, 2), // Simpan jarak untuk laporan
            ]);

            return redirect()->route('karyawan.absen.index')
        ->with('success', 'Absen Hadir berhasil dicatat.')
        ->with('attendance_type', 'hadir')
        ->with('user_name', Auth::user()->name); // Add this line

        } catch (\Exception $e) {
            // Hapus file gambar jika gagal menyimpan ke database
            if (file_exists(public_path($imagePath))) {
                unlink(public_path($imagePath));
            }
            
            return back()->withErrors(['error' => 'Gagal menyimpan absen: '.$e->getMessage()]);
        }
    }

    /**
     * Fungsi untuk menghitung jarak antara dua titik koordinat (Haversine formula)
     */
    private function hitungJarak($lat1, $lon1, $lat2, $lon2)
    {
        $R = 6371e3; // Radius bumi dalam meter
        $lat1 = deg2rad($lat1);
        $lat2 = deg2rad($lat2);
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
            cos($lat1) * cos($lat2) *
            sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        
        return $R * $c;
    }


    // Untuk absen sakit dan izin, hapus validasi jam 5 pagi
    public function storeSakit(Request $request)
    {
        // Validasi sudah absen hari ini
        $todayAbsen = AbsenKaryawan::where('user_id', Auth::id())
                        ->whereDate('tanggal_absensi', now('Asia/Jakarta')->toDateString())
                        ->first();
                        
        if ($todayAbsen) {
            return back()->withErrors(['error' => 'Anda sudah absen hari ini']);
        }

        $request->validate([
            'file' => 'required|mimes:jpg,jpeg,png,pdf|max:5120', // 5MB
            'lokasi' => 'required|string',
        ]);

        // Pastikan folder upload ada
        $uploadPath = public_path('uploads/absensakit');
        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0775, true);
        }

        // Handle file upload
        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = 'uploads/absensakit/' . $fileName;
        
        try {
            $file->move($uploadPath, $fileName);
            
            // Create attendance record
            AbsenKaryawan::create([
                'user_id' => Auth::id(),
                'jabatan_id' => Auth::user()->jabatan_id,
                'file_surat' => $filePath,
                'foto' => null, // Biarkan NULL
                'status' => 'sakit',
                'tanggal_absensi' => now(),
                'jam_absensi' => now(),
                'lokasi' => $request->lokasi,
            ]);

            // In storeSakit() method
            return redirect()->route('karyawan.absen.index')
            ->with('success', 'Absen sakit berhasil dicatat.')
            ->with('attendance_type', 'sakit')
            ->with('user_name', Auth::user()->name); // Add this line
                        
        } catch (\Exception $e) {
            // Hapus file jika gagal menyimpan ke database
            if (file_exists($uploadPath.'/'.$fileName)) {
                unlink($uploadPath.'/'.$fileName);
            }
            
            return back()->withErrors(['error' => 'Gagal menyimpan absen: '.$e->getMessage()]);
        }
    }

    public function storeIzin(Request $request)
    {
    // Validasi sudah absen hari ini
        $todayAbsen = AbsenKaryawan::where('user_id', Auth::id())
                        ->whereDate('tanggal_absensi', now('Asia/Jakarta')->toDateString())
                        ->first();
                        
        if ($todayAbsen) {
            return back()->withErrors(['error' => 'Anda sudah absen hari ini']);
        }

        $request->validate([
            'file' => 'required|mimes:jpg,png,pdf|max:5120',
            'lokasi' => 'required|string',
        ]);

        // Pindahkan file ke public/uploads/absensakit
        $fileName = time() . '_' . $request->file('file')->getClientOriginalName();
        $filePath = 'uploads/absenizin/' . $fileName;
        $request->file('file')->move(public_path('uploads/absenizin'), $fileName);

        AbsenKaryawan::create([
            'user_id' => Auth::id(),
            'jabatan_id' => Auth::user()->jabatan_id,
            'file_surat' => $filePath,
            'foto' => null, // Biarkan NULL
            'status' => 'izin',
            'tanggal_absensi' => now(),
            'jam_absensi' => now(),
            'lokasi' => $request->lokasi,
        ]);

        return redirect()->route('karyawan.absen.index')
        ->with('success', 'Absen izin berhasil dicatat.')
        ->with('attendance_type', 'izin')
        ->with('user_name', Auth::user()->name); // Add this line
    }


    
    /**
     * Store a newly created resource in storage for sakit/izin.
     */
    public function createSakit()
    {
        return view('karyawan.absen.create-sakit');
    }
    
    
    
    public function createIzin()
    {
        return view('karyawan.absen.create-izin');
    }
    
    
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Menampilkan detail absen
        $absen = AbsenKaryawan::findOrFail($id);
        return view('karyawan.absen.show', compact('absen'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Menampilkan form untuk edit absen (jika diperlukan)
        $absen = AbsenKaryawan::findOrFail($id);
        return view('karyawan.absen.edit', compact('absen'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Update data absen (jika diperlukan)
        $absen = AbsenKaryawan::findOrFail($id);
        $absen->update($request->all());

        return redirect()->route('karyawan.absen.index')->with('success', 'Absen berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Hapus data absen
        $absen = AbsenKaryawan::findOrFail($id);
        $absen->delete();

        return redirect()->route('karyawan.absen.index')->with('success', 'Absen berhasil dihapus.');
    }
}
