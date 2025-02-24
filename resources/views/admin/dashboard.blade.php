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
                                    <h5 class="mb-2 font-bold dark:text-white mt-4">29 Karyawan</h5>
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
                            <a href="#"
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
                                    <h5 class="mb-2 font-bold dark:text-white mt-4">17 Karyawan</h5>
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
                            <a href="#"
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
                                        Jumlah Stok MASUK
                                    </p>
                                    <h5 class="mb-2 font-bold dark:text-white mt-4">1.700 Stok</h5>
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
                            <a href="#"
                                class="text-sm font-semibold text-blue-500 dark:text-blue-400 hover:underline">Lihat
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
                                        Jumlah Stok KELUAR
                                    </p>
                                    <h5 class="mb-2 font-bold dark:text-white mt-4">1.200 Stok</h5>
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
                            <a href="#"
                                class="text-sm font-semibold text-blue-500 dark:text-blue-400 hover:underline">Lihat
                                Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>


            <!-- cards row 2 -->
            <!-- Card -->
            <div class="flex flex-col md:flex-row justify-center gap-8">
                <!-- Chart Karyawan -->
                <div class="bg-white shadow-lg rounded-xl p-6 w-full md:w-1/2 flex flex-col items-center mt-8">
                    <div class="relative w-60 h-60 flex justify-center items-center">
                        <canvas id="karyawanChart"></canvas>
                        <p
                            class="absolute text-center text-lg font-bold top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
                            Total: <br />
                            29 Karyawan
                        </p>
                    </div>
                    <div class="p-4 bg-gray-100 rounded-lg text-left mt-4 w-full">
                        <h3 class="text-md font-semibold mb-2">
                            Jumlah Karyawan Berdasarkan Jabatan
                        </h3>
                        <ul class="text-sm">
                            <li>
                                <span class="text-blue-500 font-bold">●</span> Karyawan Gudang =
                                17 Orang
                            </li>
                            <li>
                                <span class="text-pink-400 font-bold">●</span> Karyawan Live = 19
                                Orang
                            </li>
                            <li>
                                <span class="text-orange-400 font-bold">●</span> Karyawan Packing
                                = 20 Orang
                            </li>
                            <li>
                                <span class="text-yellow-400 font-bold">●</span> Karyawan Admin =
                                5 Orang
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Chart Absensi -->
                <div class="bg-white shadow-lg rounded-xl p-6 w-full md:w-1/2 flex flex-col items-center mt-8">
                    <h2 class="text-lg font-bold mb-4">Total Absensi Minggu Ini</h2>
                    <div class="w-full flex justify-center">
                        <canvas id="absensiChart"></canvas>
                    </div>
                </div>
            </div>

            <script>
                document.addEventListener("DOMContentLoaded", function() {
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

                        window.karyawanChart = new Chart(ctxKaryawan, {
                            type: "doughnut",
                            data: {
                                labels: [
                                    "Karyawan Gudang",
                                    "Karyawan Live",
                                    "Karyawan Packing",
                                    "Karyawan Admin",
                                ],
                                datasets: [{
                                    data: [17, 19, 20, 5],
                                    backgroundColor: ["#3B82F6", "#F472B6", "#F59E0B", "#FACC15"],
                                    hoverOffset: 5,
                                }, ],
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: {
                                    legend: {
                                        display: false,
                                    },
                                    datalabels: {
                                        color: "#fff",
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

                        window.absensiChart = new Chart(ctxAbsensi, {
                            type: "bar",
                            data: {
                                labels: ["Senin", "Selasa", "Rabu", "Kamis", "Jumat"],
                                datasets: [{
                                    label: "Absensi",
                                    data: [10, 20, 15, 25, 18],
                                    backgroundColor: [
                                        "blue",
                                        "red",
                                        "yellow",
                                        "purple",
                                        "orange",
                                    ],
                                    borderRadius: 5,
                                }, ],
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
                                    },
                                },
                            },
                        });
                    }

                    createKaryawanChart();
                    createAbsensiChart();

                    window.addEventListener("resize", function() {
                        if (window.karyawanChart) {
                            window.karyawanChart.resize();
                        }
                        if (window.absensiChart) {
                            window.absensiChart.resize();
                        }
                    });
                });
            </script>
            </body>


            <div class="bg-white dark:bg-gray-900 p-4 shadow-lg rounded-2xl w-full max-w-6xl mt-8">
                <h2 class="text-xl font-bold text-center text-gray-900 dark:text-white mb-2">Maps</h2>
                <div class="border rounded-lg overflow-hidden">
                    <iframe class="w-full h-60"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3958.501004328541!2d110.409064!3d-7.197603!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e708b8e9d7e5c2b%3A0xf7b8a1b68206e0a!2sKebon%20Kacang!5e0!3m2!1sen!2sid!4v1644846140124!5m2!1sen!2sid"
                        allowfullscreen="" loading="lazy">
                    </iframe>
                </div>
                <div class="flex justify-center mt-3">
                    <button
                        class="flex items-center gap-2 px-4 py-2 bg-black text-white dark:bg-white dark:text-black rounded-lg hover:opacity-80">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 10c0 6-9 13-9 13s-9-7-9-13a9 9 0 0 1 18 0z" />
                            <circle cx="12" cy="10" r="3" />
                        </svg>
                        Lihat Selengkapnya
                    </button>
                </div>
            </div>


            <footer class="pt-4">
                <div class="w-full px-6 mx-auto">
                    <div class="flex flex-wrap items-center -mx-3 lg:justify-between">
                        <div class="w-full max-w-full px-3 mt-0 mb-6 shrink-0 lg:mb-0 lg:w-1/2 lg:flex-none">
                            <div class="text-sm leading-normal text-center text-slate-500 lg:text-left">
                                ©
                                <script>
                                    document.write(new Date().getFullYear() + ",");
                                </script>
                                made with <i class="fa fa-heart"></i> by
                                <a href="https://www.creative-tim.com" class="font-semibold text-slate-700 dark:text-white"
                                    target="_blank">Creative Tim</a>
                                for a better web.
                            </div>
                        </div>
                        <div class="w-full max-w-full px-3 mt-0 shrink-0 lg:w-1/2 lg:flex-none">
                            <ul class="flex flex-wrap justify-center pl-0 mb-0 list-none lg:justify-end">
                                <li class="nav-item">
                                    <a href="https://www.creative-tim.com"
                                        class="block px-4 pt-0 pb-1 text-sm font-normal transition-colors ease-in-out text-slate-500"
                                        target="_blank">Creative Tim</a>
                                </li>
                                <li class="nav-item">
                                    <a href="https://www.creative-tim.com/presentation"
                                        class="block px-4 pt-0 pb-1 text-sm font-normal transition-colors ease-in-out text-slate-500"
                                        target="_blank">About Us</a>
                                </li>
                                <li class="nav-item">
                                    <a href="https://creative-tim.com/blog"
                                        class="block px-4 pt-0 pb-1 text-sm font-normal transition-colors ease-in-out text-slate-500"
                                        target="_blank">Blog</a>
                                </li>
                                <li class="nav-item">
                                    <a href="https://www.creative-tim.com/license"
                                        class="block px-4 pt-0 pb-1 pr-0 text-sm font-normal transition-colors ease-in-out text-slate-500"
                                        target="_blank">License</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    @endsection
