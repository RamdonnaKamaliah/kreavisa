@extends('layout2.karyawan')
@section('content')
    @push('page-title')
        Profile Karyawan
    @endpush
    <div class="max-w-4xl mx-auto py-16 px-6 bg-white rounded-2xl shadow-2xl md:mr-20 mt-10 border border-gray-300">
        <div class="flex flex-wrap items-center gap-6">
            <div class="w-32 h-32 rounded-full flex items-center justify-center shadow-lg overflow-hidden">
                @php
                    $fotoPath = $user->foto;
                    
                    if (strpos($fotoPath, 'uploads/datakaryawan/') !== false) {
                        $photoUrl = asset($fotoPath);
                    } 
                    elseif (!empty($fotoPath)) {
                        $photoUrl = asset('uploads/datakaryawan/' . $fotoPath);
                    } 
                    else {
                        $photoUrl = asset('asset-landing-page/img/profile.png');
                    }
                    
                    $photoUrl .= '?v=' . time();
                @endphp
                
                <img src="{{ $photoUrl }}" alt="Foto Karyawan" class="w-full h-full object-cover">
            </div>
            <div class="flex-1 min-w-[200px]">
                <h1 class="text-3xl font-extrabold text-gray-900">{{ $user->nama_lengkap }}</h1>
                <p class="text-gray-600">{{ $user->email }}</p>
                <p class="text-gray-600">Karyawan Navisa Basic Colection</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('profile.edit') }}"
                    class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:opacity-90 transition duration-300 shadow-lg">Edit
                    Profile</a>
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit"
                        class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition duration-300 shadow-lg">
                        Logout
                    </button>
                </form>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-8">
            <div>
                <label class="block text-gray-600 font-medium">Username</label>
                <div class="bg-gray-200 p-4 rounded-lg shadow-inner">{{ $user->name }}</div>
            </div>
            <div>
                <label class="block text-gray-600 font-medium">No Telepon</label>
                <div class="bg-gray-200 p-4 rounded-lg shadow-inner">{{ $user->no_telepon }}</div>
            </div>
            <div>
                <label class="block text-gray-600 font-medium">Jabatan</label>
                <div class="bg-gray-200 p-4 rounded-lg shadow-inner">{{ $user->jabatan->nama_jabatan ?? 'Belum ada jabatan' }}</div>
            </div>
            <div>
                <label class="block text-gray-600 font-medium">Nama Lengkap</label>
                <div class="bg-gray-200 p-4 rounded-lg shadow-inner">{{ $user->nama_lengkap }}</div>
            </div>
            <div>
                <label class="block text-gray-600 font-medium">Gender</label>
                <div class="bg-gray-200 p-4 rounded-lg shadow-inner">{{ $user->gender }}</div>
            </div>
            <div>
                <label class="block text-gray-600 font-medium">Tanggal Lahir</label>
                <div class="bg-gray-200 p-4 rounded-lg shadow-inner">{{ \Carbon\Carbon::parse($user->tanggal_lahir)->format('d-m-Y') }}</div>
            </div>
            <div class="sm:col-span-2">
                <label class="block text-gray-600 font-medium">Umur</label>
                <div class="bg-gray-200 p-4 rounded-lg shadow-inner">{{ $user->usia }} tahun</div>
            </div>
        </div>
    </div>
@endsection
