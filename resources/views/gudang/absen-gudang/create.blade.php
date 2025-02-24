@push('page-title')
    Absen Karyawan
@endpush
<x-layout-gudang>
    <section class="flex items-center justify-center min-h-screen md:ml-24 ">
        <div class="bg-gray-800 text-white p-12 rounded-2xl shadow-lg text-center w-[500px]">
            <h2 class="text-2xl font-bold">Anda Sudah Melakukan Absensi Hari Ini</h2>
            <div class="my-6 flex justify-center">
                <img src="{{ asset('asset-landing-page/img/gambar-sudah-absen.png') }}" alt="Absensi"
                    class="w-40 h-40 sm:w-32 sm:h-32 md:w-36 md:h-36 lg:w-40 lg:h-40 rounded-full">

            </div>
            <p class="text-gray-300">Hitung Mundur Absensi berikutnya :</p>
            <p id="countdown" class="text-3xl font-bold mt-2">06:00:00 Wib</p>
            <div class="mt-6 flex justify-center">
                <a href="#"
                    class="px-6 py-3 bg-gray-700 hover:bg-gray-600 rounded-xl flex items-center justify-center gap-2">
                    Rekap Absensimu ➝
                </a>


            </div>
        </div>
    </section>
    <script>
        function updateCountdown() {
            const now = new Date();
            const nextAbsensi = new Date();
            nextAbsensi.setHours(8, 0, 0, 0);
            if (now.getHours() >= 8) {
                nextAbsensi.setDate(nextAbsensi.getDate() + 1);
            }
            const diff = nextAbsensi - now;
            const hours = String(Math.floor((diff / (1000 * 60 * 60)) % 24)).padStart(2, '0');
            const minutes = String(Math.floor((diff / (1000 * 60)) % 60)).padStart(2, '0');
            const seconds = String(Math.floor((diff / 1000) % 60)).padStart(2, '0');
            document.getElementById("countdown").textContent = `${hours}:${minutes}:${seconds} Wib`;
        }
        setInterval(updateCountdown, 1000);
    </script>
</x-layout-gudang>
