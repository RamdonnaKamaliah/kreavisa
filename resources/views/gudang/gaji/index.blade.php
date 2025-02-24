@push('page-title')
    Rekap Gaji Karyawan
@endpush
<x-layout-gudang> 
    <div class="p-4 md:p-6 md:ml-[250px] overflow-x-hidden">
        <!-- Laporan Stok Barang -->
        <div class="bg-gray-900 text-white p-4 rounded-lg shadow-md">
            <h2 class="text-center text-xl font-bold mb-4">Rekap Gaji</h2>
            <div class="overflow-x-auto mt-4">
                <table id="stokMasukTable" class="w-full border border-gray-300 text-xs md:text-sm">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Nama</th>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">jabatan</th>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Tanggal</th>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Tipe Pembayaran</th>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Gaji Pokok</th>     
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Bonus</th>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Potongan</th>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Total Gaji</th>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Aksi</th>         
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($gajiKaryawan as $row)
                        <tr>
                            <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">{{ $row->user->nama_lengkap }}</td>
                            <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">{{ $row->user->jabatan->nama_jabatan }}</td>
                            <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">{{ $row->tanggal }}</td>
                            <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">{{ $row->tipe_pembayaran }}</td>
                            <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Rp {{ number_format($row->gaji_pokok, 0, ',', '.') }}</td>
                            <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Rp {{ number_format($row->bonus, 0, ',', '.') }}</td>
                            <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Rp {{ number_format($row->potongan, 0, ',', '.') }}</td>
                            <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Rp {{ number_format($row->total_gaji, 0, ',', '.') }}</td>
                            <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2 text-center">
                                <a href="{{ route('gajikaryawan.show', $row->id) }}" class="px-2 py-1 text-blue-600 border border-blue-600 rounded-full hover:bg-blue-100">
                                    <i class="fas fa-eye"></i> Lihat
                                </a>
                            </td>      
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout-gudang>
