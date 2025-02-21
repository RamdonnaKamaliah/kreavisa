<x-layout-admin>
    <div id="layoutSidenav_content">
        <main class="flex justify-center items-center min-h-screen py-10">
            <div class="w-full max-w-lg bg-white p-8 rounded-lg shadow-lg">
                
                <!-- Judul -->
                <h1 class="text-center text-2xl font-bold text-gray-800 mb-6">
                    Create Gaji Karyawan
                </h1>

                <!-- Form -->
                <form action="{{ route('gajikaryawan.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <!-- Pilih Karyawan -->
                    <div>
                        <label for="user_id" class="block text-gray-700 font-medium">Nama Karyawan</label>
                        <select id="user_id" name="user_id" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-400" required onchange="getGajiPokok()">
                            <option value="">-- Pilih Karyawan --</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" data-jabatan="{{ $user->jabatan->id }}">
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <!-- Gaji Pokok -->
                    <div>
                        <label for="gaji_pokok" class="block text-gray-700 font-medium">Gaji Pokok</label>
                        <input type="number" id="gaji_pokok" name="gaji_pokok" class="w-full p-3 border rounded-lg bg-gray-100" required readonly>
                    </div>

                    <!-- Tanggal -->
                    <div>
                        <label for="tanggal" class="block text-gray-700 font-medium">Tanggal</label>
                        <input type="date" id="tanggal" name="tanggal" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-400" required>
                    </div>

                    <!-- Tipe Pembayaran -->
                    <div>
                        <label for="tipe_pembayaran" class="block text-gray-700 font-medium">Tipe Pembayaran</label>
                        <select id="tipe_pembayaran" name="tipe_pembayaran" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-400" required onchange="handleTipePembayaran()">
                            <option value="non_tunai">Non Tunai</option>
                            <option value="tunai">Tunai</option>
                        </select>
                    </div>
                    
                    <!-- Nomor Rekening -->
                    <div>
                        <label for="nomor_rekening" class="block text-gray-700 font-medium">Nomor Rekening</label>
                        <input type="text" id="nomor_rekening" name="nomor_rekening" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-400" required>
                    </div>
                    
                    <!-- Bonus -->
                    <div>
                        <label for="bonus" class="block text-gray-700 font-medium">Bonus (Rp)</label>
                        <input type="number" id="bonus" name="bonus" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-400">
                    </div>
                    
                    <!-- Potongan -->
                    <div>
                        <label for="potongan" class="block text-gray-700 font-medium">Potongan (Rp)</label>
                        <input type="number" id="potongan" name="potongan" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-400">
                    </div>

                    <!-- Tombol Submit -->
                    <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-200">
                        Create
                    </button>
                </form>

                <!-- Tombol Back to List -->
                <div class="mt-6 text-center">
                    <a href="{{ route('gajikaryawan.index') }}" class="text-blue-600 hover:text-blue-800 font-medium transition">Back to List</a>
                </div>
            </div>
        </main>
    </div>

    <script>
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

        function getGajiPokok() {
            var userId = document.getElementById('user_id').value;
            if (userId) {
                fetch(`/get-gaji-pokok/${userId}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('gaji_pokok').value = data.gaji_pokok ?? 0;
                    })
                    .catch(error => console.error('Error:', error));
            } else {
                document.getElementById('gaji_pokok').value = '';
            }
        }
    </script>
</x-layout-admin>
