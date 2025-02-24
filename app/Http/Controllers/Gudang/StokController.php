<?php

namespace App\Http\Controllers\Gudang;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StokMasuk;
use App\Models\StokKeluar;
use App\Models\StokBarang;

class StokController extends Controller
{
    /**
     * Halaman utama stok gudang (list stok barang)
     */
    public function index()
    {
        $stokBarangs = StokBarang::all();
        return view('gudang.stok.index', compact('stokBarangs'));
    }

    /**
     * Halaman stok masuk
     */
    public function stokMasuk()
    {
        $stokMasuk = StokMasuk::with('stokBarang')->get();
        return view('gudang.stok.stok-masuk', compact('stokMasuk'));
    }

    /**
     * Form tambah stok masuk
     */
    public function createMasuk()
    {
        $stokBarangs = StokBarang::all();
        return view('gudang.stok.create-masuk', compact('stokBarangs'));
    }

    /**
     * Simpan stok masuk
     */
    public function storeMasuk(Request $request)
    {
        $request->validate([
            'stok_barang_id' => 'required|exists:stok_barangs,id',
            'jumlah' => 'required|integer|min:1',
        ]);

        $stokMasuk = StokMasuk::create([
            'stok_barang_id' => $request->stok_barang_id,
            'tanggal_masuk' => now(),
            'jumlah' => $request->jumlah,
        ]);

        // Tambah stok barang
        $stokMasuk->stokBarang->increment('total_stok', $request->jumlah);

        return redirect()->route('gudang.stok.masuk')->with('success', 'Stok masuk berhasil ditambahkan.');
    }

    /**
     * Halaman stok keluar
     */
    public function stokKeluar()
    {
        $stokKeluar = StokKeluar::with('stokBarang')->get();
        return view('gudang.stok.stok-keluar', compact('stokKeluar'));
    }

    /**
     * Form tambah stok keluar
     */
    public function createKeluar()
    {
        $stokBarangs = StokBarang::all();
        return view('gudang.stok.create-keluar', compact('stokBarangs'));
    }

    /**
     * Simpan stok keluar
     */
    public function storeKeluar(Request $request)
    {
        $request->validate([
            'stok_barang_id' => 'required|exists:stok_barangs,id',
            'jumlah' => 'required|integer|min:1',
        ]);

        $stokBarang = StokBarang::findOrFail($request->stok_barang_id);

        if ($stokBarang->total_stok < $request->jumlah) {
            return redirect()->back()->with('error', 'Stok tidak mencukupi.');
        }

        $stokKeluar = StokKeluar::create([
            'stok_barang_id' => $request->stok_barang_id,
            'tanggal_keluar' => now(),
            'jumlah' => $request->jumlah,
        ]);

        // Kurangi stok barang
        $stokBarang->decrement('total_stok', $request->jumlah);

        return redirect()->route('gudang.stok.keluar')->with('success', 'Stok keluar berhasil dikurangi.');
    }
}
