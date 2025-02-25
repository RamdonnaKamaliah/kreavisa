@extends('layout2.karyawan')
@section('content')
    <div class="flex-1 p-6 text-gray-900">

        <!-- Grid utama: 1 kolom di mobile, 2 kolom di desktop -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Kotak Absensi -->
            <div
                class="bg-gray-100 p-6 rounded-xl shadow-lg border-l-4	border-blue-600 border-blue-600 transition hover:scale-105">
                <p class="text-gray-700 text-lg mb-3">Anda belum melakukan absensi...</p>
                <button
                    class="flex items-center justify-between w-full px-4 py-3 bg-gray-900 text-white rounded-lg font-semibold">
                    Lakukan absensi
                    <i data-feather="arrow-right-circle"></i>
                </button>
            </div>

            <!-- Kotak Kalender -->
            <div
                class="bg-gray-100 p-6 rounded-xl shadow-lg border-l-4	border-blue-600 border-pink-500 transition hover:scale-105 relative">
                <h3 class="text-xl font-semibold mb-4 text-gray-900 text-center" id="calendarTitle"></h3>
                <div class="grid grid-cols-7 gap-2 text-center text-gray-700 text-lg" id="calendarDays"></div>
            </div>

            <!-- Kotak Waktu -->
            <div
                class="bg-gray-100 p-6 rounded-xl shadow-lg border-l-4	border-blue-600 border-yellow-300 flex flex-col items-center justify-center transition hover:scale-105">
                <i data-feather="clock" class="text-gray-500 text-4xl mb-3"></i>
                <p class="text-gray-700 text-lg">Waktu saat ini:</p>
                <p class="text-3xl font-bold text-gray-900" id="currentTime">00:00</p>
            </div>

            <!-- Kotak Jabatan -->
            <div
                class="bg-gray-100 p-6 rounded-xl shadow-lg border-l-4	border-blue-600 border-orange-500 flex flex-col items-center justify-center transition hover:scale-105">
                <i data-feather="briefcase" class="text-gray-500 text-4xl mb-3"></i>
                <p class="text-gray-700 text-lg">Jabatan Anda:</p>
                <p class="text-2xl font-bold text-gray-900">{{ auth()->user()->name }}</p>
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
                    calendarHTML += `<span class="bg-gray-900 text-white px-3 py-1 rounded-md font-bold">${i}</span>`;
                } else {
                    calendarHTML += `<span class="text-gray-700">${i}</span>`;
                }
            }

            document.getElementById('calendarDays').innerHTML = calendarHTML;
        }

        updateCalendar();
    </script>
@endsection
