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
            
            <!-- Judul Absen Izin di tengah -->
            <h1 class="text-2xl font-semibold text-gray-800 mb-6 text-center dark:text-white">Absen Izin</h1>

            @if ($errors->has('file'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded">
                    <p class="font-bold">Perhatian!</p>
                    <p>Ukuran file maksimal 5MB. Format yang diterima: JPG, PNG, PDF</p>
                </div>
            @endif


            <form action="{{ route('karyawan.absen.izin.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="lokasi" id="lokasi">

                <!-- Upload Bukti Izin Section -->
                <div class="mb-8">
                    <label class="block text-gray-700 text-sm font-medium mb-4 text-center dark:text-gray-300">Upload Bukti Izin</label>
                    
                    <div class="flex flex-col items-center space-y-4">
                        <!-- File Upload Area -->
                        <div class="w-full max-w-xs">
                            <label for="file" class="flex flex-col items-center justify-center w-full h-40 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition duration-200">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <i class="fas fa-file-alt text-3xl text-gray-400 mb-2"></i>
                                    <p class="mb-2 text-sm text-gray-500 text-center">
                                        <span class="font-semibold">Klik untuk upload</span><br>
                                        atau drag and drop file
                                    </p>
                                    <p class="text-xs text-gray-500">
                                        Format: JPG, PNG, PDF (Max: 5MB)
                                    </p>
                                </div>
                                <input id="file" name="file" type="file" class="hidden" accept=".jpg,.png,.pdf" required>
                            </label>
                        </div>
                        
                        <!-- File Preview -->
                        <div id="filePreview" class="hidden w-full max-w-xs">
                            <div class="border border-gray-200 rounded-lg p-3 flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-file text-blue-500 text-xl"></i>
                                    <div>
                                        <p id="fileName" class="text-sm font-medium text-gray-700 truncate dark:text-white"></p>
                                        <p id="fileSize" class="text-xs text-gray-500 dark:text-white"></p>
                                    </div>
                                </div>
                                <button type="button" id="removeFile" class="text-red-500 hover:text-red-700">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
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
        // File Upload Preview
        const fileInput = document.getElementById('file');
        const filePreview = document.getElementById('filePreview');
        const fileName = document.getElementById('fileName');
        const fileSize = document.getElementById('fileSize');
        const removeFileBtn = document.getElementById('removeFile');

        fileInput.addEventListener('change', function(e) {
            if (this.files && this.files[0]) {
                const file = this.files[0];
                
                // Validate file size (max 5MB)
                if (file.size > 5 * 1024 * 1024) {
                    Swal.fire({
                        icon: "error",
                        title: "File terlalu besar",
                        text: "Ukuran file maksimal 5MB",
                        confirmButtonColor: "#3b82f6"
                    });
                    this.value = '';
                    return;
                }
                
                // Validate file type
                const validTypes = ['image/jpeg', 'image/png', 'application/pdf'];
                if (!validTypes.includes(file.type)) {
                    Swal.fire({
                        icon: "error",
                        title: "Format file tidak valid",
                        text: "Hanya menerima file JPG, PNG, atau PDF",
                        confirmButtonColor: "#3b82f6"
                    });
                    this.value = '';
                    return;
                }
                
                // Show preview
                fileName.textContent = file.name;
                fileSize.textContent = formatFileSize(file.size);
                filePreview.classList.remove('hidden');
            }
        });

        removeFileBtn.addEventListener('click', function() {
            fileInput.value = '';
            filePreview.classList.add('hidden');
        });

        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }

        // Geolocation
        document.addEventListener("DOMContentLoaded", function() {
            const lokasiInput = document.getElementById('lokasi');
            
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        const userLat = position.coords.latitude;
                        const userLng = position.coords.longitude;
                        lokasiInput.value = `${userLat}, ${userLng}`;
                    },
                    function(error) {
                        console.error("Error getting location:", error);
                        lokasiInput.value = "Lokasi tidak tersedia";
                    }
                );
            } else {
                lokasiInput.value = "Geolocation tidak didukung";
            }
        });
    </script>
@endsection