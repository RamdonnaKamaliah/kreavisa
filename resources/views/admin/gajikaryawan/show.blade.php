@extends('layout.main')
@section('content')
    <div class="relative flex justify-center items-center py-8 px-6">
        <div class="w-full max-w-5xl text-gray-700 relative z-10">
            <div class="flex items-center mb-4">
                <a href="{{ route('gajikaryawan.index') }}" class="text-blue-500 hover:text-blue-600 text-2xl flex items-center mr-4">
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>    
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-left">
                @foreach ([
                    ['label' => 'Nama Karyawan', 'value' => $gajiKaryawan->user->nama_lengkap],
                    ['label' => 'Jabatan', 'value' => $gajiKaryawan->user->jabatan->nama_jabatan ?? '-'],
                    ['label' => 'Tanggal', 'value' => $gajiKaryawan->tanggal],
                    ['label' => 'Nomor Rekening', 'value' => $gajiKaryawan->nomor_rekening],
                    ['label' => 'Tipe Pembayaran', 'value' => ucfirst($gajiKaryawan->tipe_pembayaran)],
                    ['label' => 'Gaji Pokok', 'value' => 'Rp ' . number_format($gajiKaryawan->gaji_pokok, 0, ',', '.')],
                    ['label' => 'Bonus', 'value' => 'Rp ' . number_format($gajiKaryawan->bonus, 0, ',', '.')],
                    ['label' => 'Potongan', 'value' => 'Rp ' . number_format($gajiKaryawan->potongan, 0, ',', '.')],
                    ['label' => 'Total Gaji', 'value' => 'Rp ' . number_format($gajiKaryawan->gaji_pokok + $gajiKaryawan->bonus - $gajiKaryawan->potongan, 0, ',', '.')]
                ] as $item)
                    <div class="pb-3 border-b border-gray-600">
                        <label class="block text-gray-400 text-sm mb-1">{{ $item['label'] }}</label>
                        <p class="font-bold text-lg">{{ $item['value'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
