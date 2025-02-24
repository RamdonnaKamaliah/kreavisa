@push('page-title')
    Absen Karyawan
@endpush
<x-layout-gudang>
    <section class="flex-grow flex items-center justify-center min-h-screen md:ml-16 md:mr-0 md:pl-40 pt-20">
        <div class="p-6 rounded-xl shadow-lg text-center max-w-4xl w-full mx-auto md:ml-auto md:mr-auto bg-gray-800">
            <!-- Heading dan Deskripsi -->
            <h2 class="text-white text-2xl font-bold mb-1">Absensi Karyawan</h2>
            <p class="text-gray-400 text-sm mb-8 pt-0">Pastikan Anda melakukan absensi setiap hari sesuai kondisi Anda.
            </p>

            <!-- Statistik Kehadiran (Disesuaikan agar lebih rapat) -->
            <div class="flex justify-between items-center bg-gray-700 rounded-lg p-4 mb-6 text-white gap-4">
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

            <!-- Form Absensi -->
            <form action="{{ route('absen-karyawan.store') }}" method="POST" enctype="multipart/form-data"
                id="absenForm">
                @csrf
                <input type="hidden" name="latitude" id="latitude">
                <input type="hidden" name="longitude" id="longitude">
                <input type="hidden" name="foto_base64" id="foto_base64">

                <!-- Tombol Pilihan Absen (Lebar tombol disesuaikan) -->
                <div class="flex justify-center gap-4 mt-4 mb-5">
                    <button type="button" id="btn-hadir"
                        class="btn-absen bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 w-24">Hadir</button>
                    <button type="button" id="btn-sakit"
                        class="btn-absen bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 w-24">Sakit</button>
                    <button type="button" id="btn-izin"
                        class="btn-absen bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 w-24">Izin</button>
                </div>

                <!-- Tombol Ambil Foto (Muncul saat Hadir) -->
                <div id="ambilFotoSection" class="hidden">
                    <button type="button" id="btn-ambil-foto"
                        class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 w-32">Ambil Foto</button>
                </div>

                <!-- Preview Nama File (Muncul setelah foto disimpan) -->
                <div id="fileNameSection" class="hidden mt-4">
                    <p class="text-white text-left mb-2">Nama File:</p>
                    <p id="fileName" class="text-white text-left"></p>
                </div>

                <!-- File Surat Section (Muncul saat Sakit/Izin) -->
                <div id="fileSuratSection" class="hidden">
                    <label for="file_surat" class="block text-white text-left mb-2">Surat Keterangan (jika
                        Sakit/Izin):</label>
                    <input type="file" name="file_surat" class="w-full text-white bg-gray-700 rounded-lg px-4 py-2">
                </div>

                <!-- Tombol Submit (Lebar tombol disesuaikan) -->
                <a href="{{ route('absen-gudang.create') }}"
                    class="bg-blue-500 text-white py-2 px-4 rounded-lg flex items-center justify-center space-x-2 hover:bg-blue-600 mt-6 w-40 mx-auto text-sm">
                    <i class="fas fa-camera"></i>
                    <span>Submit Absen</span>
                </a>
            </form>
        </div>
    </section>

    <!-- Pop-up Kamera -->
    <!-- Pop-up Kamera -->
    <div id="cameraPopup" class="fixed inset-0 bg-black bg-opacity-75 flex justify-center items-center hidden">
        <div class="bg-gray-800 p-6 rounded-lg w-11/12 max-w-lg relative">
            <!-- Tombol Close di atas kanan -->
            <button type="button" id="closeCamera"
                class="absolute top-2 right-2 bg-red-500 text-white p-2 rounded-full hover:bg-red-600">
                <i class="fas fa-times"></i>
            </button>
            <p class="text-white text-lg font-bold mb-4 text-center">Ambil Foto</p>
            <video id="video" class="w-full h-56 rounded-lg border-2 border-gray-600 overflow-hidden"
                autoplay></video>

            <!-- Canvas untuk preview foto -->
            <canvas id="canvas"
                class="w-full h-56 rounded-lg border-2 border-gray-600 overflow-hidden mt-4 hidden"></canvas>

            <div class="flex justify-between mt-4">
                <button type="button" id="capture"
                    class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">Ambil Foto</button>

                <button type="button" id="retakePhoto"
                    class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 hidden">Ambil Ulang</button>

                <button type="button" id="savePhoto"
                    class="bg-green-500 text-white px-6 py-2 rounded-lg hover:bg-green-600 hidden">Simpan</button>
            </div>
        </div>
    </div>

    </div>

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

            const jenis = buttonId.replace('btn-', '');
            const ambilFotoSection = document.getElementById('ambilFotoSection');
            const fileSuratSection = document.getElementById('fileSuratSection');
            const photoPreviewSection = document.getElementById('photoPreviewSection');

            if (jenis === 'hadir') {
                ambilFotoSection.style.display = 'block';
                fileSuratSection.style.display = 'none';
                photoPreviewSection.style.display = 'none';
            } else if (jenis === 'sakit' || jenis === 'izin') {
                ambilFotoSection.style.display = 'none';
                fileSuratSection.style.display = 'block';
                photoPreviewSection.style.display = 'none';
            } else {
                ambilFotoSection.style.display = 'none';
                fileSuratSection.style.display = 'none';
                photoPreviewSection.style.display = 'none';
            }
        }

        // Fungsi untuk menampilkan pop-up kamera
        document.getElementById('btn-ambil-foto').addEventListener('click', function() {
            const cameraPopup = document.getElementById('cameraPopup');
            cameraPopup.style.display = 'flex';
            startCamera();
        });

        // Fungsi untuk menutup pop-up kamera
        document.getElementById('closeCamera').addEventListener('click', function() {
            const cameraPopup = document.getElementById('cameraPopup');
            cameraPopup.style.display = 'none';
            stopCamera();
        });

        // Fungsi untuk memulai kamera
        function startCamera() {
            navigator.mediaDevices.getUserMedia({
                    video: true
                })
                .then(function(stream) {
                    const video = document.getElementById('video');
                    video.srcObject = stream;
                    window.cameraStream = stream;
                })
                .catch(function(err) {
                    console.error("Error accessing camera: ", err);
                    alert("Tidak bisa mengakses kamera. Pastikan izin kamera diberikan.");
                });
        }

        // Fungsi untuk menghentikan kamera
        function stopCamera() {
            if (window.cameraStream) {
                window.cameraStream.getTracks().forEach(track => track.stop());
                window.cameraStream = null;
            }
        }

        // Fungsi untuk mengambil foto
        // Fungsi untuk mengambil foto
        document.getElementById('capture').addEventListener('click', function() {
            const canvas = document.getElementById('canvas');
            const video = document.getElementById('video');
            const retakePhotoButton = document.getElementById('retakePhoto');
            const savePhotoButton = document.getElementById('savePhoto');
            const captureButton = document.getElementById('capture');

            // Atur ukuran canvas sesuai dengan video
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);

            // Sembunyikan video dan tampilkan canvas
            video.style.display = 'none';
            canvas.style.display = 'block';

            // Tampilkan tombol "Ambil Ulang" dan "Simpan"
            retakePhotoButton.style.display = 'inline-block';
            savePhotoButton.style.display = 'inline-block';
            captureButton.style.display = 'none';
        });

        // Fungsi untuk mengambil ulang foto
        document.getElementById('retakePhoto').addEventListener('click', function() {
            const canvas = document.getElementById('canvas');
            const video = document.getElementById('video');
            const retakePhotoButton = document.getElementById('retakePhoto');
            const savePhotoButton = document.getElementById('savePhoto');
            const captureButton = document.getElementById('capture');

            // Sembunyikan canvas dan tampilkan kembali video
            canvas.style.display = 'none';
            video.style.display = 'block';

            // Sembunyikan tombol "Ambil Ulang" dan "Simpan", tampilkan tombol "Ambil Foto"
            retakePhotoButton.style.display = 'none';
            savePhotoButton.style.display = 'none';
            captureButton.style.display = 'inline-block';
        });

        // Fungsi untuk menyimpan foto
        document.getElementById('savePhoto').addEventListener('click', function() {
            const canvas = document.getElementById('canvas');
            const fotoBase64Input = document.getElementById('foto_base64');
            const fileNameSection = document.getElementById('fileNameSection');
            const fileNameElement = document.getElementById('fileName');
            const cameraPopup = document.getElementById('cameraPopup');

            // Simpan foto ke input hidden
            const fotoBase64 = canvas.toDataURL('image/jpeg');
            fotoBase64Input.value = fotoBase64;

            // Tampilkan nama file (contoh: "foto_20231025.jpg")
            const currentDate = new Date();
            const fileName =
                `foto_${currentDate.getFullYear()}${(currentDate.getMonth() + 1).toString().padStart(2, '0')}${currentDate.getDate().toString().padStart(2, '0')}.jpg`;
            fileNameElement.textContent = fileName;
            fileNameSection.style.display = 'block';

            // Tutup pop-up kamera dan hentikan kamera
            cameraPopup.style.display = 'none';
            stopCamera();
        });
        // Fungsi untuk menyimpan foto
        document.getElementById('savePhoto').addEventListener('click', function() {
            const canvas = document.getElementById('canvas');
            const fotoBase64Input = document.getElementById('foto_base64');
            const fileNameSection = document.getElementById('fileNameSection');
            const fileNameElement = document.getElementById('fileName');
            const cameraPopup = document.getElementById('cameraPopup');

            // Simpan foto ke input hidden
            const fotoBase64 = canvas.toDataURL('image/jpeg');
            fotoBase64Input.value = fotoBase64;

            // Tampilkan nama file (contoh: "foto_20231025.jpg")
            const currentDate = new Date();
            const fileName =
                `foto_${currentDate.getFullYear()}${(currentDate.getMonth() + 1).toString().padStart(2, '0')}${currentDate.getDate().toString().padStart(2, '0')}.jpg`;
            fileNameElement.textContent = fileName;
            fileNameSection.style.display = 'block';

            // Tutup pop-up kamera dan hentikan kamera
            cameraPopup.style.display = 'none';
            stopCamera();
        });
        document.getElementById('btn-ambil-foto').addEventListener('click', function() {
            const cameraPopup = document.getElementById('cameraPopup');
            const video = document.getElementById('video');
            const canvas = document.getElementById('canvas');
            const fotoBase64Input = document.getElementById('foto_base64');
            const fileNameSection = document.getElementById('fileNameSection');
            const fileNameElement = document.getElementById('fileName');
            const retakePhotoButton = document.getElementById('retakePhoto');
            const savePhotoButton = document.getElementById('savePhoto');
            const captureButton = document.getElementById('capture');

            // Reset tampilan jika ada foto sebelumnya
            fotoBase64Input.value = '';
            fileNameElement.textContent = '';
            fileNameSection.style.display = 'none';
            canvas.style.display = 'none';
            video.style.display = 'block';
            retakePhotoButton.style.display = 'none';
            savePhotoButton.style.display = 'none';
            captureButton.style.display = 'inline-block';

            // Tampilkan pop-up dan mulai kamera
            cameraPopup.style.display = 'flex';
            startCamera();
        });


        // Set kondisi awal
        setActiveButton('btn-hadir');
    </script>

    <style>
        /* Style untuk tombol yang aktif */
        .btn-absen.active {
            background-color: #2563eb;
            border: 2px solid #1e40af;
        }

        /* Style untuk pop-up kamera */
        /* Style untuk pop-up kamera */
        #cameraPopup {
            z-index: 1000;
        }

        #cameraPopup>div {
            background-color: #2d3748;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 500px;
        }

        #cameraPopup video,
        #cameraPopup canvas {
            width: 100%;
            height: auto;
            aspect-ratio: 4/3;
            /* Memastikan rasio aspek 4:3 untuk video dan canvas */
            border-radius: 8px;
            background-color: #1a202c;
        }

        #cameraPopup .flex {
            margin-top: 16px;
        }

        #cameraPopup button {
            padding: 8px 16px;
            border-radius: 8px;
            font-weight: 500;
            transition: background-color 0.2s;
        }

        #cameraPopup button:hover {
            opacity: 0.9;
        }

        #cameraPopup #closeCamera {
            background-color: #e53e3e;
        }

        #cameraPopup #capture,
        #cameraPopup #retakePhoto {
            background-color: #4299e1;
        }

        #cameraPopup #savePhoto {
            background-color: #48bb78;
        }
    </style>
    </x-layout-karyawan>
