@extends('layout3.karyawan3')
@section('content')
    <div class="p-4 md:p-6 overflow-x-hidden">
        <div class="bg-white text-gray-900 p-4 rounded-lg shadow-md">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @php
                $todayAbsen = $absen->where('tanggal_absensi', now()->toDateString())->first();
                $nextAbsenTime = now()->endOfDay()->timestamp * 1000;
            @endphp

            <!-- Google Maps -->
            <div class="mb-4">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.3048621459625!2d106.7626191737859!3d-6.608989364603464!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c5001b7efe39%3A0x911c1a77e2752ac4!2sNavisa%20Basic%20Collection!5e0!3m2!1sid!2sid!4v1740474347021!5m2!1sid!2sid"
                    class="w-full h-64 md:h-80 rounded-lg shadow" style="border:0;" allowfullscreen loading="lazy"></iframe>
            </div>

            <div id="absen-section" class="flex flex-wrap gap-2 justify-center mb-4">
                @if (!$todayAbsen)
                    <a href="{{ route('karyawan.absen.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow">Hadir</a>
                    <a href="{{ route('karyawan.absen.sakit') }}" class="bg-orange-400 text-white px-4 py-2 rounded-lg shadow">Sakit</a>
                    <a href="{{ route('karyawan.absen.izin') }}" class="bg-yellow-300 text-white px-4 py-2 rounded-lg shadow">Izin</a>
                @else
                    <p class="text-green-600 text-center w-full">Anda sudah absen hari ini. Anda dapat absen kembali dalam:</p>
                    <h4 id="countdown" class="text-center w-full font-bold"></h4>
                @endif
            </div>

            <!-- Tombol Riwayat Absen -->
            <button id="toggleRiwayatAbsen" class="bg-gray-500 text-white px-4 py-2 rounded-lg shadow mt-4 w-full md:w-auto">
                Lihat Riwayat Absen
            </button>

            <!-- Tabel Riwayat Absen (Disembunyikan Awal) -->
            <div id="riwayatAbsenTable" class="overflow-x-auto mt-4 hidden">
                <h2 class="text-center text-xl font-bold mb-4">Riwayat Absen</h2>
                <table class="w-full border border-gray-300 text-xs md:text-sm">
                    <thead class="bg-gray-200 text-gray-900">
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
                        @empty
                            <tr>
                                <td colspan="6" class="text-center border border-gray-300 px-2 py-1 md:px-4 md:py-2">
                                    Tidak ada riwayat absen.
                                </td>
                            </tr>
                        @endforelse
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
            let button = document.getElementById("toggleRiwayatAbsen");
            let table = document.getElementById("riwayatAbsenTable");
            button.addEventListener("click", function() {
                table.classList.toggle("hidden");
            });
        });
    </script>
@endsection
