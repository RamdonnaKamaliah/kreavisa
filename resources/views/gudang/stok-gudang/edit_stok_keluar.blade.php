<x-layout-gudang>
    <div class="w-full sm:max-w-lg mx-auto bg-gray-900 text-white px-4 sm:px-6 py-6 rounded-2xl shadow-md mt-16">
        <a href="{{ route('stok-gudang.index') }}">
            <button class="flex items-center gap-2 bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded-md">
                <i class="fas fa-arrow-left"></i> Kembali
            </button>
        </a>

        <h2 class="text-center text-2xl font-semibold mt-4 mb-2">Create Laporan Stok Keluar</h2>
        <hr class="border-gray-600 mb-4">

        <form action="#" method="POST" class="space-y-4">
            <div>
                <label for="kategori" class="block text-sm font-medium">Kategori Barang:</label>
                <input type="text" id="kategori" name="kategori" value=""
                    class="w-full mt-1 p-2 border border-gray-600 rounded-lg bg-gray-800 text-white focus:ring focus:ring-gray-500">
            </div>

            <div>
                <label for="tanggal" class="block text-sm font-medium">Tanggal:</label>
                <input type="date" id="tanggal" name="tanggal" value=""
                    class="w-full mt-1 p-2 border border-gray-600 rounded-lg bg-gray-800 text-white focus:ring focus:ring-gray-500">
            </div>

            <div>
                <label for="jumlah" class="block text-sm font-medium">Jumlah:</label>
                <input type="number" id="jumlah" name="jumlah" value=""
                    class="w-full mt-1 p-2 border border-gray-600 rounded-lg bg-gray-800 text-white focus:ring focus:ring-gray-500">
            </div>

            <div class="flex justify-end">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-500 text-white px-4 py-2 rounded-lg">Create</button>
            </div>
        </form>
    </div>


</x-layout-gudang>
