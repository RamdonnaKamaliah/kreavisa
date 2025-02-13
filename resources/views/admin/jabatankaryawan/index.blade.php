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
                    @foreach ($jabatanKaryawan as $row)
                    <tr>
                        <td>{{ $row->nama_jabatan }}</td>
                        <td class="text-center">
                            <div class="d-flex flex-wrap justify-content-center gap-2">
                                <a href="{{ route('jabatankaryawan.show', $row->id) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye"></i> <span class="d-none d-sm-inline"> View</span>
                                </a>
                                <a href="{{ route('jabatankaryawan.edit', $row->id) }}"  class="btn btn-sm btn-outline-warning">
                                    <i class="fas fa-eye"></i> <span class="d-none d-sm-inline"> Edit</span>
                                </a>
                                <form action="{{ route('jabatankaryawan.destroy', $row->id) }}" method="POST" class="d-inline">
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
