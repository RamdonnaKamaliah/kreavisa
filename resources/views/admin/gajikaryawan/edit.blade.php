@extends('layout.main')
@section('content')
    <div class="p-4 md:p-6 overflow-x-hidden">
        <div class="flex justify-center items-center min-h-screen py-10">
            <div class="w-full max-w-4xl bg-white dark:bg-slate-800 p-8 rounded-lg shadow-lg">
                <div class="mb-4">
                    <a href="{{ route('gajikaryawan.index') }}" class="text-blue-600 hover:text-blue-800 font-medium transition flex items-center">
                        <i class="fas fa-arrow-left mr-2"></i>
                    </a>
                </div>
                <h1 class="text-center text-2xl font-bold text-gray-800 mb-6 dark:text-white">Edit Gaji Karyawan</h1>
                <form action="{{ route('gajikaryawan.update', $gajiKaryawan->id) }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-gray-700 font-medium dark:text-gray-200">Nama Karyawan</label>
                        <input type="text" class="w-full p-3 border rounded-lg bg-gray-100" value="{{ $gajiKaryawan->user->nama_lengkap }}" readonly>
                        <input type="hidden" name="user_id" value="{{ $gajiKaryawan->user_id }}">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium dark:text-gray-200">Gaji Pokok</label>
                        <input type="number" name="gaji_pokok" value="{{ $gajiKaryawan->gaji_pokok }}" class="w-full p-3 border rounded-lg bg-gray-100" required readonly>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium dark:text-gray-200">Tanggal</label>
                        <input type="date" name="tanggal" value="{{ $gajiKaryawan->tanggal }}" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-400" required>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium dark:text-gray-200">Metode Pembayaran</label>
                        <select name="tipe_pembayaran" id="tipe_pembayaran" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-400" required onchange="handleMetodePembayaran()">
                            <option value="non_tunai" {{ $gajiKaryawan->tipe_pembayaran == 'non_tunai' ? 'selected' : '' }}>Non Tunai</option>
                            <option value="tunai" {{ $gajiKaryawan->tipe_pembayaran == 'tunai' ? 'selected' : '' }}>Tunai</option>
                        </select>
                    </div>

                    <div id="rekening-container">
                        <label class="block text-gray-700 font-medium dark:text-gray-200">Nomor Rekening</label>
                        <input type="text" id="nomor_rekening" name="nomor_rekening" value="{{ $gajiKaryawan->tipe_pembayaran == 'tunai' ? '-' : $gajiKaryawan->nomor_rekening }}" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-400" required {{ $gajiKaryawan->tipe_pembayaran == 'tunai' ? 'readonly' : '' }}>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium dark:text-gray-200">Bonus (Rp)</label>
                        <input type="number" name="bonus" value="{{ $gajiKaryawan->bonus }}" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-400">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium dark:text-gray-200">Potongan (Rp)</label>
                        <input type="number" name="potongan" value="{{ $gajiKaryawan->potongan }}" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-400">
                    </div>

                    <div class="col-span-1 md:col-span-2">
                        <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-200">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            handleMetodePembayaran(true);
        });

        function handleMetodePembayaran(onLoad = false) {
            var metode = document.getElementById('tipe_pembayaran').value;
            var nomorRekening = document.getElementById('nomor_rekening');

            if (metode === 'tunai') {
                nomorRekening.value = '-';
                nomorRekening.readOnly = true;
            } else {
                if (!onLoad) { 
                    nomorRekening.value = ''; 
                }
                nomorRekening.readOnly = false;
            }
        }
    </script>
@endsection
