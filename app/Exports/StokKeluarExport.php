<?php

namespace App\Exports;

use App\Models\StokKeluar;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StokKeluarExport implements FromCollection, WithHeadings
{

    protected $date;

    public function __construct($date = null)
{
    $this->date = $date;
}

public function collection()
{
    $query = StokKeluar::with('stokBarang');

    if ($this->date) {
        $query->whereDate('tanggal_keluar', $this->date);
    }

    return $query->get()->map(function ($stokKeluar) {
        return [
            'Kode Barang' => $stokKeluar->stokBarang->kode_barang ?? 'N/A',
            'Jumlah Keluar' => $stokKeluar->jumlah,
            'Tanggal Keluar' => $stokKeluar->tanggal_keluar,
        ];
    });
}

    public function headings(): array
    {
        return ['ID Stok Barang', 'Jumlah Keluar', 'Tanggal Keluar'];
    }
}
