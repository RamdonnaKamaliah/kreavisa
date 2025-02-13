<x-layout-admin>
    <div id="layoutSidenav_content">
        <main class="d-flex justify-content-center align-items-center" style="min-height: 100vh; padding-top: 2px;">
            <div class="card mx-auto shadow p-4" style="max-width: 600px; background-color: #f8f9fa; border-radius: 12px;">
                <div class="container">
                    <h1 class="text-center my-4" style="font-family: 'Arial', sans-serif; color: #333; padding-top: 10px;">
                        View Data Karyawan
                    </h1>

                    <!-- Foto Karyawan -->
                    <div class="text-center">
                        @if ($datakaryawan->foto)
                            <img src="{{ asset($datakaryawan->foto) }}" class="rounded-circle shadow" alt="Foto Karyawan"
                                style="width: 120px; height: 120px; object-fit: cover;">
                        @else
                            <img src="{{ asset('asset-landing-admin/img/profile.png') }}" class="rounded-circle shadow" alt="Default Foto"
                                style="width: 120px; height: 120px; object-fit: cover;">
                        @endif
                    </div>

                    <div class="row g-3">
                        <!-- Nama Karyawan -->
                        <div class="col-12">
                            <strong>Nama:</strong>
                            <p>{{ $datakaryawan->name }}</p>
                        </div>
                        
                        <!-- Jabatan -->
                        <div class="col-12">
                            <strong>Jabatan:</strong>
                            <p>{{ $datakaryawan->jabatan->nama_jabatan ?? '-' }}</p>

                        </div>
                        
                        <!-- Email -->
                        <div class="col-12">
                            <strong>Email:</strong>
                            <p>{{ $datakaryawan->email }}</p>
                        </div>

                        <!-- No Telepon -->
                        <div class="col-12">
                            <strong>No Telepon:</strong>
                            <p>{{ $datakaryawan->no_telepon }}</p>
                        </div>

                        <!-- Gender -->
                        <div class="col-12">
                            <strong>Gender:</strong>
                            <p>{{ $datakaryawan->gender }}</p>
                        </div>

                        <!-- Usia -->
                        <div class="col-12">
                            <strong>Usia:</strong>
                            <p>{{ $datakaryawan->usia }} tahun</p>
                        </div>

                    </div>
                    <a href="{{ route('datakaryawan.index') }}" class="btn btn-modern mt-4" style="background-color: #000000; color: white;">Back to List</a>
                </div>
            </div>
        </main>
    </div>
</x-layout-admin>
