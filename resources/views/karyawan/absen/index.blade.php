@extends('layout3.karyawan3')
@section('content')
    <div class="p-4 md:p-6 overflow-x-hidden">
        <div class="bg-white text-gray-900 p-4 rounded-lg shadow-md">
            @if(session('success'))
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                window.onload = function() {
                    const type = "{{ session('attendance_type') }}";
                    let message = '';
                    
                    switch(type) {
                        case 'hadir': message = 'Absen hadir berhasil dicatat!'; break;
                        case 'sakit': message = 'Absen sakit berhasil dicatat!'; break;
                        case 'izin': message = 'Absen izin berhasil dicatat!'; break;
                        default: message = "{{ session('success') }}";
                    }
                    
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: message,
                        showConfirmButton: false,
                        timer: 2000
                    });
                };
            </script>
            @endif

            <!-- Google Maps -->
            <div class="mb-4">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.3048621459625!2d106.7626191737859!3d-6.608989364603464!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c5001b7efe39%3A0x911c1a77e2752ac4!2sNavisa%20Basic%20Collection!5e0!3m2!1sid!2sid!4v1740474347021!5m2!1sid!2sid"
                    class="w-full h-64 md:h-80 rounded-lg shadow" style="border:0;" allowfullscreen loading="lazy"></iframe>
            </div>

            <div id="absen-section" class="flex flex-col items-center gap-2 justify-center mb-4">
                @if(!$todayAbsen)
                    @if($currentHour >= 5)
                        <!-- Jam 05:00-23:59 dan belum absen -->
                        <div class="flex gap-2">
                            <a href="{{ route('karyawan.absen.create') }}" class="bg-green-500 text-white px-4 py-2 rounded-lg shadow">Hadir</a>
                            <a href="{{ route('karyawan.absen.sakit') }}" class="bg-red-500 text-white px-4 py-2 rounded-lg shadow hover:bg-red-600 transition-colors">Sakit</a>
                            <a href="{{ route('karyawan.absen.izin') }}" class="bg-yellow-300 text-white px-4 py-2 rounded-lg shadow">Izin</a>
                        </div>
                    @else
                        <!-- Jam 00:00-04:59 dan belum absen -->
                        <p class="text-red-600 text-center w-full">Absen hanya bisa dilakukan mulai jam 05:00 WIB</p>
                    @endif
                @else
                    <!-- Sudah absen hari ini -->
                    <p class="text-green-600 text-center w-full">Anda sudah absen hari ini</p>
                    <p class="text-center">Absen berikutnya bisa dilakukan besok jam 05:00 WIB</p>
                @endif
            </div>
            <script>
                function getWIBTime() {
                    const now = new Date();
                    return new Date(now.getTime() + (7 * 60 * 60 * 1000)); // UTC+7
                }
            
                const nowWIB = getWIBTime();
                const currentHourWIB = nowWIB.getHours();
                const isAfterMidnight = currentHourWIB >= 0 && currentHourWIB < 5;
            
                @if(!$todayAbsen)
                    // Case 1: Belum absen hari ini
                    if(isAfterMidnight) {
                        // Hitung mundur sampai jam 05:00 hari ini
                        const target = new Date(nowWIB);
                        target.setHours(5, 0, 0, 0);
                        
                        const countdown = setInterval(() => {
                            const now = getWIBTime();
                            const distance = target - now;
                            
                            if(distance <= 0) {
                                clearInterval(countdown);
                                location.reload();
                                return;
                            }
                            
                            const hours = Math.floor(distance / (1000 * 60 * 60));
                            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                            const seconds = Math.floor((distance % (1000 * 60)) / 1000);
                            
                            document.getElementById("countdown").textContent = 
                                `Absen buka dalam: ${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
                        }, 1000);
                    }
                @else
                    // Case 2: Sudah absen hari ini
                    // Hitung mundur sampai jam 05:00 besok
                    const target = new Date(nowWIB);
                    target.setDate(target.getDate() + 1);
                    target.setHours(5, 0, 0, 0);
                    
                    const countdown = setInterval(() => {
                        const now = getWIBTime();
                        const distance = target - now;
                        
                        if(distance <= 0) {
                            clearInterval(countdown);
                            location.reload();
                            return;
                        }
                        
                        const hours = Math.floor(distance / (1000 * 60 * 60));
                        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                        const seconds = Math.floor((distance % (1000 * 60)) / 1000);
                        
                        document.getElementById("countdown").textContent = 
                            `Absen berikutnya buka dalam: ${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
                    }, 1000);
                @endif
            </script>

            <!-- Tombol Riwayat Absen -->
            <div class="flex justify-center mt-4">
                <button id="toggleRiwayatAbsen" class="bg-gray-500 text-white px-4 py-2 rounded-lg shadow w-full md:w-auto">
                    Lihat Riwayat Absen
                </button>
            </div>

            <!-- Tabel Riwayat Absen (Disembunyikan Awal) -->
            <div id="riwayatAbsenTable" class="overflow-x-auto mt-4 hidden">
                <h2 class="text-center text-xl font-bold mb-4">Riwayat Absen</h2>
                <table class="w-full border border-gray-300 text-xs md:text-sm">
                    <thead class="bg-gray-200 text-gray-900">
                        <tr>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Nama Lengkap</th>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Jabatan</th>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Tanggal</th>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Status</th>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Lokasi</th>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Foto</th>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">File Surat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($absen as $item)
                            <tr>
                                <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">{{ $item->user->nama_lengkap ?? '-' }}</td>
                                <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">{{ $item->user->jabatan->nama_jabatan ?? '-' }}</td>
                                <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">
                                    <div class="flex items-center gap-1">
                                        <span class="font-medium text-gray-900">
                                            {{ \Carbon\Carbon::parse($item->tanggal_absensi)->isoFormat('D MMMM YYYY') }}
                                        </span>
                                        <span class="text-gray-400">•</span>
                                        <span class="text-gray-500">
                                            {{ \Carbon\Carbon::parse($item->tanggal_absensi)->isoFormat('HH:mm') }}
                                        </span>
                                    </div>
                                </td>
                                <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2 text-center">
                                    <span class="
                                        @if($item->status === 'hadir') bg-green-100 text-green-800 @endif
                                        @if($item->status === 'izin') bg-yellow-100 text-yellow-800 @endif
                                        @if($item->status === 'sakit') bg-red-100 text-red-800 @endif
                                        px-3 py-1 rounded-full text-sm font-medium
                                    ">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                </td>
                                <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2 text-center">
                                    @if ($item->lokasi)
                                        <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($item->lokasi) }}" 
                                           target="_blank" 
                                           class="text-blue-600 hover:text-blue-800 flex items-center justify-center space-x-2 no-underline">
                                           <i class="fa-solid fa-location-dot"></i><span>Lihat Maps</span>
                                        </a>
                                    @else
                                        <span>-</span>
                                    @endif
                                </td>
                                <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">
                                    @if ($item->foto)
                                        <a href="{{ asset($item->foto) }}" target="_blank">
                                            <img src="{{ asset($item->foto) }}" alt="Foto Absen" class="foto-absen">
                                        </a>
                                    @else
                                        <span>-</span>
                                    @endif
                                </td>
                                <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2 text-center">
                                    @if ($item->file_surat)
                                        @if(in_array($item->status, ['izin', 'sakit']))
                                            <a href="{{ asset($item->file_surat) }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                                <i class="fas fa-file-alt mr-1"></i> Open File
                                            </a>
                                        @else
                                            @php
                                                $fileExtension = pathinfo($item->file_surat, PATHINFO_EXTENSION);
                                            @endphp
                                            
                                            @if(in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif']))
                                                <a href="{{ asset($item->file_surat) }}" target="_blank">
                                                    <img src="{{ asset($item->file_surat) }}" alt="File Surat" class="file-surat">
                                                </a>
                                            @else
                                                <a href="{{ asset($item->file_surat) }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                                    <i class="fas fa-file-pdf mr-1"></i> Open File
                                                </a>
                                            @endif
                                        @endif
                                    @else
                                        <span>-</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center border border-gray-300 px-2 py-1 md:px-4 md:py-2">
                                    Tidak ada riwayat absen.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <style>
        .foto-absen {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 50%;
            cursor: pointer;
        }
        
        .file-surat {
            width: 50px;
            height: 50px;
            object-fit: cover;
            cursor: pointer;
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let button = document.getElementById("toggleRiwayatAbsen");
            let table = document.getElementById("riwayatAbsenTable");
            button.addEventListener("click", function() {
                table.classList.toggle("hidden");
            });
        });
    </script>
@endsection