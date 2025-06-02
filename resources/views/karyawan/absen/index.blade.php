@extends('layout3.karyawan3')
@section('page-title', 'Absensi')
@section('content')
    <div class="p-4 md:p-6 overflow-x-hidden mt-6">
        <div class="bg-white dark:bg-slate-850 dark:shadow-dark-xl text-gray-900 p-4 rounded-lg shadow-md">
            <!-- Notifikasi akan muncul di sini -->
            @if (session('success'))
                <div id="success-notification" class="mb-4">
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 dark:bg-green-800 dark:border-green-600 dark:text-green-100"
                        role="alert">
                        <div class="flex justify-between items-center">
                            <div>
                                @php
                                    $type = session('attendance_type');
                                    $userName = session('user_name');
                                    $message = '';

                                    switch ($type) {
                                        case 'hadir':
                                            $message = "$userName, absen hadir berhasil dicatat!";
                                            break;
                                        case 'sakit':
                                            $message = "$userName, absen sakit berhasil dicatat!";
                                            break;
                                        case 'izin':
                                            $message = "$userName, absen izin berhasil dicatat!";
                                            break;
                                        default:
                                            $message = session('message');
                                    }
                                @endphp
                                <p class="font-bold">Berhasil</p>
                                <p>{{ $message }}</p>
                            </div>
                            <button onclick="document.getElementById('success-notification').remove()"
                                class="text-green-700 dark:text-green-200 hover:text-green-900">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Dropdown Pilihan -->
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-4">
                    <label for="tableSelect" class="text-gray-700 dark:text-gray-300 text-lg">Pilih:</label>
                    <select id="tableSelect"
                        class="p-2 border border-gray-400 rounded-md w-64 dark:bg-gray-700 dark:text-white">
                        <option value="absenForm">Melakukan Absen</option>
                        <option value="riwayatAbsen">Riwayat Absen</option>
                    </select>
                </div>
            </div>

            <!-- Container untuk Form Absen -->
            <div id="absenFormContainer">
                <!-- Google Maps -->
                <div class="mb-4">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.3048621459625!2d106.7626191737859!3d-6.608989364603464!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c5001b7efe39%3A0x911c1a77e2752ac4!2sNavisa%20Basic%20Collection!5e0!3m2!1sid!2sid!4v1740474347021!5m2!1sid!2sid"
                        class="w-full h-64 md:h-80 rounded-lg shadow" style="border:0;" allowfullscreen
                        loading="lazy"></iframe>
                </div>

                <div id="absen-section" class="flex flex-col items-center gap-6 justify-center mb-8">
                    @if ($showAbsenButton)
                        <div class="flex flex-wrap justify-center gap-4">
                            <a href="{{ route('karyawan.absen.create') }}"
                                class="flex items-center gap-2 bg-green-500 hover:bg-green-600 text-white font-semibold px-6 py-3 rounded-full shadow-md transform transition-all hover:scale-105">
                                <span class="iconify w-6 h-6" data-icon="majesticons:camera-line" data-inline="false"></span>
                                Hadir
                            </a>
                            <a href="{{ route('karyawan.absen.sakit') }}"
                                class="flex items-center gap-2 bg-red-500 hover:bg-red-600 text-white font-semibold px-6 py-3 rounded-full shadow-md transform transition-all hover:scale-105">
                                <span class="iconify w-6 h-6" data-icon="material-symbols-light:sick-outline" data-inline="false"></span>
                                Sakit
                            </a>
                            <a href="{{ route('karyawan.absen.izin') }}"
                                class="flex items-center gap-2 bg-yellow-400 hover:bg-yellow-500 text-white font-semibold px-6 py-3 rounded-full shadow-md transform transition-all hover:scale-105">
                                <span class="iconify w-6 h-6" data-icon="mdi:calendar-clock" data-inline="false"></span>
                                Izin
                            </a>
                        </div>
                        <p class="text-gray-600 text-sm mt-4 dark:text-gray-400">Absen hanya bisa dilakukan sebelum jam
                            00:00 WIB</p>
                    @else
                        <div class="text-center">
                            <p class="text-green-600 font-semibold text-lg dark:text-green-400">Anda sudah absen hari ini
                            </p>
                            <p class="text-gray-600 dark:text-gray-400">Absen berikutnya bisa dilakukan besok</p>
                        </div>
                    @endif
                </div>

            </div>

            <!-- Container untuk Riwayat Absen (Awalnya Disembunyikan) -->
            <div id="riwayatAbsenContainer" class="hidden">
                <div
                    class="dark:text-white max-w-[1020px] mx-auto px-4 py-5 bg-white dark:bg-[#1f1f1f] mt-6 rounded-xl shadow-md overflow-x-auto">
                    <h2 class="text-center text-xl font-semibold mb-4 dark:text-white">Riwayat Absen Saya</h2>
                    <table id="myTable" class="w-full text-sm text-left">
                        <thead>
                            <tr
                                class="text-gray-600 dark:text-gray-300 uppercase text-xs border-b border-gray-200 dark:border-gray-700">
                                <th class="py-3">Tanggal</th>
                                <th class="py-3">Status</th>
                                <th class="py-3">Lokasi</th>
                                <th class="py-3">Foto</th>
                                <th class="py-3">File Surat</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-800 dark:text-gray-200">
                            @forelse($absen as $item)
                                <tr
                                    class="border-b border-gray-100 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-[#2a2a2a] transition">
                                    <td class="py-3">
                                        {{ \Carbon\Carbon::parse($item->tanggal_absensi)->isoFormat('D MMM YYYY • HH:mm') }}
                                    </td>
                                    <td class="py-3">
                                        @php
                                            $badgeColor = match ($item->status) {
                                                'hadir'
                                                    => 'bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-200',
                                                'izin'
                                                    => 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900 dark:text-yellow-200',
                                                'sakit' => 'bg-red-100 text-red-700 dark:bg-red-900 dark:text-red-200',
                                                default
                                                    => 'bg-gray-200 text-gray-600 dark:bg-gray-600 dark:text-gray-200',
                                            };
                                        @endphp
                                        <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $badgeColor }}">
                                            {{ ucfirst($item->status) }}
                                        </span>
                                    </td>
                                    <td class="py-3 text-blue-600 dark:text-blue-400">
                                        @if ($item->lokasi)
                                            <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($item->lokasi) }}"
                                                target="_blank" class="hover:underline"><i class="fa-solid fa-location-dot"></i><span> Lihat Maps</span></a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="py-3 text-center">
                                        @if (!empty($item->foto) && file_exists(public_path($item->foto)))
                                            <a href="{{ asset($item->foto) }}" target="_blank">
                                                <img src="{{ asset($item->foto) }}" alt="Foto Absen"
                                                    class="w-10 h-10 object-cover rounded-lg mx-auto">
                                            </a>
                                        @else
                                            <span class="text-gray-500">-</span>
                                        @endif
                                    </td>
                                    <td class="py-3">
                                        @if ($item->file_surat)
                                            @php
                                                $ext = pathinfo($item->file_surat, PATHINFO_EXTENSION);
                                                $isImage = in_array(strtolower($ext), [
                                                    'jpg',
                                                    'jpeg',
                                                    'png',
                                                    'gif',
                                                    'webp',
                                                ]);
                                                $filePath = public_path($item->file_surat);
                                            @endphp
                                            @if (file_exists($filePath))
                                                @if ($isImage)
                                                    <a href="{{ asset($item->file_surat) }}" target="_blank">
                                                        <img src="{{ asset($item->file_surat) }}"
                                                            class="w-10 h-10 object-cover rounded-lg" alt="File Surat">
                                                    </a>
                                                @else
                                                    <a href="{{ asset($item->file_surat) }}" target="_blank"
                                                        class="text-blue-600 hover:underline dark:text-blue-400">
                                                        <i class="fas fa-file-alt mr-1"></i> Open File
                                                    </a>
                                                @endif
                                            @else
                                                -
                                            @endif
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                            @empty
                    
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const tableSelect = document.getElementById('tableSelect');
            const absenFormContainer = document.getElementById('absenFormContainer');
            const riwayatAbsenContainer = document.getElementById('riwayatAbsenContainer');

            // Toggle tampilan berdasarkan dropdown
            tableSelect.addEventListener('change', function() {
                if (this.value === 'absenForm') {
                    absenFormContainer.classList.remove('hidden');
                    riwayatAbsenContainer.classList.add('hidden');
                } else {
                    absenFormContainer.classList.add('hidden');
                    riwayatAbsenContainer.classList.remove('hidden');
                }
            });

            // Jika ada parameter hash di URL (misal: #riwayatAbsen)
            if (window.location.hash === '#riwayatAbsen') {
                tableSelect.value = 'riwayatAbsen';
                absenFormContainer.classList.add('hidden');
                riwayatAbsenContainer.classList.remove('hidden');
            }
        });
    </script>
@endsection
