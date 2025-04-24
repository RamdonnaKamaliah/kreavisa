@extends('layout.main')

@section('content')
    <div class="p-4 md:p-6 overflow-x-hidden">
        <!-- Dropdown Pilihan Tabel -->
        <div class="mb-4">
            <label for="tableSelect" class="block text-lg mb-2 text-white">Pilih Laporan:</label>
            <div class="max-w-xs">
                <select id="tableSelect" class="p-2 border border-gray-400 rounded-md w-full">
                    <option value="jadwalKaryawan">Laporan Jadwal Karyawan</option>
                    <option value="shiftKaryawan">Laporan Shift Karyawan</option>
                </select>
            </div>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                let currentURL = window.location.href;
                let selectElement = document.getElementById("tableSelect");

                if (currentURL.includes("jadwalkaryawan")) {
                    selectElement.value = "jadwalKaryawan";
                } else if (currentURL.includes("shiftkaryawan")) {
                    selectElement.value = "shiftKaryawan";
                }

                selectElement.addEventListener("change", function() {
                    let selectedValue = this.value;
                    if (selectedValue === "jadwalKaryawan") {
                        window.location.href = "{{ route('jadwalkaryawan.index') }}";
                    } else if (selectedValue === "shiftKaryawan") {
                        window.location.href = "{{ route('shiftkaryawan.index') }}";
                    }
                });
            });
        </script>

        <!-- Laporan Shift Karyawan -->
        <div class="bg-white dark:bg-slate-800 text-gray-900 dark:text-gray-100 p-4 rounded-lg shadow-md dark:shadow-lg">
            <h2 class="text-center text-xl font-bold mb-4 dark:text-white">Laporan Shift Karyawan</h2>
            <div class="flex justify-between items-center mb-4">
                <a href="{{ route('shiftkaryawan.create') }}"
                    class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-md">
                    + Tambah Data
                </a>
            </div>
            <div class="overflow-x-auto mt-4">
                <table id="myTable" class="w-full border border-gray-300 text-xs md:text-sm dark:border-gray-600">
                    <thead class="bg-gray-200 text-gray-800 dark:bg-slate-700 dark:text-gray-100">
                        <tr>
                            <th class="border border-gray-400 px-2 py-1 md:px-4 md:py-2">Nama</th>
                            <th class="border border-gray-400 px-2 py-1 md:px-4 md:py-2">Jabatan</th>
                            <th class="border border-gray-400 px-2 py-1 md:px-4 md:py-2">Shift 1</th>
                            <th class="border border-gray-400 px-2 py-1 md:px-4 md:py-2">Shift 2</th>
                            <th class="border border-gray-400 px-2 py-1 md:px-4 md:py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($shifts as $row)
                            <tr>
                                <td class="border border-gray-400 px-2 py-1 md:px-4 md:py-2 dark:text-gray-300">
                                    {{ $row->user->nama_lengkap ?? '-' }}
                                </td>
                                <td class="border border-gray-400 px-2 py-1 md:px-4 md:py-2 dark:text-gray-300">
                                    {{ $row->user->jabatan->nama_jabatan ?? '-' }}
                                </td>
                                <td class="border border-gray-400 px-2 py-1 md:px-4 md:py-2 dark:text-gray-300">
                                    {{ $row->shift_1 ?? '-' }}
                                </td>
                                <td class="border border-gray-400 px-2 py-1 md:px-4 md:py-2 dark:text-gray-300">
                                    {{ $row->shift_2 ?? '-' }}
                                </td>
                                <td class="border border-gray-400 px-2 py-1 md:px-4 md:py-2 text-center">
                                    <div class="flex justify-center space-x-1 md:space-x-2">
                                        <a href="{{ route('shiftkaryawan.edit', $row->id) }}"
                                            class="px-2 py-1 text-yellow-600 border border-yellow-600 rounded-full hover:bg-yellow-100 flex items-center gap-1 text-xs md:text-sm">
                                            <i class="fas fa-edit"></i> <span class="hidden sm:inline">Edit</span>
                                        </a>
                                        <a href="{{ route('shiftkaryawan.show', $row->id) }}"
                                            class="px-2 py-1 text-blue-600 border border-blue-600 rounded-full hover:bg-blue-100 flex items-center gap-1 text-xs md:text-sm">
                                            <i class="fas fa-eye"></i> <span class="hidden sm:inline">View</span>
                                        </a>
                                        <form action="{{ route('shiftkaryawan.destroy', $row->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <!-- Di file index shift (bagian tombol delete) -->
                                            <button type="button" onclick="console.log({{ $row->id }}); deleteShift(this)"
                                            class="px-2 py-1 text-red-600 border border-red-600 rounded-full hover:bg-red-100 flex items-center gap-1 text-xs md:text-sm delete-shift">
                                            <i class="fas fa-trash-alt"></i> <span class="hidden sm:inline">Delete</span>
                                            </button>
                                        </form>
                                        <script>
                                        function deleteShift(button) {
                                            Swal.fire({
    icon: "warning",
    title: "Yakin ingin menghapus Shift ini?",
    html: "<div style='text-align:center'>Jika shift dihapus:<br>Data shift akan dihapus permanen, semua jadwal karyawan yang menggunakan shift ini akan otomatis terhapus</div>",
    showCancelButton: true,
    confirmButtonText: "Ya, Hapus!",
    cancelButtonText: "Batal",
    customClass: {
        popup: 'custom-swal-popup',
        htmlContainer: 'custom-swal-html',
        confirmButton: 'bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded mr-2',
        cancelButton: 'bg-gray-300 hover:bg-gray-400 text-black font-semibold py-2 px-4 rounded'
    },
    buttonsStyling: false
}).then((result) => {
    if (result.isConfirmed) {
        button.closest('form').submit();
    }
});

                                        }

                                        // Fungsi untuk delete biasa (untuk yang lain)
                                        function deleted(button) {
                                            Swal.fire({
                                                icon: "warning",
                                                title: "Yakin ingin menghapus?",
                                                text: "Data akan dihapus permanen",
                                                showCancelButton: true,
                                                confirmButtonColor: "#3085d6",
                                                cancelButtonColor: "#d33",
                                                confirmButtonText: "Ya, Hapus!",
                                                cancelButtonText: "Batal"
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    button.parentElement.submit();
                                                }
                                            });
                                        }
                                        </script>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        @if ($shifts->isEmpty())
                            <tr>
                                <td colspan="5" class="text-center p-4 text-gray-600">Tidak ada data shift karyawan.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    
@endsection
