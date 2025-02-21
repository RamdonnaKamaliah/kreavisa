<x-layout-admin> 
    <div class="p-4 md:p-6 md:ml-[250px] overflow-x-hidden">
        <!-- Laporan Stok Masuk -->
        <div class="bg-gray-900 text-white p-4 rounded-lg shadow-md">
            <h2 class="text-center text-xl font-bold mb-4">Laporan Data Karyawan</h2>
            <div class="flex flex-wrap gap-2 justify-center md:justify-start">
                <a href="{{ route('datakaryawan.create') }}">
                    <button
                        class="bg-gray-300 text-black px-3 py-1.5 text-sm md:px-4 md:py-2 md:text-base rounded-md hover:bg-gray-400">
                        Tambah Data
                    </button>
                </a>
            </div>
            <div class="overflow-x-auto mt-4">
                <table id="stokMasukTable" class="w-full border border-gray-300 text-xs md:text-sm">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Foto</th>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Nama</th>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Usia</th>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Jenis Kelamin</th>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Tanggal Lahir</th>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">No HP</th>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Jabatan</th>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataKaryawan as $row)
                        <tr>
                            <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">
                                <img src="{{ $row->foto ? asset($row->foto) : asset('asset-landing-admin/img/profile.png') }}"
                                    class="w-14 h-14 rounded-full object-cover border border-gray-300">
                            </td>
                            <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">{{ $row->name }}</td>
                            <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">{{ $row->usia }} th</td>
                            <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">{{ $row->gender }}</td>
                            <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">{{ \Carbon\Carbon::parse($row->tanggal_lahir)->format('d M Y') }}</td>
                            <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">{{ $row->no_telepon }}</td>
                            <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">{{ $row->jabatan->nama_jabatan ?? '-' }}</td>
                            <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2 text-center">
                                <div class="flex justify-center space-x-1 md:space-x-2">
                                    <a  
                                    href="{{ route('datakaryawan.edit', $row->id) }}" class="px-2 py-1 text-yellow-600 border border-yellow-600 rounded-full hover:bg-yellow-100 flex items-center gap-1 text-xs md:text-sm">
                                        <i class="fas fa-edit"></i> <span class="hidden sm:inline">Edit</span>
                                    </a>
                                    <a 
                                    href="{{ route('datakaryawan.show', $row->id) }}" class="px-2 py-1 text-blue-600 border border-blue-600 rounded-full hover:bg-blue-100 flex items-center gap-1 text-xs md:text-sm">
                                        <i class="fas fa-eye"></i> <span class="hidden sm:inline">View</span>
                                    </a>
                                    <form action="{{ route('datakaryawan.destroy', $row->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="deleted(this)" 
                                            class="px-2 py-1 text-red-600 border border-red-600 rounded-full hover:bg-red-100 flex items-center gap-1 text-xs md:text-sm">
                                            <i class="fas fa-trash-alt"></i> <span class="hidden sm:inline">Delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout-admin>
