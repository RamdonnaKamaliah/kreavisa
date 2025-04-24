@extends('layout.main')
@section('content')
    <div id="layoutSidenav_content">
        <div class="relative flex justify-center items-center py-8 px-6">

            <div class="w-full max-w-5xl text-gray-700 relative z-10">
                <div class="flex items-center mb-4">
                    <a href="{{ route('datakaryawan.index') }}"
                        class="text-blue-500 hover:text-blue-600 text-2xl flex items-center mr-4">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div>

                <!-- Foto Karyawan -->
                <div class="flex justify-center mb-8 relative">
                    <div class="rounded-full p-2 border-4 border-blue-600 bg-gray-900 cursor-pointer" id="profilePic">
                        @if ($datakaryawan->foto)
                            <img src="{{ asset($datakaryawan->foto) }}"
                                class="w-48 h-48 rounded-full shadow-md object-cover border border-gray-600">
                        @else
                            <img src="{{ asset('asset-landing-page/img/profile.png') }}"
                                class="w-32 h-32 rounded-full shadow-md object-cover border border-gray-600">
                        @endif
                    </div>
                </div>

                <!-- Data Form -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-left dark:text-gray-300">
                    @foreach ([['label' => 'Username', 'icon' => 'user-circle', 'value' => $datakaryawan->name], ['label' => 'Nama Lengkap', 'icon' => 'user', 'value' =>
                    $datakaryawan->nama_lengkap],  ['label' => 'Gender', 'icon' => 'venus-mars', 'value' => $datakaryawan->gender], ['label' => 'Email', 'icon' => 'envelope', 'value' => $datakaryawan->email], ['label' => 'No. Telp', 'icon' => 'phone', 'value' => $datakaryawan->no_telepon], ['label' => 'Jabatan', 'icon' => 'briefcase', 'value' => $datakaryawan->jabatan->nama_jabatan ?? '-'], ['label' => 'Tanggal Lahir', 'icon' => 'calendar', 'value' => $datakaryawan->tanggal_lahir], ['label' => 'Usia', 'icon' => 'birthday-cake', 'value' => $datakaryawan->usia . ' th']] as $item)
                        <div class="pb-3 border-b border-gray-600">
                            <label class="block text-gray-400 text-sm mb-1"><i
                                    class="fas fa-{{ $item['icon'] }} mr-2"></i>{{ $item['label'] }}</label>
                            <p class="font-bold text-lg">{{ $item['value'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
