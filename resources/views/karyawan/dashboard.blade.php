@extends('layout3.karyawan3')
@section('content')
    <div class="flex-1 p-6 text-gray-900">

        <!-- Grid utama -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Kotak Waktu & Sapaan dengan Gambar -->
            <div class="bg-gray-50 p-8 rounded-xl shadow-lg flex items-center justify-between w-full border border-gray-100">
                <div class="text-left">
                    <p class="text-2xl font-montserrat text-gray-600 mb-10">Selamat Malam, {{ auth()->user()->name }}</p>
                    <p class="text-3xl font-bold text-gray-900 tracking-widest" id="currentTime">
                        00:00 AM
                    </p>
                </div>
                <img src="{{ asset('asset-landing-page/img/Desain_tanpa_judul__5_-removebg-preview.png') }}" alt="Waktu Malam"
                    class="w-40 h-44">
            </div>

            <!-- Kotak Cuaca -->
            <div id="weatherBox"
            class="bg-white p-6 rounded-xl shadow-lg flex items-center gap-4 w-full text-gray-900">
            <!-- Gambar Cuaca di Kiri -->
            <img id="weatherIcon" src="" alt="Cuaca" class="w-20 h-20">
        
            <!-- Informasi Cuaca di Kanan -->
            <div class="text-left">
                <p id="temperature" class="text-4xl font-bold">--°C</p>
                <p id="weatherDescription" class="text-lg text-gray-600">Memuat...</p>
            </div>
        </div>
        

        </div>

        <!-- Grid kedua: 3 kolom -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">

            <!-- Kotak Kalender -->
            <div class="bg-white p-6 rounded-xl shadow-lg text-center">
                <h3 class="text-xl font-semibold mb-4 text-gray-900" id="calendarTitle"></h3>
                <div class="grid grid-cols-7 gap-2 text-gray-700 text-lg" id="calendarDays"></div>
            </div>

            <!-- Kotak Absensi -->
            <div class="bg-white p-6 rounded-xl shadow-lg flex flex-col items-center text-center">
                <i data-feather="clock" class="text-blue-500 text-4xl mb-3"></i>
                <p class="text-lg text-gray-600">Ayo Absen!</p>
                <button class="px-6 py-3 bg-gray-900 text-white rounded-lg font-semibold mt-3">
                    Klik Untuk Absen
                </button>
            </div>

            <!-- Kotak Motivasi -->
            <div class="bg-white p-6 rounded-xl shadow-lg flex flex-col items-center text-center">
                <i data-feather="briefcase" class="text-gray-500 text-4xl mb-3"></i>
                <p class="text-lg text-gray-600">Work Hard!</p>
            </div>

        </div>

        <!-- Footer -->
        <p class="mt-8 text-gray-500 text-center text-lg">CopyRight@Kreavisa</p>

    </div>

    <script>
        feather.replace();

        // Update waktu real-time
        function updateTime() {
            const now = new Date();
            document.getElementById('currentTime').textContent = now.toLocaleTimeString('id-ID', {
                hour: '2-digit',
                minute: '2-digit',
            }).replace('.', ':'); // Ubah titik ke format jam Indonesia (ex: 10:30 AM)
        }
        setInterval(updateTime, 1000);
        updateTime();

        // Fungsi untuk menampilkan kalender bulan saat ini
        function updateCalendar() {
            const now = new Date();
            const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September",
                "Oktober", "November", "Desember"
            ];
            const daysInMonth = new Date(now.getFullYear(), now.getMonth() + 1, 0).getDate();
            const firstDay = new Date(now.getFullYear(), now.getMonth(), 1).getDay();

            document.getElementById('calendarTitle').textContent = monthNames[now.getMonth()] + " " + now.getFullYear();

            let calendarHTML =
                "<span>Mo</span> <span>Tu</span> <span>We</span> <span>Th</span> <span>Fr</span> <span>Sa</span> <span>Su</span>";

            for (let i = 0; i < (firstDay === 0 ? 6 : firstDay - 1); i++) {
                calendarHTML += "<span></span>";
            }

            for (let i = 1; i <= daysInMonth; i++) {
                if (i === now.getDate()) {
                    calendarHTML += `<span class="bg-gray-900 text-white px-3 py-1 rounded-md font-bold">${i}</span>`;
                } else {
                    calendarHTML += `<span class="text-gray-700">${i}</span>`;
                }
            }

            document.getElementById('calendarDays').innerHTML = calendarHTML;
        }

        updateCalendar();

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
