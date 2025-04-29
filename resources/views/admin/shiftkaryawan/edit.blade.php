@extends('layout.main')
@section('page-title', 'Edit Shift Karyawan')
@section('content')
    <div class="p-4 md:p-6">
        <div class="bg-white dark:bg-slate-800 text-gray-900 p-4 rounded-lg shadow-md border border-gray-300 dark:border-slate-800 max-w-5xl mx-auto">
            <!-- Back Button -->
            <div class="mb-4">
                <a href="{{ route('shiftkaryawan.index') }}" class="text-blue-600 hover:text-blue-800 flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i>
                </a>
            </div>

            <!-- Name and Position Section -->
            <div class="flex justify-between items-start mb-2 pb-4">
                <div class="w-1/2 pr-2">
                    <h2 class="text-lg font-bold dark:text-white">Name:</h2>
                    <p class="text-base dark:text-gray-300">{{ $shift->user->nama_lengkap ?? '-' }}</p>
                </div>
                <div class="w-1/2 pl-2">
                    <h2 class="text-lg font-bold dark:text-white">Jabatan:</h2>
                    <p class="text-base dark:text-gray-300">{{ $shift->user->jabatan->nama_jabatan ?? '-' }}</p>
                </div>
            </div>

            <!-- Note Text -->
            <div class="text-center italic text-gray-500 mb-4">
                <p>(Data dates took dapat shetti)</p>
            </div>

            <form action="{{ route('shiftkaryawan.update', $shift->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Shifts Section -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 border-t border-gray-300 pt-4">
                    <!-- Shift 1 -->
                    <div class="pr-4">
                        <h3 class="text-lg font-semibold mb-2 dark:text-white">Shift 1</h3>
                        <div class="space-y-2">
                            <div>
                                <label for="shift_1_masuk" class="block text-gray-700 dark:text-gray-300">Jam Masuk</label>
                                <input type="text" id="shift_1_masuk" name="shift_1_masuk" 
                                       class="timepicker w-full p-2 border border-gray-400 rounded-md"
                                       value="{{ explode(' - ', $shift->shift_1 ?? '')[0] ?? '' }}" required>
                            </div>
                            <div>
                                <label for="shift_1_pulang" class="block text-gray-700 dark:text-gray-300">Jam Pulang</label>
                                <input type="text" id="shift_1_pulang" name="shift_1_pulang" 
                                       class="timepicker w-full p-2 border border-gray-400 rounded-md"
                                       value="{{ explode(' - ', $shift->shift_1 ?? '')[1] ?? '' }}" required>
                            </div>
                        </div>
                    </div>

                    <!-- Shift 2 -->
                    <div class="pl-4">
                        <h3 class="text-lg font-semibold mb-2 dark:text-white">Shift 2</h3>
                        <div class="space-y-2">
                            <div>
                                <label for="shift_2_masuk" class="block text-gray-700 dark:text-gray-300">Jam Masuk</label>
                                <input type="text" id="shift_2_masuk" name="shift_2_masuk" 
                                       class="timepicker w-full p-2 border border-gray-400 rounded-md"
                                       value="{{ explode(' - ', $shift->shift_2 ?? '')[0] ?? '' }}" required>
                            </div>
                            <div>
                                <label for="shift_2_pulang" class="block text-gray-700 dark:text-gray-300">Jam Pulang</label>
                                <input type="text" id="shift_2_pulang" name="shift_2_pulang" 
                                       class="timepicker w-full p-2 border border-gray-400 rounded-md"
                                       value="{{ explode(' - ', $shift->shift_2 ?? '')[1] ?? '' }}" required>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Save Button -->
                <div class="mt-6 text-center">
                    <button type="submit" 
                            class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-20 rounded-md font-bold">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <!-- Timepicker Script -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            flatpickr(".timepicker", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                time_24hr: true
            });
        });
    </script>
@endsection