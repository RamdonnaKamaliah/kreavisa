<x-layout-admin> 
    <div class="p-4 md:p-6 md:ml-[250px] overflow-x-hidden">
        <!-- Laporan Stok Masuk -->
        <div class="bg-gray-900 text-white p-4 rounded-lg shadow-md">
            <h2 class="text-center text-xl font-bold mb-4">Laporan Gaji Pokok</h2>
            <div class="flex justify-between items-center mb-4">
                <div class="space-x-2">
                    <a href="{{ route('gajikaryawan.index') }}"
                        class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-md">
                        Gaji Karyawan
                    </a>
                    <a href="{{ route('gajipokok.index') }}"
                        class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-md">
                        Gaji Pokok
                    </a>
                </div>
                <a href="{{ route('gajipokok.create') }}"
                    class="px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-md">
                    + Tambah Data
                </a>
            </div>
            <div class="overflow-x-auto mt-4">
                <table id="stokMasukTable" class="w-full border border-gray-300 text-xs md:text-sm">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Jabatan</th>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Gaji Pokok</th>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($gajiPokok as $row)
                        <tr>
                            <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">{{ $row->jabatan->nama_jabatan }}</td>
                            <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Rp {{ number_format($row->gaji_pokok, 0, ',', '.') }}</td>
                            <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2 text-center">
                                <div class="flex justify-center space-x-1 md:space-x-2">
                                    <a  
                                    href="{{ route('gajipokok.edit', $row->id) }}" class="px-2 py-1 text-yellow-600 border border-yellow-600 rounded-full hover:bg-yellow-100 flex items-center gap-1 text-xs md:text-sm">
                                        <i class="fas fa-edit"></i> <span class="hidden sm:inline">Edit</span>
                                    </a>
                                    <a 
                                    href="{{ route('gajipokok.show', $row->id) }}" class="px-2 py-1 text-blue-600 border border-blue-600 rounded-full hover:bg-blue-100 flex items-center gap-1 text-xs md:text-sm">
                                        <i class="fas fa-eye"></i> <span class="hidden sm:inline">View</span>
                                    </a>
                                    <form action="{{ route('gajipokok.destroy', $row->id) }}" method="POST" class="inline">
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
