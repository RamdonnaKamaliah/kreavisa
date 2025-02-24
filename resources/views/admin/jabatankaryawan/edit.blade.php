@push('page-title')
    Data Jabatan Karyawan
@endpush
<x-layout-admin>
    <div id="layoutSidenav_content">
        <div class="flex justify-center items-center min-h-screen background-color: #f8f9fa; py-6 px-4">
            <div class="w-full max-w-md bg-white p-6 rounded-lg shadow-lg">
                <div class="mb-4">
                    <a href="{{ route('jabatankaryawan.index') }}" class="text-blue-600 hover:text-blue-800">
                        <i class='bx bx-arrow-back text-2xl'></i>
                    </a>
                </div>
                <!-- Judul -->
                <h1 class="text-center text-2xl font-bold text-gray-800 mb-6">Edit Data Jabatan</h1>
                

                <!-- Form -->
                <form action="{{ route('jabatankaryawan.update', $jabatan->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <!-- Input Nama Jabatan -->
                    <div class="mb-4">
                        <label for="nama_jabatan" class="block text-gray-700 font-semibold mb-2">Nama Jabatan</label>
                        <input type="text" id="nama_jabatan" name="nama_jabatan" placeholder="Input Nama Jabatan" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:border-blue-500 transition" value="{{ old('nama_jabatan', $jabatan->nama_jabatan) }}" required>
                    </div>

                    <!-- Tombol Submit -->
                    <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition">
                        Simpan Perubahan
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-layout-admin>
