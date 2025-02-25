@extends('layout.main')
@section('content')
    <div class="p-4 md:p-6 overflow-x-hidden">
        <!-- Dropdown Pilihan Tabel -->
        <div class="mb-4">
            <label for="tableSelect" class="block text-gray-800 text-lg mb-2">Pilih Laporan:</label>
            <div class="max-w-xs">
                <select id="tableSelect" class="p-2 border border-gray-400 rounded-md w-full">
                    <option value="gajiKaryawan">Laporan Gaji Karyawan</option> 
                    <option value="gajiPokok">Laporan Gaji Pokok</option> 
                </select>
            </div>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                let currentURL = window.location.href;
                let selectElement = document.getElementById("tableSelect");
                
                if (currentURL.includes("gajikaryawan")) {
                    selectElement.value = "gajiKaryawan";
                } else if (currentURL.includes("gajipokok")) {
                    selectElement.value = "gajiPokok";
                }
                
                selectElement.addEventListener("change", function() {
                    let selectedValue = this.value;
                    if (selectedValue === "gajiKaryawan") {
                        window.location.href = "{{ route('gajikaryawan.index') }}";
                    } else if (selectedValue === "gajiPokok") {
                        window.location.href = "{{ route('gajipokok.index') }}";
                    }
                });
            });
        </script>

        <!-- Laporan Gaji Karyawan -->
        <div class="bg-white text-gray-900 p-4 rounded-lg shadow-md border border-gray-300">
            <h2 class="text-center text-xl font-bold mb-4">Laporan Gaji Karyawan</h2>
            <div class="flex justify-between items-center mb-4">
                <a href="{{ route('gajikaryawan.create') }}"
                    class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-md">
                    + Tambah Data
                </a>
            </div>
            <div class="overflow-x-auto mt-4">
                <table id="stokMasukTable" class="w-full border border-gray-400 text-xs md:text-sm">
                    <thead class="bg-gray-200 text-gray-900">
                        <tr>
                            <th class="border border-gray-400 px-2 py-1 md:px-4 md:py-2">Nama</th>
                            <th class="border border-gray-400 px-2 py-1 md:px-4 md:py-2">Jabatan</th>
                            <th class="border border-gray-400 px-2 py-1 md:px-4 md:py-2">Gaji Pokok</th>
                            <th class="border border-gray-400 px-2 py-1 md:px-4 md:py-2">Metode Pembayaran</th>
                            <th class="border border-gray-400 px-2 py-1 md:px-4 md:py-2">Bonus</th>
                            <th class="border border-gray-400 px-2 py-1 md:px-4 md:py-2">Potongan</th>
                            <th class="border border-gray-400 px-2 py-1 md:px-4 md:py-2">Total Gaji</th>
                            <th class="border border-gray-400 px-2 py-1 md:px-4 md:py-2">Tanggal Diberikan</th>
                            <th class="border border-gray-400 px-2 py-1 md:px-4 md:py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($gajiKaryawan as $row)
                        <tr>
                            <td class="border border-gray-400 px-2 py-1 md:px-4 md:py-2">{{ $row->user->name }}</td>
                            <td class="border border-gray-400 px-2 py-1 md:px-4 md:py-2">{{ $row->user->jabatan->nama_jabatan }}</td>
                            <td class="border border-gray-400 px-2 py-1 md:px-4 md:py-2">Rp {{ number_format($row->gaji_pokok, 0, ',', '.') }}</td>
                            <td class="border border-gray-400 px-2 py-1 md:px-4 md:py-2">{{ $row->tipe_pembayaran }}</td>
                            <td class="border border-gray-400 px-2 py-1 md:px-4 md:py-2">Rp {{ number_format($row->bonus, 0, ',', '.') }}</td>
                            <td class="border border-gray-400 px-2 py-1 md:px-4 md:py-2">Rp {{ number_format($row->potongan, 0, ',', '.') }}</td>
                            <td class="border border-gray-400 px-2 py-1 md:px-4 md:py-2">Rp {{ number_format($row->total_gaji, 0, ',', '.') }}</td>
                            <td class="border border-gray-400 px-2 py-1 md:px-4 md:py-2">{{ $row->tanggal }}</td>
                            <td class="border border-gray-400 px-2 py-1 md:px-4 md:py-2 text-center">
                                <div class="flex justify-center space-x-1 md:space-x-2">
                                    <a href="{{ route('gajikaryawan.edit', $row->id) }}" class="px-2 py-1 text-yellow-600 border border-yellow-600 rounded-full hover:bg-yellow-100 flex items-center gap-1 text-xs md:text-sm">
                                        <i class="fas fa-edit"></i> <span class="hidden sm:inline">Edit</span>
                                    </a>
                                    <a href="{{ route('gajikaryawan.show', $row->id) }}" class="px-2 py-1 text-blue-600 border border-blue-600 rounded-full hover:bg-blue-100 flex items-center gap-1 text-xs md:text-sm">
                                        <i class="fas fa-eye"></i> <span class="hidden sm:inline">View</span>
                                    </a>
                                    <form action="{{ route('gajikaryawan.destroy', $row->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="deleted(this)" class="px-2 py-1 text-red-600 border border-red-600 rounded-full hover:bg-red-100 flex items-center gap-1 text-xs md:text-sm">
                                            <i class="fas fa-trash-alt"></i> <span class="hidden sm:inline">Delete</span>
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
@endsection
