@extends('layout.main')
@section('page-title', 'Edit Data Karyawan')
@section('content')
    <div class="p-6 w-full max-w-5xl flex items-center justify-center mx-auto">
        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 rounded-md shadow-md w-full mb-6">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <main class="w-full">
            <div class="bg-white dark:bg-slate-800 shadow-2xl rounded-3xl p-10 max-w-5xl mx-auto relative overflow-hidden">

                <!-- Tombol Kembali -->
                <div class="absolute top-4 left-4">
                    <a href="{{ route('datakaryawan.index') }}"
                        class="p-2 rounded-full text-blue-500 hover:bg-blue-100 transition">
                        <i class="fas fa-arrow-left text-2xl"></i>
                    </a>
                </div>

                <h1 class="text-3xl font-bold text-center mb-10 dark:text-white">Edit Data Karyawan</h1>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">

                    <!-- Profil Karyawan -->
                    <div
                        class="border-r md:border-r border-b md:border-b-0 border-blue-500 pr-8 pb-8 md:pb-0 flex flex-col items-center">

                        @php
                            $defaultPhoto = asset('asset-landing-page/img/profile.png');
                            if (!empty($karyawan->foto)) {
                                if (strpos($karyawan->foto, 'uploads/datakaryawan/') !== false) {
                                    $photoPath = $karyawan->foto;
                                } else {
                                    $photoPath = 'uploads/datakaryawan/' . $karyawan->foto;
                                }
                                $photoUrl = file_exists(public_path($photoPath)) ? asset($photoPath) : $defaultPhoto;
                            } else {
                                $photoUrl = $defaultPhoto;
                            }
                            $photoUrl .= '?v=' . time();
                        @endphp

                        <img src="{{ $photoUrl }}"
                            class="w-36 h-36 rounded-full object-cover border-4 border-gray-300 shadow-md hover:scale-105 transition-transform duration-300"
                            alt="Foto profil {{ $karyawan->nama_lengkap }}"
                            onerror="this.onerror=null;this.src='{{ $defaultPhoto }}'">

                        <label class="block text-lg font-semibold text-gray-700 mt-6 dark:text-gray-300">
                            Nama Lengkap
                        </label>

                        <input type="text"
                            class="w-full mt-2 px-4 py-2 bg-gray-100 text-gray-700 border border-gray-300 rounded-lg text-center text-lg focus:outline-none"
                            value="{{ $karyawan->nama_lengkap }}" disabled>

                        <p class="text-sm text-red-400 text-center mt-4">(Data sebelah kiri tidak dapat diedit)</p>
                    </div>

                    <!-- Form Edit Jabatan -->
                    <form action="{{ route('datakaryawan.update', $karyawan->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="jabatan_id"
                                class="block text-lg font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                Nama Jabatan
                            </label>

                            <select name="jabatan_id" id="jabatan_id"
                                class="w-full px-4 py-3 bg-gray-100 text-gray-700 border border-gray-300 rounded-lg text-lg focus:ring-2 focus:ring-blue-400 focus:outline-none"
                                required>
                                @foreach ($jabatanKaryawan as $row)
                                    <option value="{{ $row->id }}"
                                        {{ $karyawan->jabatan_id == $row->id ? 'selected' : '' }}>
                                        {{ $row->nama_jabatan }}
                                    </option>
                                @endforeach
                            </select>

                            @error('jabatan_id')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex justify-end">
                            <button type="submit"
                                class="bg-yellow-400 hover:bg-yellow-300 text-gray-900 font-semibold py-3 px-8 rounded-lg shadow-md transition duration-300 transform hover:scale-105">
                                Simpan
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </main>
    </div>

@endsection
