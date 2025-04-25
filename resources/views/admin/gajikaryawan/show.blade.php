@extends('layout.main')
@section('content')
<div class="relative flex justify-center items-center py-8 px-6 min-h-screen">
    <!-- Background dengan gradien -->
    <div class="absolute inset-0 from-blue-50 to-gray-100 dark:from-gray-800 dark:to-gray-900 opacity-90"></div>
    
    <!-- Container utama dengan shadow dan rounded -->
    <div class="w-full max-w-5xl bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 relative z-10">
        <!-- Header dengan tombol back dan judul di tengah -->
        <div class="flex items-center justify-between mb-6">
            <a href="{{ route('gajikaryawan.index') }}" class="text-blue-500 hover:text-blue-600 text-2xl flex items-center">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white text-center flex-grow">Detail Gaji Karyawan</h1>
            <div class="w-8"></div> <!-- Spacer untuk balance layout -->
        </div>
            
            <!-- Grid informasi gaji -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach ([
                    ['label' => 'Nama Karyawan', 'value' => $gajiKaryawan->user->nama_lengkap, 'icon' => 'fas fa-user'],
                    ['label' => 'Jabatan', 'value' => $gajiKaryawan->user->jabatan->nama_jabatan ?? '-', 'icon' => 'fas fa-briefcase'],
                    ['label' => 'Nomor Rekening', 'value' => $gajiKaryawan->nomor_rekening, 'icon' => 'fas fa-credit-card'],
                    ['label' => 'Tipe Pembayaran', 'value' => ucfirst($gajiKaryawan->tipe_pembayaran), 'icon' => 'fas fa-money-bill-wave'],
                    ['label' => 'Gaji Pokok', 'value' => 'Rp ' . number_format($gajiKaryawan->gaji_pokok, 0, ',', '.'), 'icon' => 'fas fa-wallet'],
                    ['label' => 'Bonus', 'value' => 'Rp ' . number_format($gajiKaryawan->bonus, 0, ',', '.'), 'icon' => 'fas fa-gift'],
                    ['label' => 'Potongan', 'value' => 'Rp ' . number_format($gajiKaryawan->potongan, 0, ',', '.'), 'icon' => 'fas fa-minus-circle'],
                    ['label' => 'Total Gaji', 'value' => 'Rp ' . number_format($gajiKaryawan->total_gaji, 0, ',', '.'), 'icon' => 'fas fa-calculator']
                ] as $item)
                    <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm">
                        <div class="flex items-center mb-2">
                            <i class="{{ $item['icon'] }} text-blue-500 mr-2"></i>
                            <label class="text-gray-600 dark:text-gray-300">{{ $item['label'] }}</label>
                        </div>
                        <p class="font-bold text-lg text-gray-800 dark:text-white pl-6">{{ $item['value'] }}</p>
                    </div>
                @endforeach
            </div>
            
            <!-- Footer dengan informasi admin dan tanggal -->
            <div class="mt-8 pt-4 border-t border-gray-200 dark:border-gray-700">
                <p class="text-gray-500 dark:text-gray-400 text-sm">
                    <i class="fas fa-user-shield mr-2"></i>
                    Admin: {{ auth()->user()->email }}
                </p>
                <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">
                    <i class="fas fa-calendar-alt mr-2"></i>
                    Dibuat pada Tanggal: {{ \Carbon\Carbon::parse($gajiKaryawan->tanggal)->format('Y-m-d') }}
                </p>
            </div>
        </div>
    </div>
@endsection