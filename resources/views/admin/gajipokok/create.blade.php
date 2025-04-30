@extends('layout.main')
@section('page-title', 'Create Gaji Pokok')
@section('content')

    <div id="layoutSidenav_content">
        <!-- Container utama -->
        <main class="flex justify-center items-center min-h-screen py-6 px-4 text-gray-900 -mt-20">
            <div class="w-full max-w-4xl bg-white dark:bg-slate-800 p-8 rounded-lg shadow-lg">
                <div class="mb-4">
                    <a href="{{ route('gajipokok.index') }}"
                        class="text-blue-600 hover:text-blue-800 font-medium transition flex items-center">
                        <i class="fas fa-arrow-left mr-2"></i>
                    </a>
                </div>
                <!-- Judul -->
                <h1 class="text-center text-2xl font-bold text-gray-800 mb-6 dark:text-white">Create Gaji Pokok</h1>

                @if ($jabatan->count() > 0)

                    <!-- Form -->
                    <form action="{{ route('gajipokok.store') }}" method="POST" class="space-y-4">
                        @csrf

                        <div>
                            <label for="jabatan_id" class="block text-gray-700 font-medium dark:text-gray-200">Jabatan<span
                                    class="text-red-500">*</span></label>
                            <select id="jabatan_id" name="jabatan_id"
                                class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-400" required>
                                @if ($jabatan->count() > 0)
                                    @foreach ($jabatan as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_jabatan }}</option>
                                    @endforeach
                                @else
                                    <option value="">Semua jabatan sudah memiliki gaji pokok</option>
                                @endif
                            </select>
                        </div>

                        <!-- Input Gaji Pokok -->
                        <div>
                            <label for="gaji_pokok" class="block text-gray-700 font-medium dark:text-gray-200">Gaji Pokok
                                (Rp)<span class="text-red-500">*</label>
                            <input type="text" id="gaji_pokok" name="gaji_pokok" @class([
                                'w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-400',
                                'border-gray-300 focus:ring-blue-400 focus:border-blue-500' => !$errors->has(
                                    'gaji_pokok'),
                                'border-2 border-red-500 focus:ring-red-400 focus:border-red-500' => $errors->has(
                                    'gaji_pokok'),
                            ])
                                oninput="formatRupiah(this)" placeholder="Masukkan gaji pokok">

                            @error('gaji_pokok')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <script>
                            function formatRupiah(input) {
                                // Hapus semua karakter non-digit
                                let value = input.value.replace(/[^\d]/g, '');

                                // Format dengan titik sebagai pemisah ribuan
                                if (value.length > 3) {
                                    value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                                }

                                // Update nilai input
                                input.value = value;
                            }

                            // Tambahkan event listener untuk form submission
                            document.querySelector('form').addEventListener('submit', function(e) {
                                // Hilangkan titik sebelum submit
                                const gajiInput = document.getElementById('gaji_pokok');
                                gajiInput.value = gajiInput.value.replace(/\./g, '');
                            });
                        </script>

                        <!-- Tombol Submit -->
                        <button type="submit"
                            class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition">Simpan</button>
                    </form>
                @else
                    <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-4">
                        <p>Tidak ada jabatan yang tersedia untuk ditambahkan gaji pokok. Semua jabatan sudah memiliki gaji
                            pokok.</p>
                    </div>
                @endif
            </div>
        </main>
    </div>
@endsection
