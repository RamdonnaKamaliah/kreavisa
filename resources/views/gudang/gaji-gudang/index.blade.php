<x-layout-gudang>
    <div class="pt-20">
        <div class="p-6 md:ml-auto md:w-[calc(100%-250px)] bg-white rounded-lg shadow-lg">
            <h2 class="text-center text-2xl font-bold text-gray-800 mb-4">Gaji Karyawan</h2>
            <div class="w-full overflow-auto">
                <table id="myTable" class="display nowrap min-w-full text-gray-900 rounded-lg overflow-hidden">
                    <thead class="bg-gray-200 text-xs md:text-sm whitespace-nowrap">
                        <tr>
                            <th class="py-2 px-4 border-b border-gray-300">No</th>
                            <th class="py-2 px-4 border-b border-gray-300">Nama</th>
                            <th class="py-2 px-4 border-b border-gray-300">Email</th>
                            <th class="py-2 px-4 border-b border-gray-300">Telepon</th>
                            <th class="py-2 px-4 border-b border-gray-300">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b border-gray-300 hover:bg-gray-100 transition duration-300">
                            <td class="py-2 px-4">1</td>
                            <td class="py-2 px-4">John Doe</td>
                            <td class="py-2 px-4">john@example.com</td>
                            <td class="py-2 px-4">08123456789</td>
                            <td class="py-2 px-4 flex flex-wrap gap-2">
                                <button class="px-3 py-1 bg-blue-500 hover:bg-blue-600 text-white rounded-md">Edit</button>
                                <button class="px-3 py-1 bg-red-500 hover:bg-red-600 text-white rounded-md" onclick="deleted(this)">Hapus</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout-gudang>
