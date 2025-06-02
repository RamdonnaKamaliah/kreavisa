<?php

namespace App\Imports;

use App\Models\User;
use App\Models\JabatanKaryawan;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendPasswordEmail;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class KaryawanImport implements ToCollection, WithHeadingRow
{
    private $errors = [];

    public function collection(Collection $rows)
    {
        foreach ($rows as $index => $row) {
            $rowNumber = $index + 2;
            
            try {
                // Normalisasi data
                $row = $this->normalizeData($row);

                $validator = Validator::make($row->toArray(), [
                    'nama_lengkap' => 'required|string|max:100',
                    'username' => 'required|string|max:100|unique:users,name',
                    'email' => 'required|email|unique:users,email',
                    'tanggal_lahir' => 'required|date',
                    'no_telepon' => 'required',
                    'jabatan' => 'required|string',
                ]);

                if ($validator->fails()) {
                    $this->errors[] = "Baris $rowNumber: " . implode(', ', $validator->errors()->all());
                    continue;
                }

                $jabatan = JabatanKaryawan::where('nama_jabatan', 'like', '%'.trim($row['jabatan']).'%')->first();

                if (!$jabatan) {
                    $this->errors[] = "Baris $rowNumber: Jabatan '{$row['jabatan']}' tidak ditemukan";
                    continue;
                }

                $randomPassword = Str::random(8);

                $data = [
                    'nama_lengkap' => $row['nama_lengkap'],
                    'name' => $row['username'],
                    'email' => $row['email'],
                    'usia' => $this->calculateAge($row['tanggal_lahir']),
                    'tanggal_lahir' => $row['tanggal_lahir'],
                    'no_telepon' => $this->normalizePhone($row['no_telepon']),
                    'gender' => $row['gender'] ?? 'Laki-laki',
                    'jabatan_id' => $jabatan->id,
                    'usertype' => 'karyawan',
                    'password' => Hash::make($randomPassword),
                ];

                $user = User::create($data);

                try {
                    Mail::to($user->email)->send(new SendPasswordEmail($randomPassword));
                } catch (\Exception $e) {
                    $this->errors[] = "Baris $rowNumber: Gagal mengirim email ke {$user->email}";
                }

            } catch (\Exception $e) {
                $this->errors[] = "Baris $rowNumber: " . $e->getMessage();
            }
        }
    }

    private function normalizeData($row)
    {
        // Normalisasi tanggal lahir
        if (isset($row['tanggal_lahir'])) {
            $row['tanggal_lahir'] = $this->parseDate($row['tanggal_lahir']);
        }

        return $row;
    }

    private function parseDate($dateValue)
    {
        try {
            // Handle formula Excel (=DATE(...))
            if (is_string($dateValue) && str_starts_with($dateValue, '=DATE(')) {
                preg_match('/=DATE\((\d+),\s*(\d+),\s*(\d+)\)/', $dateValue, $matches);
                if (count($matches) === 4) {
                    return Carbon::create($matches[1], $matches[2], $matches[3])->format('Y-m-d');
                }
            }
            
            // Handle numeric Excel date (serial number)
            if (is_numeric($dateValue)) {
                return Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($dateValue))
                    ->format('Y-m-d');
            }
    
            // Handle berbagai format teks
            $formats = [
                'd/m/Y', 'd-m-Y', 'd.m.Y',
                'm/d/Y', 'm-d-Y', 'm.d.Y',
                'Y/m/d', 'Y-m-d', 'Y.m.d',
                'j/n/Y', 'j-n-Y', 'j.n.Y',
                'n/j/Y', 'n-j-Y', 'n.j.Y'
            ];
    
            foreach ($formats as $format) {
                try {
                    $parsedDate = Carbon::createFromFormat($format, $dateValue);
                    if ($parsedDate !== false) {
                        return $parsedDate->format('Y-m-d');
                    }
                } catch (\Exception $e) {
                    continue;
                }
            }
    
            throw new \Exception("Format tanggal tidak dikenali");
    
        } catch (\Exception $e) {
            throw new \Exception("Tanggal lahir tidak valid: {$dateValue}");
        }
    }
    

    private function normalizePhone($phone)
    {
        // Hanya ambil angka saja
        return preg_replace('/[^0-9]/', '', $phone);
    }

    private function calculateAge($birthDate)
    {
        return Carbon::parse($birthDate)->age;
    }

    public function getErrors()
    {
        return $this->errors;
    }
}