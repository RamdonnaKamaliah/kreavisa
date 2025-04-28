@extends('layout3.karyawan3')
@section('content')
<div class="p-4 md:p-6 overflow-x-hidden">
    <div class="bg-white dark:bg-slate-850 dark:shadow-dark-xl text-gray-900 p-4 rounded-lg shadow-md">
                <!-- Back Button -->
                <div class="mb-4">
                    <a href="{{ route('karyawan.absen.index') }}" class="text-blue-600 hover:text-blue-800 flex items-center">
                        <i class="fas fa-arrow-left mr-2"></i>
                    </a>
                </div>
            <!-- Judul Absen Hadir di tengah -->
            <h1 class="text-2xl font-semibold text-gray-800 mb-4 text-center dark:text-white">Absen Hadir</h1>

            @if ($errors->any())
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
        <ul class="list-disc pl-5 space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

            <form action="{{ route('karyawan.absen.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="lokasi" id="lokasi">

                <!-- Kamera Section -->
                <div class="mb-8">
                    <!-- Label Ambil Foto di tengah -->
                    <label class="block text-gray-700 text-sm font-medium mb-4 text-center dark:text-gray-300">Ambil Foto</label>
                    
                    <div class="flex flex-col items-center space-y-4">
                        <!-- Container untuk video dan canvas dengan shadow -->
                        <div class="relative w-full max-w-xl aspect-[4/3] rounded-2xl overflow-hidden shadow-md border-4 border-blue-500 backdrop-blur-md bg-white/30 dark:bg-slate-700/30">
                            <video id="video" width="320" height="240" autoplay class="w-full h-full object-cover absolute inset-0"></video>
                            <canvas id="canvas" width="320" height="240" class="w-full h-full object-cover absolute inset-0 hidden"></canvas>
                        </div>
                        
                        <!-- Tombol-tombol dengan spacing yang rapi -->
                        <div class="flex flex-wrap justify-center space-x-4 items-center mb-4">
                            <!-- Tombol Ambil Foto -->
                            <button type="button" id="captureBtn" class="px-5 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-200 flex items-center">
                                <i class="fas fa-camera mr-2"></i>
                                <span>Ambil Foto</span>
                            </button>
                            
                            <!-- Tombol Ambil Ulang -->
                            <button type="button" id="retakeBtn" class="px-5 py-2.5 bg-gray-600 text-white rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition duration-200 hidden flex items-center">
                                <i class="fas fa-redo mr-2"></i>
                                <span>Ambil Ulang</span>
                            </button>
                        </div>
                        
                        <input type="hidden" name="foto" id="fotoInput">
                        
                        <!-- Tombol Simpan Absen -->
                        <div class="flex justify-center">
                            <button type="submit" class="w-48 px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-200 font-medium">
                                Simpan Absen
                            </button>
                        </div>
                    </div>
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

        // Di file absen-hadir.blade.php, perbaiki bagian geolocation:
document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector("form");
    const lokasiInput = document.getElementById('lokasi');
    const absenBtn = document.querySelector("button[type='submit']");

    // Dapatkan lokasi saat halaman dimuat
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            function(position) {
                const userLat = position.coords.latitude;
                const userLng = position.coords.longitude;
                lokasiInput.value = `${userLat},${userLng}`;
                
                // Tampilkan koordinat di console untuk debugging
                console.log("Koordinat Anda:", userLat, userLng);
                
                // Aktifkan tombol submit
                absenBtn.disabled = false;
            },
            function(error) {
                console.error("Error mendapatkan lokasi:", error);
                let errorMessage = "Gagal mendapatkan lokasi: ";
                
                switch(error.code) {
                    case error.PERMISSION_DENIED:
                        errorMessage += "Izin lokasi ditolak. Mohon aktifkan izin lokasi.";
                        break;
                    case error.POSITION_UNAVAILABLE:
                        errorMessage += "Informasi lokasi tidak tersedia.";
                        break;
                    case error.TIMEOUT:
                        errorMessage += "Permintaan lokasi timeout.";
                        break;
                    case error.UNKNOWN_ERROR:
                        errorMessage += "Error tidak diketahui.";
                        break;
                }
                
                Swal.fire({
                    icon: "error",
                    title: "Error Lokasi",
                    text: errorMessage,
                    confirmButtonColor: "#3b82f6"
                });
                
                // Tetap aktifkan tombol submit untuk kasus tertentu
                absenBtn.disabled = false;
            },
            {
  enableHighAccuracy: true,
  timeout: 15000,      // tambahkan waktu sedikit agar sempat dapat lokasi GPS
  maximumAge: 0
}

        );
    } else {
        Swal.fire({
            icon: "error",
            title: "Browser Tidak Mendukung",
            text: "Browser Anda tidak mendukung geolokasi.",
            confirmButtonColor: "#3b82f6"
        });
    }

    form.addEventListener('submit', function(e) {
        if (!lokasiInput.value) {
            e.preventDefault();
            Swal.fire({
                icon: "error",
                title: "Lokasi Tidak Tersedia",
                text: "Mohon tunggu sistem mendapatkan lokasi Anda...",
                confirmButtonColor: "#3b82f6"
            });
        }
    });
});
    </script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const lokasiInput = document.getElementById('lokasi');

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                function(position) {
                    const userLat = position.coords.latitude;
                    const userLng = position.coords.longitude;
                    lokasiInput.value = `${userLat},${userLng}`;
                    console.log("Koordinat Anda:", userLat, userLng);
                },
                function(error) {
                    let message = '';
                    switch(error.code) {
                        case error.PERMISSION_DENIED:
                            message = "Akses lokasi ditolak. Aktifkan izin lokasi di browser.";
                            break;
                        case error.POSITION_UNAVAILABLE:
                            message = "Informasi lokasi tidak tersedia.";
                            break;
                        case error.TIMEOUT:
                            message = "Waktu permintaan lokasi habis.";
                            break;
                        default:
                            message = "Terjadi kesalahan saat mengambil lokasi.";
                            break;
                    }

                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal Mengambil Lokasi',
                        text: message,
                        confirmButtonColor: '#3b82f6'
                    });
                }
            );
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Browser Tidak Mendukung',
                text: 'Browser Anda tidak mendukung geolocation.',
                confirmButtonColor: '#3b82f6'
            });
        }
    });
</script>


@endsection