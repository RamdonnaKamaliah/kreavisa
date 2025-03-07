@extends('layout.main')
@section('content')
    <div id="layoutSidenav_content">
        <main class="flex justify-center items-center min-h-screen py-6 px-4 text-gray-900 -mt-20">
            <div class="w-full max-w-3xl bg-white p-6 rounded-lg shadow-md border border-gray-300 min-h-[250px] flex flex-col justify-center">

                <!-- Tombol Kembali -->
                <div class="mb-4">
                    <a href="{{ route('stokbarang.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 transition">
                        <i class='bx bx-arrow-back text-2xl'></i>
                    </a>
                </div>

                <!-- Judul -->
                <h1 class="text-center text-xl font-bold text-gray-800 mb-4">Detail Stok Barang</h1>

                <!-- Informasi Stok Barang -->
                <div class="bg-gray-200 p-6 rounded-lg shadow-inner">
                    <p class="text-md font-bold text-gray-700">Kode Barang: 
                        <span class="text-gray-600">{{ $stokBarang->kode_barang }}</span>
                    </p>
                    <p class="text-md font-bold text-gray-700 mt-2">Warna: 
                        <span class="text-gray-600">{{ $stokBarang->warna }}</span>
                    </p>
                    <p class="text-md font-bold text-gray-700 mt-2">Size: 
                        <span class="text-gray-600">{{ $stokBarang->size }}</span>
                    </p>
                    <p class="text-md font-bold text-gray-700 mt-2">Total Stok: 
                        <span class="text-gray-600">{{ $stokBarang->total_stok }}</span>
                    </p>
                    <p class="text-md font-bold text-gray-700 mt-2">Keterangan: 
                        <span class="text-gray-600">{{ $stokBarang->keterangan ?? '-' }}</span>
                    </p>
                </div>
            </div>
        </main>
    </div>
@endsection
