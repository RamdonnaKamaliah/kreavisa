@extends('layout3.karyawan3')
@section('page-title', 'Kinerja')
@section('content')
    <div class="p-4 md:p-6 overflow-x-hidden mt-6">
        <div class="bg-white dark:bg-slate-850 dark:shadow-dark-xl text-gray-900 p-4 rounded-lg shadow-md">
            <!-- Dropdown Pilihan -->
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-4">
                    <label for="viewSelect" class="text-gray-700 dark:text-gray-300 text-lg">Pilih Tampilan:</label>
                    <select id="viewSelect"
                        class="p-2 border border-gray-400 rounded-md w-64 dark:bg-gray-700 dark:text-white">
                        <option value="performanceView">Ringkasan Kinerja</option>
                        <option value="historyView">Riwayat Penilaian</option>
                    </select>
                </div>
            </div>

            <!-- Container untuk Ringkasan Kinerja -->
            <div id="performanceViewContainer">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 pt-6">
                    <!-- Chart Total -->
<div class="flex flex-col items-center gap-2 bg-slate-50 dark:bg-gray-800 text-black rounded-xl py-4 px-6 min-w-[100px] shadow-lg">
    <h3 class="text-black dark:text-white font-bold font-popins">Total</h3>
    <div class="relative">
        <canvas id="totalScoreChart" width="150" height="150"></canvas>
        <div id="totalScoreCenterText" class="absolute inset-0 flex items-center justify-center text-black dark:text-white font-bold text-lg">
            0/100
        </div>
    </div>
    <div class="flex items-center gap-1 mt-2">
        @for($i = 1; $i <= 5; $i++)
            @if($i <= round($averages['total_skor'] / 20))
                <img src="https://cdn-icons-png.flaticon.com/512/1828/1828884.png" alt="Star Icon" class="w-5 h-5">
            @else
                <img src="https://cdn-icons-png.flaticon.com/512/1828/1828970.png" alt="Empty Star Icon" 
                     class="w-5 h-5 dark:filter dark:invert dark:brightness-0 dark:contrast-100">
            @endif
        @endfor
    </div>
</div>

                    <!-- Penilaian: Tanggung Jawab -->
                    <div class="bg-slate-50 dark:bg-gray-800 rounded-xl py-4 px-6 space-y-2 flex flex-col items-center text-center shadow-lg">
                        <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Responsibility Icon" class="w-8 h-8">
                        <p class="text-base font-semibold text-black dark:text-white">Tanggung Jawab</p>
                        <div class="flex items-center gap-2">
                            <img src="https://cdn-icons-png.flaticon.com/512/190/190411.png" alt="Star Icon" class="w-5 h-5">
                            <p class="text-sm font-bold @if($averages['tanggung_jawab'] >= 4) text-green-400 @elseif($averages['tanggung_jawab'] >= 3) text-blue-400 @elseif($averages['tanggung_jawab'] >= 2) text-yellow-400 @else text-red-400 @endif">
                                {{ number_format($averages['tanggung_jawab'], 1) }}/5
                            </p>
                        </div>
                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-3">
                            <div class="bg-blue-500 h-3 rounded-full" style="width: {{ ($averages['tanggung_jawab'] / 5) * 100 }}%"></div>
                        </div>
                        <p class="text-sm text-black dark:text-white">
                            @if($averages['tanggung_jawab'] >= 4) Sangat Baik!
                            @elseif($averages['tanggung_jawab'] >= 3) Baik
                            @elseif($averages['tanggung_jawab'] >= 2) Cukup
                            @else Perlu Peningkatan
                            @endif
                        </p>
                    </div>

                    <!-- Penilaian: Produktivitas -->
                    <div class="bg-slate-50 dark:bg-gray-800 rounded-xl py-4 px-6 space-y-2 flex flex-col items-center text-center shadow-lg">
                        <img src="https://cdn-icons-png.flaticon.com/512/190/190406.png" alt="Produktivitas Icon" class="w-8 h-8">
                        <p class="text-base font-semibold text-black dark:text-white">Produktivitas</p>
                        <div class="flex items-center gap-2">
                            <img src="https://cdn-icons-png.flaticon.com/512/190/190411.png" alt="Star Icon" class="w-5 h-5">
                            <p class="text-sm font-bold @if($averages['produktivitas'] >= 4) text-green-400 @elseif($averages['produktivitas'] >= 3) text-blue-400 @elseif($averages['produktivitas'] >= 2) text-yellow-400 @else text-red-400 @endif">
                                {{ number_format($averages['produktivitas'], 1) }}/5
                            </p>
                        </div>
                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-3">
                            <div class="bg-blue-500 h-3 rounded-full" style="width: {{ ($averages['produktivitas'] / 5) * 100 }}%"></div>
                        </div>
                        <p class="text-sm text-black dark:text-white">
                            @if($averages['produktivitas'] >= 4) Sangat Baik!
                            @elseif($averages['produktivitas'] >= 3) Baik
                            @elseif($averages['produktivitas'] >= 2) Cukup
                            @else Perlu Peningkatan
                            @endif
                        </p>
                    </div>

                    <!-- Penilaian: Kehadiran & Ketepatan Waktu -->
                    <div class="bg-slate-50 dark:bg-gray-800 rounded-xl py-4 px-6 space-y-2 flex flex-col items-center text-center shadow-lg">
                        <img src="https://cdn-icons-png.flaticon.com/512/1828/1828640.png" alt="Kehadiran Icon" class="w-12 h-112">
                        <p class="text-base font-semibold text-black dark:text-white">Kehadiran & Ketepatan Waktu</p>
                        <div class="flex items-center gap-2">
                            <img src="https://cdn-icons-png.flaticon.com/512/190/190411.png" alt="Star Icon" class="w-5 h-5">
                            <p class="text-sm font-bold @if($averages['kehadiran_ketepatan_waktu'] >= 4) text-green-400 @elseif($averages['kehadiran_ketepatan_waktu'] >= 3) text-blue-400 @elseif($averages['kehadiran_ketepatan_waktu'] >= 2) text-yellow-400 @else text-red-400 @endif">
                                {{ number_format($averages['kehadiran_ketepatan_waktu'], 1) }}/5
                            </p>
                        </div>
                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-3">
                            <div class="bg-blue-500 h-3 rounded-full" style="width: {{ ($averages['kehadiran_ketepatan_waktu'] / 5) * 100 }}%"></div>
                        </div>
                        <p class="text-sm text-black dark:text-white">
                            @if($averages['kehadiran_ketepatan_waktu'] >= 4) Sangat Baik!
                            @elseif($averages['kehadiran_ketepatan_waktu'] >= 3) Baik
                            @elseif($averages['kehadiran_ketepatan_waktu'] >= 2) Cukup
                            @else Perlu Peningkatan
                            @endif
                        </p>
                    </div>

                    <!-- Penilaian: Kerja Sama Tim -->
                    <div class="bg-slate-50 dark:bg-gray-800 rounded-xl py-4 px-6 space-y-2 flex flex-col items-center text-center shadow-lg">
                        <img src="https://cdn-icons-png.flaticon.com/512/1681/1681135.png" alt="Teamwork Icon" class="w-8 h-8">
                        <p class="text-base font-semibold text-black dark:text-white">Kerja Sama Tim</p>
                        <div class="flex items-center gap-2">
                            <img src="https://cdn-icons-png.flaticon.com/512/190/190411.png" alt="Star Icon" class="w-5 h-5">
                            <p class="text-sm font-bold @if($averages['kerja_sama_tim'] >= 4) text-green-400 @elseif($averages['kerja_sama_tim'] >= 3) text-blue-400 @elseif($averages['kerja_sama_tim'] >= 2) text-yellow-400 @else text-red-400 @endif">
                                {{ number_format($averages['kerja_sama_tim'], 1) }}/5
                            </p>
                        </div>
                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-3">
                            <div class="bg-blue-500 h-3 rounded-full" style="width: {{ ($averages['kerja_sama_tim'] / 5) * 100 }}%"></div>
                        </div>
                        <p class="text-sm text-black dark:text-white">
                            @if($averages['kerja_sama_tim'] >= 4) Sangat Baik!
                            @elseif($averages['kerja_sama_tim'] >= 3) Baik
                            @elseif($averages['kerja_sama_tim'] >= 2) Cukup
                            @else Perlu Peningkatan
                            @endif
                        </p>
                    </div>

                    <!-- Penilaian: Kemampuan Komunikasi -->
                    <div class="bg-slate-50 dark:bg-gray-800 rounded-xl py-4 px-6 space-y-2 flex flex-col items-center text-center shadow-lg">
                        <img src="https://cdn-icons-png.flaticon.com/512/875/875865.png" alt="Communication Icon" class="w-8 h-8">
                        <p class="text-base font-semibold text-black dark:text-white">Kemampuan Komunikasi</p>
                        <div class="flex items-center gap-2">
                            <img src="https://cdn-icons-png.flaticon.com/512/190/190411.png" alt="Star Icon" class="w-5 h-5">
                            <p class="text-sm font-bold @if($averages['kemampuan_komunikasi'] >= 4) text-green-400 @elseif($averages['kemampuan_komunikasi'] >= 3) text-blue-400 @elseif($averages['kemampuan_komunikasi'] >= 2) text-yellow-400 @else text-red-400 @endif">
                                {{ number_format($averages['kemampuan_komunikasi'], 1) }}/5
                            </p>
                        </div>
                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-3">
                            <div class="bg-blue-500 h-3 rounded-full" style="width: {{ ($averages['kemampuan_komunikasi'] / 5) * 100 }}%"></div>
                        </div>
                        <p class="text-sm text-black dark:text-white">
                            @if($averages['kemampuan_komunikasi'] >= 4) Sangat Baik!
                            @elseif($averages['kemampuan_komunikasi'] >= 3) Baik
                            @elseif($averages['kemampuan_komunikasi'] >= 2) Cukup
                            @else Perlu Peningkatan
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <!-- Container untuk Riwayat Penilaian (Awalnya Disembunyikan) -->
            <div id="historyViewContainer" class="hidden">
                <div class="bg-slate-50 dark:bg-gray-800 rounded-xl py-4 px-6 shadow-lg mt-4">
                    <h3 class="text-lg font-semibold text-black dark:text-white mb-4">Riwayat Penilaian</h3>
                    <div class="overflow-x-auto">
                        <table class="w-full border border-gray-300 text-xs md:text-sm dark:border-gray-600">
                            <thead class="bg-gray-200 text-gray-800 dark:bg-slate-700 dark:text-gray-100">
                                <tr>
                                    <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Nama Lengkap</th>
                                    <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Tanggal Penilaian</th>
                                    <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Periode</th>
                                    <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Total Skor</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($kinerja as $item)
                                    <tr>
                                        <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">{{ $item->user->nama_lengkap }}</td>
                                        <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">{{ \Carbon\Carbon::parse($item->tanggal_penilaian)->format('d-m-Y') }}</td>
                                        <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">{{ $item->periode }}</td>
                                        <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">{{ $item->total_skor }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="border border-gray-300 px-2 py-1 md:px-4 md:py-2 text-center">Belum ada data penilaian</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<style>
    #totalScoreChart {
        width: 110px !important;
        height: 110px !important;
    }

    .total-container {
        min-width: 150px;
        min-height: 150px;
    }
</style>

@push('scripts')
  
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const ctx = document.getElementById('totalScoreChart');
        const scoreText = document.getElementById('totalScoreCenterText');

        const actualScore = {{ $averages['total_skor'] ?? 0 }};
        const maxScore = 100;

        // Update angka di tengah
        scoreText.innerText = `${Math.round(actualScore)}/${maxScore}`;

        // Deteksi mode dark atau light
        const isDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches || document.documentElement.classList.contains('dark');

        // Atur warna berdasarkan theme
        const emptyColor = isDarkMode ? '#374151' : '#E2E8F0'; // dark: abu-abu gelap, light: abu-abu terang
        const fillColor = actualScore > 0 ? '#3B82F6' : 'transparent'; // Kalau skor 0, transparan

        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Skor', 'Sisa'],
                datasets: [{
                    label: 'Skor Kinerja',
                    data: [actualScore, maxScore - actualScore],
                    backgroundColor: [fillColor, emptyColor],
                    borderWidth: 0
                }]
            },
            options: {
                cutout: '75%',
                plugins: {
                    tooltip: { enabled: false },
                    legend: { display: false },
                },
                responsive: true,
                maintainAspectRatio: false
            }
        });
    });
</script>


@endpush