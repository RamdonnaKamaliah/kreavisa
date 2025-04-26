@extends('layout3.karyawan3')
@section('page-title', 'Dashboard')
@section('content')
    <div>
        <div class="flex-1 p-6 max-w-7xl mx-auto text-gray-900">
            <div class="flex flex-wrap -mx-3">

                <!-- card1 - Total Kehadiran -->
                <div class="hidden sm:block w-full max-w-full px-3 mb-6 sm:w-1/2 xl:w-1/4">
                    <div
                        class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                        <div class="flex-auto p-4 min-h-[120px]">
                            <div class="flex flex-row -mx-3">
                                <div class="flex-none w-2/3 max-w-full px-3">
                                    <div>
                                        <p
                                            class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">
                                            Total Kehadiran
                                        </p>
                                        <h5 class="mb-2 font-bold dark:text-white mt-8">{{ $totalHadir }} Hari</h5>
                                    </div>
                                </div>
                                <div class="px-3 text-right basis-1/3">
                                    <div
                                        class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-gradient-to-tl from-emerald-500 to-blue-500">
                                        <i class='bx bx-check-shield text-lg text-white'></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- card2 - Izin/Sakit -->
                <div class="hidden sm:block w-full max-w-full px-3 mb-6 sm:w-1/2 xl:w-1/4">
                    <div
                        class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                        <div class="flex-auto p-4 min-h-[120px]">
                            <div class="flex flex-row -mx-3">
                                <div class="flex-none w-2/3 max-w-full px-3">
                                    <div>
                                        <p
                                            class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">
                                            Izin / Sakit
                                        </p>
                                        <h5 class="mb-2 font-bold dark:text-white mt-8">{{ $totalIzinSakit }} Hari</h5>
                                    </div>
                                </div>
                                <div class="px-3 text-right basis-1/3">
                                    <div
                                        class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-gradient-to-tl from-rose-500 to-pink-400">
                                        <i class='bx bx-first-aid text-lg text-white'></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- card3 - Absen Hari ini -->
                <div class="hidden sm:block max-w-full px-3 mb-6 sm:w-1/2 xl:w-1/4 order-5 md:order-5">
                    <div
                        class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                        <div class="flex-auto p-4 min-h-[120px]">
                            <div class="flex flex-row -mx-3">
                                <div class="flex-none w-2/3 max-w-full px-3">
                                    <div>
                                        <p
                                            class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">
                                            Absen Hari ini
                                        </p>
                                        <h5 class="mb-2 font-bold dark:text-white mt-8">{{ ucfirst($absenHariIni) }}</h5>
                                    </div>
                                </div>
                                <div class="px-3 text-right basis-1/3">
                                    <div
                                        class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-gradient-to-tl from-orange-500 to-yellow-400">
                                        <i class='bx bx-time-five text-lg text-white'></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- card4 -->
                <div class="hidden sm:block max-w-full px-3 mb-6 sm:w-1/2 xl:w-1/4 order-6 md:order-6">
                    <div
                        class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                        <div class="flex-auto p-4 min-h-[120px]">
                            <div class="flex flex-row -mx-3">
                                <div class="flex-none w-2/3 max-w-full px-3">
                                    <div>
                                        <p
                                            class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">
                                            Cuaca hari ini
                                        </p>


                                        <!-- Informasi Cuaca di Kanan -->
                                        <div class="text-left">
                                            <p id="temperature" class="text-2xl font-semibold text-black dark:text-white">
                                                --°C
                                            </p>
                                            <p id="weatherDescription" class="mb-2 font-bold text-gray-600 dark:text-white">
                                                Memuat...</p>
                                        </div>

                                    </div>
                                </div>
                                <div
                                    class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-gradient-to-tl from-sky-500 to-slate-400  ">
                                    <img id="weatherIcon" src="" alt="Cuaca"
                                        class="w-full h-full object-contain">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        {{-- kartu ucapan --}}

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pl-6 pr-3 -mt-8">

            <div
                class="bg-gradient-to-r from-blue-100 via-white to-purple-100 dark:from-slate-800 dark:via-slate-900 dark:to-slate-800 p-8 rounded-xl shadow-lg dark:shadow-dark-xl flex items-center justify-between w-full backdrop-blur-md relative overflow-hidden order-1 md:order-1">

                <!-- Ornamen blur background -->
                <div
                    class="absolute -top-10 -left-10 w-40 h-40 bg-purple-300 dark:bg-blue-600 opacity-30 rounded-full blur-3xl">
                </div>
                <div
                    class="absolute -bottom-10 -right-10 w-40 h-40 bg-blue-300 dark:bg-blue-600 opacity-30 rounded-full blur-3xl">
                </div>

                <div class="text-left z-10">
                    <p class="text-md text-gray-500 dark:text-gray-400 font-medium">Selamat datang kembali
                        {{ auth()->user()->name }}</p>
                    <p id="greetingText"
                        class="text-2xl font-semibold font-montserrat text-gray-700 dark:text-white flex items-center gap-2">
                        <i id="greetingIcon" data-lucide="sun" class="w-6 h-6 text-yellow-500"></i>
                        <span id="greetingMessage">Selamat Pagi</span>
                    </p>
                    <p id="currentTime"
                        class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white tracking-widest drop-shadow-sm glow-text">
                        00:00 AM
                    </p>
                </div>

                <img id="bouncingImage"
                    src="{{ asset('asset-landing-page/img/Desain_tanpa_judul__5_-removebg-preview.png') }}"
                    alt="Waktu Malam" class="w-40 h-44 z-10">

                <style>
                    @keyframes bounce {

                        0%,
                        100% {
                            transform: translateY(0);
                        }

                        50% {
                            transform: translateY(-15px);
                        }
                    }

                    #bouncingImage {
                        animation: bounce 3.5s infinite ease-in-out;
                    }

                    .glow-text {
                        text-shadow: 0 0 8px rgba(255, 255, 255, 0.4);
                    }

                    #weatherDescription {
                        white-space: nowrap;
                        /* Jangan melipat */
                        overflow: hidden;
                        text-overflow: ellipsis;
                        max-width: 120px;
                    }
                </style>

                <script>
                    const updateTimeAndGreeting = () => {
                        const currentTimeElement = document.getElementById("currentTime");
                        const greetingMessageElement = document.getElementById("greetingMessage");
                        const greetingIconElement = document.getElementById("greetingIcon");

                        const now = new Date();
                        const hours = now.getHours();
                        const minutes = now.getMinutes();
                        const isAM = hours < 12;
                        const displayHour = hours % 12 || 12;
                        const displayMinutes = minutes < 10 ? `0${minutes}` : minutes;
                        const ampm = isAM ? "AM" : "PM";

                        currentTimeElement.textContent = `${displayHour}:${displayMinutes} ${ampm}`;

                        let greeting = "",
                            icon = "",
                            color = "";
                        if (hours >= 5 && hours < 12) {
                            greeting = "Selamat Pagi";
                            icon = "sun";
                            color = "text-yellow-500";
                        } else if (hours >= 12 && hours < 17) {
                            greeting = "Selamat Siang";
                            icon = "sun-medium";
                            color = "text-orange-400";
                        } else if (hours >= 17 && hours < 20) {
                            greeting = "Selamat Sore";
                            icon = "sunset";
                            color = "text-pink-500";
                        } else {
                            greeting = "Selamat Malam";
                            icon = "moon-stars";
                            color = "text-indigo-400";
                        }

                        greetingMessageElement.textContent = greeting;
                        greetingIconElement.setAttribute("data-lucide", icon);
                        greetingIconElement.className = `w-6 h-6 ${color}`;
                        lucide.createIcons(); // refresh icon
                    };

                    setInterval(updateTimeAndGreeting, 1000);
                    updateTimeAndGreeting();
                </script>
            </div>



            <!-- Kotak Calender -->
            <div class="relative w-full max-w-3xl mx-auto order-2 md:order-2">
                <!-- Ornamen blur background -->
                <div
                    class="absolute -top-10 -left-10 w-40 h-40 bg-purple-300 dark:bg-blue-600 opacity-30 rounded-full blur-3xl z-0">
                </div>
                <div
                    class="absolute -bottom-10 -right-10 w-40 h-40 bg-blue-300 dark:bg-blue-600 opacity-30 rounded-full blur-3xl z-0">
                </div>

                <!-- Kalender dengan background -->
                <div
                    class="relative bg-gray-50 dark:bg-slate-850 dark:shadow-dark-xl p-8 rounded-2xl shadow-blue-400 w-full space-y-6 z-10">

                    <!-- Header Bulan -->
                    <div class="flex items-center justify-center gap-4">
                        <button id="prevWeek"
                            class="p-2 rounded-full bg-gray-100 dark:bg-slate-700 hover:bg-gray-200 dark:hover:bg-slate-600 transition text-black dark:text-white">
                            <i data-lucide="chevron-left" class="w-5 h-5"></i>
                        </button>
                        <h3 class="text-black dark:text-white font-bold text-lg tracking-widest" id="calendarTitle">April
                            2025
                        </h3>
                        <button id="nextWeek"
                            class="p-2 rounded-full bg-gray-100 dark:bg-slate-700 hover:bg-gray-200 dark:hover:bg-slate-600 transition text-black dark:text-white">
                            <i data-lucide="chevron-right" class="w-5 h-5"></i>
                        </button>
                    </div>

                    <!-- Weekly Calendar -->
                    <div id="weeklyCalendar" class="grid grid-cols-5 gap-4">
                        <!-- JS render -->
                    </div>

                    <!-- Informasi tambahan -->
                    <div
                        class="mt-6 rounded-xl p-4 bg-gradient-to-r from-blue-100 to-purple-200 dark:from-slate-700 dark:to-slate-800 text-center shadow-inner">
                        <p class="text-gray-800 dark:text-white text-base mb-1 font-medium">
                            Total Hari Kerja Minggu Ini: <span class="font-bold text-indigo-600 dark:text-indigo-400">5
                                Hari</span>
                        </p>
                        <p class="text-sm text-gray-500 dark:text-gray-300 italic">
                            “Tetap semangat dan jangan lupa istirahat yang cukup 💪”
                        </p>
                    </div>

                </div>
            </div>


        </div>
        <div id="riwayatAbsenTable"
            class="max-w-[1020px] mx-auto px-4 py-5 bg-white dark:bg-[#1f1f1f] mt-6 rounded-xl shadow-md overflow-x-auto">
            <h2 class="text-center text-xl font-semibold mb-4">Riwayat Absen Saya</h2>
            <table class="w-full text-sm text-left">
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
                                        'hadir' => 'bg-green-100 text-green-700',
                                        'izin' => 'bg-yellow-100 text-yellow-700',
                                        'sakit' => 'bg-red-100 text-red-700',
                                        default => 'bg-gray-200 text-gray-600',
                                    };
                                @endphp
                                <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $badgeColor }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>
                            <td class="py-3 text-#15803D
">
                                @if ($item->lokasi)
                                    <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($item->lokasi) }}"
                                        target="_blank" class="hover:underline">Lihat Maps</a>
                                @else
                                    -
                                @endif
                            </td>
                            <td class="py-3">
                                @if ($item->foto)
                                    <a href="{{ asset($item->foto) }}" target="_blank">
                                        <img src="{{ asset($item->foto) }}" alt="Foto Absen"
                                            class="w-10 h-10 object-cover rounded-lg">
                                    </a>
                                @else
                                    -
                                @endif
                            </td>
                            <td class="py-3">
                                @if ($item->file_surat)
                                    @php
                                        $ext = pathinfo($item->file_surat, PATHINFO_EXTENSION);
                                        $isImage = in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'gif', 'webp']);
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
                                                class="text-blue-600 hover:underline">
                                                Open File
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
                        <tr>
                            <td colspan="5" class="py-4 text-center text-gray-500">Tidak ada riwayat absen.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <style>
            #riwayatAbsenTable {
                background-color: #ffffff;
                box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1),
                    0 4px 6px -4px rgba(0, 0, 0, 0.1);
                /* Shadow-xl */
                transition: background-color 0.3s ease, box-shadow 0.3s ease;
                border-radius: 12px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
                overflow-x: auto;
                padding: 16px;
                transition: background-color 0.3s ease;
            }

            h2 {
                color: #000
            }

            /* Dark mode */
            .dark #riwayatAbsenTable {
                background-color: #1e293b;
                /* slate-850 ≈ #1e293b */
                box-shadow: 0 20px 27px 0 rgba(0, 0, 0, 0.05);
            }

            table {
                font-size: 12px;
                width: 100%;
            }

            th,
            td {
                padding: 8px 10px !important;
            }

            .dark h2 {
                color: #f0f0f0
            }

            thead th {
                color: #4b5563;
            }

            .dark thead th {
                color: #d1d5db;
                border-bottom: 1px solid #374151;
            }

            tbody td {
                color: #1f2937;
            }

            .dark tbody td {
                color: #e5e7eb;
                border-color: #2a2a2a;
            }

            tr td:first-child {
                border-top-left-radius: 8px;
                border-bottom-left-radius: 8px;
            }

            tr td:last-child {
                border-top-right-radius: 8px;
                border-bottom-right-radius: 8px;
            }

            .status-badge {
                padding: 6px 12px;
                border-radius: 9999px;
                font-weight: 600;
                font-size: 12px;
                display: inline-block;
            }

            /* Background badge */
            .bg-green {
                background-color: #e6f4ea;
                color: #2e7d32;
            }

            .dark .bg-green {
                background-color: #264d3b;
                color: #a6e9c1;
            }

            .bg-yellow {
                background-color: #fff9e6;
                color: #f9a825;
            }

            .dark .bg-yellow {
                background-color: #4b3c1c;
                color: #ffe082;
            }

            .bg-red {
                background-color: #fdecea;
                color: #c62828;
            }

            .dark .bg-red {
                background-color: #4a1d1d;
                color: #ef9a9a;
            }

            .bg-gray {
                background-color: #f0f0f0;
                color: #555;
            }

            .dark .bg-gray {
                background-color: #2d2d2d;
                color: #a1a1a1;
            }

            .foto-absen,
            .file-surat {
                width: 40px;
                height: 40px;
                object-fit: cover;
                border-radius: 8px;
                cursor: pointer;
            }

            a {
                color: #007bff;
                text-decoration: none;
            }

            a:hover {
                text-decoration: underline;
            }

            .dark a {
                color: #60a5fa;
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
    </div>



    <!-- Footer -->

    </div>


    {{-- 
    // Fungsi untuk menampilkan kalender bulan saat ini --}}
    <script>
        const weeklyCalendar = document.getElementById('weeklyCalendar');
        const calendarTitle = document.getElementById('calendarTitle');
        const prevWeekBtn = document.getElementById('prevWeek');
        const nextWeekBtn = document.getElementById('nextWeek');

        let currentDate = new Date();

        function getStartOfWeek(date) {
            const day = date.getDay();
            const diff = date.getDate() - (day === 0 ? 6 : day - 1); // Mulai Senin
            return new Date(date.setDate(diff));
        }

        function renderWeek() {
            weeklyCalendar.innerHTML = "";

            const startOfWeek = getStartOfWeek(new Date(currentDate));
            const today = new Date();

            for (let i = 0; i < 5; i++) {
                const day = new Date(startOfWeek);
                day.setDate(startOfWeek.getDate() + i);

                const isToday = day.toDateString() === today.toDateString();

                const dayBox = document.createElement("div");
                dayBox.className = `
  flex flex-col items-center justify-center
  p-4 rounded-xl border border-gray-200 dark:border-slate-700
  bg-white/60 dark:bg-slate-800/60 backdrop-blur-md
  text-gray-800 dark:text-white
  shadow-sm hover:shadow-md transition
  ${isToday ? 'ring-2 ring-blue-500 dark:ring-blue-400 shadow-lg' : ''}
`;


                const dayName = day.toLocaleDateString("id-ID", {
                    weekday: 'short'
                });
                const dayNum = day.getDate();

                dayBox.innerHTML = `
                <span class="text-sm text-gray-500 dark:text-gray-300">${dayName}</span>
                <span class="text-xl font-semibold">${dayNum}</span>
            `;

                weeklyCalendar.appendChild(dayBox);
            }

            calendarTitle.textContent = startOfWeek.toLocaleDateString('id-ID', {
                month: 'long',
                year: 'numeric'
            });
            lucide.createIcons();
        }

        prevWeekBtn.addEventListener("click", () => {
            currentDate.setDate(currentDate.getDate() - 7);
            renderWeek();
        });

        nextWeekBtn.addEventListener("click", () => {
            currentDate.setDate(currentDate.getDate() + 7);
            renderWeek();
        });

        renderWeek();



        async function getWeather() {
            const apiKey = 'a48b67fe40c192a0bcfb78d6c6ee4951'; // 🔹 GANTI dengan API Key OpenWeather
            const city = 'bogor'; // 🔹 Bisa diganti dengan kota lain
            const url =
                `https://api.openweathermap.org/data/2.5/weather?q=${city}&units=metric&lang=id&appid=${apiKey}`;

            try {
                const response = await fetch(url);
                const data = await response.json();

                // 🔹 Set suhu
                document.getElementById('temperature').textContent = `${Math.round(data.main.temp)}°C`;

                // 🔹 Set deskripsi cuaca
                document.getElementById('weatherDescription').textContent = data.weather[0].description;

                // 🔹 Set gambar cuaca
                const iconCode = data.weather[0].icon;
                document.getElementById('weatherIcon').src = `https://openweathermap.org/img/wn/${iconCode}@2x.png`;

            } catch (error) {
                console.error('Error fetching weather data:', error);
                document.getElementById('weatherDescription').textContent = 'Gagal memuat cuaca';
            }
        }

        getWeather();
    </script>
@endsection
