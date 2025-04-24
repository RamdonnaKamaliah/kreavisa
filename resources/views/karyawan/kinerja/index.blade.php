@extends('layout3.karyawan3')

@section('content')
    <div class="p-6 min-h-screen text-white">

        <h2 class="text-2xl font-bold mb-6 text-center">Kinerja Rifdah</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Chart Donat -->
            <div class="md:col-span-2 flex justify-center">
                <canvas id="totalScoreChart" width="200" height="200"></canvas>
            </div>

            <!-- Kiri - Tanggung Jawab dan Produktivitas -->
            <div class="bg-gray-800 rounded-xl p-4 space-y-4">
                <div>
                    <p class="text-sm font-semibold mb-1">Tanggung Jawab</p>
                    <p class="text-xs text-green-400 font-bold">Sangat Baik!</p>
                    <div class="w-full bg-gray-700 rounded-full h-3 mt-1">
                        <div class="bg-blue-500 h-3 rounded-full w-full"></div>
                    </div>
                    <p class="text-xs mt-1">5/5</p>
                </div>
                <div>
                    <p class="text-sm font-semibold mb-1">Produktivitas</p>
                    <p class="text-xs text-blue-400 font-bold">Baik</p>
                    <div class="w-full bg-gray-700 rounded-full h-3 mt-1">
                        <div class="bg-blue-500 h-3 rounded-full w-[80%]"></div>
                    </div>
                    <p class="text-xs mt-1">4/5</p>
                </div>
            </div>

            <!-- Kanan - Kehadiran, Kerja Sama & Inisiatif -->
            <div class="bg-gray-800 rounded-xl p-4 space-y-4">
                <div>
                    <p class="text-sm font-semibold mb-1">Kehadiran dan Ketepatan Waktu</p>
                    <p class="text-xs text-green-400 font-bold">Sangat Baik!</p>
                    <div class="w-full bg-gray-700 rounded-full h-3 mt-1">
                        <div class="bg-blue-500 h-3 rounded-full w-full"></div>
                    </div>
                    <p class="text-xs mt-1">5/5</p>
                </div>
                <div>
                    <p class="text-sm font-semibold mb-1">Kerja Sama Tim</p>
                    <p class="text-xs text-yellow-400 font-bold">Cukup Baik</p>
                    <div class="w-full bg-gray-700 rounded-full h-3 mt-1">
                        <div class="bg-blue-500 h-3 rounded-full w-[60%]"></div>
                    </div>
                    <p class="text-xs mt-1">3/5</p>
                </div>
                <div>
                    <p class="text-sm font-semibold mb-1">Inisiatif Tim</p>
                    <p class="text-xs text-red-400 font-bold">Kurang Baik</p>
                    <div class="w-full bg-gray-700 rounded-full h-3 mt-1">
                        <div class="bg-blue-500 h-3 rounded-full w-[40%]"></div>
                    </div>
                    <p class="text-xs mt-1">2/5</p>
                </div>
            </div>
        </div>

    </div>
@endsection

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
                    }
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
