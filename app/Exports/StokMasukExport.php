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

        return $query->select('stok_barang_id', 'jumlah', 'tanggal_masuk')->get();
    }

    public function headings(): array
    {
        return ['ID Stok Barang', 'Jumlah Masuk', 'Tanggal Masuk'];
    }
}
