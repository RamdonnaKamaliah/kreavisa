@extends('layout.main')
@section('page-title', 'Absensi Karyawan')
@section('content')
    <div class="p-4 md:p-6 overflow-x-hidden">
        <!-- Section Lokasi Absen -->
        <div class="bg-white dark:bg-slate-800 text-black p-4 rounded-lg shadow-md border border-gray-300 dark:border-slate-800 mb-6">
            <h2 class="text-lg font-bold mb-4 text-gray-800 dark:text-white">Titik Lokasi Absen</h2>
            
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            
            <form action="{{ route('admin.absen.update-lokasi') }}" method="POST">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="md:col-span-2">
                        <label for="google_maps_link" class="block text-gray-700 dark:text-gray-300 mb-2">Link Google Maps</label>
                        <input type="url" name="google_maps_link" id="google_maps_link" 
                               value="{{ $lokasiAbsen ? 'https://www.google.com/maps?q='.$lokasiAbsen->latitude.','.$lokasiAbsen->longitude : '' }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-slate-700 dark:border-slate-600 dark:text-white" required>
                        <p class="text-sm text-gray-500 mt-1 dark:text-gray-400">
                            Cara: Buka Web Google Maps > Klik titik lokasi > Salin Url
                        </p>
                    </div>
                    
                    <div>
                        <label for="radius" class="block text-gray-700 dark:text-gray-300 mb-2">Radius (meter)</label>
                        <input type="number" name="radius" id="radius" min="1" 
                               value="{{ $lokasiAbsen ? $lokasiAbsen->radius : 100 }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-slate-700 dark:border-slate-600 dark:text-white" required>
                    </div>
                </div>
                
                <div class="mt-4">
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200">
                        <i class="fas fa-save mr-2"></i>Simpan
                    </button>
                    
                    @if($lokasiAbsen)
                    <div class="mt-3 text-sm text-gray-600 dark:text-gray-300">
                        <p>Lokasi saat ini: {{ $lokasiAbsen->latitude }}, {{ $lokasiAbsen->longitude }}</p>
                        <p>Radius: {{ $lokasiAbsen->radius }} meter</p>
                    </div>
                    @endif
                </div>
            </form>
        </div>
        <!-- Laporan Stok Masuk -->
        <div class="bg-white dark:bg-slate-800 text-black p-4 rounded-lg shadow-md border border-gray-300 dark:border-slate-800">
            <h2 class="text-center text-xl font-bold mb-4 text-gray-800 dark:text-white">Rekap Absensi Karyawan</h2>
        
            <div class="flex justify-between items-center mb-4">
                <div class="flex items-center space-x-4">
                    <div class="relative flex items-center border border-gray-300 rounded-md overflow-hidden bg-white">
                        <input type="date" id="filterDate" class="p-2 text-black border-none focus:ring-0 bg-white">
                        <button onclick="applyFilter()" class="p-2 text-gray-600 hover:text-blue-600">
                            <i class="fas fa-search"></i>
                        </button>
                        <button onclick="resetFilter()" class="p-2 text-gray-600 hover:text-red-600">
                            <i class="fas fa-sync-alt"></i>
                        </button>
                    </div>
                    
                    <!-- Button Export -->
                    <button onclick="exportData()" 
                            class="flex items-center px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition-colors">
                        <i class="fas fa-file-export mr-2"></i>
                        Export Excel
                    </button>
                </div>
            </div>
            
            <script>
                function exportData() {
                    let date = document.getElementById("filterDate").value;
                    let url = "{{ route('absenkaryawan.export') }}";
                    
                    if (date) {
                        url += `?date=${date}`;
                    }
                    
                    window.location.href = url;
                }
            </script>
            <div class="overflow-x-auto mt-4 dark:text-white">
                <table id="myTable" class="w-full border border-gray-300 text-xs md:text-sm">
                    <thead class="bg-gray-200 dark:bg-slate-700 text-gray-800 dark:text-gray-100">
                        <tr>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Nama Lengkap</th>
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
                            <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2 dark:text-gray-300">{{ $item->user->nama_lengkap ?? '-' }}</td>
                            <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2 dark:text-gray-300">{{ $item->user->jabatan->nama_jabatan ?? '-' }}</td>
                            <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">
                                <div class="flex items-center gap-1">
                                    <span class="font-medium text-gray-900 dark:text-gray-300">
                                        {{ \Carbon\Carbon::parse($item->tanggal_absensi)->isoFormat('D MMMM YYYY') }}
                                    </span>
                                    <span class="text-gray-400">•</span>
                                    <span class="text-gray-500 dark:text-gray-300">
                                        {{ \Carbon\Carbon::parse($item->tanggal_absensi)->isoFormat('HH:mm') }}
                                    </span>
                                </div>
                            </td>
                            <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2 text-center">
                                <span class="
                                    @if($item->status === 'hadir') bg-green-100 text-green-800 @endif
                                    @if($item->status === 'izin') bg-yellow-100 text-yellow-800 @endif
                                    @if($item->status === 'sakit') bg-red-100 text-red-800 @endif
                                    px-3 py-1 rounded-full text-sm font-medium
                                ">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>
                            <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2 text-center">
                                @if ($item->lokasi)
                                    <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($item->lokasi) }}" 
                                       target="_blank" 
                                       class="text-blue-600 hover:text-blue-800 flex items-center justify-center space-x-2 no-underline">
                                       <i class="fa-solid fa-location-dot"></i><span>Lihat Maps</span>
                                    </a>
                                @else
                                    <span>-</span>
                                @endif
                            </td>
                            <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2 text-center">
                                @if (!empty($item->foto) && file_exists(public_path($item->foto)))
                                    <a href="{{ asset($item->foto) }}" target="_blank">
                                        <img src="{{ asset($item->foto) }}" alt="Foto Absen" class="foto-absen">
                                    </a>
                                @else
                                    <span class="dark:text-white">-</span>
                                @endif
                            </td>
                            <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2 text-center">
                                @if ($item->file_surat)
                                    @if(in_array($item->status, ['izin', 'sakit']))
                                        <a href="{{ asset($item->file_surat) }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                            <i class="fas fa-file-alt mr-1"></i> Open File
                                        </a>
                                    @else
                                        @php
                                            $fileExtension = pathinfo($item->file_surat, PATHINFO_EXTENSION);
                                        @endphp
                                        
                                        @if(in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif']))
                                            <a href="{{ asset($item->file_surat) }}" target="_blank">
                                                <img src="{{ asset($item->file_surat) }}" alt="File Surat" class="file-surat">
                                            </a>
                                        @else
                                            <a href="{{ asset($item->file_surat) }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                                <i class="fas fa-file-pdf mr-1"></i> Open File
                                            </a>
                                        @endif
                                    @endif
                                @else
                                    <span class="dark:text-white">-</span>
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
