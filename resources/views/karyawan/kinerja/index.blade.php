@extends('layout3.karyawan3')
@section('page-title', 'Kinerja')
@section('content')
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 pt-12 px-6 min-h-screen h-auto overflow-y-auto">
        <!-- Chart Total -->
        <div
            class="flex flex-col items-center gap-2 bg-slate-50 dark:bg-gray-800 rounded-xl py-4 px-6 min-w-[100px] shadow-lg">
            <h3 class="text-black dark:text-white font-bold font-popins">Total</h3>
            <canvas id="totalScoreChart" width="50" height="500"></canvas>
            <div class="flex items-center gap-1">
                <img src="https://cdn-icons-png.flaticon.com/512/1828/1828884.png" alt="Star Icon" class="w-5 h-5">
                <img src="https://cdn-icons-png.flaticon.com/512/1828/1828884.png" alt="Star Icon" class="w-5 h-5">
                <img src="https://cdn-icons-png.flaticon.com/512/1828/1828884.png" alt="Star Icon" class="w-5 h-5">
                <img src="https://cdn-icons-png.flaticon.com/512/1828/1828884.png" alt="Star Icon" class="w-5 h-5">
                <img src="https://cdn-icons-png.flaticon.com/512/1828/1828884.png" alt="Star Icon" class="w-5 h-5">
            </div>
        </div>


        <!-- Penilaian: Tanggung Jawab -->
        <div
            class="bg-slate-50 dark:bg-gray-800 rounded-xl py-4 px-6 space-y-2 flex flex-col items-center text-center shadow-lg">
            <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Responsibility Icon" class="w-8 h-8">
            <p class="text-base font-semibold text-black dark:text-white">Tanggung Jawab</p>
            <div class="flex items-center gap-2">
                <img src="https://cdn-icons-png.flaticon.com/512/190/190411.png" alt="5 Star Icon" class="w-5 h-5">
                <p class="text-sm text-green-400 font-bold">5/5</p>
            </div>
            <div class="w-full bg-slate-50 dark:bg-gray-700 rounded-full h-3">
                <div class="bg-blue-500 h-3 rounded-full w-full"></div>
            </div>
            <p class="text-sm text-black dark:text-white">Sangat Baik!</p>
        </div>

        <!-- Penilaian: Produktivitas -->
        <div
            class="bg-slate-50 dark:bg-gray-800 rounded-xl py-4 px-6 space-y-2 flex flex-col items-center text-center shadow-lg">
            <img src="https://cdn-icons-png.flaticon.com/512/190/190406.png" alt="Produktivitas Icon" class="w-8 h-8">
            <p class="text-base font-semibold text-black dark:text-white">Produktivitas</p>
            <div class="flex items-center gap-2">
                <img src="https://cdn-icons-png.flaticon.com/512/190/190410.png" alt="4 Star Icon" class="w-5 h-5">
                <p class="text-sm text-blue-400 font-bold">4/5</p>
            </div>
            <div class="w-full bg-gray-700 rounded-full h-3">
                <div class="bg-blue-500 h-3 rounded-full w-[80%]"></div>
            </div>
            <p class="text-sm text-black dark:text-white">Baik</p>
        </div>


        <!-- Penilaian: Kehadiran & Ketepatan Waktu -->
        <div
            class="bg-slate-50 dark:bg-gray-800 rounded-xl py-4 px-6 space-y-2 flex flex-col items-center text-center shadow-lg">
            <img src="https://cdn-icons-png.flaticon.com/512/1828/1828640.png" alt="Kehadiran Icon" class="w-12 h-112">
            <p class="text-base font-semibold text-black dark:text-white">Kehadiran & Ketepatan Waktu</p>
            <div class="flex items-center gap-2">
                <img src="https://cdn-icons-png.flaticon.com/512/190/190411.png" alt="5 Star Icon" class="w-5 h-5">
                <p class="text-sm text-green-400 font-bold">5/5</p>
            </div>
            <div class="w-full bg-slate-50 dark:bg-gray-800 rounded-full h-3">
                <div class="bg-blue-500 h-3 rounded-full w-full"></div>
            </div>
            <p class="text-sm text-black dark:text-white">Sangat Baik!</p>
        </div>

        <!-- Penilaian: Kerja Sama Tim -->
        <div
            class="bg-slate-50 dark:bg-gray-800 rounded-xl py-4 px-6 space-y-2 flex flex-col items-center text-center shadow-lg">
            <img src="https://cdn-icons-png.flaticon.com/512/1681/1681135.png" alt="Teamwork Icon" class="w-8 h-8">
            <p class="text-base font-semibold text-black dark:text-white">Kerja Sama Tim</p>
            <div class="flex items-center gap-2">
                <img src="https://cdn-icons-png.flaticon.com/512/190/190408.png" alt="3 Star Icon" class="w-5 h-5">
                <p class="text-sm text-yellow-400 font-bold">3/5</p>
            </div>
            <div class="w-full bg-gray-700 rounded-full h-3">
                <div class="bg-blue-500 h-3 rounded-full w-[60%]"></div>
            </div>
            <p class="text-sm text-black dark:text-white">Cukup Baik</p>
        </div>

        <!-- Penilaian: Inisiatif Tim -->
        <div
            class="bg-slate-50 dark:bg-gray-800 rounded-xl py-4 px-6 space-y-2 flex flex-col items-center text-center shadow-lg">
            <img src="https://cdn-icons-png.flaticon.com/512/875/875865.png" alt="Inisiatif Icon" class="w-8 h-8">
            <p class="text-base font-semibold text-black dark:text-white">Inisiatif Tim</p>
            <div class="flex items-center gap-2">
                <img src="https://cdn-icons-png.flaticon.com/512/190/190407.png" alt="2 Star Icon" class="w-5 h-5">
                <p class="text-sm text-red-400 font-bold">2/5</p>
            </div>
            <div class="w-full bg-gray-700 rounded-full h-3">
                <div class="bg-blue-500 h-3 rounded-full w-[40%]"></div>
            </div>
            <p class="text-sm text-black dark:text-white">Kurang Baik</p>
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
    <script>
        const ctx = document.getElementById('totalScoreChart');

        const actualScore = 5 + 4 + 5 + 3 + 2; // total = 19
        const maxScore = 25;

        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Skor', 'Sisa'],
                datasets: [{
                    label: 'Skor Kinerja',
                    data: [actualScore, maxScore - actualScore],
                    backgroundColor: ['#3B82F6', '#1F2937'],
                    borderWidth: 0
                }]
            },
            options: {
                cutout: '75%',
                plugins: {
                    tooltip: {
                        enabled: false
                    },
                    legend: {
                        display: false
                    },
                    responsive: true,
                }
            },
            plugins: [{
                id: 'centerText',
                beforeDraw: function(chart) {
                    const width = chart.width,
                        height = chart.height,
                        ctx = chart.ctx;
                    ctx.restore();
                    const fontSize = (height / 100).toFixed(2);
                    ctx.font = fontSize + "em sans-serif";
                    ctx.textBaseline = "middle";
                    const text = `${actualScore}/${maxScore}`,
                        textX = Math.round((width - ctx.measureText(text).width) / 2),
                        textY = height / 2;
                    ctx.fillStyle = '#fff';
                    ctx.fillText(text, textX, textY);
                    ctx.save();
                }
            }]
        });
    </script>
@endpush
