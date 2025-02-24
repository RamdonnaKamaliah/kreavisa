@extends('layout.main')
@section('content')
    <div class="p-6 min-h-screen flex items-center justify-center">
        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 rounded-md">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <main>
            <div class="container mx-auto">
                <div class="bg-white shadow-lg rounded-2xl p-8 max-w-5xl mx-auto text-gray-900 relative">
                    <!-- Tombol Kembali -->
                    <div class="absolute top-4 left-4">
                        <a href="{{ route('datakaryawan.index') }}" class="p-2 rounded-full text-blue-500">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                    </div>
                    <h1 class="text-2xl font-bold text-center mb-6">Edit Data Karyawan</h1>

                    <div class="grid grid-cols-2 gap-8 items-center">
                        <!-- Nama Karyawan (Tidak Bisa Diedit) -->
                        <div class="border-r border-gray-300 pr-8">
                            <div class="flex flex-col items-center">
                                <div class="w-32 h-32 bg-gray-300 rounded-full flex items-center justify-center">
                                    <i class="fas fa-user text-4xl text-gray-600"></i>
                                </div>
                                <label class="block text-lg font-medium text-gray-600 mt-4">Nama Lengkap</label>
                                <input type="text"
                                    class="w-full px-3 py-2 bg-gray-200 text-gray-700 border border-gray-300 rounded-md text-center text-lg"
                                    value="{{ $karyawan->nama }}" disabled>
                            </div>
                            <p class="text-sm text-red-400 text-center mt-2">(Data sebelah kiri tidak dapat diedit)</p>
                        </div>

                        <!-- Form Edit Jabatan -->
                        <form action="{{ route('datakaryawan.update', $karyawan->id) }}" method="POST" class="space-y-6">
                            @csrf
                            @method('PUT')
                            <div>
                                <label for="jabatan_id" class="block text-lg font-medium text-gray-600">Nama Jabatan</label>
                                <select name="jabatan_id" id="jabatan_id"
                                    class="w-full px-3 py-2 bg-gray-200 text-gray-700 border border-gray-300 rounded-md text-lg"
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
                            <div class="mt-6 flex justify-end">
                                <button type="submit" class="bg-yellow-300 text-gray-900 py-2 px-6 rounded-md text-lg">
                                    Edit
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
