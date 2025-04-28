@extends('layout.main')
@section('page-title', 'Lihat Kinerja Karyawan')
@section('content')

<div class="p-4 md:p-6 overflow-x-hidden">
    <div class="bg-white dark:bg-slate-800 text-gray-900 dark:text-gray-100 p-4 rounded-lg shadow-md dark:shadow-lg">
        <!-- Header with back button -->
        <div class="flex justify-between items-center mb-4">
            <a href="{{ route('kinerjakaryawan.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 transition">
                <i class='bx bx-arrow-back text-2xl'></i>
            </a>
            <h1 class="text-xl font-bold text-center dark:text-white">Detail Penilaian Karyawan</h1>
            <div class="w-8"></div> <!-- Spacer for alignment -->
        </div>

        <!-- Employee Information -->
        <div class="row p-4">
            <div class="col-md-12 mb-4">
                <div class="form-group">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Karyawan</label>
                    <div class="mt-1 border border-gray-300 rounded-md p-2 dark:border-gray-600 bg-gray-50 dark:bg-gray-700">
                        <p class="text-gray-700 dark:text-gray-300">
                            {{ $kinerjaKaryawan->user->nama_lengkap ?? 'N/A' }} - 
                            {{ $kinerjaKaryawan->user->jabatan->nama_jabatan ?? 'Tidak ada jabatan' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Date and Period Information -->
        <div class="px-4 mb-4">
            <div class="bg-blue-50 dark:bg-blue-900/30 p-3 rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                    <div>
                        <label class="text-sm text-gray-600 dark:text-gray-300">Tanggal Penilaian:</label>
                        <div class="mt-1 block w-full rounded-md bg-gray-100 dark:bg-gray-700 p-2">
                            {{ $kinerjaKaryawan->tanggal_penilaian }}
                        </div>
                    </div>
                    <div>
                        <label class="text-sm text-gray-600 dark:text-gray-300">Periode:</label>
                        <div class="mt-1 block w-full rounded-md bg-gray-100 dark:bg-gray-700 p-2">
                            {{ $kinerjaKaryawan->periode }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Assessment Aspects -->
        <div class="px-4">
            <div class="card mb-4">
                <div class="card-body p-0">
                    <div class="overflow-x-auto">
                        <div class="inline-block min-w-full align-middle">
                            <div class="overflow-hidden">
                                <table class="min-w-full border border-gray-300 text-sm dark:border-gray-600">
                                    <thead class="bg-gray-200 text-gray-800 dark:bg-slate-700 dark:text-gray-100">
                                        <tr>
                                            <th class="px-4 py-3 text-left w-10 sticky left-0 bg-gray-200 dark:bg-slate-700 z-10">No.</th>
                                            <th class="px-4 py-3 text-left w-40 sticky left-10 bg-gray-200 dark:bg-slate-700 z-10">Aspek</th>
                                            <th class="px-4 py-3 text-left min-w-[200px]">Detail Aspek</th>
                                            <th class="px-4 py-3 text-center min-w-[250px]">Nilai</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-300 dark:divide-gray-600">
                                        <!-- Tanggung Jawab -->
                                        <tr class="hover:bg-gray-50 dark:hover:bg-slate-700">
                                            <td class="px-4 py-3 sticky left-0 bg-white dark:bg-slate-800 z-10">1.</td>
                                            <td class="px-4 py-3 font-medium sticky left-10 bg-white dark:bg-slate-800 z-10">Tanggung Jawab</td>
                                            <td class="px-4 py-3">Kemampuan menyelesaikan tugas dengan bertanggung jawab dan mandiri</td>
                                            <td class="px-4 py-3 text-center">
                                                <span class="inline-block px-3 py-1 rounded-full 
                                                    @if($kinerjaKaryawan->tanggung_jawab >= 4) bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                                    @elseif($kinerjaKaryawan->tanggung_jawab >= 3) bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200
                                                    @else bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200 @endif">
                                                    {{ $kinerjaKaryawan->tanggung_jawab }}
                                                </span>
                                            </td>
                                        </tr>
                                        
                                        <!-- Kehadiran & Ketepatan Waktu -->
                                        <tr class="hover:bg-gray-50 dark:hover:bg-slate-700">
                                            <td class="px-4 py-3 sticky left-0 bg-white dark:bg-slate-800 z-10">2.</td>
                                            <td class="px-4 py-3 font-medium sticky left-10 bg-white dark:bg-slate-800 z-10">Kehadiran & Ketepatan Waktu</td>
                                            <td class="px-4 py-3">Konsistensi kehadiran dan ketepatan waktu dalam menyelesaikan tugas</td>
                                            <td class="px-4 py-3 text-center">
                                                <span class="inline-block px-3 py-1 rounded-full 
                                                    @if($kinerjaKaryawan->kehadiran_ketepatan_waktu >= 4) bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                                    @elseif($kinerjaKaryawan->kehadiran_ketepatan_waktu >= 3) bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200
                                                    @else bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200 @endif">
                                                    {{ $kinerjaKaryawan->kehadiran_ketepatan_waktu }}
                                                </span>
                                            </td>
                                        </tr>
                                        
                                        <!-- Produktivitas -->
                                        <tr class="hover:bg-gray-50 dark:hover:bg-slate-700">
                                            <td class="px-4 py-3 sticky left-0 bg-white dark:bg-slate-800 z-10">3.</td>
                                            <td class="px-4 py-3 font-medium sticky left-10 bg-white dark:bg-slate-800 z-10">Produktivitas</td>
                                            <td class="px-4 py-3">Kuantitas dan kualitas hasil kerja dalam periode penilaian</td>
                                            <td class="px-4 py-3 text-center">
                                                <span class="inline-block px-3 py-1 rounded-full 
                                                    @if($kinerjaKaryawan->produktivitas >= 4) bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                                    @elseif($kinerjaKaryawan->produktivitas >= 3) bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200
                                                    @else bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200 @endif">
                                                    {{ $kinerjaKaryawan->produktivitas }}
                                                </span>
                                            </td>
                                        </tr>
                                        
                                        <!-- Kerja Sama Tim -->
                                        <tr class="hover:bg-gray-50 dark:hover:bg-slate-700">
                                            <td class="px-4 py-3 sticky left-0 bg-white dark:bg-slate-800 z-10">4.</td>
                                            <td class="px-4 py-3 font-medium sticky left-10 bg-white dark:bg-slate-800 z-10">Kerja Sama Tim</td>
                                            <td class="px-4 py-3">Kemampuan bekerja sama dalam tim dan berkolaborasi</td>
                                            <td class="px-4 py-3 text-center">
                                                <span class="inline-block px-3 py-1 rounded-full 
                                                    @if($kinerjaKaryawan->kerja_sama_tim >= 4) bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                                    @elseif($kinerjaKaryawan->kerja_sama_tim >= 3) bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200
                                                    @else bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200 @endif">
                                                    {{ $kinerjaKaryawan->kerja_sama_tim }}
                                                </span>
                                            </td>
                                        </tr>
                                        
                                        <!-- Kemampuan Komunikasi -->
                                        <tr class="hover:bg-gray-50 dark:hover:bg-slate-700">
                                            <td class="px-4 py-3 sticky left-0 bg-white dark:bg-slate-800 z-10">5.</td>
                                            <td class="px-4 py-3 font-medium sticky left-10 bg-white dark:bg-slate-800 z-10">Kemampuan Komunikasi</td>
                                            <td class="px-4 py-3">Kemampuan menyampaikan ide dan berinteraksi dengan rekan kerja</td>
                                            <td class="px-4 py-3 text-center">
                                                <span class="inline-block px-3 py-1 rounded-full 
                                                    @if($kinerjaKaryawan->kemampuan_komunikasi >= 4) bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                                    @elseif($kinerjaKaryawan->kemampuan_komunikasi >= 3) bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200
                                                    @else bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200 @endif">
                                                    {{ $kinerjaKaryawan->kemampuan_komunikasi }}
                                                </span>
                                            </td>
                                        </tr>

                                        <!-- Total Score -->
                                        <tr class="hover:bg-gray-50 dark:hover:bg-slate-700 bg-gray-100 dark:bg-gray-700">
                                            <td class="px-4 py-3 sticky left-0 bg-gray-200 dark:bg-gray-700 z-10 font-bold" colspan="3">Total Skor</td>
                                            <td class="px-4 py-3 text-center font-bold">
                                                <span class="inline-block px-3 py-1 rounded-full 
                                                    @if($kinerjaKaryawan->total_skor >= 20) bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                                    @elseif($kinerjaKaryawan->total_skor >= 15) bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200
                                                    @else bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200 @endif">
                                                    {{ $kinerjaKaryawan->total_skor ?? 'N/A' }}
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection