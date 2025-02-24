<x-layout-karyawan> 
    <div class="p-4 md:p-6 md:ml-[250px] overflow-x-hidden">
        <!-- Laporan Stok Barang -->
        <div class="bg-gray-900 text-white p-4 rounded-lg shadow-md">
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @php
            $todayAbsen = $absen->where('tanggal_absensi', now()->toDateString())->first();
            $nextAbsenTime = now()->endOfDay()->timestamp * 1000; // Waktu reset (jam 00:00)
        @endphp

        <div id="absen-section">
            @if(!$todayAbsen)
            <a href="{{ route('karyawan.absen.create') }}" class="btn btn-primary mb-3">Hadir</a>
            <a href="{{ route('karyawan.absen.sakit') }}" class="btn btn-secondary mb-3">Sakit</a>
            <a href="{{ route('karyawan.absen.izin') }}" class="btn btn-warning mb-3">Izin</a>            
            @else
                <p class="text-success">
                    Anda sudah absen hari ini. Anda dapat absen kembali dalam:
                </p>
                <h4 id="countdown"></h4>
            @endif
        </div>
            <h2 class="text-center text-xl font-bold mb-4">Absen</h2>
            <div class="overflow-x-auto mt-4">
                <table id="stokMasukTable" class="w-full border border-gray-300 text-xs md:text-sm">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Nama</th>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Jabatan</th>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Tanggal</th>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Status</th>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Lokasi</th>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Foto</th>        
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($absen as $item)
                        <tr>
                            <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">{{ $item->user->name ?? '-' }}</td>
                            <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">{{ $item->user->jabatan->nama_jabatan ?? '-' }}</td>
                            <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">{{ $item->tanggal_absensi }}</td>
                            <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">{{ ucfirst($item->status) }}</td>
                            <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">{{ $item->lokasi ?? '-' }}</td>
                            <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">
                                @if ($item->foto)
                                    <a href="{{ asset($item->foto) }}" target="_blank">
                                        <img src="{{ asset($item->foto) }}" alt="Foto Absen" class="foto-absen">
                                    </a>
                                @else
                                    <span>-</span>
                                @endif
                            </td>       
                        </tr>
                        @endforeach
                        
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
    document.addEventListener("DOMContentLoaded", function() {
        let countdownElement = document.getElementById("countdown");
        let absenSection = document.getElementById("absen-section");
        let nextAbsenTime = {{ $nextAbsenTime }}; // Waktu reset dari server (jam 00:00)
        let today = new Date().toISOString().split('T')[0]; // YYYY-MM-DD
        let lastAbsenDate = localStorage.getItem("lastAbsenDate");

        if (lastAbsenDate === today) {
            let storedNextAbsenTime = parseInt(localStorage.getItem("nextAbsenTime")) || nextAbsenTime;
            updateCountdown(storedNextAbsenTime);
        } else {
            showAbsenButtons();
        }

        function updateCountdown(targetTime) {
            function tick() {
                let now = new Date().getTime();
                let distance = targetTime - now;

                if (distance <= 0) {
                    showAbsenButtons();
                    return;
                }

                let seconds = Math.floor(distance / 1000);
                countdownElement.innerHTML = `${seconds} detik`;
                setTimeout(tick, 1000);
            }

            tick();
        }

        function showAbsenButtons() {
            absenSection.innerHTML = `
                <a href="{{ route('karyawan.absen.create') }}" class="btn btn-primary mb-3" onclick="setAbsen()">
                    Hadir
                </a>
                <a href="{{ route('karyawan.absen.sakit') }}" class="btn btn-secondary mb-3" onclick="setAbsen()">
                    Sakit
                </a>
                <a href="{{ route('karyawan.absen.izin') }}" class="btn btn-warning mb-3" onclick="setAbsen()">
                    Izin
                </a>`;
            countdownElement.innerHTML = "";
        }

        window.setAbsen = function() {
            localStorage.setItem("lastAbsenDate", today);
            localStorage.setItem("nextAbsenTime", nextAbsenTime);
        };
    });
</script>
</x-layout-karyawan>