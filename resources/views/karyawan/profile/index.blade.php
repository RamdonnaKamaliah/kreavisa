@extends('layout3.karyawan3')
@section('page-title', 'Profile')
@section('content')
    <div class="max-w-5xl mx-auto py-16 px-8 bg-white dark:bg-slate-900 rounded-3xl shadow-2xl mt-10 border border-gray-200 dark:border-slate-700 text-gray-900 dark:text-white">
        
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div class="flex items-center gap-6">
                <!-- Profile Photo -->
                <div class="w-28 h-28 md:w-32 md:h-32 rounded-full overflow-hidden border-4 border-blue-500 shadow-lg">
                    @php
                        $defaultPhoto = asset('asset-landing-page/img/profile.png');
                        $photoPath = !empty($user->foto) 
                            ? (strpos($user->foto, 'uploads/datakaryawan/') !== false 
                                ? $user->foto 
                                : 'uploads/datakaryawan/' . $user->foto) 
                            : '';
                        $photoUrl = (!empty($photoPath) && file_exists(public_path($photoPath)))
                            ? asset($photoPath)
                            : $defaultPhoto;
                        $photoUrl .= '?v=' . time();
                    @endphp
                    <img src="{{ $photoUrl }}" alt="Foto Karyawan" class="w-full h-full object-cover" onerror="this.onerror=null;this.src='{{ $defaultPhoto }}'">
                </div>

                <!-- Info Singkat -->
                <div>
                    <h1 class="text-3xl font-bold text-black dark:text-white">{{ $user->nama_lengkap }}</h1>
                    <p class="text-gray-600 dark:text-gray-300">{{ $user->email }}</p>
                    <p class="text-sm text-amber-600 dark:text-amber-400 mt-1 font-semibold">Karyawan Navisa Basic Collection</p>
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('profile.edit') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg transition shadow-md font-medium">
                    Edit Profile
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-5 py-2.5 rounded-lg transition shadow-md font-medium">
                        Logout
                    </button>
                </form>
            </div>
        </div>

        <!-- Detail Info -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-10">
            <div>
                <label class="block text-sm text-gray-500 dark:text-gray-400 font-semibold mb-1">Username</label>
                <div class="bg-gray-100 dark:bg-slate-800 p-4 rounded-lg shadow-inner">{{ $user->name }}</div>
            </div>
            <div>
                <label class="block text-sm text-gray-500 dark:text-gray-400 font-semibold mb-1">No Telepon</label>
                <div class="bg-gray-100 dark:bg-slate-800 p-4 rounded-lg shadow-inner">{{ $user->no_telepon }}</div>
            </div>
            <div>
                <label class="block text-sm text-gray-500 dark:text-gray-400 font-semibold mb-1">Jabatan</label>
                <div class="bg-gray-100 dark:bg-slate-800 p-4 rounded-lg shadow-inner">{{ $user->jabatan->nama_jabatan ?? 'Belum ada jabatan' }}</div>
            </div>
            <div>
                <label class="block text-sm text-gray-500 dark:text-gray-400 font-semibold mb-1">Nama Lengkap</label>
                <div class="bg-gray-100 dark:bg-slate-800 p-4 rounded-lg shadow-inner">{{ $user->nama_lengkap }}</div>
            </div>
            <div>
                <label class="block text-sm text-gray-500 dark:text-gray-400 font-semibold mb-1">Gender</label>
                <div class="bg-gray-100 dark:bg-slate-800 p-4 rounded-lg shadow-inner">{{ $user->gender }}</div>
            </div>
            <div>
                <label class="block text-sm text-gray-500 dark:text-gray-400 font-semibold mb-1">Tanggal Lahir</label>
                <div class="bg-gray-100 dark:bg-slate-800 p-4 rounded-lg shadow-inner">{{ \Carbon\Carbon::parse($user->tanggal_lahir)->format('d-m-Y') }}</div>
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm text-gray-500 dark:text-gray-400 font-semibold mb-1">Umur</label>
                <div class="bg-gray-100 dark:bg-slate-800 p-4 rounded-lg shadow-inner">{{ $user->usia }} tahun</div>
            </div>
        </div>
    </div>
@endsection
