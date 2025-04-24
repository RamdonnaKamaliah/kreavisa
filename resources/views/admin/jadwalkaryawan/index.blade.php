@extends('layout.main')

@section('content')
    <div class="p-4 md:p-6 overflow-x-hidden">
        <!-- Dropdown Pilihan Tabel & Tombol Tambah Data -->
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center gap-4">
                <label for="tableSelect" class="text-white text-lg">Pilih Laporan:</label>
                <select id="tableSelect" class="p-2 border border-gray-400 rounded-md w-64">
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

        <!-- Laporan Jadwal Karyawan -->
        <div class="bg-white dark:bg-slate-800 text-gray-900 p-4 rounded-lg shadow-md border border-gray-300 dark:border-slate-800">
            <h2 class="text-center text-xl font-bold mb-4 dark:text-white">Laporan Jadwal Karyawan</h2>
            <div class="flex justify-between items-center mb-4">
                <form action="{{ route('jadwalkaryawan.index') }}" method="GET" class="flex items-center gap-4">
                    <!-- Input Tahun dengan Spinner Custom -->
                    <div class="flex items-center">
                        <div class="relative flex items-center">
                            <button type="button" 
                                    onclick="changeYear(-1)" 
                                    class="p-2 bg-gray-100 hover:bg-gray-200 rounded-l-lg border border-gray-400 flex items-center justify-center h-10">
                                <i class="fas fa-minus text-gray-600"></i>
                            </button>
                            
                            <div class="w-24 px-4 py-2 border-t border-b border-gray-400 bg-white text-center font-medium h-10 flex items-center justify-center">
                                <span id="yearDisplay">{{ $tahun ?? date('Y') }}</span>
                                <input type="hidden" id="yearSelect" name="tahun" value="{{ $tahun ?? date('Y') }}">
                            </div>
                            
                            <button type="button" 
                                    onclick="changeYear(1)" 
                                    class="p-2 bg-gray-100 hover:bg-gray-200 rounded-r-lg border border-gray-400 flex items-center justify-center h-10">
                                <i class="fas fa-plus text-gray-600"></i>
                            </button>
                        </div>
                    </div>
        
                    <select id="monthSelect" name="bulan" class="p-2 border border-gray-400 rounded-md h-10">
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ ($i == ($bulan ?? date('m'))) ? 'selected' : '' }}>
                                {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                            </option>
                        @endfor
                    </select>
                    
                    <button type="submit" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-md h-10">
                        Tampilkan
                    </button>
                </form>
                <a href="{{ route('jadwalkaryawan.create') }}"
                    class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-md">
                    + Tambah Data
                </a>
            </div>
            <!-- Tabel Jadwal Karyawan -->
            <div class="overflow-x-auto w-full">
                <table class="border border-gray-400 text-xs md:text-sm min-w-max">
                    <thead class="bg-gray-200 dark:bg-slate-700 text-gray-900 dark:text-gray-100">
                        <tr>
                            <th class="border border-gray-400 px-2 py-1 md:px-4 md:py-2" rowspan="2">Nama</th>
                            <th class="border border-gray-400 px-2 py-1 md:px-4 md:py-2" rowspan="2">Jabatan</th>
                            <th class="border border-gray-400 px-2 py-1 md:px-4 md:py-2" id="dayHeader" colspan="31">Day</th>
                            <th class="border border-gray-400 px-2 py-1 md:px-4 md:py-2" rowspan="2">Aksi</th>
                        </tr>
                        <tr id="dateHeader">
                            <!-- Tanggal akan diisi oleh JavaScript -->
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        @foreach ($karyawans as $karyawan)
                            <tr>
                                <td class="border border-gray-400 px-2 py-1 md:px-4 md:py-2 dark:text-gray-300">
                                    {{ $karyawan->nama_lengkap ?? '-' }}
                                </td>
                                <td class="border border-gray-400 px-2 py-1 md:px-4 md:py-2 dark:text-gray-300">
                                    {{ $karyawan->jabatan->nama_jabatan ?? '-' }}
                                </td>


                                @php
                                $jadwal = $jadwals[$karyawan->id] ?? null;
                            @endphp
                            
                            @for ($i = 1; $i <= 31; $i++)
                                @php
                                    $jamKerja = $jadwal ? $jadwal->getShiftForDay($i) : null;
                                    $warna = $jamKerja ? 'style=background-color:#00F600;color:black;' : '';
                                @endphp
                                <td class="border border-gray-400 px-2 py-1 md:px-4 md:py-2 whitespace-nowrap" {!! $warna !!}>
                                    {{ $jamKerja ?? '' }}
                                </td>
                            @endfor


                            <td class="border border-gray-400 px-2 py-1 md:px-4 md:py-2 whitespace-nowrap">
                                @if($jadwal)
                                    <div class="flex justify-center space-x-1 md:space-x-2">
                                        <a href="{{ route('jadwalkaryawan.edit', $jadwal->id) }}" 
                                           class="px-2 py-1 text-yellow-600 border border-yellow-600 rounded-full hover:bg-yellow-100 flex items-center gap-1 text-xs md:text-sm">
                                            <i class="fas fa-edit"></i> <span class="hidden sm:inline">Edit</span>
                                        </a>
                                        <a href="{{ route('jadwalkaryawan.show', $jadwal->id) }}"
                                           class="px-2 py-1 text-blue-600 border border-blue-600 rounded-full hover:bg-blue-100 flex items-center gap-1 text-xs md:text-sm">
                                            <i class="fas fa-eye"></i> <span class="hidden sm:inline">View</span>
                                        </a>
                                        <form action="{{ route('jadwalkaryawan.destroy', $jadwal->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="deleted(this)" 
                                                    class="px-2 py-1 text-red-600 border border-red-600 rounded-full hover:bg-red-100 flex items-center gap-1 text-xs md:text-sm">
                                                <i class="fas fa-trash-alt"></i> <span class="hidden sm:inline">Delete</span>
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <div class="text-gray-400 text-center"></div>
                                @endif
                            </td>
                            </tr>
                        @endforeach
                        @if ($karyawans->isEmpty())
                            <tr>
                                <td colspan="34" class="text-center p-4 text-gray-600">Tidak ada data karyawan.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // Fungsi untuk mengubah tahun
        function changeYear(step) {
            const yearDisplay = document.getElementById('yearDisplay');
            const yearInput = document.getElementById('yearSelect');
            let currentYear = parseInt(yearDisplay.textContent);
            let newYear = currentYear + step;
            
            // Batasi tahun antara 2000-2100
            if (newYear < 2000) newYear = 2000;
            if (newYear > 2100) newYear = 2100;
            
            yearDisplay.textContent = newYear;
            yearInput.value = newYear;
            updateTable();
        }

        // ... (fungsi lainnya tetap sama) ...
    </script>

    <script>
        function getDaysInMonth(year, month) {
            return new Date(year, month, 0).getDate();
        }

        function updateTable() {
            const year = document.getElementById('yearSelect').value;
            const month = document.getElementById('monthSelect').value;
            const daysInMonth = getDaysInMonth(year, month);

            // Update header tanggal
            const dateHeader = document.getElementById('dateHeader');
            dateHeader.innerHTML = '';
            for (let i = 1; i <= daysInMonth; i++) {
                const th = document.createElement('th');
                th.className = 'border border-gray-400 px-2 py-1 md:px-4 md:py-2';
                th.textContent = i;
                dateHeader.appendChild(th);
            }

            // Update colspan untuk header Day
            document.getElementById('dayHeader').colSpan = daysInMonth;

            // Update body tabel
            const tableBody = document.getElementById('tableBody');
            const rows = tableBody.getElementsByTagName('tr');
            for (let row of rows) {
                const cells = row.getElementsByTagName('td');
                for (let i = 2; i < cells.length - 1; i++) {
                    if (i - 1 <= daysInMonth) {
                        cells[i].style.display = '';
                    } else {
                        cells[i].style.display = 'none';
                    }
                }
            }
        }

        function validateYearInput(input) {
            // Hanya menerima angka dan maksimal 4 digit
            input.value = input.value.replace(/[^0-9]/g, '').substring(0, 4);
        }

        function loadData() {
            const yearInput = document.getElementById('yearSelect').value;
            const month = document.getElementById('monthSelect').value;

            // Validasi tahun harus 4 digit
            if (yearInput.length !== 4) {
                alert('Tahun harus berupa 4 digit angka.');
                return;
            }

            const year = parseInt(yearInput, 10);
            updateTable();
            console.log(`Memuat data untuk bulan ${month} tahun ${year}`);
        }

        // Inisialisasi tabel saat pertama kali dimuat
        updateTable();
    </script>
@endsection