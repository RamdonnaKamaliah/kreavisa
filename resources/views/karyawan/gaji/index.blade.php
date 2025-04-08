@extends('layout3.karyawan3')
@section('content')
    @push('page-title')
        Rekap Gaji Karyawan
    @endpush
    <div class="p-4 md:p-6 overflow-x-hidden">
        <!-- Laporan Stok Barang -->
        <div class="bg-white text-gray-900 p-4 rounded-lg shadow-md border border-gray-300">
            <h2 class="text-center text-xl font-bold mb-4">Rekap Gaji</h2>
            <div class="overflow-x-auto mt-4">
                <table id="stokMasukTable" class="w-full border border-gray-300 text-xs md:text-sm bg-white text-gray-800">
                    <thead class="bg-gray-200 text-gray-900">
                        <tr>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Nama Lengkap</th>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Jabatan</th>
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
                                <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">
                                    {{ $row->user->nama_lengkap }}</td>
                                <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">
                                    {{ $row->user->jabatan->nama_jabatan }}</td>
                                <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">{{ $row->tanggal }}</td>
                                <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">{{ $row->tipe_pembayaran }}
                                </td>
                                <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Rp
                                    {{ number_format($row->gaji_pokok, 0, ',', '.') }}</td>
                                <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Rp
                                    {{ number_format($row->bonus, 0, ',', '.') }}</td>
                                <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Rp
                                    {{ number_format($row->potongan, 0, ',', '.') }}</td>
                                <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Rp
                                    {{ number_format($row->total_gaji, 0, ',', '.') }}</td>
                                <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2 text-center">
                                    <a href="{{ route('gajiKaryawan.show', $row->id) }}"
                                        class="px-2 py-1 text-blue-600 border border-blue-600 rounded-full hover:bg-blue-100">
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
@endsection
