@extends('layout.main')
@section('content')

<div class="p-4 md:p-6 overflow-x-hidden">
    <div class="bg-white dark:bg-slate-800 text-gray-900 dark:text-gray-100 p-4 rounded-lg shadow-md dark:shadow-lg">
        <div class="card-header pb-0">
            <h1 class="text-xl font-bold text-center dark:text-white">Edit Penilaian Karyawan</h1>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
            <form action="{{ route('kinerjakaryawan.update', $kinerjaKaryawan->id) }}" method="POST">

                @csrf
                @method('PUT')
                
                <!-- Konten form lainnya -->
                <div class="row p-4">
                    <div class="col-md-12 mb-4">
                        <div class="form-group">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Karyawan</label>
                            <div class="mt-1 border border-gray-300 rounded-md p-2 dark:border-gray-600">
                                <p class="text-gray-700 dark:text-gray-300">
                                    {{ $kinerjaKaryawan->user->nama_lengkap }} - {{ $kinerjaKaryawan->user->jabatan->nama_jabatan ?? 'Tidak ada jabatan' }}
                                </p>
                                <input type="hidden" name="user_id" value="{{ $kinerjaKaryawan->user_id }}">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Info Tanggal dan Periode -->
                <div class="px-4 mb-4">
                    <div class="bg-blue-50 dark:bg-blue-900/30 p-3 rounded-lg">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                            <div>
                                <label class="text-sm text-gray-600 dark:text-gray-300">Tanggal Penilaian:</label>
                                <input type="date" name="tanggal_penilaian" value="{{ old('tanggal_penilaian', $kinerjaKaryawan->tanggal_penilaian) }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600">
                            </div>
                            <div>
                                <label class="text-sm text-gray-600 dark:text-gray-300">Periode:</label>
                                <input type="text" name="periode" value="{{ old('periode', $kinerjaKaryawan->periode) }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Aspek Penilaian -->
                <div class="px-4">
                    <div class="card mb-4">
                        <div class="card-header bg-gray-100 dark:bg-gray-700 p-3 rounded-t-lg">
                            <h6 class="mb-0 font-semibold text-gray-800 dark:text-gray-200">Aspek Penilaian</h6>
                            <p class="text-sm mb-0 text-gray-600 dark:text-gray-300">Berikan nilai 1-5 untuk setiap aspek
                                <br>5 = (sangat baik)
                                <br>4 = (baik)
                                <br>3 = (cukup)
                                <br>2 = (buruk)
                                <br>1 = (sangat buruk)</p>
                        </div>
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
                                                    <th class="px-4 py-3 text-center min-w-[250px]">Penilaian (1-5)</th>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y divide-gray-300 dark:divide-gray-600">
                                                <tr class="hover:bg-gray-50 dark:hover:bg-slate-700">
                                                    <td class="px-4 py-3 sticky left-0 bg-white dark:bg-slate-800 z-10">1.</td>
                                                    <td class="px-4 py-3 font-medium sticky left-10 bg-white dark:bg-slate-800 z-10">Tanggung Jawab</td>
                                                    <td class="px-4 py-3">Kemampuan menyelesaikan tugas dengan bertanggung jawab dan mandiri</td>
                                                    <td class="px-4 py-3">
                                                        <div class="flex justify-between items-center min-w-[250px]">
                                                            @for($i = 1; $i <= 5; $i++)
                                                            <div class="flex items-center">
                                                                <input class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" 
                                                                       type="radio" 
                                                                       name="tanggung_jawab" 
                                                                       value="{{$i}}" 
                                                                       {{ old('tanggung_jawab', $kinerjaKaryawan->tanggung_jawab) == $i ? 'checked' : '' }}
                                                                       required>
                                                                <label class="ml-1">{{$i}}</label>
                                                            </div>
                                                            @endfor
                                                        </div>
                                                    </td>
                                                </tr>
                                                
                                                <tr class="hover:bg-gray-50 dark:hover:bg-slate-700">
                                                    <td class="px-4 py-3 sticky left-0 bg-white dark:bg-slate-800 z-10">2.</td>
                                                    <td class="px-4 py-3 font-medium sticky left-10 bg-white dark:bg-slate-800 z-10">Kehadiran & Ketepatan Waktu</td>
                                                    <td class="px-4 py-3">Konsistensi kehadiran dan ketepatan waktu dalam menyelesaikan tugas</td>
                                                    <td class="px-4 py-3">
                                                        <div class="flex justify-between items-center min-w-[250px]">
                                                            @for($i = 1; $i <= 5; $i++)
                                                            <div class="flex items-center">
                                                                <input class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" 
                                                                       type="radio" 
                                                                       name="kehadiran_ketepatan_waktu" 
                                                                       value="{{$i}}" 
                                                                       {{ old('kehadiran_ketepatan_waktu', $kinerjaKaryawan->kehadiran_ketepatan_waktu) == $i ? 'checked' : '' }}
                                                                       required>
                                                                <label class="ml-1">{{$i}}</label>
                                                            </div>
                                                            @endfor
                                                        </div>
                                                    </td>
                                                </tr>
                                                
                                                <tr class="hover:bg-gray-50 dark:hover:bg-slate-700">
                                                    <td class="px-4 py-3 sticky left-0 bg-white dark:bg-slate-800 z-10">3.</td>
                                                    <td class="px-4 py-3 font-medium sticky left-10 bg-white dark:bg-slate-800 z-10">Produktivitas</td>
                                                    <td class="px-4 py-3">Kuantitas dan kualitas hasil kerja dalam periode penilaian</td>
                                                    <td class="px-4 py-3">
                                                        <div class="flex justify-between items-center min-w-[250px]">
                                                            @for($i = 1; $i <= 5; $i++)
                                                            <div class="flex items-center">
                                                                <input class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" 
                                                                       type="radio" 
                                                                       name="produktivitas" 
                                                                       value="{{$i}}" 
                                                                       {{ old('produktivitas', $kinerjaKaryawan->produktivitas) == $i ? 'checked' : '' }}
                                                                       required>
                                                                <label class="ml-1">{{$i}}</label>
                                                            </div>
                                                            @endfor
                                                        </div>
                                                    </td>
                                                </tr>
                                                
                                                <tr class="hover:bg-gray-50 dark:hover:bg-slate-700">
                                                    <td class="px-4 py-3 sticky left-0 bg-white dark:bg-slate-800 z-10">4.</td>
                                                    <td class="px-4 py-3 font-medium sticky left-10 bg-white dark:bg-slate-800 z-10">Kerja Sama Tim</td>
                                                    <td class="px-4 py-3">Kemampuan bekerja sama dalam tim dan berkolaborasi</td>
                                                    <td class="px-4 py-3">
                                                        <div class="flex justify-between items-center min-w-[250px]">
                                                            @for($i = 1; $i <= 5; $i++)
                                                            <div class="flex items-center">
                                                                <input class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" 
                                                                       type="radio" 
                                                                       name="kerja_sama_tim" 
                                                                       value="{{$i}}" 
                                                                       {{ old('kerja_sama_tim', $kinerjaKaryawan->kerja_sama_tim) == $i ? 'checked' : '' }}
                                                                       required>
                                                                <label class="ml-1">{{$i}}</label>
                                                            </div>
                                                            @endfor
                                                        </div>
                                                    </td>
                                                </tr>
                                                
                                                <tr class="hover:bg-gray-50 dark:hover:bg-slate-700">
                                                    <td class="px-4 py-3 sticky left-0 bg-white dark:bg-slate-800 z-10">5.</td>
                                                    <td class="px-4 py-3 font-medium sticky left-10 bg-white dark:bg-slate-800 z-10">Kemampuan Komunikasi</td>
                                                    <td class="px-4 py-3">Kemampuan menyampaikan ide dan berinteraksi dengan rekan kerja</td>
                                                    <td class="px-4 py-3">
                                                        <div class="flex justify-between items-center min-w-[250px]">
                                                            @for($i = 1; $i <= 5; $i++)
                                                            <div class="flex items-center">
                                                                <input class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" 
                                                                       type="radio" 
                                                                       name="kemampuan_komunikasi" 
                                                                       value="{{$i}}" 
                                                                       {{ old('kemampuan_komunikasi', $kinerjaKaryawan->kemampuan_komunikasi) == $i ? 'checked' : '' }}
                                                                       required>
                                                                <label class="ml-1">{{$i}}</label>
                                                            </div>
                                                            @endfor
                                                        </div>
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

                <div class="row p-4">
                    <div class="col-12 text-end">
                        <a href="{{ route('kinerjakaryawan.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-600 focus:bg-gray-600 active:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">Batal</a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150 ml-2">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection