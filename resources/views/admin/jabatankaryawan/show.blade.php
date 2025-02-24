@push('page-title')
    Data Jabatan Karyawan
@endpush
<x-layout-admin>
    <div id="layoutSidenav_content">
        <!-- Card Container -->
        <main class="flex justify-center items-center min-h-screen py-6 px-4">
            <div class="w-full max-w-md bg-white p-6 rounded-lg shadow-lg">
                
                <!-- Tombol Kembali -->
                <div class="mb-4">
                    <a href="{{ route('jabatankaryawan.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 transition">
                        <i class='bx bx-arrow-back text-2xl'></i>
                        <span class="ml-2 text-lg font-medium"></span>
                    </a>
                </div>

                <!-- Judul -->
                <h1 class="text-center text-2xl font-bold text-gray-800 mb-6">View Jabatan Karyawan</h1>

                <!-- Informasi Jabatan -->
                <div class="border border-gray-300 p-4 rounded-lg bg-gray-50">
                    <p class="text-lg font-medium text-gray-700">{{ $jabatankaryawan->nama_jabatan }}</p>
                </div>
            </div>
        </main>
    </div>
</x-layout-admin>
