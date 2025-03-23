@extends('layout.main')
@section('content')

<div id="layoutSidenav_content pt-1">
    <div class="flex justify-center items-center min-h-[80vh] py-6 px-4">
        <div class="w-full max-w-4xl bg-white p-6 rounded-lg shadow-lg">

            <div class="mb-4">
                <a href="{{ route('jadwalkaryawan.index') }}" class="text-blue-600 hover:text-blue-800">
                    <i class='bx bx-arrow-back text-2xl'></i>
                </a>
            </div>

            <h1 class="text-center text-2xl font-bold text-gray-800 mb-6">Create Jadwal Karyawan</h1>
            <form action="{{ route('jadwalkaryawan.store') }}" method="POST">
                @csrf

                <!-- Pilih User -->
<div class="mb-4">
    <label for="user_id" class="block text-gray-700 font-semibold mb-2">Pilih Karyawan</label>
    <select id="user_id" name="user_id" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:border-blue-500 transition" required>
        <option value="">Pilih Karyawan</option>
        @foreach ($users as $user)
            <option value="{{ $user->id }}" data-jabatan="{{ $user->jabatan_id }}">
                {{ $user->nama_lengkap }}
            </option>
        @endforeach
    </select>    
</div>

<!-- Pilih Jabatan (Otomatis berdasarkan Karyawan) -->
<div class="mb-4">
    <label for="jabatan_id" class="block text-gray-700 font-semibold mb-2">Jabatan</label>
    <input type="text" id="jabatan_text" class="w-full p-3 border border-gray-300 rounded-lg bg-gray-100 cursor-not-allowed" disabled>
    <input type="hidden" name="jabatan_id" id="hidden_jabatan_id">
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let userSelect = document.getElementById("user_id");
        let jabatanText = document.getElementById("jabatan_text");
        let hiddenJabatanId = document.getElementById("hidden_jabatan_id");

        // Data Jabatan dari server
        let jabatans = @json($jabatans);

        userSelect.addEventListener("change", function() {
            let selectedOption = this.options[this.selectedIndex];
            let jabatanId = selectedOption.getAttribute("data-jabatan");

            if (jabatanId) {
                let jabatanNama = jabatans.find(j => j.id == jabatanId)?.nama_jabatan || "Tidak Diketahui";
                jabatanText.value = jabatanNama;
                hiddenJabatanId.value = jabatanId;
            } else {
                jabatanText.value = "";
                hiddenJabatanId.value = "";
            }
        });
    });
</script>


               <!-- Pilih Shift -->
<div class="mb-4">
    <label for="shift_id" class="block text-gray-700 font-semibold mb-2">Pilih Shift</label>
    <select id="shift_id" name="shift_id" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:border-blue-500 transition" required>
        <option value="">Pilih Shift</option>
    </select>
    <!-- Input tersembunyi untuk menyimpan informasi shift (1 atau 2) -->
    <input type="hidden" id="shift_type" name="shift_type">
</div>

<script>
    document.getElementById("user_id").addEventListener("change", function() {
        let userId = this.value;
        let shiftSelect = document.getElementById("shift_id");

        // Kosongkan dropdown shift sebelum mengisi ulang
        shiftSelect.innerHTML = '<option value="">Pilih Shift</option>';

        // Jika tidak ada user yang dipilih, keluar
        if (!userId) return;

        // Ambil daftar shift dari server
        let shifts = @json($shifts);

        shifts.forEach(shift => {
            if (shift.user_id == userId) {
                // Tambahkan shift 1 ke dropdown
                let option1 = document.createElement("option");
                option1.value = shift.id; // Hanya shift.id (integer)
                option1.textContent = "Shift 1: " + shift.shift_1;
                option1.setAttribute("data-shift-type", "1"); // Simpan informasi shift 1
                shiftSelect.appendChild(option1);

                // Tambahkan shift 2 ke dropdown
                let option2 = document.createElement("option");
                option2.value = shift.id; // Hanya shift.id (integer)
                option2.textContent = "Shift 2: " + shift.shift_2;
                option2.setAttribute("data-shift-type", "2"); // Simpan informasi shift 2
                shiftSelect.appendChild(option2);
            }
        });

        // Update input tersembunyi saat shift dipilih
        shiftSelect.addEventListener("change", function() {
            let selectedOption = this.options[this.selectedIndex];
            let shiftType = selectedOption.getAttribute("data-shift-type");
            document.getElementById("shift_type").value = shiftType;
        });
    });
</script>

                <!-- Pilih Bulan (Checkbox) -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Pilih Bulan</label>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
                        @php
                            $months = [
                                1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                                5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                                9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
                            ];
                        @endphp
                        @foreach ($months as $key => $month)
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" name="bulan[]" value="{{ $key }}" class="form-checkbox h-5 w-5 text-blue-600">
                                <span>{{ $month }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Pilih Tahun (Input Manual) -->
                <div class="mb-4">
                    <label for="tahun" class="block text-gray-700 font-semibold mb-2">Tahun</label>
                    <input type="text" id="tahun" name="tahun" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:border-blue-500 transition" placeholder="{{ date('Y') }}" maxlength="4" oninput="validateYearInput(this)" required>
                </div>
                <!-- Tombol Submit -->
                <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition">
                    Create
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let userSelect = document.getElementById("user_id");
        let jabatanSelect = document.getElementById("jabatan_id");
        let hiddenJabatanId = document.getElementById("hidden_jabatan_id");

        userSelect.addEventListener("change", function() {
            let selectedOption = this.options[this.selectedIndex];
            let jabatanId = selectedOption.getAttribute("data-jabatan");

            jabatanSelect.value = jabatanId;
            hiddenJabatanId.value = jabatanId;
        });
    });

    
</script>

@endsection