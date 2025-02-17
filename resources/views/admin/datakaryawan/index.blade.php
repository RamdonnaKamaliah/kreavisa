<x-layout-admin>
    <div class="p-6 bg-gray-400 rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-xl font-bold text-gray-700">Data Karyawan</h1>
            <a href="{{ route('datakaryawan.create') }}"
                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                + Tambah Data
            </a>
        </div>

        <div class="overflow-x-auto bg-gray-50 p-4 rounded-lg">
            <div class="w-full overflow-x-auto min-w-full">
                <table id="karyawanTable" class="w-full bg-white border border-gray-300 rounded-lg display nowrap"
                    style="width:100%">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>Usia</th>
                            <th>Jenis Kelamin</th>
                            <th>Tanggal Lahir</th>
                            <th>No HP</th>
                            <th>Divisi</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataKaryawan as $row)
                            <tr>
                                <td>
                                    <img src="{{ $row->foto ? asset($row->foto) : asset('asset-landing-admin/img/profile.png') }}"
                                        class="w-14 h-14 rounded-full object-cover border border-gray-300">
                                </td>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->usia }} th</td>
                                <td>{{ $row->gender }}</td>
                                <td>{{ \Carbon\Carbon::parse($row->tanggal_lahir)->format('d M Y') }}</td>
                                <td>{{ $row->no_telepon }}</td>
                                <td>{{ $row->jabatan->nama_jabatan ?? '-' }}</td>
                                <td class="text-center">
                                    <div class="flex justify-center space-x-2">
                                        <a href="{{ route('datakaryawan.edit', $row->id) }}"
                                            class="px-3 py-1 text-yellow-600 border border-yellow-600 rounded hover:bg-yellow-100">
                                            <i class="fas fa-edit"></i> <span class="hidden sm:inline">Edit</span>
                                        </a>
                                        <a href="{{ route('datakaryawan.show', $row->id) }}"
                                            class="px-3 py-1 text-blue-600 border border-blue-600 rounded hover:bg-blue-100">
                                            <i class="fas fa-eye"></i> <span class="hidden sm:inline">Cek Profile</span>
                                        </a>
                                        <form action="{{ route('datakaryawan.destroy', $row->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="deleted(this)"
                                                class="px-3 py-1 text-red-600 border border-red-600 rounded hover:bg-red-100">
                                                <i class="fas fa-trash-alt"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Include DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#karyawanTable').DataTable({
                "responsive": false,
                "scrollX": true,
                "autoWidth": false,
                "language": {
                    "search": "Cari:",
                    "lengthMenu": "Tampilkan _MENU_ data",
                    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Berikutnya",
                        "previous": "Sebelumnya"
                    }
                }
            });
        });
    </script>
</x-layout-admin>
