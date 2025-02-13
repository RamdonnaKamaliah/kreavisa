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
                <h1 class="text-center my-4" style="font-family: 'Arial', sans-serif; color: #333;">
                    Create Data Karyawan
                </h1>

                <div class="card mx-auto shadow p-4" style="max-width: 800px; background-color: #f8f9fa; border-radius: 12px;">

                    <form action="{{ route('datakaryawan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Upload Foto -->
                        <div class="text-center mb-4">
                            <label for="foto" class="d-block">
                                <img id="preview" src="{{ asset('asset-landing-admin/img/profile.png') }}" alt="Upload Foto"
                                    class="rounded-circle shadow" style="width: 100px; height: 100px; cursor: pointer;">
                            </label>
                            <input type="file" id="foto" name="foto" accept="image/*" class="d-none"  onchange="previewImage(event)">
                            <p class="text-muted mt-2">Upload Foto</p>
                            @error('foto')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label fw-bold">Nama</label>
                                <input type="text" id="name" name="name" placeholder="Input Nama"
                                    class="form-control rounded-pill" required>
                            </div>

                            <div class="col-md-6">
                                <label for="dob" class="form-label">Tanggal Lahir</label>
                                <input name="tanggal_lahir" type="date" id="dob" class="form-control rounded-pill">
                            </div>

                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input name="email" type="email" id="email" placeholder="Input Email"
                                    class="form-control rounded-pill">
                            </div>

                            <div class="col-md-6">
                                <label for="phone" class="form-label">No Telpon</label>
                                <input name="no_telepon" type="tel" id="phone" placeholder="Input No Telpon"
                                    class="form-control rounded-pill">
                            </div>

                            <div class="col-md-6">
                                <label for="password" class="form-label">Create Password</label>
                                <div class="input-group">
                                    <input name="password" type="password" id="password" placeholder="Input Password"
                                        class="form-control rounded-pill" required>
                                    <button type="button" class="btn btn-outline-secondary rounded-pill ms-2" onclick="togglePassword()">
                                        <i type="button" id="toggleIcon" onclick="togglePassword()"  class="fa-solid fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="age" class="form-label">Umur</label>
                                <input name="usia" type="number" id="age" placeholder="Input Umur"
                                    class="form-control rounded-pill" required>
                            </div>
                            

                            <div class="col-md-6">
                                <label for="position" class="form-label">Jabatan</label>
                                <select name="jabatan_id" id="position" class="form-control rounded-pill" required>
                                @foreach($jabatanKaryawan as $row)
                                    <option value="{{ $row->id }}">{{ $row->nama_jabatan }}</option>
                                @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="gender" class="form-label">Gender</label>
                                <select id="gender" name="gender" class="form-control rounded-pill" required>
                                    <option value="" disabled selected>Pilih Gender</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary w-100">Create</button>
                        </div>
                    </form>
                    <div class="text-center mt-3">
                        <a href="{{ route('datakaryawan.index') }}" class="btn btn-link text-primary">Back to list</a>
                    </div>
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
