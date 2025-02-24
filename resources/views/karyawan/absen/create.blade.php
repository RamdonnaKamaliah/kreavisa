<x-layout-karyawan>
    <div class="p-4 md:p-6 md:ml-[250px] overflow-x-hidden">
        <div class="bg-gray-900 text-white p-4 rounded-lg shadow-md">
        <h1>Absen Hadir</h1>
        
        <div id="alert-lokasi" class="alert alert-danger d-none">
            Anda berada di luar area absensi.
        </div>
        
        <script>
            function tampilkanAlert() {
                document.getElementById('alert-lokasi').classList.remove('d-none');
            }
        </script>
        
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    
        <form action="{{ route('karyawan.absen.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
    
            <!-- Input Lokasi -->
            <div class="form-group mb-3">
                <label for="lokasi">Lokasi</label>
                <input type="text" name="lokasi" id="lokasi" class="form-control" required>
            </div>
    
            <!-- Kamera -->
            <div class="form-group mb-3">
                <label>Ambil Foto</label>
                <video id="video" width="320" height="240" autoplay></video>
                <button type="button" id="captureBtn" class="btn btn-secondary">Ambil Foto</button>
                <canvas id="canvas" width="320" height="240" style="display: none;"></canvas>
                <input type="hidden" name="foto" id="fotoInput">
            </div>
    
            <button type="submit" class="btn btn-primary">Simpan Absen</button>
        </form>
    </div>
</div>
    <script>
        // Ambil lokasi otomatis
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                document.getElementById('lokasi').value = position.coords.latitude + ', ' + position.coords.longitude;
            });
        } else {
            alert('Geolocation tidak didukung di browser Anda.');
        }
    
        // Akses Kamera dan Ambil Foto
        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');
        const captureBtn = document.getElementById('captureBtn');
        const fotoInput = document.getElementById('fotoInput');
    
        navigator.mediaDevices.getUserMedia({ video: true })
            .then((stream) => {
                video.srcObject = stream;
            })
            .catch((error) => {
                console.error("Gagal mengakses kamera:", error);
            });
    
        captureBtn.addEventListener('click', function () {
            const context = canvas.getContext('2d');
            context.drawImage(video, 0, 0, 320, 240);
            const imageData = canvas.toDataURL('image/png');
            fotoInput.value = imageData; // Simpan ke input hidden
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const absenBtn = document.querySelector("button[type='submit']");
            const lokasiInput = document.getElementById('lokasi');
            
            const titikAbsen = { lat: -6.610085340619139, lng: 106.76667964842298 }; // Koordinat yang ditentukan
            const radiusMaksimum = 10000; // Radius dalam meter
    
            // Fungsi untuk menghitung jarak antara dua koordinat
            function hitungJarak(lat1, lon1, lat2, lon2) {
                const R = 6371e3; // Radius bumi dalam meter
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
    
            // Ambil lokasi pengguna
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    function (position) {
                        const userLat = position.coords.latitude;
                        const userLng = position.coords.longitude;
                        lokasiInput.value = `${userLat}, ${userLng}`;
    
                        const jarak = hitungJarak(userLat, userLng, titikAbsen.lat, titikAbsen.lng);
                        
                        if (jarak > radiusMaksimum) {
                            alert("Anda berada di luar area absensi. Jarak Anda: " + jarak.toFixed(2) + " meter.");
                            absenBtn.disabled = true;
                        } else {
                            absenBtn.disabled = false;
                        }
                    },
                    function (error) {
                        alert("Gagal mendapatkan lokasi. Aktifkan GPS dan coba lagi.");
                        absenBtn.disabled = true;
                    }
                );
            } else {
                alert("Perangkat Anda tidak mendukung geolokasi.");
                absenBtn.disabled = true;
            }
        });
    </script>
    
    </x-layout-karyawan>
    