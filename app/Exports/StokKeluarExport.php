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

        return $query->select('stok_barang_id', 'jumlah', 'tanggal_keluar')->get();
    }

    public function headings(): array
    {
        return ['ID Stok Barang', 'Jumlah Keluar', 'Tanggal Keluar'];
    }
}
