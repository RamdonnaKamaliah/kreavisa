@extends('layout.main')
@section('content')

<div class="p-4 md:p-6 overflow-x-hidden">
    <div class="bg-white dark:bg-slate-800 text-gray-900 dark:text-gray-100 p-4 rounded-lg shadow-md dark:shadow-lg">
        <div class="card-header pb-0">
            <h6 class="text-xl font-bold">Tambah Penilaian Karyawan</h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
            <form action="{{ route('kinerjakaryawan.store') }}" method="POST">
                @csrf
                <div class="row p-4">
                    <div class="col-md-6 mb-4">
                        <div class="form-group">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Pilih Karyawan</label>
                            <div class="mt-1 space-y-2 max-h-60 overflow-y-auto border border-gray-300 rounded-md p-2 dark:border-gray-600">
                                @foreach($users as $user)
                                    <div class="flex items-center">
                                        <input type="checkbox" name="user_ids[]" id="user_{{ $user->id }}" 
                                            value="{{ $user->id }}"
                                            class="h-4 w-4 text-blue-600 rounded border-gray-300 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="user_{{ $user->id }}" class="ml-2 text-sm text-gray-700 dark:text-gray-300">
                                            {{ $user->nama_lengkap }} - {{ $user->jabatan->nama_jabatan ?? 'Tidak ada jabatan' }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            @error('user_ids')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-4">
                        <div class="form-group">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Periode</label>
                            <select name="periode" id="periode" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                                <option value="">Pilih Periode</option>
                                @for($i = 1; $i <= 12; $i++)
                                    <option value="{{ date('F', mktime(0, 0, 0, $i, 1)) }}">{{ date('F', mktime(0, 0, 0, $i, 1)) }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-4">
                        <div class="form-group">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tanggal Penilaian</label>
                            <input type="date" name="tanggal_penilaian" id="tanggal_penilaian" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white text-blue-600 font-medium" required>
                        </div>
                    </div>
                </div>

                <!-- Aspek Penilaian -->
                <div class="px-4">
                    <div class="card mb-4">
                        <div class="card-header bg-gray-100 dark:bg-gray-700 p-3 rounded-t-lg">
                            <h6 class="mb-0 font-semibold text-gray-800 dark:text-gray-200">Aspek Penilaian</h6>
                            <p class="text-sm mb-0 text-gray-600 dark:text-gray-300">Berikan nilai 0-5 untuk setiap aspek (5 = Sangat Baik)</p>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="w-full border border-gray-300 text-sm dark:border-gray-600">
                                    <thead class="bg-gray-200 text-gray-800 dark:bg-slate-700 dark:text-gray-100">
                                        <tr>
                                            <th class="px-4 py-3 text-left w-10">No.</th>
                                            <th class="px-4 py-3 text-left w-40">Aspek</th>
                                            <th class="px-4 py-3 text-left">Detail Aspek</th>
                                            <th class="px-4 py-3 text-center w-64">Penilaian (0-5)</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-300 dark:divide-gray-600">
                                        <!-- Tanggung Jawab -->
                                        <tr class="hover:bg-gray-50 dark:hover:bg-slate-700">
                                            <td class="px-4 py-3">1.</td>
                                            <td class="px-4 py-3 font-medium">Tanggung Jawab</td>
                                            <td class="px-4 py-3">Kemampuan menyelesaikan tugas dengan bertanggung jawab dan mandiri</td>
                                            <td class="px-4 py-3">
                                                <div class="flex justify-between items-center">
                                                    @for($i = 0; $i <= 5; $i++)
                                                    <div class="flex items-center">
                                                        <input class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" type="radio" name="tanggung_jawab" id="tanggung_jawab{{$i}}" value="{{$i}}" required>
                                                        <label class="ml-1" for="tanggung_jawab{{$i}}">{{$i}}</label>
                                                    </div>
                                                    @endfor
                                                </div>
                                            </td>
                                        </tr>
                                        
                                        <!-- Kehadiran dan Ketepatan Waktu -->
                                        <tr class="hover:bg-gray-50 dark:hover:bg-slate-700">
                                            <td class="px-4 py-3">2.</td>
                                            <td class="px-4 py-3 font-medium">Kehadiran & Ketepatan Waktu</td>
                                            <td class="px-4 py-3">Konsistensi kehadiran dan ketepatan waktu dalam menyelesaikan tugas</td>
                                            <td class="px-4 py-3">
                                                <div class="flex justify-between items-center">
                                                    @for($i = 0; $i <= 5; $i++)
                                                    <div class="flex items-center">
                                                        <input class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" type="radio" name="kehadiran_ketepatan_waktu" id="kehadiran_ketepatan_waktu{{$i}}" value="{{$i}}" required>
                                                        <label class="ml-1" for="kehadiran_ketepatan_waktu{{$i}}">{{$i}}</label>
                                                    </div>
                                                    @endfor
                                                </div>
                                            </td>
                                        </tr>
                                        
                                        <!-- Produktivitas -->
                                        <tr class="hover:bg-gray-50 dark:hover:bg-slate-700">
                                            <td class="px-4 py-3">3.</td>
                                            <td class="px-4 py-3 font-medium">Produktivitas</td>
                                            <td class="px-4 py-3">Kuantitas dan kualitas hasil kerja dalam periode penilaian</td>
                                            <td class="px-4 py-3">
                                                <div class="flex justify-between items-center">
                                                    @for($i = 0; $i <= 5; $i++)
                                                    <div class="flex items-center">
                                                        <input class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" type="radio" name="produktivitas" id="produktivitas{{$i}}" value="{{$i}}" required>
                                                        <label class="ml-1" for="produktivitas{{$i}}">{{$i}}</label>
                                                    </div>
                                                    @endfor
                                                </div>
                                            </td>
                                        </tr>
                                        
                                        <!-- Kerja Sama Tim -->
                                        <tr class="hover:bg-gray-50 dark:hover:bg-slate-700">
                                            <td class="px-4 py-3">4.</td>
                                            <td class="px-4 py-3 font-medium">Kerja Sama Tim</td>
                                            <td class="px-4 py-3">Kemampuan bekerja sama dalam tim dan berkolaborasi</td>
                                            <td class="px-4 py-3">
                                                <div class="flex justify-between items-center">
                                                    @for($i = 0; $i <= 5; $i++)
                                                    <div class="flex items-center">
                                                        <input class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" type="radio" name="kerja_sama_tim" id="kerja_sama_tim{{$i}}" value="{{$i}}" required>
                                                        <label class="ml-1" for="kerja_sama_tim{{$i}}">{{$i}}</label>
                                                    </div>
                                                    @endfor
                                                </div>
                                            </td>
                                        </tr>
                                        
                                        <!-- Kemampuan Komunikasi -->
                                        <tr class="hover:bg-gray-50 dark:hover:bg-slate-700">
                                            <td class="px-4 py-3">5.</td>
                                            <td class="px-4 py-3 font-medium">Kemampuan Komunikasi</td>
                                            <td class="px-4 py-3">Kemampuan menyampaikan ide dan berinteraksi dengan rekan kerja</td>
                                            <td class="px-4 py-3">
                                                <div class="flex justify-between items-center">
                                                    @for($i = 0; $i <= 5; $i++)
                                                    <div class="flex items-center">
                                                        <input class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" type="radio" name="kemampuan_komunikasi" id="kemampuan_komunikasi{{$i}}" value="{{$i}}" required>
                                                        <label class="ml-1" for="kemampuan_komunikasi{{$i}}">{{$i}}</label>
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

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Format date
        document.getElementById('tanggal_penilaian').addEventListener('change', function() {
            let date = new Date(this.value);
            let formattedDate = date.toLocaleDateString('id-ID');
            // You can display this somewhere if needed
        });
    });
</script>
@endpush