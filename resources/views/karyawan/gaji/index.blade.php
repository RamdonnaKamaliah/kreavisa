@extends('layout3.karyawan3')
@section('page-title', 'Rekap Gaji')
@section('content')
    <div class="p-4 md:p-6 overflow-x-hidden mt-10">
        <!-- Laporan Rekap Gaji -->
        <div class="bg-white dark:bg-slate-800 text-gray-900 dark:text-gray-100 p-4 rounded-lg shadow-md dark:shadow-lg">
            <h2 class="text-center text-xl font-bold mb-4 text-black dark:text-white">Rekap Gaji</h2>
            <div class="overflow-x-auto mt-4">
                <table id="stokMasukTable"
                    class="w-full border border-gray-300 dark:border-gray-700 text-xs md:text-sm bg-white dark:bg-slate-900 text-gray-800 dark:text-gray-100">
                    <thead class="bg-gray-200 dark:bg-slate-700 text-gray-900 dark:text-gray-100">
                        <tr>
                            <th class="border border-gray-300 dark:border-gray-700 px-2 py-1 md:px-4 md:py-2">Nama Lengkap
                            </th>
                            <th class="border border-gray-300 dark:border-gray-700 px-2 py-1 md:px-4 md:py-2">Jabatan</th>
                            <th class="border border-gray-300 dark:border-gray-700 px-2 py-1 md:px-4 md:py-2">Tanggal</th>
                            <th class="border border-gray-300 dark:border-gray-700 px-2 py-1 md:px-4 md:py-2">Tipe
                                Pembayaran</th>
                            <th class="border border-gray-300 dark:border-gray-700 px-2 py-1 md:px-4 md:py-2">Gaji Pokok
                            </th>
                            <th class="border border-gray-300 dark:border-gray-700 px-2 py-1 md:px-4 md:py-2">Bonus</th>
                            <th class="border border-gray-300 dark:border-gray-700 px-2 py-1 md:px-4 md:py-2">Potongan</th>
                            <th class="border border-gray-300 dark:border-gray-700 px-2 py-1 md:px-4 md:py-2">Total Gaji
                            </th>
                            <th class="border border-gray-300 dark:border-gray-700 px-2 py-1 md:px-4 md:py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($gajiKaryawan as $row)
                            <tr class="hover:bg-gray-100 dark:hover:bg-slate-800 transition">
                                <td class="border border-gray-300 dark:border-gray-700 px-2 py-1 md:px-4 md:py-2">
                                    {{ $row->user->nama_lengkap }}</td>
                                <td class="border border-gray-300 dark:border-gray-700 px-2 py-1 md:px-4 md:py-2">
                                    {{ $row->user->jabatan->nama_jabatan }}</td>
                                <td class="border border-gray-300 dark:border-gray-700 px-2 py-1 md:px-4 md:py-2">
                                    {{ $row->tanggal }}</td>
                                <td class="border border-gray-300 dark:border-gray-700 px-2 py-1 md:px-4 md:py-2">
                                    {{ $row->tipe_pembayaran }}</td>
                                <td class="border border-gray-300 dark:border-gray-700 px-2 py-1 md:px-4 md:py-2">
                                    Rp {{ number_format($row->gaji_pokok, 0, ',', '.') }}</td>
                                <td class="border border-gray-300 dark:border-gray-700 px-2 py-1 md:px-4 md:py-2">
                                    Rp {{ number_format($row->bonus, 0, ',', '.') }}</td>
                                <td class="border border-gray-300 dark:border-gray-700 px-2 py-1 md:px-4 md:py-2">
                                    Rp {{ number_format($row->potongan, 0, ',', '.') }}</td>
                                <td class="border border-gray-300 dark:border-gray-700 px-2 py-1 md:px-4 md:py-2">
                                    Rp {{ number_format($row->total_gaji, 0, ',', '.') }}</td>
                                <td
                                    class="border border-gray-300 dark:border-gray-700 px-2 py-1 md:px-4 md:py-2 text-center">
                                    <a href="{{ route('gajiKaryawan.show', $row->id) }}"
                                        class="px-2 py-1 text-blue-600 dark:text-blue-400 border border-blue-600 dark:border-blue-400 rounded-full hover:bg-blue-100 dark:hover:bg-blue-900 transition">
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
