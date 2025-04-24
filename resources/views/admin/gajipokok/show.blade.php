@extends('layout.main')
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

                <!-- Informasi Jabatan -->
                <div class="bg-gray-200 p-6 rounded-lg shadow-inner text-center">
                    <p class="text-md font-bold text-gray-700">Nama Jabatan :
                        <span class="text-gray-600">{{ $gajipokok->jabatan->nama_jabatan }}</span>
                    </p>
                    <p class="text-md font-bold text-gray-700">Gaji Pokok :
                        <span class="text-gray-600">{{ $gajipokok->gaji_pokok }}</span>
                    </p>
                </div>
            </div>
        </main>
    </div>
@endsection
