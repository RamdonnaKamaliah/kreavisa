<?php

namespace App\Exports;

use App\Models\StokBarang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StokBarangExport implements FromCollection, WithHeadings
{
    protected $date;

    public function __construct($date = null)
    {
        $this->date = $date;
    }

    public function collection()
    {
        $query = StokBarang::select('kode_barang', 'warna', 'size', 'total_stok', 'keterangan', 'created_at');

        if ($this->date) {
            $query->whereDate('created_at', $this->date);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return ['Kode Barang', 'Warna', 'Size', 'Total Stok', 'Keterangan', 'Tanggal Dibuat'];
    }
}

