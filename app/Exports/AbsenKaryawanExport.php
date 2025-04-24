<?php

namespace App\Exports;

use App\Models\AbsenKaryawan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AbsenKaryawanExport implements FromCollection, WithHeadings, WithStyles, WithColumnWidths, WithTitle
{
    protected $date;

    public function __construct($date = null)
    {
        $this->date = $date;
    }

    public function collection()
    {
        $query = AbsenKaryawan::with(['user', 'user.jabatan'])
            ->select(
                'user_id',
                'tanggal_absensi',
                'status',
                'lokasi',
                'foto',
                'file_surat'
            );

        if ($this->date) {
            $query->whereDate('tanggal_absensi', $this->date);
        }

        $data = $query->get()->map(function ($item) {
            return [
                'Nama Karyawan' => $item->user->nama_lengkap ?? '-',
                'Jabatan' => $item->user->jabatan->nama_jabatan ?? '-',
                'Tanggal Absensi' => \Carbon\Carbon::parse($item->tanggal_absensi)->format('d F Y H:i'),
                'Status' => ucfirst($item->status),
                'Lokasi' => $item->lokasi ?? '-',
                'Foto' => $item->foto ? 'Ada' : '-',
                'File Surat' => $item->file_surat ? 'Ada' : '-',
            ];
        });

        return $data;
    }

    public function headings(): array
    {
        return [
            'Nama Karyawan',
            'Jabatan',
            'Tanggal Absensi',
            'Status',
            'Lokasi',
            'Foto',
            'File Surat'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Style untuk header (baris pertama)
        $sheet->getStyle('A1:G1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => '4285F4'], // Warna biru Google
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
        $sheet->getStyle('A2:G' . ($sheet->getHighestRow()))
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

        // Style khusus untuk kolom Status
        $highestRow = $sheet->getHighestRow();
        for ($row = 2; $row <= $highestRow; $row++) {
            $status = $sheet->getCell('D' . $row)->getValue();
            $color = 'FFFFFF'; // default white
            
            if ($status === 'Hadir') {
                $color = 'E6F4EA'; // light green
            } elseif ($status === 'Izin') {
                $color = 'FEF7E0'; // light yellow
            } elseif ($status === 'Sakit') {
                $color = 'FDECEA'; // light red
            }
            
            $sheet->getStyle('D' . $row)->applyFromArray([
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => $color],
                ],
            ]);
        }

        // Auto size semua kolom
        foreach (range('A', 'G') as $column) {
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
            'C' => 20, // Tanggal Absensi
            'D' => 15, // Status
            'E' => 30, // Lokasi
            'F' => 15, // Foto
            'G' => 15, // File Surat
        ];
    }

    public function title(): string
    {
        return 'Rekap Absen Karyawan';
    }
}