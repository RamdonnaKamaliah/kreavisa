@extends('layout3.karyawan3')
@section('content')
    @push('page-title')
        Detail Rekap Gaji - {{ $gaji->user->nama_lengkap }}
    @endpush
    
    <div class="p-6 md:p-8 overflow-x-hidden">
        <div class="bg-white dark:bg-slate-800 text-gray-900 dark:text-gray-100 p-4 rounded-lg shadow-md dark:shadow-lg">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-semibold dark:text-white">Detail Rekap Gaji</h2>
                <a href="{{ route('gajiKaryawan.index') }}" 
                   class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
            </div>

            <!-- Informasi Karyawan -->
            <div class="mb-8 p-4 border border-gray-300 rounded-lg">
                <h3 class="text-xl font-medium mb-4 border-b pb-2 dark:text-white">Informasi Karyawan</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p><span class="font-semibold">Nama:</span> {{ $gaji->user->nama_lengkap }}</p>
                        <p><span class="font-semibold">Jabatan:</span> {{ $gaji->user->jabatan->nama_jabatan }}</p>
                    </div>
                    <div>
                        <p><span class="font-semibold">Periode Gaji:</span> {{ $gaji->tanggal }}</p>
                        <p><span class="font-semibold">Tipe Pembayaran:</span> {{ $gaji->tipe_pembayaran }}</p>
                    </div>
                </div>
            </div>

            <!-- Rincian Gaji -->
            <div class="mb-8 p-4 border border-gray-300 rounded-lg">
                <h3 class="text-xl font-medium mb-4 border-b pb-2 dark:text-white">Rincian Gaji</h3>
                
                <div class="overflow-x-auto">
                    <table class="w-full border border-gray-300 dark:border-gray-600">
                        <thead class="bg-gray-200 dark:bg-slate-700 dark:text-gray-200">
                            <tr>
                                <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">Komponen</th>
                                <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-right">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 font-medium dark:text-gray-200">Gaji Pokok</td>
                                <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-right dark:text-gray-200">Rp {{ number_format($gaji->gaji_pokok, 0, ',', '.') }}</td>
                            </tr>
                            <tr class="bg-gray-50 dark:bg-slate-700">
                                <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 font-medium dark:text-gray-200">Bonus</td>
                                <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-right dark:text-gray-200">Rp {{ number_format($gaji->bonus, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 font-medium dark:text-gray-200">Potongan</td>
                                <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-right dark:text-gray-200">- Rp {{ number_format($gaji->potongan, 0, ',', '.') }}</td>
                            </tr>
                            <tr class="bg-blue-50 dark:bg-slate-600 font-bold dark:text-gray-100">
                                <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">TOTAL GAJI</td>
                                <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-right">Rp {{ number_format($gaji->total_gaji, 0, ',', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>

    <style>
        @media print {
            body * {
                visibility: hidden;
            }
            .bg-white, .bg-white * {
                visibility: visible;
            }
            .bg-white {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                box-shadow: none;
            }
            .no-print {
                display: none !important;
            }
        }
    </style>
@endsection