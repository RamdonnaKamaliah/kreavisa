<?php

namespace App\Exports;

use App\Models\GajiKaryawan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class GajiKaryawanExport implements FromCollection, WithHeadings, WithStyles, WithColumnWidths, WithTitle
{
    protected $date;

    public function __construct($date = null)
    {
        $this->date = $date;
    }

    public function collection()
    {
        $query = GajiKaryawan::with(['user', 'user.jabatan'])
            ->select(
                'user_id',
                'tanggal',
                'nomor_rekening',
                'tipe_pembayaran',
                'gaji_pokok',
                'bonus',
                'potongan',
                'total_gaji'
            );

        if ($this->date) {
            $query->whereDate('tanggal', $this->date);
        }

        $data = $query->get()->map(function ($item) {
            return [
                'Nama Karyawan' => $item->user->nama_lengkap,
                'Jabatan' => $item->user->jabatan->nama_jabatan,
                'Tanggal' => $item->tanggal,
                'Nomor Rekening' => $item->nomor_rekening,
                'Metode Pembayaran' => $item->tipe_pembayaran,
                'Gaji Pokok' => 'Rp ' . number_format($item->gaji_pokok, 0, ',', '.'),
                'Bonus' => 'Rp ' . number_format($item->bonus, 0, ',', '.'),
                'Potongan' => 'Rp ' . number_format($item->potongan, 0, ',', '.'),
                'Total Gaji' => 'Rp ' . number_format($item->total_gaji, 0, ',', '.'),
            ];
        });

        return $data;
    }

    public function headings(): array
    {
        return [
            'Nama Karyawan',
            'Jabatan',
            'Tanggal',
            'Nomor Rekening',
            'Metode Pembayaran',
            'Gaji Pokok',
            'Bonus',
            'Potongan',
            'Total Gaji'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Style untuk header (baris pertama)
        $sheet->getStyle('A1:I1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => '4CAF50'], // Warna hijau
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
        $sheet->getStyle('A2:I' . ($sheet->getHighestRow()))
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

        // Auto size semua kolom
        foreach (range('A', 'I') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        // Set tinggi baris header
        $sheet->getRowDimension(1)->setRowHeight(25);
    }

    public function columnWidths(): array
    {
        return [
            'A' => 20, // Nama Karyawan
            'B' => 20, // Jabatan
            'C' => 15, // Tanggal
            'D' => 20, // Nomor Rekening
            'E' => 20, // Metode Pembayaran
            'F' => 15, // Gaji Pokok
            'G' => 15, // Bonus
            'H' => 15, // Potongan
            'I' => 15, // Total Gaji
        ];
    }

    public function title(): string
    {
        return 'Laporan Gaji Karyawan';
    }
}