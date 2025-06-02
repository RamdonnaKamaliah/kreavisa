@extends('layout.main')
@section('page-title', 'Ceate Jadwal Karyawan')
@section('content')

    <div id="layoutSidenav_content pt-1">
        <div class="flex justify-center items-center min-h-[80vh] py-6 px-4">
            <div class="w-full max-w-5xl bg-white dark:bg-slate-800 p-6 rounded-lg shadow-lg">

                <div class="mb-4">
                    <a href="{{ route('jadwalkaryawan.index') }}" class="text-blue-600 hover:text-blue-800">
                        <i class='bx bx-arrow-back text-2xl'></i>
                    </a>
                </div>

                <h1 class="text-center text-2xl font-bold text-gray-800 mb-6 dark:text-white">Create Jadwal Karyawan</h1>
                <form action="{{ route('jadwalkaryawan.store') }}" method="POST">
                    @csrf

                    <!-- Pilih User -->
                    <div class="mb-4">
                        <label for="user_id" class="block text-gray-700 font-semibold mb-2 dark:text-gray-300">Pilih
                            Karyawan<span class="text-red-500">*</label>
                        <select id="user_id" name="user_id" @class([
                            'w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:border-blue-500 transition',
                            'border-gray-300 focus:ring-blue-400 focus:border-blue-500' => !$errors->has(
                                'user_id'),
                            'border-2 border-red-500 focus:ring-red-400 focus:border-red-500' => $errors->has(
                                'user_id'),
                        ])>
                            <option>Pilih Karyawan</option>
                            @foreach ($usersWithShifts as $user)
                                <option value="{{ $user->id }}" data-jabatan="{{ $user->jabatan_id }}"
                                    {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->nama_lengkap }}
                                </option>
                            @endforeach
                        </select>

                        @if ($usersWithShifts->isEmpty())
                            <div class="mt-2 text-red-500 text-sm">
                                Tidak ada karyawan yang memiliki shift. Silakan buat shift terlebih dahulu.
                            </div>
                        @endif
                        @error('user_id')
                            <div class="mt-2 text-red-500 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
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

                            let userShifts = shifts.filter(shift => shift.user_id == userId);

                            if (userShifts.length === 0) {
                                let option = document.createElement("option");
                                option.value = "";
                                option.textContent = "Tidak ada shift tersedia";
                                option.disabled = true;
                                option.selected = true;
                                shiftSelect.appendChild(option);
                                return;
                            }

                            userShifts.forEach(shift => {
                                // Tambahkan shift 1 ke dropdown
                                let option1 = document.createElement("option");
                                option1.value = shift.id;
                                option1.textContent = "Shift 1: " + shift.shift_1;
                                option1.setAttribute("data-shift-type", "1");
                                shiftSelect.appendChild(option1);

                                // Tambahkan shift 2 ke dropdown
                                let option2 = document.createElement("option");
                                option2.value = shift.id;
                                option2.textContent = "Shift 2: " + shift.shift_2;
                                option2.setAttribute("data-shift-type", "2");
                                shiftSelect.appendChild(option2);
                            });

                            // Update input tersembunyi saat shift dipilih
                            shiftSelect.addEventListener("change", function() {
                                let selectedOption = this.options[this.selectedIndex];
                                let shiftType = selectedOption.getAttribute("data-shift-type");
                                document.getElementById("shift_type").value = shiftType || "";
                            });
                        });
                    </script>

                    <!-- Pilih Jabatan (Otomatis berdasarkan Karyawan) -->
                    <div class="mb-4">
                        <label for="jabatan_id"
                            class="block text-gray-700 font-semibold mb-2 dark:text-gray-300">Jabatan</label>
                        <input type="text" id="jabatan_text"
                            class="w-full p-3 border border-gray-300 rounded-lg bg-gray-100 cursor-not-allowed" disabled>
                        <input type="hidden" name="jabatan_id" id="hidden_jabatan_id">
                    </div>
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            let userSelect = document.getElementById("user_id");
                            let jabatanText = document.getElementById("jabatan_text");
                            let hiddenJabatanId = document.getElementById("hidden_jabatan_id");

                            // Data Jabatan dari server
                            let jabatans = @json($jabatans);

                            function updateJabatan() {
                                let selectedOption = userSelect.options[userSelect.selectedIndex];
                                let jabatanId = selectedOption.getAttribute("data-jabatan");

                                if (jabatanId) {
                                    let jabatanNama = jabatans.find(j => j.id == jabatanId)?.nama_jabatan || "Tidak Diketahui";
                                    jabatanText.value = jabatanNama;
                                    hiddenJabatanId.value = jabatanId;
                                } else {
                                    jabatanText.value = "";
                                    hiddenJabatanId.value = "";
                                }
                            }

                            // Bind change event
                            userSelect.addEventListener("change", updateJabatan);

                            // Jalankan sekali saat load jika ada value yang sudah dipilih
                            if (userSelect.value) {
                                updateJabatan();
                            }
                        });
                    </script>


                    <!-- Pilih Shift -->
                    <div class="mb-4">
                        <label for="shift_id" class="block text-gray-700 font-semibold mb-2 dark:text-gray-300">Pilih
                            Shift<span class="text-red-500">*</label>
                        <select id="shift_id" name="shift_id" @class([
                            'w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:border-blue-500 transition',
                            'border-gray-300 focus:ring-blue-400 focus:border-blue-500' => !$errors->has(
                                'shift_id'),
                            'border-2 border-red-500 focus:ring-red-400 focus:border-red-500' => $errors->has(
                                'shift_id'),
                        ])>
                            <option value="{{ old('shift_id') }}">Pilih Shift</option>
                        </select>
                        <!-- Input tersembunyi untuk menyimpan informasi shift (1 atau 2) -->
                        <input type="hidden" id="shift_type" name="shift_type">
                        @error('shift_id')
                            <p class="mt-2 text-red-500 text-sm">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            const userSelect = document.getElementById("user_id");
                            const shiftSelect = document.getElementById("shift_id");
                            const shiftTypeInput = document.getElementById("shift_type");
                            const shifts = @json($shifts);
                            const oldUserId = "{{ old('user_id') }}";
                            const oldShiftId = "{{ old('shift_id') }}";

                            function populateShifts(userId) {
                                shiftSelect.innerHTML = '<option value="">Pilih Shift</option>';

                                shifts.forEach(shift => {
                                    if (shift.user_id == userId) {
                                        // Shift 1
                                        const option1 = document.createElement("option");
                                        option1.value = shift.id;
                                        option1.textContent = "Shift 1: " + shift.shift_1;
                                        option1.setAttribute("data-shift-type", "1");
                                        if (shift.id == oldShiftId && !shiftSelect.querySelector('option[selected]')) {
                                            option1.selected = true;
                                            shiftTypeInput.value = "1";
                                        }
                                        shiftSelect.appendChild(option1);

                                        // Shift 2
                                        const option2 = document.createElement("option");
                                        option2.value = shift.id;
                                        option2.textContent = "Shift 2: " + shift.shift_2;
                                        option2.setAttribute("data-shift-type", "2");
                                        if (shift.id == oldShiftId && !shiftSelect.querySelector('option[selected]')) {
                                            option2.selected = true;
                                            shiftTypeInput.value = "2";
                                        }
                                        shiftSelect.appendChild(option2);
                                    }
                                });
                            }

                            // Trigger saat user diganti
                            userSelect.addEventListener("change", function() {
                                populateShifts(this.value);
                            });

                            // Update shift_type saat shift dipilih
                            shiftSelect.addEventListener("change", function() {
                                const selectedOption = this.options[this.selectedIndex];
                                const shiftType = selectedOption.getAttribute("data-shift-type");
                                shiftTypeInput.value = shiftType || "";
                            });

                            // Jika ada old user_id (form reload karena error), isi otomatis
                            if (oldUserId) {
                                populateShifts(oldUserId);
                            }
                        });
                    </script>


                    <!-- Pilih Bulan (Checkbox) -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2 dark:text-gray-300">Pilih Bulan<span
                                class="text-red-500">*</label>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
                            @php
                                $months = [
                                    1 => 'Januari',
                                    2 => 'Februari',
                                    3 => 'Maret',
                                    4 => 'April',
                                    5 => 'Mei',
                                    6 => 'Juni',
                                    7 => 'Juli',
                                    8 => 'Agustus',
                                    9 => 'September',
                                    10 => 'Oktober',
                                    11 => 'November',
                                    12 => 'Desember',
                                ];
                                $oldBulan = old('bulan', []);
                            @endphp
                            @foreach ($months as $key => $month)
                                <label class="flex items-center space-x-2">
                                    <input type="checkbox" name="bulan[]" value="{{ $key }}"
                                        class="form-checkbox h-5 w-5 text-blue-600 dark:text-green-500">
                                    <span>{{ $month }}</span>
                                </label>
                            @endforeach

                            @error('bulan')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="tahun" class="block text-gray-700 font-semibold mb-2 dark:text-gray-300">Pilih Tahun
                            <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="number" id="tahun" name="tahun"
                                class="w-full p-3 border rounded-lg transition pr-4
                                    {{ $errors->has('tahun') ? 'border-2 border-red-500 focus:ring-red-400 focus:border-red-500' : 'border-gray-300 focus:ring-2 focus:ring-blue-400 focus:border-blue-500' }}"
                                value="{{ old('tahun', date('Y')) }}" min="{{ date('Y') }}"
                                max="{{ date('Y') + 5 }}">
                        </div>
                        @error('tahun')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Tombol Submit -->
                    <button type="submit"
                        class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition">
                        Simpan
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
