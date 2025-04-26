<?php

namespace App\Exports;

use App\Models\KinerjaKaryawan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class KinerjaKaryawanExport implements FromCollection, WithHeadings, WithStyles, WithColumnWidths, WithTitle
{
    protected $month;
    protected $year;

    public function __construct($month = null, $year = null)
    {
        $this->month = $month;
        $this->year = $year;
    }

    public function collection()
    {
        $query = KinerjaKaryawan::with(['user', 'jabatan'])
            ->select(
                'user_id',
                'jabatan_id',
                'tanggal_penilaian',
                'periode',
                'tanggung_jawab',
                'kehadiran_ketepatan_waktu',
                'produktivitas',
                'kerja_sama_tim',
                'kemampuan_komunikasi',
                'total_skor'
            );

        if ($this->month && $this->year) {
            $query->whereMonth('tanggal_penilaian', $this->month)
                  ->whereYear('tanggal_penilaian', $this->year);
        }

        $data = $query->get()->map(function ($item) {
            // Calculate total score out of 100 (5 criteria * 20 points each)
            $totalSkor = ($item->tanggung_jawab + $item->kehadiran_ketepatan_waktu + 
                         $item->produktivitas + $item->kerja_sama_tim + 
                         $item->kemampuan_komunikasi) * 4;
            
            return [
                'Nama Karyawan' => $item->user->nama_lengkap ?? '-',
                'Jabatan' => $item->jabatan->nama_jabatan ?? '-',
                'Tanggal Penilaian' => \Carbon\Carbon::parse($item->tanggal_penilaian)->format('d F Y'),
                'Periode' => $item->periode,
                'Tanggung Jawab' => $item->tanggung_jawab ?? 0.0, // Show 0 if null
                'Kehadiran & Ketepatan Waktu' => $item->kehadiran_ketepatan_waktu ?? 0.0,
                'Produktivitas' => $item->produktivitas ?? 0.0,
                'Kerja Sama Tim' => $item->kerja_sama_tim ?? 0.0,
                'Komunikasi' => $item->kemampuan_komunikasi ?? 0.0,
                'Total Skor' => $totalSkor,
                'Kategori' => $this->getKategori($totalSkor)
            ];
        });

        return $data;
    }

    private function getKategori($skor)
    {
        if ($skor >= 80) return 'Sangat Baik';
        if ($skor >= 60) return 'Baik';
        if ($skor >= 40) return 'Cukup';
        if ($skor >= 20) return 'Buruk';
        return 'Sangat Buruk';
    }

    public function headings(): array
    {
        return [
            'Nama Karyawan',
            'Jabatan',
            'Tanggal Penilaian',
            'Periode',
            'Tanggung Jawab (1-5)',
            'Kehadiran & Ketepatan Waktu (1-5)',
            'Produktivitas (1-5)',
            'Kerja Sama Tim (1-5)',
            'Komunikasi (1-5)',
            'Total Skor (0-100)',
            'Kategori'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Style untuk header (baris pertama)
        $sheet->getStyle('A1:K1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => '673AB7'], // Warna ungu
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ]);

        // Style untuk semua sel data
        $sheet->getStyle('A2:K' . ($sheet->getHighestRow()))
            ->applyFromArray([
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                ],
            ]);

        // Style untuk kolom Kategori
        $highestRow = $sheet->getHighestRow();
        for ($row = 2; $row <= $highestRow; $row++) {
            $kategori = $sheet->getCell('K' . $row)->getValue();
            $color = 'FFFFFF'; // default white
            
            if ($kategori === 'Sangat Baik') {
                $color = '4CAF50'; // hijau
            } elseif ($kategori === 'Baik') {
                $color = '8BC34A'; // hijau muda
            } elseif ($kategori === 'Cukup') {
                $color = 'FFC107'; // kuning
            } elseif ($kategori === 'Buruk') {
                $color = 'FF9800'; // orange
            } elseif ($kategori === 'Sangat Buruk') {
                $color = 'F44336'; // merah
            }
            
            $sheet->getStyle('K' . $row)->applyFromArray([
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => $color],
                ],
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => in_array($kategori, ['Cukup', 'Buruk']) ? '000000' : 'FFFFFF'],
                ]
            ]);
        }

        // Auto size semua kolom
        foreach (range('A', 'K') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        // Set tinggi baris header
        $sheet->getRowDimension(1)->setRowHeight(25);
    }

    public function columnWidths(): array
    {
        return [
            'A' => 25, // Nama Karyawan
            'B' => 20, // Jabatan
            'C' => 20, // Tanggal Penilaian
            'D' => 15, // Periode
            'E' => 20, // Tanggung Jawab
            'F' => 25, // Kehadiran & Ketepatan Waktu
            'G' => 15, // Produktivitas
            'H' => 15, // Kerja Sama Tim
            'I' => 15, // Komunikasi
            'J' => 15, // Total Skor
            'K' => 15, // Kategori
        ];
    }

    public function title(): string
    {
        $bulan = $this->month ? date('F', mktime(0, 0, 0, $this->month, 1)) : '';
        $tahun = $this->year ?? '';
        return 'Laporan Kinerja ' . ($bulan ? $bulan . ' ' . $tahun : '');
    }
}