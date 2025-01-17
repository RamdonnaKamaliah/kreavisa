<x-layout-admin>
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h4 text-secondary">Data Gaji</h2>
            <a href="{{ route('gajikaryawan.create') }}" class="btn btn-primary">
                + Tambah Data
            </a>

        </div>
        <!-- Membungkus tabel dengan class table-responsive untuk membuatnya responsif -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="myTable">
                <thead class="table-dark text-white">
                    <tr>
                        <th class="text-start">Nama</th>
                        <th class="text-start">Jabatan</th>
                        <th class="text-start">Metode Pembayaran</th>
                        <th class="text-start">Bonus</th>
                        <th class="text-start">Potongan Gaji</th>
                        <th class="text-start">Total Gaji</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Contoh data statis -->
                    <tr>
                        <td>Rizky</td>
                        <td>Live</td>
                        <td>DANA</td>
                        <td>Rp.200.000</td>
                        <td>2%</td>
                        <td>Rp.1.200.000</td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="#" class="btn btn-sm btn-outline-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="#" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye"></i> Cek Profile
                                </a>
                                <button class="btn btn-sm btn-outline-danger">
                                    <i class="fas fa-trash-alt"></i>
                                    Hapus
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
