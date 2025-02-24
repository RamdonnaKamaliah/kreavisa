<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GajiKaryawan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tanggal',
        'nomor_rekening',
        'tipe_pembayaran',
        'gaji_pokok',
        'bonus',
        'potongan',
        'total_gaji',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}