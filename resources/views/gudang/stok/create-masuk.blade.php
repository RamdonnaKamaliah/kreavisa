@extends('layout2.karyawan')
@section('content')
    @push('page-title')
        Stok Barang
    @endpush
    <div class="p-4 md:p-6 overflow-x-hidden">
        <!-- Card Form -->
        <div class="bg-white shadow-lg rounded-lg p-6 max-w-lg mx-auto">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Tambah Stok Masuk</h2>
            <form action="{{ route('gudang.stok.store-masuk') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="stok_barang_id" class="block text-gray-600 font-medium">Kategori Barang</label>
                    <select name="stok_barang_id" id="stok_barang_id"
                        class="mt-1 p-2 w-full border border-gray-300 rounded-md" required>
                        <option value="" disabled selected>Pilih Barang</option>
                        @foreach ($stokBarangs as $barang)
                            <option value="{{ $barang->id }}">{{ $barang->kode_barang }} - {{ $barang->warna }} -
                                {{ $barang->size }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="jumlah" class="block text-gray-600 font-medium">Jumlah Stok Masuk</label>
                    <input type="number" name="jumlah" class="mt-1 p-2 w-full border border-gray-300 rounded-md" required
                        min="1">
                </div>
                <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded-md hover:bg-blue-700 transition">
                    Tambah Stok
                </button>
            </form>
        </div>
    </div>
@endsection
