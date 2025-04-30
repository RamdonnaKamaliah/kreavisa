@extends('layout.main')
@section('page-title', 'Create Shift Karyawan')
@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <div id="layoutSidenav_content pt-1">
        <div class="flex justify-center items-center min-h-[80vh] py-6 px-12">
            <div class="w-full max-w-5xl bg-white dark:bg-slate-800 p-6 rounded-lg shadow-lg min-h-[300px]">
                <div class="mb-4">
                    <a href="{{ route('shiftkaryawan.index') }}" class="text-blue-600 hover:text-blue-800">
                        <i class='bx bx-arrow-back text-2xl'></i>
                    </a>
                </div>

                <h1 class="text-center text-2xl font-bold text-gray-800 mb-6 dark:text-white">Create Shift Karyawan</h1>

                @if ($users->count() > 0)
                    <form action="{{ route('shiftkaryawan.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="user_id" class="block text-gray-700 font-semibold mb-2 dark:text-gray-300">Pilih
                                Karyawan<span class="text-red-500">*</span></label>
                            <select id="user_id" name="user_id" @class([
                                'w-full p-3 border rounded-lg focus:ring-2 transition',
                                'border-gray-300 focus:ring-blue-400 focus:border-blue-500' => !$errors->has(
                                    'user_id'),
                                'border-2 border-red-500 focus:ring-red-400 focus:border-red-500' => $errors->has(
                                    'user_id'),
                            ])>
                                <option value="">Pilih Karyawan</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}
                                        data-jabatan="{{ $user->jabatan_id }}">
                                        {{ $user->nama_lengkap }}
                                    </option>
                                @endforeach

                            </select>

                            @error('user_id')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror


                        </div>

                        <div class="mb-4">
                            <label for="jabatan_id"
                                class="block text-gray-700 font-semibold mb-2 dark:text-gray-300">Jabatan</label>
                            <select id="jabatan_id"
                                class="w-full p-3 border border-gray-300 rounded-lg bg-gray-100 cursor-not-allowed"
                                disabled>
                                @class([
                                    'w-full p-3 border rounded-lg focus:ring-2 transition',
                                    'border-gray-300 focus:ring-blue-400 focus:border-blue-500' => !$errors->has(
                                        'user_id'),
                                    'border-2 border-red-500 focus:ring-red-400 focus:border-red-500' => $errors->has(
                                        'user_id'),
                                ])">
                                <option value="">Pilih Jabatan</option>
                                @foreach ($jabatans as $jabatan)
                                    <option value="{{ $jabatan->id }}" @selected(old('jabatan_id') == $jabatan->id)>
                                        {{ $jabatan->nama_jabatan }}
                                    </option>
                                @endforeach
                            </select>
                            <input type="hidden" name="jabatan_id" id="hidden_jabatan_id" value="{{ old('jabatan_id') }}">
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

                        <div class="mb-4">
                            <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Shift 1 <span
                                    class="text-red-500">*</span></h2>

                            <label for="shift_1_masuk" class="block text-gray-700 font-semibold mt-2 dark:text-gray-400">Jam
                                Masuk</label>
                            <input type="text" id="shift_1_masuk" name="shift_1_masuk"
                                value="{{ old('shift_1_masuk') }}" @class([
                                    'timepicker w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-400 transition',
                                    'border-gray-300 focus:ring-blue-400 focus:border-blue-500' => !$errors->has(
                                        'user_id'),
                                    'border-2 border-red-500 focus:ring-red-400 focus:border-red-500' => $errors->has(
                                        'user_id'),
                                ])>
                            @error('shift_1_masuk')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror

                            <label for="shift_1_pulang"
                                class="block text-gray-700 font-semibold mt-2 dark:text-gray-400">Jam Pulang</label>
                            <input type="text" id="shift_1_pulang" name="shift_1_pulang"
                                value="{{ old('shift_1_pulang') }}" @class([
                                    'timepicker w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-400 transition',
                                    'border-gray-300 focus:ring-blue-400 focus:border-blue-500' => !$errors->has(
                                        'shift_1_pulang'),
                                    'border-2 border-red-500 focus:ring-red-400 focus:border-red-500' => $errors->has(
                                        'shift_1_pulang'),
                                ])>
                            @error('shift_1_pulang')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Shift 2 <span
                                    class="text-red-500">*</span></h2>

                            <label for="shift_2_masuk" class="block text-gray-700 font-semibold mt-2 dark:text-gray-400">Jam
                                Masuk</label>
                            <input type="text" id="shift_2_masuk" name="shift_2_masuk"
                                value="{{ old('shift_2_masuk') }}" @class([
                                    'timepicker w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-400 transition',
                                    'border-gray-300 focus:ring-blue-400 focus:border-blue-500' => !$errors->has(
                                        'shift_1_pulang'),
                                    'border-2 border-red-500 focus:ring-red-400 focus:border-red-500' => $errors->has(
                                        'shift_1_pulang'),
                                ])>
                            @error('shift_2_masuk')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror

                            <label for="shift_2_pulang"
                                class="block text-gray-700 font-semibold mt-2 dark:text-gray-400">Jam Pulang</label>
                            <input type="text" id="shift_2_pulang" name="shift_2_pulang"
                                value="{{ old('shift_2_pulang') }}" @class([
                                    'timepicker w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-400 transition',
                                    'border-gray-300 focus:ring-blue-400 focus:border-blue-500' => !$errors->has(
                                        'shift_1_pulang'),
                                    'border-2 border-red-500 focus:ring-red-400 focus:border-red-500' => $errors->has(
                                        'shift_1_pulang'),
                                ])>
                            @error('shift_2_pulang')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                flatpickr(".timepicker", {
                                    enableTime: true,
                                    noCalendar: true,
                                    dateFormat: "H:i", // Format 24 jam
                                    time_24hr: true
                                });
                            });
                        </script>

                        <button type="submit"
                            class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition">
                            Simpan
                        </button>
                    </form>
                @else
                    <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-4">
                        <p>Tidak ada karyawan yang tersedia untuk ditambahkan shift. Semua karyawan sudah memiliki shift.
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
