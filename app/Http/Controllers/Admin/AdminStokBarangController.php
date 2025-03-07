<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StokBarang;
use App\Models\StokMasuk;
use App\Models\StokKeluar;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StokBarangExport;
use App\Exports\StokMasukExport;
use App\Exports\StokKeluarExport;

class AdminStokBarangController extends Controller
{
    /**
     * Menampilkan daftar stok barang.
     */
    public function index(Request $request)
{
    $date = $request->query('date');
    $query = StokBarang::query();

    if ($date) {
        $query->whereDate('created_at', $date);
    }

    $stokBarangs = $query->get();
    return view('admin.stokbarang.index', compact('stokBarangs'));
}


    
    public function export(Request $request)
    {
        $date = $request->query('date');
        $type = $request->query('type'); // Menentukan jenis export (stok_barang, stok_masuk, stok_keluar)
    
        switch ($type) {
            case 'stok_barang':
                return Excel::download(new StokBarangExport($date), 'stok_barang_' . ($date ?? 'semua') . '.xlsx');
    
            case 'stok_masuk':
                return Excel::download(new StokMasukExport($date), 'stok_masuk_' . ($date ?? 'semua') . '.xlsx');
    
            case 'stok_keluar':
                return Excel::download(new StokKeluarExport($date), 'stok_keluar_' . ($date ?? 'semua') . '.xlsx');
    
            default:
                return back()->with('error', 'Jenis export tidak valid');
        }
    }
    
    
    public function stokMasuk(Request $request)
{
    $date = $request->query('date');
    $query = StokMasuk::with('stokBarang');

    if ($date) {
        $query->whereDate('tanggal_masuk', $date);
    }

    $stokMasuk = $query->get();
    return view('admin.stokbarang.stokmasuk', compact('stokMasuk', 'date'));
}

public function stokKeluar(Request $request)
{
    $date = $request->query('date');
    $query = StokKeluar::with('stokBarang'); // Pastikan pakai model StokKeluar

    if ($date) {
        $query->whereDate('tanggal_keluar', $date);
    }

    $stokKeluar = $query->get();
    return view('admin.stokbarang.stokkeluar', compact('stokKeluar', 'date'));
}


    /**
     * Menampilkan form untuk menambah stok barang.
     */
    public function create()
    {
        return view('admin.stokbarang.create');
    }

    /**
     * Menyimpan data stok barang baru.
     */
    public function store(Request $request)
{
    $request->validate([
        'kode_barang' => 'required',
        'warna' => 'required',
        'size' => 'required|in:37,38,39,40,41',
        'total_stok' => 'required|integer|min:0',
        'keterangan' => 'nullable|string',
    ]);

    // Cek apakah data sudah ada dalam database
    $cekDuplikat = StokBarang::where('kode_barang', $request->kode_barang)
        ->where('warna', $request->warna)
        ->where('size', $request->size)
        ->exists();

    if ($cekDuplikat) {
        return redirect()->back()->with('error', 'Stok barang dengan kode, warna, dan size ini sudah ada!')->withInput();
    }

    // Simpan jika tidak duplikat
    StokBarang::create($request->all());

    return redirect()->route('stokbarang.index')->with('added', true);
}


    /**
     * Menampilkan detail stok barang.
     */
    public function show($id)
    {
        $stokBarang = StokBarang::findOrFail($id);
        return view('admin.stokbarang.show', compact('stokBarang'));
    }

    /**
     * Menampilkan form edit stok barang.
     */
    public function edit($id)
    {
        $stokBarang = StokBarang::findOrFail($id);
        return view('admin.stokbarang.edit', compact('stokBarang'));
    }

    /**
     * Memperbarui data stok barang.
     */
    public function update(Request $request, $id)
    {
        $stokBarang = StokBarang::findOrFail($id);

        $request->validate([
            'kode_barang' => 'required',
            'warna' => 'required',
            'size' => 'required|in:37,38,39,40,41',
            'total_stok' => 'required|integer|min:0',
            'keterangan' => 'nullable|string',
        ]);

        $stokBarang->update($request->all());
        return redirect()->route('stokbarang.index')->with('edited', true);
    }

    /**
     * Menghapus stok barang.
     */
    public function destroy($id)
{
    $stokBarang = StokBarang::find($id);

    if (!$stokBarang) {
        return redirect()->route('stokbarang.index')->with('error', 'Data tidak ditemukan!');
    }

    $stokBarang->delete();

    return redirect()->route('stokbarang.index')->with('deleted', true);
}

}
