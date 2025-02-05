<x-layout-karyawan2>

    <x-layout-class></x-layout-class>


    <body>
        <section class="relative w-full mx-auto pt-8 overflow-hidden" id="home">
            <!-- Bagian Atas -->
            <div class="text-white p-8 h-[300px] flex flex-col sm:flex-row justify-center items-center relative">
                <div class="dashboard-top flex flex-col sm:flex-row items-center sm:items-start w-full max-w-6xl">
                    <!-- Gambar Planet (Di atas saat mobile) -->
                    <div class="flex justify-center sm:justify-end order-1 sm:order-2 w-full sm:w-auto">
                        <img alt="Decorative image of a planet with rings"
                            class="w-40 h-40 sm:w-64 sm:h-64 md:w-80 md:h-80"
                            src="{{ asset('asset-landing-page/img/planet-2-removebg-preview.png') }}"
                            style="object-fit: contain;" />
                    </div>

                    <!-- Teks -->
                    <div class="text-center sm:text-left order-2 sm:order-1 sm:ml-8">
                        <h1 class="text-3xl font-montserrat text-black font-bold">Welcome</h1>
                        <h2 class="text-4xl font-bold font-montserrat mt-2 text-[#C0B7E8]">Kreavisa Employees</h2>
                        <p class="mt-2 font-montserrat mb-5 text-black">System Management Berbasis Website</p>
                    </div>
                </div>
            </div>

            <!-- Grid Kotak Informasi -->
            <div class="flex justify-center items-center p-4 sm:p-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 w-full max-w-6xl">
                    <div class="bg-white p-6 rounded-lg shadow-lg text-center border-t-4 border-blue-500">
                        <h3 class="text-xl font-semibold text-gray-700">Total Karyawan</h3>
                        <p class="text-4xl font-bold text-gray-900">50</p>
                        <p class="text-gray-500">Terdaftar</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-lg text-center border-t-4 border-green-500">
                        <h3 class="text-xl font-semibold text-gray-700">Absensi Hari Ini</h3>
                        <p class="text-4xl font-bold text-gray-900">45</p>
                        <p class="text-gray-500">Hadir</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-lg text-center border-t-4 border-yellow-500">
                        <h3 class="text-xl font-semibold text-gray-700">Jadwal Kerja</h3>
                        <p class="text-lg font-medium text-gray-900">Senin - Jumat</p>
                        <p class="text-gray-500">09:00 - 17:00</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-lg text-center border-t-4 border-red-500">
                        <h3 class="text-xl font-semibold text-gray-700">Gaji Bulan Ini</h3>
                        <p class="text-3xl font-bold text-gray-900">Rp50.000.000</p>
                        <p class="text-gray-500">Dibayarkan</p>
                    </div>
                </div>
            </div>

            <!-- Kotak Bawah (Notifikasi dan Pengumuman) -->
            <div class="mt-8 p-4 sm:p-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 w-full max-w-6xl mx-auto">
                    <div class="bg-white p-6 rounded-lg shadow-lg border-l-4 border-purple-500">
                        <h3 class="text-xl font-semibold text-gray-700 mb-3">Notifikasi Terbaru</h3>
                        <ul class="list-disc ml-5 text-gray-700">
                            <li>Karyawan A melakukan absensi pada 08:30.</li>
                            <li>Jadwal rapat dengan tim pada 14:00.</li>
                        </ul>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-lg border-l-4 border-indigo-500">
                        <h3 class="text-xl font-semibold text-gray-700 mb-3">Pengumuman</h3>
                        <p class="text-gray-700">Libur nasional pada tanggal 25 Januari.</p>
                        <p class="text-gray-700">Upgrade sistem pada tanggal 30 Januari.</p>
                    </div>
                </div>
            </div>
            </div>
        </section>
    </body>



    <style>
        .dashboard-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-direction: row;
        }

        /* Responsif untuk layar mobile */
        @media (max-width: 768px) {
            .dashboard-top {
                flex-direction: column;
                text-align: center;
            }

            .dashboard-top img {
                order: -1;
                /* Gambar di atas teks */
                margin-bottom: 20px;
            }

            .dashboard-top .text-left {
                text-align: center;
                /* Teks di tengah saat mobile */
            }
        }
    </style>

    <!-- Tambahkan CSS untuk tata letak responsif -->
</x-layout-karyawan2>