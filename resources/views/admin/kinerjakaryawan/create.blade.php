@extends('layout.main')
@section('page-title', 'Create Kinerja Karyawan')
@section('content')

    <div class="p-4 md:p-6 overflow-x-hidden">
        <div class="bg-white dark:bg-slate-800 text-gray-900 dark:text-gray-100 p-4 rounded-lg shadow-md dark:shadow-lg">
            <div class="card-header pb-0">
                <a href="{{ route('kinerjakaryawan.index') }}"
                    class="inline-flex items-center text-blue-600 hover:text-blue-800 transition">
                    <i class='bx bx-arrow-back text-2xl'></i>
                </a>
                <h1 class="text-xl font-bold text-center dark:text-white">Create Kinerja Karyawan</h1>
            </div>
            @if ($errors->any())
                <div class="px-4 mb-4">
                    <div class="bg-red-50 dark:bg-red-900/30 p-3 rounded-lg">
                        @foreach ($errors->get('user_ids') as $error)
                            <p class="text-red-600 dark:text-red-400">{{ $error }}</p>
                        @endforeach
                    </div>
                </div>
            @endif
            <div class="card-body px-0 pt-0 pb-2">
                <form action="{{ route('kinerjakaryawan.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="tanggal_penilaian" value="{{ date('Y-m-d') }}">
                    <input type="hidden" name="periode" value="{{ date('F') }}">

                    <div class="row p-4">
                        <div class="col-md-12 mb-4">
                            <div class="form-group">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Pilih
                                    Karyawan<span class="text-red-500">*</label>
                                <div
                                    class="mt-1 space-y-2 max-h-60 overflow-y-auto border border-gray-300 rounded-md p-2 dark:border-gray-600">
                                    @foreach ($users as $user)
                                        <div class="flex items-center">
                                            <input type="checkbox" name="user_ids[]" id="user_{{ $user->id }}"
                                                value="{{ $user->id }}"
                                                class="h-4 w-4 text-blue-600 dark:text-green-500 rounded border-gray-300 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600">
                                            <label for="user_{{ $user->id }}"
                                                class="ml-2 text-sm text-gray-700 dark:text-gray-300">
                                                {{ $user->nama_lengkap }} -
                                                {{ $user->jabatan->nama_jabatan ?? 'Tidak ada jabatan' }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                                @error('user_ids')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Info Tanggal dan Periode -->
                    <div class="px-4 mb-4">
                        <div class="bg-blue-50 dark:bg-blue-900/30 p-3 rounded-lg">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-300">Tanggal Penilaian:</p>
                                    <p class="font-medium">{{ date('l, d F Y') }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-300">Periode:</p>
                                    <p class="font-medium">{{ date('F') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Aspek Penilaian -->
                    <div class="px-4">
                        <div class="card mb-4">
                            <div class="card-header bg-gray-100 dark:bg-gray-700 p-3 rounded-t-lg">
                                <h6 class="mb-0 font-semibold text-gray-800 dark:text-gray-200">Aspek Penilaian</h6>
                                <p class="text-sm mb-0 text-gray-600 dark:text-gray-300">Berikan nilai 1-5 untuk setiap
                                    aspek
                                    <br>5 = (sangat baik)
                                    <br>4 = (baik)
                                    <br>3 = (cukup)
                                    <br>2 = (buruk)
                                    <br>1 = (sangat buruk)
                                </p>
                            </div>
                            <div class="card-body p-0">
                                <div class="overflow-x-auto">
                                    <div class="inline-block min-w-full align-middle">
                                        <div class="overflow-hidden">
                                            <table class="min-w-full border border-gray-300 text-sm dark:border-gray-600">
                                                <thead
                                                    class="bg-gray-200 text-gray-800 dark:bg-slate-700 dark:text-gray-100">
                                                    <tr>
                                                        <th
                                                            class="px-4 py-3 text-left w-10 sticky left-0 bg-gray-200 dark:bg-slate-700 z-10">
                                                            No.</th>
                                                        <th
                                                            class="px-4 py-3 text-left w-40 sticky left-10 bg-gray-200 dark:bg-slate-700 z-10">
                                                            Aspek</th>
                                                        <th class="px-4 py-3 text-left min-w-[200px]">Detail Aspek</th>
                                                        <th class="px-4 py-3 text-center min-w-[250px]">Penilaian (1-5)<span
                                                                class="text-red-500">*</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="divide-y divide-gray-300 dark:divide-gray-600">
                                                    <tr class="hover:bg-gray-50 dark:hover:bg-slate-700">
                                                        <td class="px-4 py-3 sticky left-0 bg-white dark:bg-slate-800 z-10">
                                                            1.</td>
                                                        <td
                                                            class="px-4 py-3 font-medium sticky left-10 bg-white dark:bg-slate-800 z-10">
                                                            Tanggung Jawab</td>
                                                        <td class="px-4 py-3">Mengukur tingkat tanggung jawab karyawan terhadap tugas dan pekerjaannya.</td>
                                                        <td class="px-4 py-3">
                                                            <div class="flex justify-between items-center min-w-[250px]">
                                                                @for ($i = 1; $i <= 5; $i++)
                                                                    <div class="flex items-center">
                                                                        <input
                                                                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                                                            type="radio" name="tanggung_jawab"
                                                                            value="{{ $i }}" required>
                                                                        <label class="ml-1">{{ $i }}</label>
                                                                    </div>
                                                                @endfor
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr class="hover:bg-gray-50 dark:hover:bg-slate-700">
                                                        <td class="px-4 py-3 sticky left-0 bg-white dark:bg-slate-800 z-10">
                                                            2.</td>
                                                        <td
                                                            class="px-4 py-3 font-medium sticky left-10 bg-white dark:bg-slate-800 z-10">
                                                            Kehadiran & Ketepatan Waktu</td>
                                                        <td class="px-4 py-3">Menilai kedisiplinan karyawan dalam hal kehadiran dan ketepatan waktu dalam menjalankan tugas. Ini juga mencakup absensi, sakit, dan izin.
                                                        </td>
                                                        <td class="px-4 py-3">
                                                            <div class="flex justify-between items-center min-w-[250px]">
                                                                @for ($i = 1; $i <= 5; $i++)
                                                                    <div class="flex items-center">
                                                                        <input
                                                                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                                                            type="radio" name="kehadiran_ketepatan_waktu"
                                                                            value="{{ $i }}" required>
                                                                        <label class="ml-1">{{ $i }}</label>
                                                                    </div>
                                                                @endfor
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr class="hover:bg-gray-50 dark:hover:bg-slate-700">
                                                        <td class="px-4 py-3 sticky left-0 bg-white dark:bg-slate-800 z-10">
                                                            3.</td>
                                                        <td
                                                            class="px-4 py-3 font-medium sticky left-10 bg-white dark:bg-slate-800 z-10">
                                                            Produktivitas</td>
                                                        <td class="px-4 py-3">Mengukur seberapa banyak atau seberapa cepat karyawan dapat menyelesaikan tugas yang diberikan.</td>
                                                        <td class="px-4 py-3">
                                                            <div class="flex justify-between items-center min-w-[250px]">
                                                                @for ($i = 1; $i <= 5; $i++)
                                                                    <div class="flex items-center">
                                                                        <input
                                                                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                                                            type="radio" name="produktivitas"
                                                                            value="{{ $i }}" required>
                                                                        <label class="ml-1">{{ $i }}</label>
                                                                    </div>
                                                                @endfor
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr class="hover:bg-gray-50 dark:hover:bg-slate-700">
                                                        <td class="px-4 py-3 sticky left-0 bg-white dark:bg-slate-800 z-10">
                                                            4.</td>
                                                        <td
                                                            class="px-4 py-3 font-medium sticky left-10 bg-white dark:bg-slate-800 z-10">
                                                            Kerja Sama Tim</td>
                                                        <td class="px-4 py-3">Menilai kemampuan karyawan untuk bekerja sama dengan rekan kerja lainnya dalam satu tim.</td>
                                                        <td class="px-4 py-3">
                                                            <div class="flex justify-between items-center min-w-[250px]">
                                                                @for ($i = 1; $i <= 5; $i++)
                                                                    <div class="flex items-center">
                                                                        <input
                                                                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                                                            type="radio" name="kerja_sama_tim"
                                                                            value="{{ $i }}" required>
                                                                        <label class="ml-1">{{ $i }}</label>
                                                                    </div>
                                                                @endfor
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr class="hover:bg-gray-50 dark:hover:bg-slate-700">
                                                        <td
                                                            class="px-4 py-3 sticky left-0 bg-white dark:bg-slate-800 z-10">
                                                            5.</td>
                                                        <td
                                                            class="px-4 py-3 font-medium sticky left-10 bg-white dark:bg-slate-800 z-10">
                                                            Kemampuan Komunikasi</td>
                                                        <td class="px-4 py-3">Kemampuan menyampaikan ide dan berinteraksi
                                                            dengan rekan kerja</td>
                                                        <td class="px-4 py-3">
                                                            <div class="flex justify-between items-center min-w-[250px]">
                                                                @for ($i = 1; $i <= 5; $i++)
                                                                    <div class="flex items-center">
                                                                        <input
                                                                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                                                            type="radio" name="kemampuan_komunikasi"
                                                                            value="{{ $i }}" required>
                                                                        <label class="ml-1">{{ $i }}</label>
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
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150 ml-2">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
