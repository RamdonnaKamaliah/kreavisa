<?php

namespace App\Exports;

use App\Models\StokMasuk;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StokMasukExport implements FromCollection, WithHeadings
{
    protected $date;

    public function __construct($date = null)
{
    $this->date = $date;
}

public function collection()
{
    $query = StokMasuk::with('stokBarang');

    if ($this->date) {
        $query->whereDate('tanggal_masuk', $this->date);
    }

    return $query->get()->map(function ($stokMasuk) {
        return [
            'Kode Barang' => $stokMasuk->stokBarang->kode_barang ?? 'N/A',
            'Jumlah Masuk' => $stokMasuk->jumlah,
            'Tanggal Masuk' => $stokMasuk->tanggal_masuk,
        ];
    });
}


    public function headings(): array
    {
        return ['Kode Barang', 'Jumlah Masuk', 'Tanggal Masuk'];
    }
}
