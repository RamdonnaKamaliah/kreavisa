@extends('layout3.karyawan3')
@section('page-title', 'Jadwal Kerja')
@section('content')
    <div class="p-4 md:p-6 mt-10">

        <!-- Container Kalender -->
        <div class="bg-white dark:bg-slate-850 dark:shadow-dark-xl p-6 rounded-xl shadow-lg border border-blue-500">
            <!-- Navigasi Bulan -->
            <div class="flex justify-between items-center mb-4">
                <button onclick="changeMonth(-1)" class="p-2 bg-gray-200 rounded-full hover:bg-gray-300">&lt;</button>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white text-center" id="calendarTitle"></h3>
                <button onclick="changeMonth(1)" class="p-2 bg-gray-200 rounded-full hover:bg-gray-300">&gt;</button>
            </div>

            <!-- Grid Header Hari -->
            <div class="grid grid-cols-7 gap-2 text-center text-gray-700 text-lg font-medium border-t border-gray-400">
                <span class="font-bold text-blue-600 border-b border-gray-400 py-2">SEN</span>
                <span class="font-bold text-blue-600 border-b border-gray-400 py-2">SEL</span>
                <span class="font-bold text-blue-600 border-b border-gray-400 py-2">RAB</span>
                <span class="font-bold text-blue-600 border-b border-gray-400 py-2">KAM</span>
                <span class="font-bold text-blue-600 border-b border-gray-400 py-2">JUM</span>
                <span class="font-bold text-red-500 border-b border-gray-400 py-2">SAB</span>
                <span class="font-bold text-red-500 border-b border-gray-400 py-2">MIN</span>
            </div>

            <!-- Grid Kalender -->
            <div class="grid grid-cols-7 gap-2 text-center text-gray-700 dark:text-white text-lg font-medium mt-2" id="calendarDays"></div>
            
            <!-- Legend -->
            <div class="flex justify-center mt-4 space-x-4">
                <div class="flex items-center">
                    <div class="w-4 h-4 bg-blue-500 rounded mr-2"></div>
                    <span class="text-sm">Shift 1</span>
                </div>
                <div class="flex items-center">
                    <div class="w-4 h-4 bg-green-500 rounded mr-2"></div>
                    <span class="text-sm">Shift 2</span>
                </div>
                <div class="flex items-center">
                    <div class="w-4 h-4 bg-red-500 rounded mr-2"></div>
                    <span class="text-sm">Libur</span>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentMonth = new Date().getMonth();
        let currentYear = new Date().getFullYear();
        let jadwals = @json($jadwals);
        let shifts = @json($shifts); // Pastikan mengirim data shifts dari controller

        function updateCalendar() {
            const monthNames = [
                "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli",
                "Agustus", "September", "Oktober", "November", "Desember"
            ];
            const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();
            const firstDay = new Date(currentYear, currentMonth, 1).getDay();

            document.getElementById('calendarTitle').textContent = `${monthNames[currentMonth]} ${currentYear}`;

            let calendarHTML = '';

            // Cari semua jadwal yang cocok dengan bulan & tahun yang dipilih
            let shiftData = jadwals.filter(jadwal =>
                jadwal.bulan == currentMonth + 1 && jadwal.tahun == currentYear
            );

            // Tambahkan spasi kosong sebelum tanggal 1
            for (let i = 0; i < (firstDay === 0 ? 6 : firstDay - 1); i++) {
                calendarHTML += `<span class="py-2"></span>`;
            }

            // Tambahkan tanggal
            const today = new Date();
            for (let i = 1; i <= daysInMonth; i++) {
                const currentDate = new Date(currentYear, currentMonth, i);
                const isSunday = currentDate.getDay() === 0;
                
                let shiftText = '';
                let dayClass = 'py-2 border border-gray-300 rounded min-h-[80px] flex flex-col';
                let highlightClass = '';

                // Highlight hari ini
                if (i === today.getDate() && currentMonth === today.getMonth() && currentYear === today.getFullYear()) {
                    highlightClass = "bg-blue-600 text-white font-bold px-2 rounded";
                }

                // Cek apakah hari Minggu
                if (isSunday) {
                    shiftText = '<div class="mt-auto bg-red-500 text-white text-xs font-bold px-1 py-0.5 rounded self-center">Libur</div>';
                }

                // Cek apakah ada shift untuk hari ini
    shiftData.forEach(jadwal => {
        if (jadwal[`day_${i}`] && !isSunday) {
            // Cari data shift yang sesuai
            const shift = shifts.find(s => s.id == jadwal.shift_id);
            
            if (shift) {
                // Bandingkan jam kerja dengan shift_1 dan shift_2
                if (jadwal[`day_${i}`] === shift.shift_1) {
                    bgColor = 'bg-blue-600'; // Shift 1
                } else if (jadwal[`day_${i}`] === shift.shift_2) {
                    bgColor = 'bg-green-600'; // Shift 2
                }
            }
            
            shiftText +=
                `<div class="mt-1 ${bgColor} text-white text-xs font-bold px-2 py-1 rounded">${jadwal[`day_${i}`]}</div>`;
        }
    });

                calendarHTML += `
                    <div class="${dayClass}">
                        <span class="${highlightClass}">${i}</span>
                        <div class="flex flex-col mt-1">
                            ${shiftText}
                        </div>
                    </div>`;
            }

            document.getElementById('calendarDays').innerHTML = calendarHTML;
        }

        function changeMonth(step) {
            currentMonth += step;
            if (currentMonth < 0) {
                currentMonth = 11;
                currentYear--;
            } else if (currentMonth > 11) {
                currentMonth = 0;
                currentYear++;
            }
            updateCalendar();
        }

        updateCalendar();
    </script>
@endsection