<x-layout-admin>
    <div id="layoutSidenav_content">
        <main>
            <div class="container">
                <h1 class="text-center my-4" style="font-family: 'Arial', sans-serif; color: #333;">
                    Create Data Karyawan
                </h1>

                <!-- Card Container -->
                <div class="card mx-auto shadow p-4"
                    style="max-width: 800px; background-color: #f8f9fa; border-radius: 12px;">

                    <!-- Upload Foto -->
                    <div class="text-center mb-4">
                        <label for="photoUpload" class="d-block">
                            <img src="{{ asset('asset-landing-admin/img/profile1.jpeg') }}" alt="Upload Foto"
                                class="rounded-circle shadow" style="width: 100px; height: 100px; cursor: pointer;">
                        </label>
                        <input type="file" id="photoUpload" name="photo" class="d-none">
                        <p class="text-muted mt-2">Upload Foto</p>
                    </div>

                    <!-- Form -->
                    <form action="#" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row g-3">
                            <!-- Nama -->
                            <div class="col-md-6">
                                <label for="name" class="form-label fw-bold">Nama</label>
                                <input type="text" id="name" name="name" placeholder="Input Nama"
                                    class="form-control rounded-pill" required>
                            </div>

                            <!-- Tanggal Lahir !-->
                            <div class="col-md-6">
                                <label for="dob" class="form-label">Tanggal Lahir</label>
                                <input type="date" id="dob" class="form-control rounded-pill">
                            </div>

                            <!-- Email !-->
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" placeholder="Input Email"
                                    class="form-control rounded-pill">
                            </div>

                            <!-- NO Telpon !-->
                            <div class="col-md-6">
                                <label for="phone" class="form-label">No Telpon</label>
                                <input type="tel" id="phone" placeholder="Input No Telpon"
                                    class="form-control rounded-pill">
                            </div>

                            <!-- password -->
                            <div class="col-md-6">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" id="password" placeholder="Input Password"
                                    class="form-control rounded-pill">
                            </div>

                            <!-- Umur -->
                            <div class="col-md-6">
                                <label for="age" class="form-label">Umur</label>
                                <input type="number" id="age" name="age" placeholder="Input Umur"
                                    class="form-control rounded-pill" required>
                            </div>

                            <!-- jabatan -->
                            <div class="col-md-6">
                                <label for="position" class="form-label">Jabatan</label>
                                <input type="text" id="position" name="position" placeholder="Input jabatan"
                                    class="form-control rounded-pill" required>
                            </div>

                            <!-- Gender -->
                            <div class="col-md-6">
                                <label for="gender" class="form-label">Gender</label>
                                <select id="gender" name="gender" class="form-control rounded-pill" required>
                                    <option value="" disabled selected>Pilih Gender</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>

                        <!-- Submit Button -->
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
</x-layout-admin>
