<x-layout-admin>
</x-layout-admin>
<div class="container-fluid p-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="h4 text-secondary">Data Karyawan</h2>
                <a href="{{ route('datakaryawan.create') }}" class="btn btn-primary">
                    + Tambah Data
                </a>

            </div>
            <!-- Membungkus tabel dengan class table-responsive untuk membuatnya responsif -->
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark text-white">
                        <tr>
                            <th class="text-start">Nama</th>
                            <th class="text-start">Usia</th>
                            <th class="text-start">Jenis Kelamin</th>
                            <th class="text-start">Tanggal Lahir</th>
                            <th class="text-start">No HP</th>
                            <th class="text-start">Divisi</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Contoh data statis -->
                        <tr>
                            <td class="d-flex align-items-center">
                                <img src="https://via.placeholder.com/40" class="rounded-circle me-2" alt="Foto Profil">
                                <span>Rizki</span>
                            </td>
                            <td>25th</td>
                            <td>Laki-laki</td>
                            <td>6 April 1998</td>
                            <td>085642576182</td>
                            <td>Gudang</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="#" class="btn btn-warning btn-sm">
                                        Edit
                                    </a>
                                    <button class="btn btn-danger btn-sm">
                                        Hapus
                                    </button>
                                    <button class="btn btn-info btn-sm">
                                        Cek Profil
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <!-- Tambahkan data lainnya di sini -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

