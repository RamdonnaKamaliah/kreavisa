@extends('layout2.karyawan')
@section('content')
    @push('page-title')
        Edit Profile
    @endpush
    <div class="max-w-4xl mx-auto py-8 px-6 bg-white rounded-2xl shadow-2xl md:mr-20 mt-10 border border-gray-300">
        <!-- Back Button -->
        <div class="mb-4">
            <a href="{{ route('profile.index') }}" class="text-blue-600 hover:text-blue-800 flex items-center">
                <i class="fas fa-arrow-left mr-2"></i>
            </a>
        </div>

        @if(session('success'))
    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
        {{ session('error') }}
    </div>
@endif

@if($errors->any())
    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="flex flex-wrap items-center gap-6 mb-8">
                <div class="w-32 h-32 rounded-full flex items-center justify-center shadow-lg overflow-hidden relative">
                    @php
                        $fotoPath = $user->foto;
                        
                        if (strpos($fotoPath, 'uploads/datakaryawan/') !== false) {
                            $photoUrl = asset($fotoPath);
                        } 
                        elseif (!empty($fotoPath)) {
                            $photoUrl = asset('uploads/datakaryawan/' . $fotoPath);
                        } 
                        else {
                            $photoUrl = asset('asset-landing-page/img/profile.png');
                        }
                        
                        $photoUrl .= '?v=' . time();
                    @endphp
                    
                    <img id="profileImage" src="{{ $photoUrl }}" alt="Foto Karyawan" class="w-full h-full object-cover">
                </div>
                <div class="flex-1 min-w-[200px]">
                    <div class="mb-4">
                        <label for="foto" class="block text-gray-600 font-medium mb-2">Foto Profil</label>
                        <div class="flex items-center gap-3 flex-wrap">
                            <label class="cursor-pointer">
                                <span class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:opacity-90 transition duration-300 shadow-lg inline-flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    Pilih Foto
                                </span>
                                <input type="file" id="foto" name="foto" class="hidden" accept="image/*">
                            </label>
                            <button type="button" id="cancelUpload" class="hidden bg-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-400 transition duration-300 shadow-lg inline-flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                                Batal
                            </button>
                            <span id="fileName" class="text-gray-600 text-sm"></span>
                        </div>
                        @error('foto')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="nama_lengkap" class="block text-gray-600 font-medium">Nama Lengkap</label>
                    <input type="text" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap', $user->nama_lengkap) }}"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('nama_lengkap')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="name" class="block text-gray-600 font-medium">Username</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="email" class="block text-gray-600 font-medium">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="no_telepon" class="block text-gray-600 font-medium">No Telepon</label>
                    <input type="text" id="no_telepon" name="no_telepon" value="{{ old('no_telepon', $user->no_telepon) }}"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('no_telepon')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="gender" class="block text-gray-600 font-medium">Gender</label>
                    <select id="gender" name="gender" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                        <option value="Laki-laki" {{ old('gender', $user->gender) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ old('gender', $user->gender) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('gender')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="tanggal_lahir" class="block text-gray-600 font-medium">Tanggal Lahir</label>
                    <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir', $user->tanggal_lahir) }}"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('tanggal_lahir')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="usia" class="block text-gray-600 font-medium">Usia</label>
                    <input type="number" id="usia" name="usia" value="{{ old('usia', $user->usia) }}"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" readonly>
                    @error('usia')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Password Reset Section -->
            <div class="mt-8 border-t pt-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Reset Password</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label for="current_password" class="block text-gray-600 font-medium">Password Saat Ini</label>
                        <input type="password" id="current_password" name="current_password"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('current_password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="password" class="block text-gray-600 font-medium">Password Baru</label>
                        <input type="password" id="password" name="password"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="password_confirmation" class="block text-gray-600 font-medium">Konfirmasi Password Baru</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
            </div>

            <div class="mt-8 flex justify-end gap-4">
                <a href="{{ route('profile.index') }}"
                    class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400 transition duration-300 shadow-lg">Batal</a>
                <button type="submit"
                    class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:opacity-90 transition duration-300 shadow-lg">Simpan Perubahan</button>
            </div>
        </form>
    </div>

    <script>
        // Improved image upload handling
        const fileInput = document.getElementById('foto');
        const profileImage = document.getElementById('profileImage');
        const fileName = document.getElementById('fileName');
        const cancelUpload = document.getElementById('cancelUpload');
        let originalImageSrc = profileImage.src;

        fileInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                // Show file name
                fileName.textContent = file.name;
                
                // Show cancel button
                cancelUpload.classList.remove('hidden');
                
                // Preview image
                const reader = new FileReader();
                reader.onload = function(e) {
                    profileImage.src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });

        // Cancel upload functionality
        cancelUpload.addEventListener('click', function() {
            fileInput.value = ''; // Clear file input
            profileImage.src = originalImageSrc; // Revert to original image
            fileName.textContent = ''; // Clear file name
            cancelUpload.classList.add('hidden');
        });

        // Calculate age based on birth date
        document.getElementById('tanggal_lahir').addEventListener('change', function() {
            const birthDate = new Date(this.value);
            const today = new Date();
            let age = today.getFullYear() - birthDate.getFullYear();
            const monthDiff = today.getMonth() - birthDate.getMonth();
            
            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }
            
            document.getElementById('usia').value = age;
        });
    </script>
@endsection
