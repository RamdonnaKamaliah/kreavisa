<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StokBarang;
use App\Models\StokMasuk;
use App\Models\StokKeluar;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StokBarangExport;

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
        return Excel::download(new StokBarangExport($date), 'stok_barang.xlsx');
    }

    

    public function stokMasuk()
    {
        $stokMasuk = StokMasuk::with('stokBarang')->get();
        return view('admin.stokbarang.stokmasuk', compact('stokMasuk'));
    }

    public function stokKeluar()
    {
        $stokKeluar = StokKeluar::with('stokBarang')->get();
        return view('admin.stokbarang.stokkeluar', compact('stokKeluar'));
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
            'size' => 'required',
            'total_stok' => 'required|integer|min:0',
            'keterangan' => 'nullable|string',
        ]);

        StokBarang::create($request->all());

        return redirect()->route('stokbarang.index')->with('success', 'Stok barang berhasil ditambahkan.');
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
            'size' => 'required',
            'total_stok' => 'required|integer|min:0',
            'keterangan' => 'nullable|string',
        ]);

        $stokBarang->update($request->all());

        return redirect()->route('admin.stokbarang.index')->with('success', 'Stok barang berhasil diperbarui.');
    }

    /**
     * Menghapus stok barang.
     */
    public function destroy($id)
    {
        $stokBarang = StokBarang::findOrFail($id);
        $stokBarang->delete();

        return redirect()->route('admin.stokbarang.index')->with('success', 'Stok barang berhasil dihapus.');
    }
}
