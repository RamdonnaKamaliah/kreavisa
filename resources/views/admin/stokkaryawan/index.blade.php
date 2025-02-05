<x-layout-admin>
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h4 text-secondary">Data Stock</h1>
            {{-- <a href="{{ route('absenkaryawan.create') }}" class="btn btn-primary">
                + Tambah Data
            </a> --}}

        </div>
        <!-- Membungkus tabel dengan class table-responsive untuk membuatnya responsif -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="myTable">
                <thead class="table-dark text-white">
                    <tr>
                        <th class="text-start">Tanggal Masuk</th>
                        <th class="text-start">Kode Barang</th>
                        <th class="text-start">Nama Barang</th>
                        <th class="text-center">Kategori</th>
                        <th class="text-center">Warna</th>
                        <th class="text-center">Ukuran</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Contoh data statis -->
                    <tr>
                        <td>12 januari 2025</td>
                        <td>0007</td>
                        <td>Sepatu</td>
                        <td>Non Formal</td>
                        <td>Pink</td>
                        <td>38</td>
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
