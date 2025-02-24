<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokBarang extends Model
{
    use HasFactory;

    protected $table = 'stok_barangs';

    protected $fillable = [
        'kode_barang',
        'warna',
        'size',
        'total_stok',
        'keterangan',
    ];

    public function stokMasuk()
    {
        return $this->hasMany(StokMasuk::class, 'stok_barang_id');
    }

    public function stokKeluar()
    {
        return $this->hasMany(StokKeluar::class, 'stok_barang_id');
    }
}

