@extends('layout.main')
@section('page-title', 'Tambah Gaji Karyawan')
@section('content')
    <div class="p-4 md:p-6 overflow-x-hidden">
        <!-- Form Create Gaji Karyawan -->
        <div class="flex justify-center items-center min-h-screen py-10">
            <div class="w-full max-w-4xl bg-white dark:bg-slate-800 p-8 rounded-lg shadow-lg">
                @if ($errors->any())
                <div class="mb-4 col-span-1 md:col-span-2">
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
                <!-- Tombol Back dengan Ikon Panah -->
                <div class="mb-4">
                    <a href="{{ route('gajikaryawan.index') }}"
                        class="text-blue-600 hover:text-blue-800 font-medium transition flex items-center">
                        <i class="fas fa-arrow-left mr-2"></i> 
                    </a>
                </div>

                <h1 class="text-center text-2xl font-bold text-gray-800 mb-6 dark:text-white">
                    Create Gaji Karyawan
                </h1>

                <form action="{{ route('gajikaryawan.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @csrf

                    <!-- Pilih Karyawan -->
                    <div>
                        <label for="user_id" class="block text-gray-700 font-medium dark:text-gray-200">Nama Karyawan</label>
                        <select id="user_id" name="user_id"
                            class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-400" required
                            onchange="getGajiPokok()">
                            <option value="">-- Pilih Karyawan --</option>
                            @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->nama_lengkap }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Gaji Pokok -->
                    <div>
                        <label for="gaji_pokok" class="block text-gray-700 font-medium dark:text-gray-200">Gaji Pokok (Rp)</label>
                        <input type="text" id="gaji_pokok" name="gaji_pokok"
                            class="w-full p-3 border rounded-lg bg-gray-100" required readonly
                            oninput="formatRupiah(this)">
                        <input type="hidden" id="gaji_pokok_raw" name="gaji_pokok_raw">
                    </div>

                    <!-- Tanggal -->
                    <div>
                        <label for="tanggal" class="block text-gray-700 font-medium dark:text-gray-200">Tanggal</label>
                        <input type="date" id="tanggal" name="tanggal"
                            class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-400" required>
                    </div>

                    <!-- Tipe Pembayaran -->
                    <div>
                        <label for="tipe_pembayaran" class="block text-gray-700 font-medium dark:text-gray-200">Tipe Pembayaran</label>
                        <select id="tipe_pembayaran" name="tipe_pembayaran"
                            class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-400" required
                            onchange="handleTipePembayaran()">
                            <option value="non_tunai">Non Tunai</option>
                            <option value="tunai">Tunai</option>
                        </select>
                    </div>

                    <!-- Nomor Rekening -->
                    <div>
                        <label for="nomor_rekening" class="block text-gray-700 font-medium dark:text-gray-200">Nomor Rekening</label>
                        <input type="text" id="nomor_rekening" name="nomor_rekening"
                            class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-400" required>
                    </div>

                    <!-- Bonus -->
<div>
    <label for="bonus" class="block text-gray-700 font-medium dark:text-gray-200">Bonus (Rp)</label>
    <input type="text" id="bonus" name="bonus"
           class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-400"
           oninput="formatRupiah(this)">
</div>

<!-- Potongan -->
<div class="md:col-span-2">
    <label for="potongan" class="block text-gray-700 font-medium dark:text-gray-200">Potongan (Rp)</label>
    <input type="text" id="potongan" name="potongan"
           class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-400"
           oninput="formatRupiah(this)">
</div>

                    <!-- Tombol Submit -->
                    <div class="col-span-1 md:col-span-2">
                        <button type="submit"
                            class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-200">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
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
        
        // Update nilai raw untuk gaji pokok
        if (input.id === 'gaji_pokok') {
            document.getElementById('gaji_pokok_raw').value = value.replace(/\./g, '');
        }
    }

    function getGajiPokok() {
        var userId = document.getElementById('user_id').value;
        if (userId) {
            fetch(`/get-gaji-pokok/${userId}`)
                .then(response => response.json())
                .then(data => {
                    const gajiPokok = data.gaji_pokok ?? 0;
                    // Format nilai gaji pokok
                    const formatted = gajiPokok.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                    document.getElementById('gaji_pokok').value = formatted;
                    document.getElementById('gaji_pokok_raw').value = gajiPokok;
                })
                .catch(error => console.error('Error:', error));
        } else {
            document.getElementById('gaji_pokok').value = '';
            document.getElementById('gaji_pokok_raw').value = '';
        }
    }

    function handleTipePembayaran() {
            var tipePembayaran = document.getElementById('tipe_pembayaran').value;
            var nomorRekening = document.getElementById('nomor_rekening');

            if (tipePembayaran === 'tunai') {
                nomorRekening.value = '-';
                nomorRekening.readOnly = true;
            } else {
                nomorRekening.value = '';
                nomorRekening.readOnly = false;
            }
        }
</script>
@endsection
