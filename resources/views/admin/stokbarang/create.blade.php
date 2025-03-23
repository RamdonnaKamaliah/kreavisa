@extends('layout.main')
@section('content')
    <div class="p-4 md:p-6 overflow-x-hidden flex justify-center">
        <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-4xl">
            <div class="mb-4">
                <a href="{{ route('stokbarang.index') }}"
                    class="text-blue-600 hover:text-blue-800 font-medium transition flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i>
                </a>
            </div>
            <h2 class="text-center text-xl font-bold text-gray-900 mb-4">Tambah Stok Barang</h2>

            <!-- Form Tambah Stok Barang -->
            <form action="{{ route('stokbarang.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="kode_barang" class="block text-gray-700 font-medium">Kode Barang</label>
                        <input type="text"
                            class="w-full p-2 border rounded-md @error('kode_barang') border-red-500 @enderror"
                            id="kode_barang" name="kode_barang" value="{{ old('kode_barang') }}" required>
                        @error('kode_barang')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="warna" class="block text-gray-700 font-medium">Warna</label>
                        <input type="text" class="w-full p-2 border rounded-md @error('warna') border-red-500 @enderror"
                            id="warna" name="warna" value="{{ old('warna') }}" required>
                        @error('warna')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="size" class="block text-gray-700 font-medium">Size</label>
                        <select class="w-full p-2 border rounded-md @error('size') border-red-500 @enderror" id="size" name="size" required>
                            <option value="" disabled selected>Pilih Size</option>
                            @for ($i = 37; $i <= 41; $i++)
                                <option value="{{ $i }}" {{ old('size') == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                        @error('size')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="total_stok" class="block text-gray-700 font-medium">Total Stok</label>
                        <input type="number"
                            class="w-full p-2 border rounded-md @error('total_stok') border-red-500 @enderror"
                            id="total_stok" name="total_stok" value="{{ old('total_stok') }}" required min="0">
                        @error('total_stok')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-4">
                    <label for="keterangan" class="block text-gray-700 font-medium">Keterangan (Opsional)</label>
                    <textarea class="w-full p-2 border rounded-md @error('keterangan') border-red-500 @enderror" id="keterangan"
                        name="keterangan" rows="3">{{ old('keterangan') }}</textarea>
                    @error('keterangan')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end mt-4">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Simpan</button>
                </div>
            </form>
        </div>
    </div>
    @if (session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "{{ session('error') }}",
                confirmButtonColor: '#d33'
            });
        });
    </script>
@endif

@endsection
