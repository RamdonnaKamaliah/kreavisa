<x-layout-admin>
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h4 text-secondary">Data Karyawan</h1>
            <a href="{{ route('datakaryawan.create') }}" class="btn btn-primary">
                + Tambah Data
            </a>

        </div>
        <!-- Membungkus tabel dengan class table-responsive untuk membuatnya responsif -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="myTable">
                <thead class="table-dark text-white">
                    <tr>
                        <th class="text-start">Foto</th>
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
                    @foreach ($dataKaryawan as $row)
                    <tr>
                        <td>
                            <img src="{{ $row->foto ? asset($row->foto) : asset('asset-landing-admin/img/profile.png') }}" class="rounded-circle me-2"
                                alt="Foto Profil" style="width: 50px; height: 50px; object-fit: cover;">
                        </td>                        
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->usia }} th</td>
                        <td>{{ $row->gender }}</td>
                        <td>{{ \Carbon\Carbon::parse($row->tanggal_lahir)->format('d M Y') }}</td>
                        <td>{{ $row->no_telepon }}</td>
                        <td>{{ $row->jabatan->nama_jabatan ?? '-' }}</td>
                        <td class="text-center">
                            <div class="d-flex flex-wrap justify-content-center gap-2">
                                <!-- Edit Button -->
                                <a href="{{ route('datakaryawan.edit', $row->id) }}" class="btn btn-sm btn-outline-warning">
                                    <i class="fas fa-edit"></i> <span class="d-none d-sm-inline">Edit</span>
                                </a>

                                <!-- Cek Profile Button -->
                                <a href="{{ route('datakaryawan.show', $row->id) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye"></i> <span class="d-none d-sm-inline">Cek Profile</span>
                                </a>

                                <form action="{{ route('datakaryawan.destroy', $row->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-outline-danger" 
                                    onclick="deleted(this)"><i class="fas fa-trash-alt"></i> Delete</button>
                                </form>
                            </div>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layout-admin>
