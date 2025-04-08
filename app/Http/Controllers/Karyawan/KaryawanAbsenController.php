<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AbsenKaryawan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class KaryawanAbsenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    // Set timezone ke Asia/Jakarta
    date_default_timezone_set('Asia/Jakarta');
    
    $now = now();
    $currentHour = $now->hour;
    $currentDate = $now->toDateString();
    
    // Cek absen hari ini
    $todayAbsen = AbsenKaryawan::where('user_id', Auth::id())
                    ->whereDate('tanggal_absensi', $currentDate)
                    ->first();
    
    return view('karyawan.absen.index', [
        'absen' => AbsenKaryawan::where('user_id', Auth::id())->orderBy('tanggal_absensi', 'desc')->get(),
        'todayAbsen' => $todayAbsen,
        'currentHour' => $currentHour
    ]);
}
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Menampilkan form untuk absen hadir
        return view('karyawan.absen.create');
    }

    
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{

    // Validasi jam absen
$currentHour = now('Asia/Jakarta')->hour;
if ($currentHour < 5) {
    return back()->withErrors(['error' => 'Absen hanya bisa dilakukan mulai jam 05:00 WIB']);
}

// Validasi sudah absen hari ini
$todayAbsen = AbsenKaryawan::where('user_id', Auth::id())
                ->whereDate('tanggal_absensi', now('Asia/Jakarta')->toDateString())
                ->first();
                
if ($todayAbsen) {
    return back()->withErrors(['error' => 'Anda sudah absen hari ini']);
}

    // Validasi input
    $request->validate([
        'foto' => 'required',
        'lokasi' => 'required|string',
    ]);
     
    // Ambil koordinat pengguna dari input lokasi
    list($userLat, $userLng) = explode(',', $request->lokasi);
    $userLat = floatval(trim($userLat));
    $userLng = floatval(trim($userLng));

    // Koordinat titik absen
    $titikAbsen = ['lat' => -6.6048439603911815, 'lng' => 106.7282283957573];
    $radiusMaksimum = 10000; // 10 meter

    // Fungsi hitung jarak (Haversine formula)
    function hitungJarak($lat1, $lon1, $lat2, $lon2) {
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

    $jarak = hitungJarak($userLat, $userLng, $titikAbsen['lat'], $titikAbsen['lng']);

    // Validasi apakah berada dalam radius yang diizinkan
    if ($jarak > $radiusMaksimum) {
        return redirect()->back()->withErrors(["Anda berada di luar area absen. Jarak Anda: " . round($jarak, 2) . " meter."]);
    }

    // Decode Base64 menjadi file gambar
    $imageData = $request->foto;
    $image = str_replace('data:image/png;base64,', '', $imageData);
    $image = str_replace(' ', '+', $image);
    $imageName = 'absen_' . Auth::id() . '_' . time() . '.png';
    $imagePath = 'uploads/absenfoto/' . $imageName;

    if (!file_exists(public_path('uploads/absenfoto'))) {
        mkdir(public_path('uploads/absenfoto'), 0775, true);
    }

    file_put_contents(public_path($imagePath), base64_decode($image));

    // Simpan ke database
    AbsenKaryawan::create([
        'user_id' => Auth::id(),
        'jabatan_id' => Auth::user()->jabatan_id,
        'lokasi' => $request->lokasi,
        'foto' => $imagePath,
        'status' => 'hadir',
        'tanggal_absensi' => now(),
        'jam_absensi' => now(),
    ]);

    return redirect()->route('karyawan.absen.index')
    ->with('success', 'Absen Hadir berhasil dicatat.')
    ->with('attendance_type', 'hadir');
}


    
    /**
     * Store a newly created resource in storage for sakit/izin.
     */
    public function createSakit()
    {
        return view('karyawan.absen.create-sakit');
    }
    
    public function storeSakit(Request $request)
{

    // Validasi jam absen
$currentHour = now('Asia/Jakarta')->hour;
if ($currentHour < 5) {
    return back()->withErrors(['error' => 'Absen hanya bisa dilakukan mulai jam 05:00 WIB']);
}

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
            'foto' => 'default.png', // atau null jika kolom sudah nullable
            'status' => 'sakit',
            'tanggal_absensi' => now(),
            'jam_absensi' => now(),
            'lokasi' => $request->lokasi,
        ]);

        // In storeSakit() method
return redirect()->route('karyawan.absen.index')
->with('success', 'Absen sakit berhasil dicatat.')
->with('attendance_type', 'sakit');

            
    } catch (\Exception $e) {
        // Hapus file jika gagal menyimpan ke database
        if (file_exists($uploadPath.'/'.$fileName)) {
            unlink($uploadPath.'/'.$fileName);
        }
        
        return back()->withErrors(['error' => 'Gagal menyimpan absen: '.$e->getMessage()]);
    }
}

    
    public function createIzin()
    {
        return view('karyawan.absen.create-izin');
    }
    
    public function storeIzin(Request $request)
    {

        // Validasi jam absen
$currentHour = now('Asia/Jakarta')->hour;
if ($currentHour < 5) {
    return back()->withErrors(['error' => 'Absen hanya bisa dilakukan mulai jam 05:00 WIB']);
}

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
            'status' => 'izin',
            'tanggal_absensi' => now(),
            'jam_absensi' => now(),
            'lokasi' => $request->lokasi,
        ]);
    
       // In storeIzin() method
return redirect()->route('karyawan.absen.index')
->with('success', 'Absen izin berhasil dicatat.')
->with('attendance_type', 'izin');
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