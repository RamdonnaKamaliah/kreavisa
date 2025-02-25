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
            <div class="overflow-x-auto mt-4">
                <table id="stokMasukTable" class="w-full border border-gray-400 text-xs md:text-sm">
                    <thead class="bg-gray-200 text-gray-800">
                        <tr>
                            <th class="border border-gray-400 px-2 py-1 md:px-4 md:py-2">Kode Barang</th>
                            <th class="border border-gray-400 px-2 py-1 md:px-4 md:py-2">Jumlah Keluar</th>
                            <th class="border border-gray-400 px-2 py-1 md:px-4 md:py-2">Tanggal Keluar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stokKeluar as $keluar)
                            <tr>
                                <td class="border border-gray-400 px-2 py-1 md:px-4 md:py-2">
                                    {{ $keluar->stokBarang->kode_barang }}</td>
                                <td class="border border-gray-400 px-2 py-1 md:px-4 md:py-2">{{ $keluar->jumlah }}</td>
                                <td class="border border-gray-400 px-2 py-1 md:px-4 md:py-2">{{ $keluar->tanggal_keluar }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
