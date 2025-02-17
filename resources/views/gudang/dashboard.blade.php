<x-layout-gudang>
    <div class="flex-1 p-6 md:pl-64">

        <!-- Header -->
        <div class="mb-8 text-center md:text-left">
            <h1 class="text-4xl font-bold text-white font-protest">Hai, Ramdona 👋</h1>
            <p class="text-lg text-gray-300 font-popins">Selamat datang di platform digital management karyawan</p>
        </div>

        <!-- Grid utama: 1 kolom di mobile, 2 kolom di desktop -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Kotak Absensi -->
            <div class="bg-[#191E24] p-6 rounded-xl shadow-lg border border-gray-600 transition hover:scale-105 Z-10">
                <p class="text-gray-300 text-lg mb-3">Anda belum melakukan absensi...</p>
                <button
                    class="flex items-center justify-between w-full px-4 py-3 bg-white text-black rounded-lg font-semibold">
                    Lakukan absensi
                    <i data-feather="arrow-right-circle"></i>
                </button>
            </div>

            <!-- Kotak Kalender -->
            <div
                class="bg-[#191E24] p-6 rounded-xl shadow-lg border border-gray-600 transition hover:scale-105 relative z-10">
                <h3 class="text-xl font-semibold mb-4 text-white text-center" id="calendarTitle"></h3>
                <div class="grid grid-cols-7 gap-2 text-center text-gray-300 text-lg" id="calendarDays"></div>
            </div>

            <!-- Kotak Waktu -->
            <div
                class="bg-[#191E24] p-6 rounded-xl shadow-lg border border-gray-600 flex flex-col items-center justify-center transition hover:scale-105">
                <i data-feather="clock" class="text-gray-400 text-4xl mb-3"></i>
                <p class="text-gray-300 text-lg">Waktu saat ini:</p>
                <p class="text-3xl font-bold text-white" id="currentTime">00:00</p>
            </div>

            <!-- Kotak Jabatan -->
            <div
                class="bg-[#191E24] p-6 rounded-xl shadow-lg border border-gray-600 flex flex-col items-center justify-center transition hover:scale-105">
                <i data-feather="briefcase" class="text-gray-400 text-4xl mb-3"></i>
                <p class="text-gray-300 text-lg">Jabatan Anda:</p>
                <p class="text-2xl font-bold text-white">Packing</p>
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
                second: '2-digit'
            });
        }
        setInterval(updateTime, 1000);
        updateTime();

        // Fungsi untuk menampilkan kalender bulan saat ini
        function updateCalendar() {
            const now = new Date();
            const monthNames = [
                "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli",
                "Agustus", "September", "Oktober", "November", "Desember"
            ];
            const daysInMonth = new Date(now.getFullYear(), now.getMonth() + 1, 0).getDate();
            const firstDay = new Date(now.getFullYear(), now.getMonth(), 1).getDay();

            document.getElementById('calendarTitle').textContent = monthNames[now.getMonth()] + " " + now.getFullYear();

            let calendarHTML =
                "<span>Mo</span> <span>Tu</span> <span>We</span> <span>Th</span> <span>Fr</span> <span>Sa</span> <span>Su</span>";

            // Tambahkan spasi kosong sebelum tanggal 1
            for (let i = 0; i < (firstDay === 0 ? 6 : firstDay - 1); i++) {
                calendarHTML += "<span></span>";
            }

            // Tambahkan tanggal
            for (let i = 1; i <= daysInMonth; i++) {
                if (i === now.getDate()) {
                    calendarHTML += `<span class="bg-white text-black px-3 py-1 rounded-md font-bold">${i}</span>`;
                } else {
                    calendarHTML += `<span class="text-gray-400">${i}</span>`;
                }
            }

            document.getElementById('calendarDays').innerHTML = calendarHTML;
        }

        updateCalendar();
    </script>
</x-layout-gudang>
