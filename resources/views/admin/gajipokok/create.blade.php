@extends('layout.main')
@section('content')
    <div id="layoutSidenav_content">
        <!-- Container utama -->
        <main class="flex justify-center items-center min-h-screen py-10">
            <div class="w-full max-w-lg bg-white p-8 rounded-lg shadow-lg">
                
                <!-- Judul -->
                <h1 class="text-center text-2xl font-bold text-gray-800 mb-6">Create Gaji Pokok</h1>

                <!-- Form -->
                <form action="{{ route('gajipokok.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <!-- Pilihan Jabatan -->
                    <div>
                        <label for="jabatan_id" class="block text-gray-700 font-medium">Jabatan</label>
                        <select id="jabatan_id" name="jabatan_id" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-400" required>
                            @foreach($jabatan as $jabatan)
                                <option value="{{ $jabatan->id }}">{{ $jabatan->nama_jabatan }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Input Gaji Pokok -->
                    <div>
                        <label for="gaji_pokok" class="block text-gray-700 font-medium">Gaji Pokok</label>
                        <input type="number" id="gaji_pokok" name="gaji_pokok" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-400" step="0.1" required placeholder="Masukkan dalam juta (contoh: 5 untuk 5 juta)">
                    </div>

                    <!-- Tombol Submit -->
                    <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition">Create</button>
                </form>

                <!-- Tombol Back to List -->
                <div class="mt-6 text-center">
                    <a href="{{ route('gajipokok.index') }}" class="text-blue-600 hover:text-blue-800 font-medium transition">Back to List</a>
                </div>
            </div>
        </main>
    </div>
    @endsection
