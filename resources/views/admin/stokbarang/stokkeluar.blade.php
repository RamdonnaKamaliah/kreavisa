@extends('layout.main')
@section('content')
    <div class="p-4 md:p-6 overflow-x-hidden">
        <!-- Dropdown Pilihan Tabel -->
        <div class="mb-4">
            <label for="tableSelect" class="block text-gray-800 text-lg mb-2">Pilih Laporan:</label>
            <div class="max-w-xs">
                <select id="tableSelect" name="tableSelect" class="p-2 border border-gray-400 rounded-md w-full">
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

        <!-- Laporan Stok Keluar -->
        <div class="bg-white text-gray-800 p-4 rounded-lg shadow-md border border-gray-300">
            <h2 class="text-center text-xl font-bold mb-4">Laporan Stok Keluar</h2>
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
                    let url = "{{ route('stokkeluar.export') }}?type=stok_keluar"; 
                    if (date) url += "&date=" + encodeURIComponent(date);
                    window.location.href = url;
                }
            
                // Auto-fill input tanggal saat halaman dimuat
                document.addEventListener("DOMContentLoaded", function() {
                    const params = new URLSearchParams(window.location.search);
                    if (params.has('date')) {
                        document.getElementById("filterDate").value = params.get('date');
                    }
                });
            </script>
            <div class="overflow-x-auto mt-4">
                <table id="stokMasukTable" class="w-full border border-gray-400 text-xs md:text-sm">
                    <thead class="bg-gray-200 text-gray-800">
                        <tr>
                            <th class="border border-gray-400 px-2 py-1 md:px-4 md:py-2">Kategori Barang</th>
                            <th class="border border-gray-400 px-2 py-1 md:px-4 md:py-2">Jumlah Keluar</th>
                            <th class="border border-gray-400 px-2 py-1 md:px-4 md:py-2">Tanggal Keluar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($stokKeluar->isEmpty())
                            <tr>
                                <td colspan="3" class="text-center py-4 text-gray-500">Tabel kosong</td>
                            </tr>
                        @else
                            @foreach ($stokKeluar as $keluar)
                                <tr>
                                    <td class="border border-gray-400 px-2 py-1 md:px-4 md:py-2">
                                        {{ $keluar->stokBarang->kode_barang }} - {{ $keluar->stokBarang->warna }} - {{ $keluar->stokBarang->size }}</td>
                                    <td class="border border-gray-400 px-2 py-1 md:px-4 md:py-2">{{ $keluar->jumlah }}</td>
                                    <td class="border border-gray-400 px-2 py-1 md:px-4 md:py-2">{{ $keluar->tanggal_keluar ?? '-' }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>                    
                </table>
            </div>
        </div>
    </div>
@endsection
