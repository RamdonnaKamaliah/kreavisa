<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AbsenKaryawan;
use App\Models\LokasiAbsen;
use Illuminate\Http\Request;
use App\Exports\AbsenKaryawanExport;
use Maatwebsite\Excel\Facades\Excel;

class AdminabsenController extends Controller
{

    public function export(Request $request) 
    {
        $date = $request->date ? date('Y-m-d', strtotime($request->date)) : null;
        return Excel::download(new AbsenKaryawanExport($date), 'rekap_absen_karyawan.xlsx');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tanggal = $request->input('tanggal');
        $lokasiAbsen = LokasiAbsen::first(); // Ambil data lokasi (asumsi hanya 1 lokasi)

        // Query absen karyawan
        $query = AbsenKaryawan::with(['user', 'user.jabatan']);
        if ($tanggal) {
            $query->whereDate('tanggal_absensi', $tanggal);
        }
        $absen = $query->orderBy('tanggal_absensi', 'desc')->paginate(10);

        return view('admin.absenkaryawan.index', compact('absen', 'tanggal', 'lokasiAbsen'));
    }

    public function updateLokasi(Request $request)
    {
        $request->validate([
            'google_maps_link' => 'required|url',
            'radius' => 'required|integer|min:1',
        ]);

        // Ekstrak koordinat dari link Google Maps
        $coords = $this->extractCoordinates($request->google_maps_link);
        
        if (!$coords) {
            return redirect()->back()
                ->with('error', 'Link Google Maps tidak valid. Pastikan link mengandung koordinat lokasi.')
                ->withInput();
        }

        // Cari atau buat record baru jika tidak ada
        $lokasi = LokasiAbsen::firstOrCreate(
            ['id' => 1], // Asumsi kita gunakan ID 1 untuk data utama
            [
                'nama_lokasi' => 'Lokasi Kantor',
                'latitude' => 0,
                'longitude' => 0,
                'radius' => 100,
                'alamat' => null
            ]
        );

        // Update data
        $lokasi->latitude = $coords['lat'];
        $lokasi->longitude = $coords['lng'];
        $lokasi->radius = $request->radius;
        $lokasi->save();

        return redirect()->route('absenkaryawan.index')
            ->with('success', 'Lokasi absen berhasil diperbarui');
    }

    // Fungsi untuk ekstrak koordinat dari link Google Maps
    private function extractCoordinates($url)
    {
        // Coba ekstrak dari format baru (maps.google.com/?q=lat,lng)
        if (preg_match('/@(-?\d+\.\d+),(-?\d+\.\d+)/', $url, $matches)) {
            return ['lat' => $matches[1], 'lng' => $matches[2]];
        }
        
        // Coba ekstrak dari format lama (maps.google.com/?ll=lat,lng)
        if (preg_match('/!3d(-?\d+\.\d+)!4d(-?\d+\.\d+)/', $url, $matches)) {
            return ['lat' => $matches[1], 'lng' => $matches[2]];
        }
        
        // Coba ekstrak dari format parameter query
        $query = parse_url($url, PHP_URL_QUERY);
        parse_str($query, $params);
        
        if (isset($params['q'])) {
            $coords = explode(',', $params['q']);
            if (count($coords) === 2 && is_numeric($coords[0]) && is_numeric($coords[1])) {
                return ['lat' => $coords[0], 'lng' => $coords[1]];
            }
        }
        
        return null;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.absenkaryawan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('admin.absenkaryawan.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
