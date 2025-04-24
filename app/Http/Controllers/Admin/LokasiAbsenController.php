<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LokasiAbsen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LokasiAbsenController extends Controller
{
    public function index()
    {
        $lokasi = LokasiAbsen::all();
        return view('admin.lokasi-absen.index', compact('lokasi'));
    }

    public function create()
    {
        return view('admin.lokasi-absen.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_lokasi' => 'required|string|max:255',
            'google_maps_link' => 'required|url',
            'radius' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Ekstrak latitude dan longitude dari link Google Maps
        $coords = $this->extractCoordinates($request->google_maps_link);
        
        if (!$coords) {
            return redirect()->back()
                ->with('error', 'Link Google Maps tidak valid. Pastikan link mengandung koordinat lokasi.')
                ->withInput();
        }

        LokasiAbsen::create([
            'nama_lokasi' => $request->nama_lokasi,
            'latitude' => $coords['lat'],
            'longitude' => $coords['lng'],
            'radius' => $request->radius,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('admin.lokasi-absen.index')
            ->with('success', 'Lokasi absen berhasil ditambahkan');
    }

    public function edit($id)
    {
        $lokasi = LokasiAbsen::findOrFail($id);
        return view('admin.lokasi-absen.edit', compact('lokasi'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_lokasi' => 'required|string|max:255',
            'google_maps_link' => 'required|url',
            'radius' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $lokasi = LokasiAbsen::findOrFail($id);
        $coords = $this->extractCoordinates($request->google_maps_link);
        
        if (!$coords) {
            return redirect()->back()
                ->with('error', 'Link Google Maps tidak valid. Pastikan link mengandung koordinat lokasi.')
                ->withInput();
        }

        $lokasi->update([
            'nama_lokasi' => $request->nama_lokasi,
            'latitude' => $coords['lat'],
            'longitude' => $coords['lng'],
            'radius' => $request->radius,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('admin.lokasi-absen.index')
            ->with('success', 'Lokasi absen berhasil diperbarui');
    }

    public function destroy($id)
    {
        $lokasi = LokasiAbsen::findOrFail($id);
        $lokasi->delete();

        return redirect()->route('admin.lokasi-absen.index')
            ->with('success', 'Lokasi absen berhasil dihapus');
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
}