<x-layout-karyawan>
    <section class="flex-grow flex justify-center items-center bg-gray-900 min-h-screen">
        <div class="bg-gray-800 p-8 rounded-xl shadow-lg text-center max-w-4xl w-full mx-4">
            <!-- Container sudah lebar -->
            <!-- Heading dan Deskripsi -->
            <h2 class="text-white text-2xl font-bold mb-4">Absensi Karyawan</h2>
            <p class="text-gray-400 text-sm mb-8">Pastikan Anda melakukan absensi setiap hari sesuai kondisi Anda.</p>

            <!-- Statistik Kehadiran -->
            <div class="flex justify-between items-center bg-gray-700 rounded-lg p-4 mb-6 text-white">
                <div>
                    <p class="text-sm">Hadir Bulan Ini</p>
                    <p class="text-lg font-bold">20</p>
                </div>
                <div>
                    <p class="text-sm">Sakit</p>
                    <p class="text-lg font-bold">3</p>
                </div>
                <div>
                    <p class="text-sm">Izin</p>
                    <p class="text-lg font-bold">2</p>
                </div>
            </div>

            <!-- Map Box -->
            <div class="mb-6">
                <div id="map" class="w-full h-56 rounded-lg border-2 border-gray-600 overflow-hidden"></div>
            </div>

            <!-- Info Waktu -->
            <p class="text-white text-left mb-6">Waktu saat ini: <span class="font-bold" id="currentTime">10:00</span>
            </p>

            <!-- Tombol Pilihan Absen -->
            <div class="flex justify-between mb-6">
                <button id="btn-hadir"
                    class="btn-absen bg-gray-600 text-white px-6 py-2 rounded-lg hover:bg-gray-700">Hadir</button>
                <button id="btn-sakit"
                    class="btn-absen bg-gray-600 text-white px-6 py-2 rounded-lg hover:bg-gray-700">Sakit</button>
                <button id="btn-izin"
                    class="btn-absen bg-gray-600 text-white px-6 py-2 rounded-lg hover:bg-gray-700">Izin</button>
            </div>

            <!-- Form Upload Foto (Default: Hidden) -->
            <div id="upload-section" class="hidden">
                <label for="file-upload" class="block text-white text-left mb-2">Upload Foto:</label>
                <input type="file" id="file-upload" class="w-full text-white bg-gray-700 rounded-lg px-4 py-2">
            </div>

            <!-- Tombol Absen Foto -->
            <button id="btn-absen-foto"
                class="bg-blue-500 text-white w-full py-4 rounded-lg flex items-center justify-center space-x-2 hover:bg-blue-600 mt-6 hidden">
                <i class="fas fa-camera"></i>
                <span>Ambil Foto Absen</span>
            </button>
        </div>
    </section>

    <!-- Leaflet.js CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
    <!-- Leaflet.js Script -->
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>

    <script>
        // Menampilkan waktu real-time
        function updateTime() {
            const currentTime = new Date();
            document.getElementById("currentTime").textContent = currentTime.toLocaleTimeString();
        }
        setInterval(updateTime, 1000);

        // Menampilkan peta menggunakan Leaflet.js
        const map = L.map('map').setView([-6.21462, 106.84513], 13); // Koordinat default (Jakarta)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);
        const marker = L.marker([-6.21462, 106.84513]).addTo(map);
        marker.bindPopup("<b>Lokasi Absen</b>").openPopup();

        // Fungsi untuk mengatur tombol active
        function setActiveButton(buttonId) {
            const buttons = document.querySelectorAll(".btn-absen");
            buttons.forEach(btn => btn.classList.remove("active")); // Hapus semua class active
            document.getElementById(buttonId).classList.add("active"); // Tambahkan class active pada tombol yang diklik
        }

        // Event Listeners untuk Tombol Absen
        document.getElementById("btn-hadir").addEventListener("click", function() {
            setActiveButton("btn-hadir");
            document.getElementById("upload-section").classList.add("hidden");
            document.getElementById("btn-absen-foto").classList.remove("hidden");
        });

        document.getElementById("btn-sakit").addEventListener("click", function() {
            setActiveButton("btn-sakit");
            document.getElementById("upload-section").classList.remove("hidden");
            document.getElementById("btn-absen-foto").classList.add("hidden");
        });

        document.getElementById("btn-izin").addEventListener("click", function() {
            setActiveButton("btn-izin");
            document.getElementById("upload-section").classList.remove("hidden");
            document.getElementById("btn-absen-foto").classList.add("hidden");
        });
    </script>

    <style>
        /* Style untuk tombol yang aktif */
        .btn-absen.active {
            background-color: #2563eb;
            /* Warna biru */
            border: 2px solid #1e40af;
            /* Border warna biru gelap */
        }

        /* Style untuk heading dan deskripsi */
        h2 {
            font-size: 24px;
        }

        p {
            font-size: 14px;
        }

        <style>body {
            background-color: #0f172a;
            /* Warna latar utama */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            /* Isi seluruh tinggi layar */
        }

        /* Container Utama */
        section {
            padding: 32px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        /* Container Card */
        .rounded-xl {
            background-color: #1e293b;
            padding: 32px;
            border-radius: 16px;
            max-width: 600px;
            width: 100%;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        /* Jarak antar tombol lebih rapat */
        .btn-absen {
            margin-right: 8px;
        }

        /* Style untuk tombol aktif */
        .btn-absen.active {
            background-color: #2563eb;
            border: 2px solid #1e40af;
        }

        /* Sentralisasi konten */
        .flex-center {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
            /* Jarak antar elemen */
        }
    </style>

    </style>
</x-layout-karyawan>
