@extends('layout.main')
@section('content')
    <div id="layoutSidenav_content">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <main class="flex justify-center py-6 p-6">
            <div class="w-full max-w-4xl"> <!-- Perluas lebar form agar muat 3 kolom -->
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <div class="mb-4">
                        <a href="{{ route('datakaryawan.index') }}" class="text-blue-600 hover:text-blue-800">
                            <i class='bx bx-arrow-back text-2xl'></i>
                        </a>
                    </div>

                    <h1 class="text-center text-2xl font-bold text-gray-700 mb-6">Create Data Karyawan</h1>
                    <form action="{{ route('datakaryawan.store') }}" method="POST" enctype="multipart/form-data"
                        class="space-y-4">
                        @csrf

                        <div class="text-center">
                            <label for="foto" class="cursor-pointer inline-block">
                                <img id="preview" src="{{ asset('asset-landing-page/img/profile.png') }}"
                                    alt="Upload Foto" class="w-24 h-24 rounded-full object-cover border border-gray-300">
                            </label>
                            <input type="file" id="foto" name="foto" accept="image/*" class="hidden"
                                onchange="previewImage(event)">
                            <p class="text-sm text-gray-600 mt-2">Upload Foto</p>
                            @error('foto')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4"> <!-- Ubah grid jadi 3 kolom -->
                            <div class="space-y-4">
                                <label for="nama_lengkap" class="block text-gray-700 font-medium">Nama Lengkap</label>
                                <input type="text" id="nama_lengkap" name="nama_lengkap" placeholder="Input Nama Lengkap"
                                    class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-400" required>
                            </div>

                            <div class="space-y-4">
                                <label for="name" class="block text-gray-700 font-medium">Username</label>
                                <input type="text" id="name" name="name" placeholder="Input Username"
                                    class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-400" required>
                            </div>

                            <div class="space-y-4">
                                <label for="gender" class="block text-gray-700 font-medium">Gender</label>
                                <select id="gender" name="gender"
                                    class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-400" required>
                                    <option value="" disabled selected>Pilih Gender</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>

                            <div class="space-y-4">
                                <label for="email" class="block text-gray-700 font-medium">Email</label>
                                <input name="email" type="email" id="email" placeholder="Input Email"
                                    class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-400">
                            </div>

                            <div class="space-y-4">
                                <label for="phone" class="block text-gray-700 font-medium">No Telpon</label>
                                <input name="no_telepon" type="tel" id="phone" placeholder="Input No Telpon"
                                    class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-400">
                            </div>

                            <div class="space-y-4">
                                <label for="position" class="block text-gray-700 font-medium">Jabatan</label>
                                <select name="jabatan_id" id="position"
                                    class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-400" required>
                                    @foreach ($jabatanKaryawan as $row)
                                        <option value="{{ $row->id }}">{{ $row->nama_jabatan }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="md:col-span-3 space-y-4">
                                <label for="dob" class="block text-gray-700 font-medium">Tanggal Lahir</label>
                                <input name="tanggal_lahir" type="date" id="dob"
                                    class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-400">
                            </div>

                            <div class="md:col-span-3 space-y-4"> <!-- Usia diberi lebar penuh -->
                                <label for="age" class="block text-gray-700 font-medium">Umur</label>
                                <input name="usia" type="number" id="age"
                                    class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-400" readonly>
                            </div>
                        </div>

                        <div class="text-center mt-6">
                            <button type="submit"
                                class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition">Create</button>
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
                var output = document.getElementById('preview');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }

        document.getElementById('dob').addEventListener('change', function() {
            var dob = new Date(this.value);
            var today = new Date();
            var age = today.getFullYear() - dob.getFullYear();
            var monthDiff = today.getMonth() - dob.getMonth();
            var dayDiff = today.getDate() - dob.getDate();

            if (monthDiff < 0 || (monthDiff === 0 && dayDiff < 0)) {
                age--;
            }

            document.getElementById('age').value = age;
        });
    </script>
@endsection
