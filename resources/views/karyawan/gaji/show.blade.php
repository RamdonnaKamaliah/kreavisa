@extends('layout3.karyawan3')
@section('page-title', 'Detail Rekap Gaji')
@section('content')
    @push('page-title')
        Detail Rekap Gaji - {{ $gaji->user->nama_lengkap }}
    @endpush
    
    <div class="p-6 md:p-8 overflow-x-hidden">
        <div class="bg-white dark:bg-slate-800 text-gray-900 dark:text-gray-100 p-4 rounded-lg shadow-md dark:shadow-lg">
             <!-- Back Button -->
             <div class="mb-4">
                <a href="{{ route('gajikaryawan.index') }}" class="text-blue-600 hover:text-blue-800 flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i>
                </a>
            </div>

             <!-- Judul Absen Hadir di tengah -->
             <h1 class="text-2xl font-semibold text-gray-800 mb-4 text-center dark:text-white">Detail Rekap Gaji</h1>
             <div class="float-right">
                <!-- Tombol Export PDF -->
                <a href="{{ route('gajikaryawan.download.pdf', $gaji->id) }}" 
   class="btn btn-danger">
   <i class="fas fa-file-pdf"></i> Export PDF
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