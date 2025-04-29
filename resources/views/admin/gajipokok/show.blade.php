@extends('layout.main')
@section('page-title', 'View Gaji Pokok')
@section('content')
    <div id="layoutSidenav_content">
        <main class="flex justify-center items-center min-h-screen py-6 px-4 text-gray-900 -mt-20">
            <div
                class="w-full max-w-3xl bg-white dark:bg-slate-800 p-6 rounded-lg shadow-md border border-gray-300 dark:border-slate-800 min-h-[250px] flex flex-col justify-center">

                <!-- Tombol Kembali -->
                <div class="mb-4">
                    <a href="{{ route('gajipokok.index') }}"
                        class="inline-flex items-center text-blue-600 hover:text-blue-800 transition">
                        <i class='bx bx-arrow-back text-2xl'></i>
                    </a>
                </div>

                <!-- Judul -->
                <h1 class="text-center text-xl font-bold text-gray-800 mb-4 dark:text-white">View Gaji Pokok Karyawan</h1>

                <div class="flex flex-col md:flex-row gap-4">
                    <!-- Nama Jabatan -->
                    <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm flex-1">
                        <div class="flex items-center mb-2">
                            <i class="fas fa-briefcase text-blue-500 mr-2"></i>
                            <label class="text-gray-600 dark:text-gray-300">Nama Jabatan :</label>
                        </div>
                        <p class="font-bold text-lg text-gray-800 dark:text-white pl-6">{{ $gajipokok->jabatan->nama_jabatan }}</p>
                    </div>

                    <!-- Gaji Pokok -->
                    <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm flex-1">
                        <div class="flex items-center mb-2">
                            <i class="fas fa-money-bill-wave text-blue-500 mr-2"></i>
                            <label class="text-gray-600 dark:text-gray-300">Gaji Pokok :</label>
                        </div>
                        <p class="font-bold text-lg text-gray-800 dark:text-white pl-6">{{ number_format($gajipokok->gaji_pokok, 2, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection