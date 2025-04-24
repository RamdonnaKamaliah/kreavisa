@extends('layout.main')
@section('content')
    <div class="p-4 md:p-6 overflow-x-hidden">
        <div class="bg-white dark:bg-slate-800 rounded-lg shadow-md border border-gray-300 dark:border-slate-800 p-6">
            <div class="mb-4">
                <a href="{{ route('jadwalkaryawan.index', ['bulan' => $jadwal->bulan, 'tahun' => $jadwal->tahun]) }}" class="text-blue-600 hover:text-blue-800">
                    <i class='bx bx-arrow-back text-2xl'></i>
                </a>
            </div>

            <h1 class="text-center text-2xl font-bold text-gray-800 mb-6 dark:text-white">Edit Jadwal Karyawan</h1>
            
            <form action="{{ route('jadwalkaryawan.update', $jadwal->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Informasi Karyawan dan Jabatan -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div class="border border-gray-300 rounded-lg p-4">
                        <label class="block text-gray-500 text-sm mb-1 dark:text-white">Nama Karyawan</label>
                        <p class="text-lg font-medium dark:text-gray-200">{{ $jadwal->user->nama_lengkap }}</p>
                    </div>
                    
                    <div class="border border-gray-300 rounded-lg p-4">
                        <label class="block text-gray-500 text-sm mb-1 dark:text-white">Jabatan</label>
                        <p class="text-lg font-medium dark:text-gray-200">{{ $jadwal->jabatan->nama_jabatan }}</p>
                    </div>
                </div>

                <!-- Informasi Periode (Bulan dan Tahun) -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div class="border border-gray-300 rounded-lg p-4">
                        <label class="block text-gray-500 text-sm mb-1 dark:text-white">Bulan</label>
                        <p class="text-lg font-medium dark:text-gray-200">
                            {{ DateTime::createFromFormat('!m', $jadwal->bulan)->format('F') }}
                        </p>
                        <input type="hidden" name="bulan" value="{{ $jadwal->bulan }}">
                    </div>
                    
                    <div class="border border-gray-300 rounded-lg p-4">
                        <label class="block text-gray-500 text-sm mb-1 dark:text-white">Tahun</label>
                        <p class="text-lg font-medium dark:text-gray-200">{{ $jadwal->tahun }}</p>
                        <input type="hidden" name="tahun" value="{{ $jadwal->tahun }}">
                    </div>
                </div>

                <!-- Tabel Jadwal Harian -->
                <div class="overflow-x-auto mb-6">
                    <table class="w-full border border-gray-400">
                        <thead class="bg-gray-200 dark:bg-slate-700 dark:text-gray-100">
                            <tr>
                                <th class="border border-gray-400 p-2">Tanggal</th>
                                <th class="border border-gray-400 p-2">Shift</th>
                            </tr>
                        </thead>
                        <tbody id="daysContainer">
                            @php
                                $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $jadwal->bulan, $jadwal->tahun);
                                $currentShift = $jadwal->shift;
                            @endphp
                            
                            @for($day = 1; $day <= $jadwal->getDaysInMonth(); $day++)
                                <tr>
                                    <td class="border border-gray-400 p-2 text-center dark:text-gray-200">
                                        {{ DateTime::createFromFormat('!d', $day)->format('D, d') }}
                                    </td>
                                    <td class="border border-gray-400 p-2">
                                        <select name="shift_type_{{ $day }}" class="w-full p-2 border border-gray-300 rounded day-shift-type">
                                            <option value="1" {{ $jadwal->getShiftForDay($day) == $currentShift->shift_1 ? 'selected' : '' }}>
                                                Shift 1: {{ $currentShift->shift_1 }}
                                            </option>
                                            <option value="2" {{ $jadwal->getShiftForDay($day) == $currentShift->shift_2 ? 'selected' : '' }}>
                                                Shift 2: {{ $currentShift->shift_2 }}
                                            </option>
                                        </select>
                                    </td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>

                <!-- Tombol Aksi -->
                <div class="flex justify-between">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-6 rounded-lg font-medium">
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('jadwalkaryawan.index', ['bulan' => $jadwal->bulan, 'tahun' => $jadwal->tahun]) }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 py-2 px-6 rounded-lg font-medium">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Pastikan form submit dengan data yang benar
            document.querySelector('form').addEventListener('submit', function(e) {
                const selects = document.querySelectorAll('.day-shift-type');
                selects.forEach(select => {
                    if (!select.value) {
                        e.preventDefault();
                        alert('Harap pilih shift untuk semua hari');
                        return;
                    }
                });
            });
        });
    </script>
@endsection