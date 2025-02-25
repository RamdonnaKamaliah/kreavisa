@extends('layout2.karyawan')
@section('content')
    @push('page-title')
        Profile Karyawan
    @endpush
    <div class="max-w-4xl mx-auto py-16 px-6 bg-white rounded-2xl shadow-2xl md:mr-20 mt-10 border border-gray-300">
        <div class="flex flex-wrap items-center gap-6">
            <div
                class="w-32 h-32 bg-gradient-to-r from-blue-400 to-indigo-500 rounded-full flex items-center justify-center shadow-lg">
                <span class="text-6xl text-white">👤</span>
            </div>
            <div class="flex-1 min-w-[200px]">
                <h1 class="text-3xl font-extrabold text-gray-900">romusha</h1>
                <p class="text-gray-600">rama1@gmail.com</p>
                <p class="text-gray-600">Karyawan Navisa Basic Collection</p>
            </div>
            <div class="flex gap-3">
                <button
                    class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:opacity-90 transition duration-300 shadow-lg">Edit
                    Profile</button>
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
                <div class="bg-gray-200 p-4 rounded-lg shadow-inner">romusha</div>
            </div>
            <div>
                <label class="block text-gray-600 font-medium">No Telepon</label>
                <div class="bg-gray-200 p-4 rounded-lg shadow-inner">08675468997</div>
            </div>
            <div>
                <label class="block text-gray-600 font-medium">Jabatan</label>
                <div class="bg-gray-200 p-4 rounded-lg shadow-inner">Live</div>
            </div>
            <div>
                <label class="block text-gray-600 font-medium">Nama Lengkap</label>
                <div class="bg-gray-200 p-4 rounded-lg shadow-inner">Romusha Sarif</div>
            </div>
            <div>
                <label class="block text-gray-600 font-medium">Gender</label>
                <div class="bg-gray-200 p-4 rounded-lg shadow-inner">Laki-laki</div>
            </div>
            <div>
                <label class="block text-gray-600 font-medium">Tanggal Lahir</label>
                <div class="bg-gray-200 p-4 rounded-lg shadow-inner">13-10-2007</div>
            </div>
            <div class="sm:col-span-2">
                <label class="block text-gray-600 font-medium">Umur</label>
                <div class="bg-gray-200 p-4 rounded-lg shadow-inner">17 th</div>
            </div>
        </div>
    </div>
@endsection
