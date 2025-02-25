@extends('layout2.karyawan')
@section('content')
    @push('page-title')
        Stok Barang
    @endpush
    <div class="p-4 md:p-6 overflow-x-hidden">
        <!-- Dropdown Pilihan Tabel -->
        <div class="mb-4">
            <label for="tableSelect" class="block text-gray-800 text-lg mb-2">Pilih Laporan:</label>
            <div class="max-w-xs">
                <select id="tableSelect" name="tableSelect"
                    class="p-2 border border-gray-300 rounded-md w-full bg-white text-gray-800">
                    <option value="{{ route('gudang.stok.index') }}" {{ request()->routeIs('gudang.stok.index') ? 'selected' : '' }}>Laporan List Stok Barang</option>
                    <option value="{{ route('gudang.stok.masuk') }}" {{ request()->routeIs('gudang.stok.masuk') ? 'selected' : '' }}>Laporan Stok Masuk</option>
                    <option value="{{ route('gudang.stok.keluar') }}" {{ request()->routeIs('gudang.stok.keluar') ? 'selected' : '' }}>Laporan Stok Keluar</option>
                </select>
            </div>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                document.getElementById('tableSelect').addEventListener('change', function () {
                    let selectedValue = this.value;
                    if (selectedValue) {
                        window.location.href = selectedValue;
                    }
                });
            });
        </script>

        <!-- Laporan Stok Barang -->
        <div class="bg-white text-gray-900 p-4 rounded-lg shadow-md border border-gray-300">
            <h2 class="text-center text-xl font-bold mb-4">Laporan List Stok Barang</h2>
            <div class="overflow-x-auto mt-4">
                <table id="stokMasukTable" class="w-full border border-gray-300 text-xs md:text-sm bg-white text-gray-800">
                    <thead class="bg-gray-200 text-gray-900">
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
                                <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">
                                    {{ $barang->keterangan ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
