@extends('layout.main')
@section('page-title', 'Create Jabatan Karyawan')
@section('content')
    <div id="layoutSidenav_content pt-1">
        <div class="flex justify-center items-center min-h-[80vh] py-6 px-4">
            <div class="w-full max-w-5xl min-h-[400px] bg-white dark:bg-slate-800 p-6 rounded-lg shadow-lg">
                <div class="mb-4">
                    <a href="{{ route('jabatankaryawan.index') }}" class="text-blue-600 hover:text-blue-800">
                        <i class='bx bx-arrow-back text-2xl'></i>
                    </a>
                </div>
                <!-- Judul -->
                <h1 class="text-center text-2xl font-bold text-gray-800 mb-6 dark:text-white">Create Data Jabatan</h1>


                <!-- Form -->
                <form action="{{ route('jabatankaryawan.store') }}" method="POST">
                    @csrf

                    <!-- Input Nama Jabatan -->
                    <!-- Input Nama Jabatan -->
                    <div class="pt-10 mb-4">
                        <label for="nama_jabatan" class="block text-gray-700 font-semibold mb-2 dark:text-gray-300">
                            Nama Jabatan<span class="text-red-500">*</span>
                        </label>

                        <input type="text" id="nama_jabatan" name="nama_jabatan" placeholder="Input Nama Jabatan"
                            value="{{ old('nama_jabatan') }}" @class([
                                'w-full p-3 rounded-lg transition',
                                'border border-red-500 focus:ring-red-400 focus:border-red-500' => $errors->has(
                                    'nama_jabatan'),
                                'border border-gray-300 focus:ring-blue-400 focus:border-blue-500' => !$errors->has(
                                    'nama_jabatan'),
                            ])>

                        {{-- Tampilkan pesan error jika ada --}}
                        @error('nama_jabatan')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>




                    <!-- Tombol Submit -->
                    <div class="pt-6">
                        <button type="submit"
                            class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let errorMessage = "";

                @foreach ($errors->all() as $error)
                    @if ($error === 'The nama jabatan has already been taken.')
                        @php
                            $errorMessage = 'Nama jabatan sudah digunakan. Silakan masukkan nama yang berbeda.';
                        @endphp
                    @else
                        @php
                            $errorMessage = $error;
                        @endphp
                    @endif
                @endforeach
            });
        </script>
    @endif
@endsection
