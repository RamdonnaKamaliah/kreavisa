<x-layout-admin>
    <div id="layoutSidenav_content">
        <div class="flex justify-center items-center min-h-screen background-color: #f8f9fa; py-6 px-4">
            <div class="w-full max-w-lg bg-white p-6 rounded-lg shadow-lg">
                
                <!-- Judul -->
                <h1 class="text-center text-2xl font-bold text-gray-800 mb-6">View Data Karyawan</h1>

                <!-- Foto Karyawan -->
                <div class="flex justify-center mb-4">
                    @if ($datakaryawan->foto)
                        <img src="{{ asset($datakaryawan->foto) }}" class="w-24 h-24 rounded-full shadow-md object-cover">
                    @else
                        <img src="{{ asset('asset-landing-admin/img/profile.png') }}" class="w-24 h-24 rounded-full shadow-md object-cover">
                    @endif
                </div>

                <!-- Data Karyawan -->
                <div class="space-y-4">
                    <div>
                        <span class="text-gray-600 font-semibold">Nama:</span>
                        <p class="text-gray-800">{{ $datakaryawan->name }}</p>
                    </div>

                    <div>
                        <span class="text-gray-600 font-semibold">Jabatan:</span>
                        <p class="text-gray-800">{{ $datakaryawan->jabatan->nama_jabatan ?? '-' }}</p>
                    </div>

                    <div>
                        <span class="text-gray-600 font-semibold">Email:</span>
                        <p class="text-gray-800">{{ $datakaryawan->email }}</p>
                    </div>

                    <div>
                        <span class="text-gray-600 font-semibold">No Telepon:</span>
                        <p class="text-gray-800">{{ $datakaryawan->no_telepon }}</p>
                    </div>

                    <div>
                        <span class="text-gray-600 font-semibold">Gender:</span>
                        <p class="text-gray-800">{{ $datakaryawan->gender }}</p>
                    </div>

                    <div>
                        <span class="text-gray-600 font-semibold">Usia:</span>
                        <p class="text-gray-800">{{ $datakaryawan->usia }} tahun</p>
                    </div>
                </div>

                <!-- Tombol Kembali -->
                <div class="text-center mt-6">
                    <a href="{{ route('datakaryawan.index') }}" class="w-full bg-gray-900 text-white py-2 px-4 rounded-lg hover:bg-gray-700 transition">
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layout-admin>
