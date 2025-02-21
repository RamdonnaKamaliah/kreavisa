<x-layout-admin>
    <div id="layoutSidenav_content">
        <main class="flex justify-center py-8">
            <div class="w-full max-w-xl bg-white p-6 rounded-lg shadow-lg">
                
                <!-- Tombol Kembali -->
                <div class="mb-4 flex items-center">
                    <a href="{{ route('datakaryawan.index') }}" class="text-blue-600 hover:text-blue-800 flex items-center">
                        <i class='bx bx-arrow-back text-2xl'></i>
                        <span class="ml-2 text-lg font-semibold"></span>
                    </a>
                </div>

                <!-- Judul -->
                <h1 class="text-center text-3xl font-bold text-gray-700 mb-6">Edit Jabatan Karyawan</h1>

                <!-- Notifikasi Error -->
                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                        <strong>Error!</strong> Silakan perbaiki kesalahan berikut:
                        <ul class="mt-2 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Form Edit Jabatan -->
                <form action="{{ route('datakaryawan.update', $karyawan->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-6">
                        <label for="jabatan_id" class="block text-gray-700 font-medium mb-2">Jabatan</label>
                        <select name="jabatan_id" id="jabatan_id" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:border-blue-500 transition" required>
                            @foreach($jabatanKaryawan as $row)
                                <option value="{{ $row->id }}" {{ $karyawan->jabatan_id == $row->id ? 'selected' : '' }}>
                                    {{ $row->nama_jabatan }}
                                </option>
                            @endforeach
                        </select>
                        @error('jabatan_id')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>      

                    <!-- Tombol Simpan -->
                    <div class="text-center">
                        <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition font-semibold shadow-md">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</x-layout-admin>
