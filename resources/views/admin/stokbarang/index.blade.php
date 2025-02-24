@push('page-title')
    Data Stok Barang
@endpush

<x-layout-admin> 
    <div class="p-4 md:p-6 md:ml-[250px] overflow-x-hidden">
        <!-- Dropdown Pilihan Tabel -->
        <div class="mb-4">
            <label for="tableSelect" class="block text-white text-lg mb-2">Pilih Laporan:</label>
            <div class="max-w-xs">
                <select id="tableSelect" name="tableSelect" class="p-2 border border-gray-300 rounded-md w-full">
                    <option value="{{ route('stokbarang.index') }}">Laporan List Stok Barang</option> 
                    <option value="{{ route('stokbarang.stokmasuk') }}">Laporan Stok Masuk</option>
                    <option value="{{ route('stokbarang.stokkeluar') }}">Laporan Stok Keluar</option>  
                </select>
            </div>
        </div>

        <script>
           document.addEventListener("DOMContentLoaded", function() {
                let currentURL = window.location.href; // Ambil URL lengkap
                let selectElement = document.getElementById("tableSelect");

                // Loop melalui semua opsi dan cari yang sesuai dengan URL saat ini
                for (let option of selectElement.options) {
                    if (option.value === currentURL) {
                        selectElement.value = option.value;
                        break;
                    }
                }

                // Event Listener ketika dropdown berubah
                selectElement.addEventListener("change", function() {
                    let selectedURL = this.value;
                    window.location.assign(selectedURL);
                });
            });
        </script>
        @if (session('success'))
        <div class="alert alert-success" role="alert"> 
            {{ session('success') }}
        </div>
        @endif
        <!-- Laporan Stok Barang -->
        <div class="bg-gray-900 text-white p-4 rounded-lg shadow-md">
            <h2 class="text-center text-xl font-bold mb-4">Laporan List Stok Barang</h2>
            <div class="flex justify-between items-center mb-4">
                <a href="{{ route('stokbarang.create') }}"
                    class="px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-md">
                    + Tambah Data
                </a>
                <div class="flex items-center space-x-2 mb-4">
                    <!-- Input Tanggal + Search & Reload -->
                    <div class="relative flex items-center border border-gray-300 rounded-md overflow-hidden bg-white">
                        <input type="date" id="filterDate" class="p-2 text-black border-none focus:ring-0 bg-white">
                        <button onclick="applyFilter()" class="p-2 text-gray-600 hover:text-blue-600">
                            <i class="fas fa-search"></i>
                        </button>
                        <button onclick="resetFilter()" class="p-2 text-gray-600 hover:text-red-600">
                            <i class="fas fa-sync-alt"></i>
                        </button>
                    </div>
                
                    <!-- Export Excel -->
                    <button onclick="exportExcel()" class="p-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-md">
                        <i class="fas fa-file-excel"></i> Export Excel
                    </button>
                </div>
                
                <script>
                    function applyFilter() {
                        let date = document.getElementById("filterDate").value;
                        let url = new URL(window.location.href);
                        if (date) {
                            url.searchParams.set('date', date);
                        } else {
                            url.searchParams.delete('date');
                        }
                        window.location.href = url.toString();
                    }
                
                    function resetFilter() {
                        let url = new URL(window.location.href);
                        url.searchParams.delete('date');
                        window.location.href = url.toString();
                    }
                
                    function exportExcel() {
                        let date = document.getElementById("filterDate").value;
                        let url = "{{ route('stokbarang.export') }}";
                        if (date) url += "?date=" + encodeURIComponent(date);
                        window.location.href = url;
                    }
                
                    // Auto-fill tanggal saat halaman dimuat
                    document.addEventListener("DOMContentLoaded", function() {
                        const params = new URLSearchParams(window.location.search);
                        if (params.has('date')) {
                            document.getElementById("filterDate").value = params.get('date');
                        }
                    });
                </script>
                                        
            </div>
            <div class="overflow-x-auto mt-4">
                <table id="stokMasukTable" class="w-full border border-gray-300 text-xs md:text-sm">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Kode Barang</th>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Warna</th>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Size</th>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Total Stok</th>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Keterangan</th>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Aksi</th>
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
                            <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2 text-center">
                                <div class="flex justify-center space-x-1 md:space-x-2">
                                    <a href="{{ route('stokbarang.edit', $barang->id) }}"
                                       class="px-2 py-1 text-yellow-600 border border-yellow-600 rounded-full hover:bg-yellow-100 flex items-center gap-1 text-xs md:text-sm">
                                        <i class="fas fa-edit"></i> <span class="hidden sm:inline">Edit</span>
                                    </a>
                                    <a href="{{ route('stokbarang.show', $barang->id) }}"
                                       class="px-2 py-1 text-blue-600 border border-blue-600 rounded-full hover:bg-blue-100 flex items-center gap-1 text-xs md:text-sm">
                                        <i class="fas fa-eye"></i> <span class="hidden sm:inline">View</span>
                                    </a>
                                    <form action="{{ route('stokbarang.destroy', $barang->id) }}" method="POST" class="inline">
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
