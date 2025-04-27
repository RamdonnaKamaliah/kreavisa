@extends('layout.main')
@section('content')
    <div class="w-full px-6 py-6 mx-auto">
        <!-- row 1 -->
        <div class="flex flex-wrap -mx-3">
            <!-- card1 -->
            <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 xl:w-1/4">
                <div
                    class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                    <div class="flex-auto p-4">
                        <div class="flex flex-row -mx-3">
                            <div class="flex-none w-2/3 max-w-full px-3">
                                <div>
                                    <p
                                        class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">
                                        Total karyawan kreavisa
                                    </p>
                                    <h5 class="mb-2 font-bold dark:text-white mt-4">
                                        {{ count($datakaryawan) }} Karyawan
                                    </h5>

                                </div>
                            </div>
                            <div class="px-3 text-right basis-1/3">
                                <div
                                    class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-gradient-to-tl from-blue-500 to-violet-500">
                                    <i class='bx bx-group text-lg text-white'></i>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 text-left">
                            <a href="{{ route('datakaryawan.index') }}"
                                class="text-sm font-semibold text-blue-500 dark:text-blue-400 hover:underline">Lihat
                                Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- card2 -->
            <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 xl:w-1/4">
                <div
                    class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                    <div class="flex-auto p-4">
                        <div class="flex flex-row -mx-3">
                            <div class="flex-none w-2/3 max-w-full px-3">
                                <div>
                                    <p
                                        class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">
                                        Jumlah Absen Hari ini
                                    </p>
                                    <h5 class="mb-2 font-bold dark:text-white mt-4">{{ count($absenkaryawan) }} Karyawan
                                    </h5>
                                </div>
                            </div>
                            <div class="px-3 text-right basis-1/3">
                                <div
                                    class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-gradient-to-tl from-red-600 to-orange-600">
                                    <i class='bx bx-time-five text-lg text-white'></i>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 text-left">
                            <a href="{{ route('absenkaryawan.index') }}"
                                class="text-sm font-semibold text-blue-500 dark:text-blue-400 hover:underline">Lihat
                                Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- card3 -->
            <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 xl:w-1/4">
                <div
                    class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                    <div class="flex-auto p-4">
                        <div class="flex flex-row -mx-3">
                            <div class="flex-none w-2/3 max-w-full px-3">
                                <div>
                                    <p
                                        class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">
                                        Jumlah Jabatan Karyawan
                                    </p>
                                    <h5 class="mb-2 font-bold dark:text-white mt-4">{{ count($stokmasuk) }} Stok</h5>
                                </div>
                            </div>
                            <div class="px-3 text-right basis-1/3">
                                <div
                                    class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-gradient-to-tl from-emerald-500 to-teal-400">
                                    <i class="bx bx-box text-lg text-white"></i>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 text-left">
                            <a href="" class="text-sm font-semibold text-blue-500 dark:text-blue-400 hover:underline">Lihat
                                Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- card4 -->
            <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 xl:w-1/4">
                <div
                    class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                    <div class="flex-auto p-4">
                        <div class="flex flex-row -mx-3">
                            <div class="flex-none w-2/3 max-w-full px-3">
                                <div>
                                    <p
                                        class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">
                                        Jumlah Kinerja Baik
                                    </p>
                                    <h5 class="mb-2 font-bold dark:text-white mt-4">{{ count($stokkeluar) }} Stok</h5>
                                </div>
                            </div>
                            <div class="px-3 text-right basis-1/3">
                                <div
                                    class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-gradient-to-tl from-orange-500 to-yellow-500">
                                    <i class="bx bx-cart text-lg text-white"></i>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 text-left">
                            <a href="" class="text-sm font-semibold text-blue-500 dark:text-blue-400 hover:underline">Lihat
                                Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>


            <!-- cards row 2 -->
            <!-- Card -->
            <div class="flex flex-col md:flex-row justify-center gap-8 ml-4">
                <!-- Chart Karyawan -->
                <div
                    class="bg-white dark:bg-slate-850 dark:shadow-dark-xl shadow-lg rounded-xl p-6 w-full md:w-[55%] flex flex-col mt-6">
                    <h2 class="text-lg font-bold mb-4 text-center dark:text-white dark:opacity-60">Jumlah Karyawan</h2>
                    <div class="flex flex-row justify-center items-center gap-8">
                        <!-- Chart Donut -->
                        <div class="relative w-52 h-52 flex justify-center items-center mt-8">
                            <canvas id="karyawanChart"></canvas>
                            <p
                                class="absolute text-center text-base font-bold top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 dark:text-white dark:opacity-60">
                                Total: <br /> {{ $datakaryawan->count() }} Karyawan
                            </p>
                        </div>
                        <!-- Box Keterangan -->
                        <div class="p-5 bg-gray-100 dark:bg-gray-700 rounded-lg shadow text-left w-60">
                            <h3 class="text-base font-semibold mb-3 dark:text-white dark:opacity-60">Jumlah Karyawan
                                Berdasarkan Jabatan</h3>
                            <ul class="text-sm">
                                @foreach ($datakaryawan->groupBy('jabatan.nama_jabatan') as $jabatan => $karyawan)
                                    <li>
                                        <span class="font-bold"
                                            style="color: {{ ['#3B82F6', '#F472B6', '#F59E0B', '#FACC15'][$loop->index % 4] }};">●</span>
                                        {{ $jabatan }} = {{ $karyawan->count() }} Orang
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Chart Absensi -->
                <div
                    class="bg-white dark:bg-slate-850 dark:shadow-dark-xl  shadow-lg rounded-xl p-6 w-full md:w-[45%] flex flex-col items-center mt-6">
                    <h2 class="text-lg font-bold mb-4 dark:text-white dark:opacity-60">Total Absensi Minggu Ini</h2>
                    <div class="w-full flex justify-center">
                        <canvas id="absensiChart" class="h-56"></canvas>
                    </div>
                    <a href="{{ route('absenkaryawan.index') }}"
                        class="mt-6 w-full text-center bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-800 flex items-center justify-center gap-1 text-sm">
                        Selengkapnya <i class='bx bx-right-arrow-alt text-lg'></i>
                    </a>
                </div>
            </div>



            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    if (typeof ChartDataLabels !== "undefined") {
                        Chart.register(ChartDataLabels);
                    }

                    function createKaryawanChart() {
                        const canvasKaryawan = document.getElementById("karyawanChart");
                        if (!canvasKaryawan) {
                            console.error("Elemen karyawanChart tidak ditemukan!");
                            return;
                        }

                        const ctxKaryawan = canvasKaryawan.getContext("2d");

                        if (window.karyawanChart instanceof Chart) {
                            window.karyawanChart.destroy();
                        }

                        // Ambil data karyawan dari Laravel
                        const dataJabatan = @json($datakaryawan->groupBy('jabatan.nama_jabatan')->map->count());
                        const labels = Object.keys(dataJabatan);
                        const values = Object.values(dataJabatan);
                        const colors = ["#3B82F6", "#F472B6", "#F59E0B", "#FACC15", "#10B981", "#EF4444", "#8B5CF6"];

                        window.karyawanChart = new Chart(ctxKaryawan, {
                            type: "doughnut",
                            data: {
                                labels: labels,
                                datasets: [{
                                    data: values,
                                    backgroundColor: colors.slice(0, labels.length),
                                    hoverOffset: 5,
                                    borderColor: document.documentElement.classList.contains('dark') ? '#1e293b' : '#fff', // Border color for dark mode
                                    borderWidth: 2,
                                }],
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: {
                                    legend: {
                                        display: false,
                                    },
                                    datalabels: {
                                        color: document.documentElement.classList.contains('dark') ? '#fff' : '#333',
                                        font: {
                                            weight: "bold",
                                            size: 14,
                                        },
                                        formatter: (value) => value,
                                    },
                                },
                                cutout: "70%",
                            },
                        });
                    }

                    function createAbsensiChart() {
                        const canvasAbsensi = document.getElementById("absensiChart");
                        if (!canvasAbsensi) {
                            console.error("Elemen absensiChart tidak ditemukan!");
                            return;
                        }

                        const ctxAbsensi = canvasAbsensi.getContext("2d");

                        if (window.absensiChart instanceof Chart) {
                            window.absensiChart.destroy();
                        }

                        // Ambil data absensi dari Laravel (Menggunakan absenkaryawan)
                        const absenKaryawan = @json($absenkaryawan);
                        const labels = ["Senin", "Selasa", "Rabu", "Kamis", "Jumat"];
                        const values = labels.map(day => absenKaryawan[day] || 0);
                        const colors = ["#3B82F6", "#F472B6", "#F59E0B", "#FACC15", "#10B981"];

                        window.absensiChart = new Chart(ctxAbsensi, {
                            type: "bar",
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: "Jumlah Absensi",
                                    data: values,
                                    backgroundColor: colors,
                                    borderRadius: 5,
                                    borderColor: document.documentElement.classList.contains('dark') ? '#1e293b' : '#fff',
                                    borderWidth: 1,
                                }],
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: {
                                    legend: {
                                        display: false,
                                    },
                                    tooltip: {
                                        enabled: true,
                                        callbacks: {
                                            label: (tooltipItem) => ` ${tooltipItem.raw} Absensi`,
                                        },
                                    },
                                },
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        ticks: {
                                            stepSize: 1,
                                            color: document.documentElement.classList.contains('dark') ? '#e2e8f0' : '#64748b',
                                        },
                                        grid: {
                                            color: document.documentElement.classList.contains('dark') ? '#334155' : '#e2e8f0',
                                        },
                                    },
                                    x: {
                                        ticks: {
                                            color: document.documentElement.classList.contains('dark') ? '#e2e8f0' : '#64748b',
                                        },
                                        grid: {
                                            color: document.documentElement.classList.contains('dark') ? '#334155' : '#e2e8f0',
                                        },
                                    },
                                },
                            },
                        });
                    }

                    createKaryawanChart();
                    createAbsensiChart();

                    // Listen for dark mode changes and update charts
                    const observer = new MutationObserver(function (mutations) {
                        mutations.forEach(function (mutation) {
                            if (mutation.attributeName === 'class') {
                                createKaryawanChart();
                                createAbsensiChart();
                            }
                        });
                    });

                    observer.observe(document.documentElement, {
                        attributes: true,
                        attributeFilter: ['class']
                    });

                    window.addEventListener("resize", function () {
                        if (window.karyawanChart) {
                            window.karyawanChart.resize();
                        }
                        if (window.absensiChart) {
                            window.absensiChart.resize();
                        }
                    });
                });
            </script>




            <div class="bg-white dark:bg-slate-850 p-4 shadow-lg rounded-2xl w-full max-w-6xl mt-8">
                <h2 class="text-xl font-bold text-center text-gray-900 dark:text-white mb-2">Maps</h2>
                <div class="border rounded-lg overflow-hidden">
                    <iframe class="w-full h-60"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.3048621459625!2d106.7626191737859!3d-6.608989364603464!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c5001b7efe39%3A0x911c1a77e2752ac4!2sNavisa%20Basic%20Collection!5e0!3m2!1sid!2sid!4v1740666686244!5m2!1sid!2sid"
                        allowfullscreen="" loading="lazy">
                    </iframe>
                </div>
                <div class="flex justify-center mt-3">
                    <a href="https://maps.app.goo.gl/h6qyQiHKDmRCuopP7" target="_blank" rel="noopener noreferrer">
                        <button
                            class="flex items-center gap-2 px-4 py-2 bg-black text-white dark:bg-white dark:text-black rounded-lg hover:opacity-80">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 10c0 6-9 13-9 13s-9-7-9-13a9 9 0 0 1 18 0z" />
                                <circle cx="12" cy="10" r="3" />
                            </svg>
                            Lihat Selengkapnya
                        </button>
                    </a>
                </div>

            </div>
        </div>
@endsection