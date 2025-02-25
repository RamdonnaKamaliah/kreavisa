@extends('layout2.karyawan')
@section('content')
    @push('page-title')
        Rekap Gaji Karyawan
    @endpush
    <div class="p-6 md:p-8 overflow-x-hidden">
        <div class="bg-white text-gray-900 p-6 rounded-lg shadow-lg">
            <h2 class="text-center text-2xl font-semibold mb-6">Rekap Gaji</h2>
            <div class="overflow-x-auto mt-4">
                <table id="stokMasukTable" class="w-full border border-gray-300 text-sm md:text-base bg-white text-gray-900">
                    <thead class="bg-gray-200 text-gray-900">
                        <tr>
                            <th class="border border-gray-300 px-3 py-2">Nama</th>
                            <th class="border border-gray-300 px-3 py-2">Jabatan</th>
                            <th class="border border-gray-300 px-3 py-2">Tanggal</th>
                            <th class="border border-gray-300 px-3 py-2">Tipe Pembayaran</th>
                            <th class="border border-gray-300 px-3 py-2">Gaji Pokok</th>
                            <th class="border border-gray-300 px-3 py-2">Bonus</th>
                            <th class="border border-gray-300 px-3 py-2">Potongan</th>
                            <th class="border border-gray-300 px-3 py-2">Total Gaji</th>
                            <th class="border border-gray-300 px-3 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($gajiKaryawan as $row)
                            <tr class="bg-white hover:bg-gray-100">
                                <td class="border border-gray-300 px-3 py-2">{{ $row->user->nama_lengkap }}</td>
                                <td class="border border-gray-300 px-3 py-2">{{ $row->user->jabatan->nama_jabatan }}</td>
                                <td class="border border-gray-300 px-3 py-2">{{ $row->tanggal }}</td>
                                <td class="border border-gray-300 px-3 py-2">{{ $row->tipe_pembayaran }}</td>
                                <td class="border border-gray-300 px-3 py-2">Rp
                                    {{ number_format($row->gaji_pokok, 0, ',', '.') }}</td>
                                <td class="border border-gray-300 px-3 py-2">Rp
                                    {{ number_format($row->bonus, 0, ',', '.') }}</td>
                                <td class="border border-gray-300 px-3 py-2">Rp
                                    {{ number_format($row->potongan, 0, ',', '.') }}</td>
                                <td class="border border-gray-300 px-3 py-2">Rp
                                    {{ number_format($row->total_gaji, 0, ',', '.') }}</td>
                                <td class="border border-gray-300 px-3 py-2 text-center">
                                    <a href="{{ route('gajikaryawan.show', $row->id) }}"
                                        class="px-3 py-1 text-blue-600 border border-blue-600 rounded-full hover:bg-blue-500 hover:text-white transition">
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
