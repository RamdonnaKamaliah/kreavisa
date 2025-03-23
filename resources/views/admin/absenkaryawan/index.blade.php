@extends('layout.main')
@section('content')
    <div class="p-4 md:p-6 overflow-x-hidden">
        <!-- Laporan Stok Masuk -->
        <div class="bg-white text-black p-4 rounded-lg shadow-md border border-gray-300">
            <h2 class="text-center text-xl font-bold mb-4 text-gray-800">Rekap Absensi Karyawan</h2>
            <div class="flex justify-between items-center mb-4">
                <div class="relative flex items-center border border-gray-300 rounded-md overflow-hidden bg-white">
                    <input type="date" id="filterDate" class="p-2 text-black border-none focus:ring-0 bg-white">
                    <button onclick="applyFilter()" class="p-2 text-gray-600 hover:text-blue-600">
                        <i class="fas fa-search"></i>
                    </button>
                    <button onclick="resetFilter()" class="p-2 text-gray-600 hover:text-red-600">
                        <i class="fas fa-sync-alt"></i>
                    </button>
                </div>
            </div>
            <div class="overflow-x-auto mt-4">
                <table id="stokMasukTable" class="w-full border border-gray-300 text-xs md:text-sm">
                    <thead class="bg-gray-200 text-gray-800">
                        <tr>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Nama</th>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Jabatan</th>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Tanggal</th>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Status</th>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Lokasi</th>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Foto</th>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">File Surat</th> <!-- Tambahkan header -->
                        </tr>
                    </thead>
                    <tbody>
                        @if ($absen->isEmpty())
                        <tr>
                            <td colspan="7" class="text-center py-4 text-gray-500">Tabel kosong</td> <!-- Sesuaikan colspan -->
                        </tr>
                        @else
                        @foreach ($absen as $item)
                        <tr>
                            <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">{{ $item->user->nama_lengkap ?? '-' }}</td>
                            <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">{{ $item->user->jabatan->nama_jabatan ?? '-' }}</td>
                            <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">{{ $item->tanggal_absensi }}</td>
                            <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">{{ ucfirst($item->status) }}</td>
                            <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">
                                @if ($item->lokasi)
                                    <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($item->lokasi) }}" target="_blank" class="text-blue-600 underline">
                                        Lihat di Maps
                                    </a>
                                @else
                                    <span>-</span>
                                @endif
                            </td>
                            <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">
                                @if ($item->foto)
                                    <a href="{{ asset($item->foto) }}" target="_blank">
                                        <img src="{{ asset($item->foto) }}" alt="Foto Absen" class="foto-absen">
                                    </a>
                                @else
                                    <span>-</span>
                                @endif
                            </td>
                            <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">
                                @if ($item->file_surat)
                                    <a href="{{ asset($item->file_surat) }}" target="_blank" class="text-blue-600 underline">
                                        Lihat Surat
                                    </a>
                                @else
                                    <span>-</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>                    
                </table>
            </div>
        </div>
    </div>
    <style>
        .foto-absen {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 50%;
            cursor: pointer;
        }
    </style>
    
    <script>
        function applyFilter() {
            let date = document.getElementById("filterDate").value;
            let url = new URL(window.location.href);
            if (date) {
                url.searchParams.set('tanggal', date);
            } else {
                url.searchParams.delete('tanggal');
            }
            window.location.href = url.toString();
        }
    
        function resetFilter() {
            let url = new URL(window.location.href);
            url.searchParams.delete('tanggal');
            window.location.href = url.toString();
        }
    
        document.addEventListener("DOMContentLoaded", function() {
            const params = new URLSearchParams(window.location.search);
            if (params.has('tanggal')) {
                document.getElementById("filterDate").value = params.get('tanggal');
            }
        });
    </script>
@endsection
