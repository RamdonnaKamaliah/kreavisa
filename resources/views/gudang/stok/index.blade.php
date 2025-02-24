@push('page-title')
    Stok Barang
@endpush
<x-layout-gudang> 
    <div class="p-4 md:p-6 md:ml-[250px] overflow-x-hidden">
        <!-- Dropdown Pilihan Tabel -->
        <div class="mb-4">
            <label for="tableSelect" class="block text-white text-lg mb-2">Pilih Laporan:</label>
            <div class="max-w-xs">
                <select id="tableSelect" name="tableSelect" class="p-2 border border-gray-300 rounded-md w-full">
                    <option value="{{ route('gudang.stok.index') }}">Laporan List Stok Barang</option> 
                    <option value="{{ route('gudang.stok.masuk') }}">Laporan Stok Masuk</option>
                    <option value="{{ route('gudang.stok.keluar') }}">Laporan Stok Keluar</option>   
                </select>
            </div>
        </div>

        <script>
         document.addEventListener("DOMContentLoaded", function () {
    document.getElementById('exportExcel').addEventListener('click', function () {
        let selectedDate = document.getElementById('exportDate').value;
        let url = "{{ route('stokbarang.export') }}";

        if (!url) {
            alert("URL export tidak ditemukan.");
            return;
        }

        let finalUrl = url;
        if (selectedDate) {
            finalUrl += "?date=" + encodeURIComponent(selectedDate) + "&table=stok_barang";
        } else {
            finalUrl += "?table=stok_barang";
        }

        window.location.href = finalUrl;
    });
});
        </script>

        <!-- Laporan Stok Barang -->
        <div class="bg-gray-900 text-white p-4 rounded-lg shadow-md">
            <h2 class="text-center text-xl font-bold mb-4">Laporan List Stok Barang</h2>
            <div class="overflow-x-auto mt-4">
                <table id="stokMasukTable" class="w-full border border-gray-300 text-xs md:text-sm">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Kode Barang</th>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Warna</th>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Size</th>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Total Stok</th>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Keterangan</th>              
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stokBarangs as $barang)
                        <tr>
                            <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">{{ $barang->kode_barang }}</td>
                            <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">{{ $barang->warna }}</td>
                            <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">{{ $barang->size }}</td>
                            <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">{{ $barang->total_stok }}</td>
                            <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">{{ $barang->keterangan ?? '-' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout-gudang>
