@extends('layout2.karyawan')
@section('content')
<div class="p-4 md:p-6 overflow-x-hidden">
    <div class="bg-white text-gray-900 p-4 rounded-lg shadow-md">
                <!-- Back Button -->
                <div class="mb-4">
                    <a href="{{ route('gudang.absen.index') }}" class="text-blue-600 hover:text-blue-800 flex items-center">
                        <i class="fas fa-arrow-left mr-2"></i>
                    </a>
                </div>
            <!-- Judul Absen Hadir di tengah -->
            <h1 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Absen Hadir</h1>

            @if ($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('gudang.absen.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="lokasi" id="lokasi">

                <!-- Kamera Section -->
                <div class="mb-8">
                    <!-- Label Ambil Foto di tengah -->
                    <label class="block text-gray-700 text-sm font-medium mb-4 text-center">Ambil Foto</label>
                    
                    <div class="flex flex-col items-center space-y-4">
                        <!-- Container untuk video dan canvas dengan shadow -->
                        <div class="relative w-full max-w-xs h-60 rounded-lg overflow-hidden shadow-md">
                            <video id="video" width="320" height="240" autoplay class="w-full h-full object-cover absolute inset-0"></video>
                            <canvas id="canvas" width="320" height="240" class="w-full h-full object-cover absolute inset-0 hidden"></canvas>
                        </div>
                        
                        <!-- Tombol-tombol dengan spacing yang rapi -->
                        <div class="flex space-x-4 justify-center">
                            <button type="button" id="captureBtn" class="px-5 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-200 flex items-center">
                                <i class="fas fa-camera mr-2"></i>
                                <span>Ambil Foto</span>
                            </button>
                            <button type="button" id="retakeBtn" class="px-5 py-2.5 bg-gray-600 text-white rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition duration-200 hidden flex items-center">
                                <i class="fas fa-redo mr-2"></i>
                                <span>Ambil Ulang</span>
                            </button>
                        </div>
                        <input type="hidden" name="foto" id="fotoInput">
                    </div>
                </div>

                <!-- Tombol Submit -->
                <button type="submit" class="w-full px-4 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-200 font-medium">
                    Simpan Absen
                </button>
            </form>
        </div>
    </div>
    
    <!-- Include SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Include Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <script>
        // Akses Kamera
        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');
        const captureBtn = document.getElementById('captureBtn');
        const retakeBtn = document.getElementById('retakeBtn');
        const fotoInput = document.getElementById('fotoInput');

        navigator.mediaDevices.getUserMedia({ 
            video: { 
                width: 320,
                height: 240,
                facingMode: 'user' // Gunakan kamera depan
            } 
        })
        .then((stream) => {
            video.srcObject = stream;
            video.play();
        })
        .catch((error) => {
            console.error("Gagal mengakses kamera:", error);
            Swal.fire({
                icon: "error",
                title: "Kamera Tidak Dapat Diakses",
                text: "Mohon izinkan akses kamera untuk melanjutkan",
                confirmButtonColor: "#3b82f6"
            });
        });

        captureBtn.addEventListener('click', function() {
            // Ambil foto
            const context = canvas.getContext('2d');
            context.drawImage(video, 0, 0, 320, 240);
            fotoInput.value = canvas.toDataURL('image/png');
            
            // Tampilkan hasil foto dan sembunyikan video
            canvas.classList.remove('hidden');
            video.classList.add('hidden');
            
            // Tampilkan tombol ambil ulang
            captureBtn.classList.add('hidden');
            retakeBtn.classList.remove('hidden');
        });

        retakeBtn.addEventListener('click', function() {
            // Sembunyikan hasil foto dan tampilkan video kembali
            canvas.classList.add('hidden');
            video.classList.remove('hidden');
            
            // Tampilkan tombol ambil foto
            captureBtn.classList.remove('hidden');
            retakeBtn.classList.add('hidden');
        });

        // Geolocation
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.querySelector("form");
            const lokasiInput = document.getElementById('lokasi');
            const absenBtn = document.querySelector("button[type='submit']");
            
            const titikAbsen = {
                lat: -6.6048439603911815,
                lng: 106.7282283957573
            };
            const radiusMaksimum = 10000; // 10 km

            form.addEventListener('submit', function(e) {
                if (!lokasiInput.value) {
                    e.preventDefault();
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Sedang mendapatkan lokasi Anda, tunggu sebentar...",
                        confirmButtonColor: "#3b82f6"
                    });
                }
            });

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        const userLat = position.coords.latitude;
                        const userLng = position.coords.longitude;
                        lokasiInput.value = `${userLat}, ${userLng}`;

                        const jarak = hitungJarak(userLat, userLng, titikAbsen.lat, titikAbsen.lng);
                        console.log("Jarak dari titik absen:", jarak, "meter");

                        if (jarak > radiusMaksimum) {
                            Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                text: "Anda berada di luar lokasi absensi!",
                                confirmButtonColor: "#3b82f6",
                                allowOutsideClick: false
                            }).then(() => {
                                window.location.href = "{{ route('gudang.absen.index') }}";
                            });
                            absenBtn.disabled = true;
                        }
                    },
                    function(error) {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Gagal mendapatkan lokasi. Aktifkan GPS dan coba lagi!",
                            confirmButtonColor: "#3b82f6"
                        });
                        absenBtn.disabled = true;
                    },
                    { enableHighAccuracy: true, timeout: 10000 }
                );
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Perangkat Anda tidak mendukung geolokasi!",
                    confirmButtonColor: "#3b82f6"
                });
                absenBtn.disabled = true;
            }

            function hitungJarak(lat1, lon1, lat2, lon2) {
                const R = 6371e3;
                const rad = (deg) => deg * (Math.PI / 180);
                const dLat = rad(lat2 - lat1);
                const dLon = rad(lon2 - lon1);
                const a =
                    Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                    Math.cos(rad(lat1)) * Math.cos(rad(lat2)) *
                    Math.sin(dLon / 2) * Math.sin(dLon / 2);
                const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
                return R * c;
            }
        });
    </script>
@endsection