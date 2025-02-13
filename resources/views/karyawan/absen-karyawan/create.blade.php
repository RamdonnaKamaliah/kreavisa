<x-layout-karyawan>


    <main class="flex-grow flex justify-center items-center mt-[-10px] pt-10 pb-10">
        <div class="bg-[#343A40] p-8 rounded-xl shadow-lg text-center max-w-md relative w-full">
            <!-- Tombol Kembali -->
            <a href="{{ url()->previous() }}" class="absolute top-4 left-4 text-white hover:text-gray-300">
                <i class="fas fa-arrow-left text-2xl"></i>
            </a>

            <!-- Kamera & Preview Foto -->
            <div class="mb-6">
                <video id="video" autoplay class="w-40 h-40 mx-auto rounded-lg border-2 border-gray-600 mb-4"></video>
                <canvas id="canvas" class="hidden"></canvas>
                <img id="previewImage" class="w-40 h-40 mx-auto rounded-lg border-2 border-gray-600 mb-4 hidden">
                <button onclick="takePhoto()"
                    class="bg-black text-white px-4 py-2 rounded-lg flex items-center justify-center space-x-2 mx-auto">
                    <span>Ambil Foto</span>
                    <i class="fas fa-camera"></i>
                </button>
            </div>

            <!-- Keterangan (Dropdown dengan Panah) -->
            <div class="mb-6 relative">
                <label for="keterangan" class="block text-white mb-2 text-left">Keterangan:</label>
                <div class="relative">
                    <select name="keterangan" id="keterangan"
                        class="w-full bg-gray-700 text-white rounded-lg px-4 py-2 appearance-none focus:outline-none">
                        <option value="hadir">Hadir</option>
                        <option value="sakit">Sakit</option>
                        <option value="izin">Izin</option>
                    </select>
                    <i class="fas fa-chevron-down absolute right-4 top-3 text-white"></i>
                </div>
            </div>

            <!-- Tombol Submit -->
            <div class="flex justify-end">
                <button type="submit"
                    class="bg-blue-500 text-white px-6 py-2 rounded-lg flex items-center space-x-2 hover:bg-blue-600 transition-all">
                    <span>Submit</span>
                    <i class="fas fa-check"></i>
                </button>
            </div>
        </div>
    </main>

    <script>
        // Menyalakan kamera saat halaman dimuat
        document.addEventListener("DOMContentLoaded", function() {
            const video = document.getElementById("video");

            navigator.mediaDevices.getUserMedia({
                    video: true
                })
                .then(function(stream) {
                    video.srcObject = stream;
                })
                .catch(function(error) {
                    console.error("Kamera tidak bisa diakses!", error);
                });
        });

        // Fungsi untuk mengambil foto
        function takePhoto() {
            const video = document.getElementById("video");
            const canvas = document.getElementById("canvas");
            const previewImage = document.getElementById("previewImage");

            const context = canvas.getContext("2d");
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;

            // Ambil gambar dari video
            context.drawImage(video, 0, 0, canvas.width, canvas.height);
            previewImage.src = canvas.toDataURL("image/png");

            // Tampilkan hasil foto & sembunyikan video
            previewImage.classList.remove("hidden");
            video.classList.add("hidden");
        }
    </script>
</x-layout-karyawan>
