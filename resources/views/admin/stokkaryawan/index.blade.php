<x-layout-admin>
    <div class="p-4 md:p-6 md:ml-[250px] overflow-x-hidden">
        <!-- Dropdown Pilihan Tabel -->
        <div class="mb-4">
            <label for="tableSelect" class="block text-white text-lg mb-2">Pilih Laporan:</label>
            <div class="max-w-xs">
                <select id="tableSelect" class="p-2 border border-gray-300 rounded-md w-full">
                    <option value="stokMasuk">Laporan Stok Masuk</option>
                    <option value="stokKeluar">Laporan Stok Keluar</option>
                </select>
            </div>
        </div>


        <!-- Laporan Stok Masuk -->
        <div id="stokMasuk" class="bg-gray-900 text-white p-4 rounded-lg shadow-md">
            <h2 class="text-center text-xl font-bold mb-4">Laporan Stok Masuk</h2>
            <div class="flex flex-wrap gap-2 justify-center md:justify-start">
                <button
                    class="bg-green-500 text-white px-3 py-1.5 text-sm md:px-4 md:py-2 md:text-base rounded-md hover:bg-green-600">Export
                    Excel</button>
                <a href="{{ route('stok-gudang.create', ['type' => 'masuk']) }}">
                    <button
                        class="bg-gray-300 text-black px-3 py-1.5 text-sm md:px-4 md:py-2 md:text-base rounded-md hover:bg-gray-400">
                        Tambah Stok Masuk
                    </button>
                </a>
            </div>
            <div class="overflow-x-auto mt-4">
                <table class="w-full max-w-full border border-gray-300 text-xs md:text-sm">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Kategori Barang</th>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Tanggal</th>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Jumlah</th>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">0-5 - Merah - 38</td>
                            <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">20/02/2025</td>
                            <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">100</td>
                            <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2 text-center">
                                <div class="flex justify-center space-x-1 md:space-x-2">
                                    <a href="#"
                                        class="px-2 py-1 text-yellow-600 border border-yellow-600 rounded-full hover:bg-yellow-100 flex items-center gap-1 text-xs md:text-sm">
                                        <i class="fas fa-edit"></i> <span class="hidden sm:inline">Edit</span>
                                    </a>
                                    <a href="#"
                                        class="px-2 py-1 text-blue-600 border border-blue-600 rounded-full hover:bg-blue-100 flex items-center gap-1 text-xs md:text-sm">
                                        <i class="fas fa-eye"></i> <span class="hidden sm:inline">View</span>
                                    </a>
                                    <form action="#" method="POST" class="inline">
                                        <button type="button"
                                            class="px-2 py-1 text-red-600 border border-red-600 rounded-full hover:bg-red-100 flex items-center gap-1 text-xs md:text-sm"
                                            onclick="deleted(this)">
                                            <i class="fas fa-trash-alt"></i> <span
                                                class="hidden sm:inline">Delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <!-- Repeat rows as needed -->
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Laporan Stok Keluar -->
        <div id="stokKeluar" class="bg-gray-900 text-white p-4 rounded-lg shadow-md hidden">
            <h2 class="text-center text-xl font-bold mb-4">Laporan Stok Keluar</h2>
            <div class="flex flex-wrap gap-2 justify-center md:justify-start">
                <button
                    class="bg-green-500 text-white px-3 py-1.5 text-sm md:px-4 md:py-2 md:text-base rounded-md hover:bg-green-600">Export
                    Excel</button>
                <a href="{{ route('stok-gudang.create', ['type' => 'keluar']) }}">
                    <button
                        class="bg-gray-300 text-black px-3 py-1.5 text-sm md:px-4 md:py-2 md:text-base rounded-md hover:bg-gray-400">
                        Tambah Stok Keluar
                    </button>
                </a>
            </div>
            <div class="overflow-x-auto mt-4">
                <table class="w-full max-w-full border border-gray-300 text-xs md:text-sm">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Kategori Barang</th>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Tanggal</th>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Jumlah</th>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">0-1 - Cream - 36</td>
                            <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">30/01/2025</td>
                            <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">100</td>
                            <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2 text-center">
                                <div class="flex justify-center space-x-1 md:space-x-2">
                                    <a href="{{ route('stok-gudang.edit', ['stok_gudang' => 1, 'type' => 'keluar']) }}"
                                        class="px-2 py-1 text-yellow-600 border border-yellow-600 rounded-full hover:bg-yellow-100 flex items-center gap-1 text-xs md:text-sm">
                                        <i class="fas fa-edit"></i> <span class="hidden sm:inline">Edit</span>
                                    </a>

                                    <a href="#"
                                        class="px-2 py-1 text-blue-600 border border-blue-600 rounded-full hover:bg-blue-100 flex items-center gap-1 text-xs md:text-sm">
                                        <i class="fas fa-eye"></i> <span class="hidden sm:inline">View</span>
                                    </a>
                                    <form action="#" method="POST" class="inline">
                                        <button type="button"
                                            class="px-2 py-1 text-red-600 border border-red-600 rounded-full hover:bg-red-100 flex items-center gap-1 text-xs md:text-sm"
                                            onclick="deleted(this)">
                                            <i class="fas fa-trash-alt"></i> <span
                                                class="hidden sm:inline">Delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <!-- Repeat rows as needed -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('tableSelect').addEventListener('change', function() {
            document.getElementById('stokMasuk').classList.toggle('hidden', this.value !== 'stokMasuk');
            document.getElementById('stokKeluar').classList.toggle('hidden', this.value !== 'stokKeluar');
        });
    </script>
</x-layout-admin>
