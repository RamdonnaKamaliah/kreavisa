<x-layout-admin>
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h4 text-secondary">Absensi Karyawan</h1>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="myTable">
                <thead class="table-dark text-white">
                    <tr>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Keterangan</th>
                        <th>Foto</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($absens as $absen)
                    <tr>
                        <td>{{ $absen->user->name }}</td>
                        <td>{{ $absen->tanggal_absensi }}</td>
                        <td>{{ ucfirst($absen->status) }}</td>
                        <td>
                            @if($absen->foto)
                            <img src="{{ asset('storage/' . $absen->foto) }}" class="rounded-circle" width="50">
                            @else
                            Tidak ada foto
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.absensi.show', $absen->id) }}" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-eye"></i> Lihat
                            </a>
                            <form action="{{ route('admin.absensi.destroy', $absen->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layout-admin>
