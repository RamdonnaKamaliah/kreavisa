@extends('layout.main')
@section('content') 
    <div class="p-4 md:p-6 overflow-x-hidden">
        <div class="bg-white dark:bg-slate-800 text-gray-900 dark:text-gray-100 p-4 rounded-lg shadow-md dark:shadow-lg">
            
            <h2 class="text-center text-xl font-bold mb-4 text-gray-800 dark:text-white">Kinerja Karyawan</h2>
            
            <!-- Search and Export Section -->
<div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4 gap-4">
    <!-- Left side - Search and Filter -->
    <div class="flex flex-col md:flex-row gap-4 w-full md:w-auto">
        <!-- Combined Date Filter with Search Icon -->
        <div class="relative w-full md:w-48">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <i class="fas fa-calendar-alt text-gray-400"></i>
            </div>
            <input type="month" id="filterDate" 
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                   value="{{ request('date') ?? '' }}">
            @if(request('date'))
            <button onclick="resetDateFilter()" 
                    class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-red-500">
                <i class="fas fa-times"></i>
            </button>
            @endif
        </div>

        <!-- Export Button -->
        <form action="{{ route('kinerjakaryawan.export') }}" method="GET" class="w-full md:w-auto">
            <input type="hidden" name="date" id="exportDate" value="{{ request('date') ?? '' }}">
            <button type="submit" 
                    class="flex items-center justify-center px-4 py-2.5 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors w-full md:w-auto">
                <i class="fas fa-file-export mr-2"></i>
                Export Excel
            </button>
        </form>
    </div>
    
    <!-- Tambah Data Button -->
    <div class="w-full md:w-auto">
        <a href="{{ route('kinerjakaryawan.create') }}" class="block w-full md:w-auto">
            <button class="flex items-center justify-center px-4 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 w-full md:w-auto">
                Tambah Data
            </button>
        </a>
    </div>
</div>
            
            <!-- Table Section -->
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
                                <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">{{ \Carbon\Carbon::parse($item->tanggal_penilaian)->format('d-m-Y') }}</td>
                                <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">{{ $item->periode }}</td>
                                <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">{{ $item->total_skor }}</td>
                                <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2 text-center">
                                    <div class="flex justify-center space-x-1 md:space-x-2">
                                        <a href="{{ route('kinerjakaryawan.edit', $item->id) }}""
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

    <script>
        // Auto-submit when date changes
        document.getElementById('filterDate').addEventListener('change', function() {
            filterByDate();
        });

        function filterByDate() {
            const dateValue = document.getElementById('filterDate').value;
            const url = new URL(window.location.href);
            
            if (dateValue) {
                url.searchParams.set('date', dateValue);
            } else {
                url.searchParams.delete('date');
            }
            
            // Update export date field
            document.getElementById('exportDate').value = dateValue;
            
            // Remove page parameter if exists to go back to first page
            url.searchParams.delete('page');
            
            window.location.href = url.toString();
        }
        
        function resetDateFilter() {
            document.getElementById('filterDate').value = '';
            filterByDate();
        }
    </script>
@endsection