<x-layout-admin>
    <div id="layoutSidenav_content">
        <!-- Card Container -->
        <main class="d-flex justify-content-center align-items-center" style="min-height: 100vh; padding-top: 2px;">
            <!-- Card Container -->
            <div class="card mx-auto shadow p-4"
                style="max-width: 600px; background-color: #f8f9fa; border-radius: 12px;">
                <div class="container">
                    <h1 class="text-center my-4"
                        style="font-family: 'Arial', sans-serif; color: #333; padding-top: 10px;">
                        Edit Jabatan Karyawan
                    </h1>

                    <!-- Form -->
                    <form action="{{ route('jabatankaryawan.update', $jabatan->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row g-3">
                            <!-- Nama Jabatan -->
                            <div class="col-12">
                                <label for="nama_jabatan" class="form-label fw-bold">Nama Jabatan</label>
                                <input type="text" id="nama_jabatan" name="nama_jabatan" 
                                    placeholder="Input Nama Jabatan" 
                                    value="{{ old('nama_jabatan', $jabatan->nama_jabatan) }}"
                                    class="form-control rounded-pill" required>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary w-100">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</x-layout-admin>
