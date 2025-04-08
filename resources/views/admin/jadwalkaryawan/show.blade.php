@extends('layout.main')
@section('content')
    <div class="p-4 md:p-6 overflow-x-hidden">
        <div class="bg-white rounded-lg shadow-md border border-gray-300 p-6">
            <div class="mb-4">
                <a href="{{ route('jadwalkaryawan.index', ['bulan' => $jadwal->bulan, 'tahun' => $jadwal->tahun]) }}" 
                   class="text-blue-600 hover:text-blue-800 flex items-center">
                    <i class='bx bx-arrow-back text-2xl mr-2'></i>
                </a>
            </div>

            <h1 class="text-center text-2xl font-bold text-gray-800 mb-6">Detail Jadwal Karyawan</h1>
            
            <!-- Informasi Karyawan dan Jabatan -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div class="border border-gray-300 rounded-lg p-4">
                    <label class="block text-gray-500 text-sm mb-1">Nama Karyawan</label>
                    <p class="text-lg font-medium">{{ $jadwal->user->nama_lengkap }}</p>
                </div>
                
                <div class="border border-gray-300 rounded-lg p-4">
                    <label class="block text-gray-500 text-sm mb-1">Jabatan</label>
                    <p class="text-lg font-medium">{{ $jadwal->jabatan->nama_jabatan }}</p>
                </div>
            </div>


            <!-- Informasi Periode -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div class="border border-gray-300 rounded-lg p-4 bg-gray-50">
                    <label class="block text-gray-500 text-sm mb-1">Bulan</label>
                    <p class="text-lg font-medium">
                        {{ DateTime::createFromFormat('!m', $jadwal->bulan)->format('F') }}
                    </p>
                </div>
                
                <div class="border border-gray-300 rounded-lg p-4 bg-gray-50">
                    <label class="block text-gray-500 text-sm mb-1">Tahun</label>
                    <p class="text-lg font-medium">{{ $jadwal->tahun }}</p>
                </div>
            </div>

            <!-- Tabel Jadwal Harian -->
            <div class="mb-4">
                <h2 class="text-center text-lg font-semibold text-gray-700 mb-2">Jadwal Harian</h2>
                <div class="overflow-x-auto border border-gray-300 rounded-lg">
                    <table class="w-full">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="p-3 text-left w-1/4">Tanggal</th>
                                <th class="p-3 text-left">Shift</th>
                                <th class="p-3 text-left">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @php
                                $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $jadwal->bulan, $jadwal->tahun);
                            @endphp
                            
                            @for($day = 1; $day <= $daysInMonth; $day++)
                                @php
                                    $shiftValue = $jadwal->{"day_$day"};
                                    $isDefault = $shiftValue === ($jadwal->shift_type == 1 ? $jadwal->shift->shift_1 : $jadwal->shift->shift_2);
                                @endphp
                                <tr class="hover:bg-gray-50">
                                    <td class="p-3">
                                        <span class="font-medium">
                                            {{ DateTime::createFromFormat('!d', $day)->format('D, d') }}
                                        </span>
                                    </td>
                                    <td class="p-3">
                                        {{ $shiftValue ?? '-' }}
                                    </td>
                                    <td class="p-3">
                                        @if($shiftValue)
                                            <span class="px-2 py-1 text-xs rounded-full 
                                                {{ $isDefault ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' }}">
                                                {{ $isDefault ? 'Default' : 'Custom' }}
                                            </span>
                                        @else
                                            <span class="text-gray-500">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection