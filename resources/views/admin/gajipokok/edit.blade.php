@extends('layout.main')
@section('content')
    <div id="layoutSidenav_content">
        <main class="flex justify-center items-center min-h-screen py-10">
            <div class="w-full max-w-4xl bg-white dark:bg-slate-800 p-8 rounded-lg shadow-lg">
                <div class="mb-4">
                    <a href="{{ route('gajipokok.index') }}" class="text-blue-600 hover:text-blue-800 font-medium transition flex items-center">
                        <i class="fas fa-arrow-left mr-2"></i>
                    </a>
                </div>

                <!-- Judul -->
                <h1 class="text-center text-2xl font-bold text-gray-800 mb-6 dark:text-white">Edit Gaji Pokok</h1>

                <!-- Form -->
                <form action="{{ route('gajipokok.update', $gajiPokok->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <!-- Tampilkan Nama Jabatan (Tidak Bisa Diedit) -->
                    <div>
                        <label class="block text-gray-700 font-medium dark:text-gray-200">Jabatan</label>
                        <div class="w-full p-3 border rounded-lg bg-gray-100 text-gray-700">
                            {{ $gajiPokok->jabatan->nama_jabatan }}
                        </div>
                    </div>

                    <!-- Input Gaji Pokok -->
                    <div>
                        <label for="gaji_pokok" class="block text-gray-700 font-medium dark:text-gray-200">Gaji Pokok (Juta)</label>
                        <input type="number" id="gaji_pokok" name="gaji_pokok" step="0.1" required
                            class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-400"
                            value="{{ old('gaji_pokok', $gajiPokok->gaji_pokok / 1_000_000) }}"
                            placeholder="Masukkan dalam juta (contoh: 5 untuk 5 juta)">
                    </div>

                    <!-- Tombol Submit -->
                    <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition">
                        Update
                    </button>
                </form>
            </div>
        </main>
    </div>
@endsection
