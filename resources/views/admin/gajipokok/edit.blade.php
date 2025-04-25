@extends('layout.main')
@section('content')
    <div id="layoutSidenav_content">
        <main class="flex justify-center items-center min-h-screen py-10">
            <div class="w-full max-w-4xl bg-white dark:bg-slate-800 p-8 rounded-lg shadow-lg">
                <div class="mb-4">
                    <a href="{{ route('gajipokok.index') }}" class="text-blue-600 hover:text-blue-800 font-medium transition flex items-center">
                        <i class="fas fa-arrow-left mr-2"></i>
                    </a>
                </div>

                <!-- Judul -->
                <h1 class="text-center text-2xl font-bold text-gray-800 mb-6 dark:text-white">Edit Gaji Pokok</h1>

                <!-- Form -->
                <form action="{{ route('gajipokok.update', $gajiPokok->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <!-- Tampilkan Nama Jabatan (Tidak Bisa Diedit) -->
                    <div>
                        <label class="block text-gray-700 font-medium dark:text-gray-200">Jabatan</label>
                        <div class="w-full p-3 border rounded-lg bg-gray-100 text-gray-700">
                            {{ $gajiPokok->jabatan->nama_jabatan }}
                        </div>
                    </div>

<!-- Input Gaji Pokok -->
<div>
    <label for="gaji_pokok" class="block text-gray-700 font-medium dark:text-gray-200">Gaji Pokok (Rp)</label>
    <input type="text" id="gaji_pokok" name="gaji_pokok"
        class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-400" required
        oninput="formatRupiah(this)"
        value="{{ old('gaji_pokok', number_format($gajiPokok->gaji_pokok, 0, ',', '.')) }}"
        placeholder="Masukkan gaji pokok">
</div>


                    <!-- Tombol Submit -->
                    <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition">
                        Simpan
                    </button>
                </form>
            </div>
        </main>
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

// Format saat halaman dimuat
document.addEventListener('DOMContentLoaded', function() {
    const gajiInput = document.getElementById('gaji_pokok');
    if (gajiInput) {
        let value = gajiInput.value.replace(/[^\d]/g, '');
        if (value.length > 3) {
            gajiInput.value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }
    }
});

// Hilangkan titik sebelum submit
document.querySelector('form').addEventListener('submit', function(e) {
    const gajiInput = document.getElementById('gaji_pokok');
    if (gajiInput) {
        gajiInput.value = gajiInput.value.replace(/\./g, '');
    }
});
    </script>
@endsection
