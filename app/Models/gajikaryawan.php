<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GajiKaryawan extends Model
{
    use HasFactory;

   // Di app/Models/GajiKaryawan.php
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

    // Tambahkan method ini untuk validasi unik
    public static function rules()
    {
        return [
            'user_id' => 'required|exists:users,id',
            'tanggal' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    $exists = static::where('user_id', request('user_id'))
                        ->whereDate('tanggal', $value)
                        ->exists();
                    
                    if ($exists) {
                        $fail('Data gaji untuk karyawan ini pada tanggal tersebut sudah ada.');
                    }
                }
            ],
            'nomor_rekening' => 'required',
            'tipe_pembayaran' => 'required|in:tunai,non_tunai',
            'bonus' => 'nullable|numeric',
            'potongan' => 'nullable|numeric',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}