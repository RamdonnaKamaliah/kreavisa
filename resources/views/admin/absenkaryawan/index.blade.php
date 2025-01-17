<x-layout-admin>
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h4 text-secondary">Absensi Karyawan</h2>
            {{-- <a href="{{ route('absenkaryawan.create') }}" class="btn btn-primary">
                + Tambah Data
            </a> --}}

        </div>
        <!-- Membungkus tabel dengan class table-responsive untuk membuatnya responsif -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="myTable">
                <thead class="table-dark text-white">
                    <tr>
                        <th class="text-start">Nama</th>
                        <th class="text-start">Keterangan</th>
                        <th class="text-start">Foto</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Contoh data statis -->
                    <tr>
                        <td>Rizky</td>
                        <td>Hadir</td>
                        <td>
                            <img src="{{ asset('asset-landing-admin/img/profile1.jpeg') }}" class="rounded-circle me-2"
                                alt="Foto Profil" style="width: 50px; height: 50px; object-fit: cover;">
                        </td>
                        <td class="text-center">
                            <div class="d-flex flex-wrap justify-content-center gap-2">
                                <!-- Cek Profile Button -->
                                <a href="#" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye"></i> <span class="d-none d-sm-inline">View</span>
                                </a>

                                <!-- Hapus Button -->
                                <button class="btn btn-sm btn-outline-danger">
                                    <i class="fas fa-trash-alt"></i> <span class="d-none d-sm-inline">Hapus</span>
                                </button>
                            </div>

                        </td>
                    </tr>
                    <!-- Tambahkan data lainnya di sini -->
                </tbody>
            </table>
        </div>
    </div>
</x-layout-admin>
