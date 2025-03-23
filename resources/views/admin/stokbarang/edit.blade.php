@extends('layout.main')
@section('content')
    <div class="p-4 md:p-6 overflow-x-hidden flex justify-center">
        <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-4xl">
            <!-- Tombol Kembali -->
            <div class="mb-4">
                <a href="{{ route('stokbarang.index') }}" class="text-blue-600 hover:text-blue-800 font-medium transition flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i>
                </a>
            </div>

            <h2 class="text-center text-xl font-bold text-gray-900 mb-4">Edit Stok Barang</h2>

            <!-- Form Edit Stok Barang -->
<form action="{{ route('stokbarang.update', $stokBarang->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-2 gap-4">
        <!-- Kode Barang -->
        <div>
            <label for="kode_barang" class="block text-gray-700 font-medium">Kode Barang</label>
            <input type="text"
                class="w-full p-2 border rounded-md @error('kode_barang') border-red-500 @enderror"
                id="kode_barang" name="kode_barang" value="{{ old('kode_barang', $stokBarang->kode_barang) }}" required>
            @error('kode_barang')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Warna -->
        <div>
            <label for="warna" class="block text-gray-700 font-medium">Warna</label>
            <input type="text" class="w-full p-2 border rounded-md @error('warna') border-red-500 @enderror"
                id="warna" name="warna" value="{{ old('warna', $stokBarang->warna) }}" required>
            @error('warna')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Size -->
        <div>
            <label for="size" class="block text-gray-700 font-medium">Size</label>
            <select class="w-full p-2 border rounded-md @error('size') border-red-500 @enderror" id="size" name="size" required>
                <option value="" disabled>Pilih Size</option>
                @for ($i = 37; $i <= 41; $i++)
                    <option value="{{ $i }}" {{ old('size', $stokBarang->size) == $i ? 'selected' : '' }}>{{ $i }}</option>
                @endfor
            </select>
            @error('size')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror            
        </div>

        <!-- Total Stok -->
        <div>
            <label for="total_stok" class="block text-gray-700 font-medium">Total Stok</label>
            <input type="number"
                class="w-full p-2 border rounded-md @error('total_stok') border-red-500 @enderror"
                id="total_stok" name="total_stok" value="{{ old('total_stok', $stokBarang->total_stok) }}" required min="0">
            @error('total_stok')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <!-- Keterangan -->
    <div class="mt-4">
        <label for="keterangan" class="block text-gray-700 font-medium">Keterangan (Opsional)</label>
        <textarea class="w-full p-2 border rounded-md @error('keterangan') border-red-500 @enderror"
            id="keterangan" name="keterangan" rows="3">{{ old('keterangan', $stokBarang->keterangan) }}</textarea>
        @error('keterangan')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Tombol Simpan -->
    <div class="flex justify-end mt-4">
        <button type="submit" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-md">Simpan</button>
    </div>
</form>

        </div>
    </div>
@endsection
