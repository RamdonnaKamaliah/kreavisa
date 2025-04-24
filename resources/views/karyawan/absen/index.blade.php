@extends('layout3.karyawan3')
@section('page-title', 'Absensi')
@section('content')
    <div class="p-4 md:p-6 overflow-x-hidden mt-6">
        
        <div class="bg-white dark:bg-slate-850 dark:shadow-dark-xl text-gray-900 p-4 rounded-lg shadow-md">
            @if (session('success'))
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    window.onload = function() {
                        const type = "{{ session('attendance_type') }}";
                        let message = '';
s
                        switch (type) {
                            case 'hadir':
                                message = 'Absen hadir berhasil dicatat!';
                                break;
                            case 'sakit':
                                message = 'Absen sakit berhasil dicatat!';
                                break;
                            case 'izin':
                                message = 'Absen izin berhasil dicatat!';
                                break;
                            default:
                                message = "{{ session('success') }}";
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
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.3048621459625!2d106.7626191737859!3d-6.608989364603464!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c5001b7efe39%3A0x911c1a77e2752ac4!2sNavisa%20Basic%20Collection!5e0!3m2!1sid!2sid!4v1740474347021!5m2!1sid!2sid"
                    class="w-full h-64 md:h-80 rounded-lg shadow" style="border:0;" allowfullscreen loading="lazy"></iframe>
            </div>

            <div id="absen-section" class="flex flex-col items-center gap-2 justify-center mb-4">
                @if (!$todayAbsen)
                    @if ($currentHour >= 5)
                        <!-- Jam 05:00-23:59 dan belum absen -->
                        <p class="font-popins text-black dark:text-white">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos enim iusto voluptatem? 
                            <br> Quam
                            et ratione sint consequuntur dignissimos officiis porro!</p>
                        <div class="flex gap-2">
                            <a href="{{ route('karyawan.absen.create') }}"
                                class="bg-green-500 text-white px-4 py-2 rounded-lg shadow">Hadir</a>
                            <a href="{{ route('karyawan.absen.sakit') }}"
                                class="bg-red-500 text-white px-4 py-2 rounded-lg shadow hover:bg-red-600 transition-colors">Sakit</a>
                            <a href="{{ route('karyawan.absen.izin') }}"
                                class="bg-yellow-300 text-white px-4 py-2 rounded-lg shadow">Izin</a>
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

                @if (!$todayAbsen)
                    // Case 1: Belum absen hari ini
                    if (isAfterMidnight) {
                        // Hitung mundur sampai jam 05:00 hari ini
                        const target = new Date(nowWIB);
                        target.setHours(5, 0, 0, 0);

                        const countdown = setInterval(() => {
                            const now = getWIBTime();
                            const distance = target - now;

                            if (distance <= 0) {
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

                        if (distance <= 0) {
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
        </div>
    </div>


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
