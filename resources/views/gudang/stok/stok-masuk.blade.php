@extends('layout2.karyawan')
@section('content')
    @push('page-title')
        Stok Barang
    @endpush
    <div class="p-4 md:p-6 overflow-x-hidden">
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
        <div class="bg-gray-900 text-white p-4 rounded-lg shadow-md">
            <h2 class="text-center text-xl font-bold mb-4">Laporan Stok Masuk</h2>
            <div class="flex justify-between items-center mb-4">
                <a href="{{ route('gudang.stok.create-masuk') }}"
                    class="px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-md">
                    + Tambah Data
                </a>
            </div>
            <div class="overflow-x-auto mt-4">
                <table id="stokMasukTable" class="w-full border border-gray-300 text-xs md:text-sm">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Kode Barang</th>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Jumlah Keluar</th>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Tanggal Keluar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stokMasuk as $row)
                            <tr>
                                <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">
                                    {{ $row->stokBarang->kode_barang }}</td>
                                <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">{{ $row->jumlah }}</td>
                                <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">{{ $row->tanggal_keluar }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
