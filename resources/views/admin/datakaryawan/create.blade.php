@extends('layout.main')
@section('page-title', 'Create Data Karyawan')
@section('content')
    <div id="layoutSidenav_content">
        <main class="flex justify-center py-6 p-6">
            <div class="w-full max-w-5xl space-y-6">
                <!-- Notifications -->
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                        role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                @if (session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif

                @if (session('import_errors'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <h4 class="font-bold">Error Import:</h4>
                        <ul class="list-disc list-inside">
                            @foreach (session('import_errors') as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Import Section with Different Background -->
                <div class="bg-white dark:bg-slate-800 p-6 rounded-lg shadow-lg">
                    <div class="flex items-center justify-between mb-4">
                        <!-- Tombol Back -->
                        <a href="{{ route('datakaryawan.index') }}" class="text-blue-600 hover:text-blue-800">
                            <i class='bx bx-arrow-back text-2xl'></i>
                        </a>

                        <!-- Judul di Tengah -->
                        <h2 class="text-xl font-semibold text-gray-700 dark:text-gray-300 text-center flex-1">
                            <div class="flex justify-center">
                                <i class='bx bx-import mr-2'></i>Import Data Karyawan
                            </div>
                        </h2>

                        <!-- Spacer untuk keseimbangan kanan -->
                        <div style="width: 2rem;"></div>
                    </div>

                    <form action="{{ route('datakaryawan.import') }}" method="POST" enctype="multipart/form-data"
                        class="space-y-4">
                        @csrf
                        <div>
                            <div
                                class="flex items-stretch rounded-lg border border-gray-300 dark:border-gray-600 overflow-hidden">
                                <!-- File input with custom styling -->
                                <label
                                    class="flex-1 cursor-pointer bg-gray-50 dark:bg-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 transition">
                                    <div class="px-4 py-2 flex items-center">
                                        <span class="text-sm text-gray-700 dark:text-gray-300 mr-2">Choose file</span>
                                        <span class="text-xs text-gray-500 dark:text-gray-400 truncate" id="file-name">No
                                            file chosen</span>
                                        <input type="file" name="file" class="hidden" required
                                            accept=".xlsx,.xls,.csv"
                                            onchange="document.getElementById('file-name').textContent = this.files[0]?.name || 'No file chosen'">
                                    </div>
                                </label>

                                <!-- Upload button -->
                                <button type="submit"
                                    class="bg-blue-700 text-white px-4 hover:bg-blue-500 transition flex items-center">
                                    <i class='bx bx-upload mr-1'></i> Upload
                                </button>
                            </div>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Format: .xlsx, .xls, atau .csv</p>

                            <script>
                                // Update file name display when file is selected
                                document.querySelector('input[type="file"]').addEventListener('change', function() {
                                    document.getElementById('file-name').textContent = this.files[0]?.name || 'No file chosen';
                                });
                            </script>
                        </div>

                        <div class="pt-2">
                            <a href="{{ asset('templates/template_import_karyawan.xlsx') }}" download
                                class="inline-flex items-center text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 text-sm">
                                <i class='bx bx-download text-lg mr-2'></i>
                                <span>Download Template Excel</span>
                            </a>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Gunakan template ini untuk format yang
                                benar</p>
                        </div>
                    </form>
                </div>

                <!-- Create Form Section with Different Background -->
                <div class="bg-white dark:bg-slate-800 p-6 rounded-lg shadow-lg">

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
                            <p class="text-sm text-gray-600 mt-2 dark:text-gray-300">Upload Foto</p>
                            @error('foto')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <!-- Column 1 -->
                            <div class="space-y-4">
                                <div>
                                    <label for="nama_lengkap"
                                        class="block text-gray-700 font-medium dark:text-gray-300">Nama Lengkap<span
                                            class="text-red-500">*</span></label>
                                    <input type="text" id="nama_lengkap" name="nama_lengkap"
                                        placeholder="Input Nama Lengkap" value="{{ old('nama_lengkap') }}"
                                        @class([
                                            'w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-400',
                                            'border-gray-300 focus:ring-blue-400 focus:border-blue-500' => !$errors->has(
                                                'nama_lengkap'),
                                            'border-2 border-red-500 focus:ring-red-400 focus:border-red-500' => $errors->has(
                                                'nama_lengkap'),
                                        ])>
                                    @error('nama_lengkap')
                                        <span class="text-red-600 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <label for="email"
                                        class="block text-gray-700 font-medium dark:text-gray-300">Email<span
                                            class="text-red-500">*</span></label>
                                    <input name="email" type="email" id="email" placeholder="Input Email"
                                        @class([
                                            'w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-400',
                                            'border-gray-300 focus:ring-blue-400 focus:border-blue-500' => !$errors->has(
                                                'email'),
                                            'border-2 border-red-500 focus:ring-red-400 focus:border-red-500' => $errors->has(
                                                'email'),
                                        ]) value="{{ old('email') }}">
                                    @error('email')
                                        <p class="text-red-600 text-sm">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="dob" class="block text-gray-700 font-medium dark:text-gray-300">Tanggal
                                        Lahir<span class="text-red-500">*</span></label>
                                    <input name="tanggal_lahir" type="date" id="dob" @class([
                                        'w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-400',
                                        'border-gray-300 focus:ring-blue-400 focus:border-blue-500' => !$errors->has(
                                            'tanggal_lahir'),
                                        'border-2 border-red-500 focus:ring-red-400 focus:border-red-500' => $errors->has(
                                            'tanggal_lahir'),
                                    ])
                                        value="{{ old('tanggal_lahir') }}">
                                    @error('tanggal_lahir')
                                        <p class="text-red-600 text-sm">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Column 2 -->
                            <div class="space-y-4">
                                <div>
                                    <label for="name"
                                        class="block text-gray-700 font-medium dark:text-gray-300">Username<span
                                            class="text-red-500">*</span></label>
                                    <input type="text" id="name" name="name" placeholder="Input Username"
                                        @class([
                                            'w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-400',
                                            'border-gray-300 focus:ring-blue-400 focus:border-blue-500' => !$errors->has(
                                                'name'),
                                            'border-2 border-red-500 focus:ring-red-400 focus:border-red-500' => $errors->has(
                                                'name'),
                                        ]) value="{{ old('name') }}">
                                    @error('name')
                                        <span class="text-red-600 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <label for="phone" class="block text-gray-700 font-medium dark:text-gray-300">No
                                        Telpon<span class="text-red-500">*</span></label>
                                    <input name="no_telepon" type="tel" id="phone" placeholder="Input No Telpon"
                                        @class([
                                            'w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-400',
                                            'border-gray-300 focus:ring-blue-400 focus:border-blue-500' => !$errors->has(
                                                'no_telepon'),
                                            'border-2 border-red-500 focus:ring-red-400 focus:border-red-500' => $errors->has(
                                                'no_telepon'),
                                        ]) value="{{ old('no_telepon') }}">
                                    @error('no_telepon')
                                        <p class="text-red-600 text-sm">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="age"
                                        class="block text-gray-700 font-medium dark:text-gray-300">Umur</label>
                                    <input name="usia" type="number" id="age"
                                        class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-400" readonly>
                                </div>
                            </div>

                            <!-- Column 3 -->
                            <div class="space-y-4">
                                <div>
                                    <label for="gender"
                                        class="block text-gray-700 font-medium dark:text-gray-300">Gender<span
                                            class="text-red-500">*</span></label>
                                    <select id="gender" name="gender" @class([
                                        'w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-400',
                                        'border-gray-300 focus:ring-blue-400 focus:border-blue-500' => !$errors->has(
                                            'gender'),
                                        'border-2 border-red-500 focus:ring-red-400 focus:border-red-500' => $errors->has(
                                            'gender'),
                                    ])>
                                        <option value="" disabled {{ old('gender') ? '' : 'selected' }}>Pilih Gender
                                        </option>
                                        <option value="Laki-laki" {{ old('gender') == 'Laki-laki' ? 'selected' : '' }}>
                                            Laki-laki</option>
                                        <option value="Perempuan" {{ old('gender') == 'Perempuan' ? 'selected' : '' }}>
                                            Perempuan</option>
                                    </select>

                                    {{-- Tampilkan pesan error --}}
                                    @error('gender')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="position"
                                        class="block text-gray-700 font-medium dark:text-gray-300">Jabatan<span
                                            class="text-red-500">*</span></label>
                                    <select name="jabatan_id" id="position" @class([
                                        'w-full p-3 rounded-lg border border-rounded-lg focus:ring-2 focus:ring-blue-400',
                                        'border-gray-300 focus:ring-blue-400 focus:border-blue-500' => !$errors->has(
                                            'jabatan_id'),
                                        'border-2 border-red-500 focus:ring-red-400 focus:border-red-500' => $errors->has(
                                            'jabatan_id'),
                                    ])>
                                        <option value="" disabled selected>Pilih Jabatan</option>
                                        @foreach ($jabatanKaryawan as $row)
                                            <option value="{{ $row->id }}"
                                                {{ old('jabatan_id', $stokBarang->jabatan_id ?? '') == $row->id ? 'selected' : '' }}>
                                                {{ $row->nama_jabatan }}
                                            </option>
                                        @endforeach
                                    </select>

                                    {{-- Tampilkan pesan error --}}
                                    @error('jabatan_id')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                            </div>
                        </div>

                        <div class="text-center mt-6">
                            <button type="submit"
                                class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition">
                                Simpan Data
                            </button>
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

            document.getElementById('age').value = age < 0 ? 0 : age;
        });
    </script>

@endsection
