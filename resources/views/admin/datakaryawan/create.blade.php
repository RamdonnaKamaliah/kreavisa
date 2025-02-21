<x-layout-admin>
    <div class="p-6 md:ml-32">
        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 rounded-md">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif  
        <main>
            <div class="container mx-auto">

                <div class="bg-white shadow-lg rounded-lg p-6 max-w-2xl mx-auto">
                    <!-- Container untuk tombol kembali dan judul -->
                    <div class="flex items-center mb-4">
                        <!-- Ikon Kembali -->
                        <a href="{{ route('datakaryawan.index') }}"
                            class="text-blue-500 hover:text-blue-600 text-2xl flex items-center mr-4">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                        <!-- Judul tetap di tengah -->
                        <h1 class="text-2xl font-bold flex-1 text-center">Create Data Karyawan</h1>
                    </div>

                    <form action="{{ route('datakaryawan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Upload Foto -->
                        <div class="text-center mb-4">
                            <label for="foto" class="block cursor-pointer">
                                <img id="preview" src="{{ asset('asset-landing-admin/img/profile.png') }}"
                                    alt="Upload Foto" class="w-24 h-24 rounded-full shadow-md mx-auto">
                            </label>
                            <input type="file" id="foto" name="foto" accept="image/*" class="hidden"
                                onchange="previewImage(event)">
                            <p class="text-gray-500 mt-2">Klik foto untuk mengunggah</p>
                            @error('foto')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Nama -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                                <input type="text" id="name" name="name" placeholder="Input Nama"
                                    class="w-full px-4 py-2 border rounded-md" required>
                                @error('name')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Tanggal Lahir -->
                            <div>
                                <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700">Tanggal
                                    Lahir</label>
                                <input type="date" id="tanggal_lahir" name="tanggal_lahir"
                                    class="w-full px-4 py-2 border rounded-md" required>
                                @error('tanggal_lahir')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" id="email" name="email" placeholder="Input Email"
                                    class="w-full px-4 py-2 border rounded-md" required>
                                @error('email')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- No Telepon -->
                            <div>
                                <label for="no_telepon" class="block text-sm font-medium text-gray-700">No
                                    Telepon</label>
                                <input type="tel" id="no_telepon" name="no_telepon" placeholder="Input No Telpon"
                                    class="w-full px-4 py-2 border rounded-md" required>
                                @error('no_telepon')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Jabatan -->
                            <div>
                                <label for="jabatan_id" class="block text-sm font-medium text-gray-700">Jabatan</label>
                                <select name="jabatan_id" id="jabatan_id" class="w-full px-4 py-2 border rounded-md"
                                    required>
                                    @foreach ($jabatanKaryawan as $row)
                                        <option value="{{ $row->id }}">{{ $row->nama_jabatan }}</option>
                                    @endforeach
                                </select>
                                @error('jabatan_id')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Gender -->
                            <div>
                                <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                                <select id="gender" name="gender" class="w-full px-4 py-2 border rounded-md"
                                    required>
                                    <option value="" disabled selected>Pilih Gender</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                                @error('gender')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Usia -->
                        <div>
                            <label for="usia" class="block text-sm font-medium text-gray-700">Usia</label>
                            <input type="number" id="usia" name="usia"
                                class="w-full px-4 py-2 border rounded-md" readonly>
                            @error('usia')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <button type="submit"
                                class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>

    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                document.getElementById('preview').src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }

        document.getElementById('tanggal_lahir').addEventListener('change', function() {
            var dob = new Date(this.value);
            var today = new Date();
            var age = today.getFullYear() - dob.getFullYear();
            var monthDiff = today.getMonth() - dob.getMonth();
            var dayDiff = today.getDate() - dob.getDate();

            if (monthDiff < 0 || (monthDiff === 0 && dayDiff < 0)) {
                age--;
            }

            document.getElementById('usia').value = age;
        });
    </script>
</x-layout-admin>
