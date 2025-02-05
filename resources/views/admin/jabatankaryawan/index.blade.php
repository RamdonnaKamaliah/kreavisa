<x-layout-admin>
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h4 text-secondary">Jabatan Karyawan</h1>
            <a href="{{ route('jabatankaryawan.create') }}" class="btn btn-primary">
                + Tambah Data
            </a>

        </div>
        <!-- Membungkus tabel dengan class table-responsive untuk membuatnya responsif -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="myTable">
                <thead class="table-dark text-white">
                    <tr>
                        <th class="text-start">Nama Jabatan</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Contoh data statis -->
                    <tr>
                        <td>Live</td>
                        <td class="text-center">
                            <div class="d-flex flex-wrap justify-content-center gap-2">
                                <a href="#" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye"></i> <span class="d-none d-sm-inline">View</span>
                                </a>
                                <button class="btn btn-sm btn-outline-danger">
                                    <i class="fas fa-trash-alt"></i> <span class="d-none d-sm-inline">Hapus</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Gudang</td>
                        <td class="text-center">
                            <div class="d-flex flex-wrap justify-content-center gap-2">
                                <a href="#" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye"></i> <span class="d-none d-sm-inline">View</span>
                                </a>
                                <button class="btn btn-sm btn-outline-danger">
                                    <i class="fas fa-trash-alt"></i> <span class="d-none d-sm-inline">Hapus</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Admin</td>
                        <td class="text-center">
                            <div class="d-flex flex-wrap justify-content-center gap-2">
                                <a href="#" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye"></i> <span class="d-none d-sm-inline">View</span>
                                </a>
                                <button class="btn btn-sm btn-outline-danger">
                                    <i class="fas fa-trash-alt"></i> <span class="d-none d-sm-inline">Hapus</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Packing</td>
                        <td class="text-center">
                            <div class="d-flex flex-wrap justify-content-center gap-2">
                                <a href="#" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye"></i> <span class="d-none d-sm-inline">View</span>
                                </a>
                                <button class="btn btn-sm btn-outline-danger">
                                    <i class="fas fa-trash-alt"></i> <span class="d-none d-sm-inline">Hapus</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</x-layout-admin>
