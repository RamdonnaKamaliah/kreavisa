@extends('layout3.karyawan3')

@section('content')
<div class="p-4 md:p-6">

    <!-- Container Kalender -->
    <div class="bg-white p-6 rounded-xl shadow-lg border border-blue-500">
        <!-- Navigasi Bulan -->
        <div class="flex justify-between items-center mb-4">
            <button onclick="changeMonth(-1)" class="p-2 bg-gray-200 rounded-full hover:bg-gray-300">&lt;</button>
            <h3 class="text-2xl font-bold text-gray-900 text-center" id="calendarTitle"></h3>
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
        <div class="grid grid-cols-7 gap-2 text-center text-gray-700 text-lg font-medium mt-2" id="calendarDays"></div>
    </div>
</div>

<script>
    let currentMonth = new Date().getMonth();
    let currentYear = new Date().getFullYear();
    let jadwals = @json($jadwals); // Kirim semua data shift ke JavaScript

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
        let shiftText = '';

        // Cek apakah ada shift untuk hari ini
        shiftData.forEach(jadwal => {
            if (jadwal[`day_${i}`]) {
                shiftText += `<div class="bg-green-500 text-white text-xs font-bold px-2 py-1 mt-1 rounded">${jadwal[`day_${i}`]}</div>`;
            }
        });

        // Highlight hari ini
        let highlightClass = (i === today.getDate() && currentMonth === today.getMonth() && currentYear === today.getFullYear()) 
            ? "bg-blue-600 text-white font-bold px-2 rounded" 
            : "";

        calendarHTML += `
            <div class="py-2 border border-gray-300 rounded">
                <span class="${highlightClass}">${i}</span>
                ${shiftText}
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

