<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalKaryawan extends Model
{
    use HasFactory;

    protected $table = 'jadwal_karyawans';

    protected $fillable = [
        'user_id',
        'jabatan_id',
        'shift_id',
        'shift_type', // Tambahkan ini
        'bulan',
        'tahun',
        'day_1', 'day_2', 'day_3', 'day_4', 'day_5', 'day_6', 'day_7', 'day_8',
        'day_9', 'day_10', 'day_11', 'day_12', 'day_13', 'day_14', 'day_15', 'day_16',
        'day_17', 'day_18', 'day_19', 'day_20', 'day_21', 'day_22', 'day_23', 'day_24',
        'day_25', 'day_26', 'day_27', 'day_28', 'day_29', 'day_30', 'day_31'
    ];

    // App\Models\JadwalKaryawan.php

    public function getShiftTime()
{
    if ($this->shift_type == 1) {
        return $this->shift->shift_1;
    }
    return $this->shift->shift_2;
}

public function scopeForMonth($query, $month, $year)
{
    return $query->where('bulan', $month)
                ->where('tahun', $year);
}

public function getDaysInMonth()
{
    return cal_days_in_month(CAL_GREGORIAN, $this->bulan, $this->tahun);
}

public function getShiftForDay($day)
{
    if ($day < 1 || $day > 31) return null;
    return $this->{"day_$day"} ?? null;
}

// Di model JadwalKaryawan
public function updateShiftTimes()
{
    if (!$this->shift) return;

    // Ambil nilai shift baru
    $newShift1 = $this->shift->shift_1;
    $newShift2 = $this->shift->shift_2;
    
    for ($i = 1; $i <= 31; $i++) {
        $currentShift = $this->{"day_$i"};
        
        // Jika shift ini adalah shift 1 (sesuai dengan format lama)
        if ($currentShift === $newShift1) {
            $this->{"day_$i"} = $newShift1;
        } 
        // Jika shift ini adalah shift 2 (sesuai dengan format lama)
        elseif ($currentShift === $newShift2) {
            $this->{"day_$i"} = $newShift2;
        }
        // Jika tidak sama dengan keduanya (sudah diedit manual), biarkan apa adanya
    }
    
    $this->save();
}

    /**
     * Relasi ke tabel User.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi ke tabel JabatanKaryawan.
     */
    public function jabatan()
    {
        return $this->belongsTo(JabatanKaryawan::class, 'jabatan_id');
    }

    /**
     * Relasi ke tabel ShiftKaryawan.
     */
    public function shift()
    {
        return $this->belongsTo(ShiftKaryawan::class, 'shift_id');
    }

    
}