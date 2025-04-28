@extends('layout.main')
@section('page-title', 'Tambah Gaji Pokok')
@section('content')
    <div id="layoutSidenav_content">
        <!-- Container utama -->
        <main class="flex justify-center items-center min-h-[-85px] py-10">
            <div class="w-full max-w-4xl bg-white dark:bg-slate-800 p-8 rounded-lg shadow-lg">
                <div class="mb-4">
                    <a href="{{ route('gajipokok.index') }}"
                        class="text-blue-600 hover:text-blue-800 font-medium transition flex items-center">
                        <i class="fas fa-arrow-left mr-2"></i>
                    </a>
                </div>
                <!-- Judul -->
                <h1 class="text-center text-2xl font-bold text-gray-800 mb-6 dark:text-white">Create Gaji Pokok</h1>

                <!-- Form -->
                <form action="{{ route('gajipokok.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <!-- Pilihan Jabatan -->
                    <div>
                        <label for="jabatan_id" class="block text-gray-700 font-medium dark:text-gray-200">Jabatan</label>
                        <select id="jabatan_id" name="jabatan_id"
                            class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-400" required>
                            @foreach ($jabatan as $jabatan)
                                <option value="{{ $jabatan->id }}">{{ $jabatan->nama_jabatan }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Input Gaji Pokok -->
<div>
    <label for="gaji_pokok" class="block text-gray-700 font-medium dark:text-gray-200">Gaji Pokok (Rp)</label>
    <input type="text" id="gaji_pokok" name="gaji_pokok"
        class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-400" required
        oninput="formatRupiah(this)"
        placeholder="Masukkan gaji pokok">
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


            </div>
        </main>
    </div>
    @if ($errors->any()) 
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let errorMessages = "";
            @foreach ($errors->all() as $error)
                errorMessages += "{{ $error }}\n";
            @endforeach

            Swal.fire({
                icon: 'error',
                title: 'Oops... Terjadi Kesalahan',
                text: errorMessages,
                confirmButtonText: 'Tutup',
                customClass: {
                    confirmButton: 'bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-400'
                },
                buttonsStyling: false
            });
        });
    </script>
@endif

@endsection
