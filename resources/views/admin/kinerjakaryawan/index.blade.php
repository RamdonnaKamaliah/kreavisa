@extends('layout.main')
@section('content')
    <div class="p-4 md:p-6 overflow-x-hidden">
        <!-- Laporan Stok Masuk -->
        <div class="bg-white dark:bg-slate-800 text-gray-900 dark:text-gray-100 p-4 rounded-lg shadow-md dark:shadow-lg">
            <h2 class="text-center text-xl font-bold mb-4 text-gray-800 dark:text-white">Kinerja Karyawan</h2>
            <div class="flex flex-wrap gap-2 justify-center md:justify-start">
                <a href="{{ route('kinerjakaryawan.create') }}">
                    <button
                        class="bg-blue-500 text-white px-3 py-1.5 text-sm md:px-4 md:py-2 md:text-base rounded-md hover:bg-blue-600">
                        Tambah Data
                    </button>
                </a>
                <form action="{{ route('kinerjakaryawan.export') }}" method="GET" class="flex items-center gap-2">
                    <input type="month" name="date" class="p-2 border border-gray-300 rounded-md dark:bg-slate-700 dark:border-gray-600 dark:text-white" 
                           value="{{ request('date') ?? '' }}">
                    <button type="submit" class="px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-md flex items-center gap-2 transition-colors">
                        <i class="fas fa-file-excel"></i> Export Excel
                    </button>
                </form>
            </div>
            <div class="overflow-x-auto mt-4">
                <table id="myTable" class="w-full border border-gray-300 text-xs md:text-sm dark:border-gray-600">
                    <thead class="bg-gray-200 text-gray-800 dark:bg-slate-700 dark:text-gray-100">
                        <tr>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Nama Karyawan</th>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Jabatan</th>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Tanggal Penilaian</th>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Periode</th>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Jumlah Skor</th>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kinerja as $item)
                            <tr>
                                <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">{{ $item->user->nama_lengkap }}</td>
                                <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">{{ $item->jabatan->nama_jabatan }}</td>
                                <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">{{ \Carbon\Carbon::parse($item->tanggal_penilaian)->format('d-m-Y') }}
                                </td>
                                <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">{{ $item->periode }}</td>
                                <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">{{ $item->total_skor }}</td>
                                <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2 text-center">
                                    <div class="flex justify-center space-x-1 md:space-x-2">
                                        <a href="{{ route('kinerjakaryawan.edit', $item->id) }}"
                                            class="px-2 py-1 text-yellow-600 border border-yellow-600 rounded-full hover:bg-yellow-100 flex items-center gap-1 text-xs md:text-sm">
                                            <i class="fas fa-edit"></i> <span class="hidden sm:inline">Edit</span>
                                        </a>
                                        <a href="{{ route('kinerjakaryawan.show', $item->id) }}"
                                            class="px-2 py-1 text-blue-600 border border-blue-600 rounded-full hover:bg-blue-100 flex items-center gap-1 text-xs md:text-sm">
                                            <i class="fas fa-eye"></i> <span class="hidden sm:inline">View</span>
                                        </a>
                                        <form action="{{ route('kinerjakaryawan.destroy', $item->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="deleted(this)"
                                                class="px-2 py-1 text-red-600 border border-red-600 rounded-full hover:bg-red-100 flex items-center gap-1 text-xs md:text-sm">
                                                <i class="fas fa-trash-alt"></i> <span
                                                    class="hidden sm:inline">Delete</span>
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
