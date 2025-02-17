<x-layout-admin>
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
        <main>
            <div class="container">
                <h1 class="text-center my-4">Edit Data Karyawan</h1>

                <div class="card mx-auto shadow p-4" style="max-width: 800px;">
                    <form action="{{ route('datakaryawan.update', $karyawan->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Upload Foto -->
                        <div class="text-center mb-4">
                            <label for="foto" class="d-block">
                                <img id="preview" src="{{ asset($karyawan->foto ?? 'asset-landing-admin/img/profile.png') }}"
                                     alt="Upload Foto" class="rounded-circle shadow" 
                                     style="width: 100px; height: 100px; cursor: pointer;">
                            </label>
                            <input type="file" id="foto" name="foto" accept="image/*" class="d-none" onchange="previewImage(event)">
                            <p class="text-muted mt-2">Klik foto untuk mengunggah ulang (Opsional)</p>
                            @error('foto')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="row g-3">
                            <!-- Nama -->
                            <div class="col-md-6">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" id="name" name="name" class="form-control rounded-pill" value="{{ old('name', $karyawan->name) }}" required>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Tanggal Lahir -->
                            <div class="col-md-6">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control rounded-pill" value="{{ old('tanggal_lahir', $karyawan->tanggal_lahir) }}" required>
                                @error('tanggal_lahir')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" name="email" class="form-control rounded-pill" value="{{ old('email', $karyawan->email) }}" required>
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- No Telepon -->
                            <div class="col-md-6">
                                <label for="no_telepon" class="form-label">No Telepon</label>
                                <input type="tel" id="no_telepon" name="no_telepon" class="form-control rounded-pill" value="{{ old('no_telepon', $karyawan->no_telepon) }}" required>
                                @error('no_telepon')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                           

                            <!-- Usia -->
                            <div class="col-md-6">
                                <label for="usia" class="form-label">Usia</label>
                                <input type="number" id="usia" name="usia" class="form-control rounded-pill" value="{{ old('usia', $karyawan->usia) }}" required>
                                @error('usia')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            

                            

                            <!-- Jabatan -->
                            <div class="col-md-6">
                                <label for="jabatan_id" class="form-label">Jabatan</label>
                                <select name="jabatan_id" id="jabatan_id" class="form-control rounded-pill" required>
                                    @foreach($jabatanKaryawan as $row)
                                        <option value="{{ $row->id }}" {{ $karyawan->jabatan_id == $row->id ? 'selected' : '' }}>
                                            {{ $row->nama_jabatan }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('jabatan_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Gender -->
                            <div class="col-md-6">
                                <label for="gender" class="form-label">Gender</label>
                                <select id="gender" name="gender" class="form-control rounded-pill" required>
                                    <option value="Laki-laki" {{ $karyawan->gender == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ $karyawan->gender == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('gender')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary w-100">Simpan Perubahan</button>
                        </div>
                    </form>
                    
                    <div class="text-center mt-3">
                        <a href="{{ route('datakaryawan.index') }}" class="btn btn-link">Kembali</a>
                    </div>
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
    </script>
    <script>
        function togglePassword() {
            var passwordInput = document.getElementById("password");
            var toggleIcon = document.getElementById("toggleIcon");
    
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                toggleIcon.classList.remove("bi-eye-slash");
                toggleIcon.classList.add("bi-eye");
            } else {
                passwordInput.type = "password";
                toggleIcon.classList.remove("bi-eye");
                toggleIcon.classList.add("bi-eye-slash");
            }
        }
    </script>
</x-layout-admin>
