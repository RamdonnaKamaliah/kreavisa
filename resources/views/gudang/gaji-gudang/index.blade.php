<x-layout-gudang>
    <x-layout-class></x-layout-class>
    <div class="card-body">

        <!-- Membungkus tabel dengan class table-responsive untuk membuatnya responsif -->
        <div class="table-responsive" style="overflow-x: auto;">
            <table class="table table-bordered table-striped" id="myTable" style="min-width: 1000px;">
                <thead class="table-dark text-white">
                    <tr>
                        <th class="text-start">Nama</th>
                        <th class="text-start">Jabatan</th>
                        <th class="text-start">Tanggal</th>
                        <th class="text-start">Nomor Rekening</th>
                        <th class="text-start">Tipe Pembayaran</th>
                        <th class="text-start">Gaji Pokok</th>
                        <th class="text-start">Bonus</th>
                        <th class="text-start">Potongan</th>
                        <th class="text-start">Total Gaji</th>
                        <th class="text-center" style="min-width: 200px;">Aksi</th> <!-- Lebar kolom aksi diperbesar -->
                    </tr>
                </thead>
                <tbody>
                    <!-- Contoh data statis -->
                    <tr>
                        <td>Rizky</td>
                        <td>Packing</td>
                        <td>02/02/2025</td>
                        <td>87868575</td>
                        <td>DANA</td>
                        <td>Rp. 500.000</td>
                        <td>Rp. 200.000</td>
                        <td>2%</td>
                        <td>Rp. 700.000</td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2" style="flex-wrap: nowrap;">
                                <!-- Tombol sejajar ke samping -->
                                <!-- Edit Button -->
                                <a href="#" class="btn btn-sm btn-outline-warning">
                                    <i class="fas fa-edit"></i> <span class="d-none d-sm-inline">Edit</span>
                                </a>

                                <!-- Cek Profile Button -->
                                <a href="#" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye"></i> <span class="d-none d-sm-inline">Cek Profile</span>
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

    <style>
        /* Responsif untuk layar kecil */
        @media (max-width: 768px) {
            .card-body {
                margin-left: 0;
                /* Hilangkan margin saat di mobile */
            }

            #myTable {
                min-width: 100%;
                /* Tabel mengambil lebar penuh */
            }

            .btn span {
                display: none;
                /* Sembunyikan teks pada tombol saat di mobile */
            }

            /* Tombol aksi ditampilkan vertikal saat di mobile */
            .d-flex.justify-content-center.gap-2 {
                flex-direction: column;
                gap: 5px !important;
            }
        }
    </style>
</x-layout-gudang>
