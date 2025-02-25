@extends('layout3.karyawan3')
@section('content')
    <div class="max-w-4xl mx-auto py-16 px-6 bg-white rounded-2xl shadow-lg md:mr-20 mt-10 border border-gray-200">
        <div class="flex flex-wrap items-center gap-6">
            <div
                class="w-32 h-32 bg-gradient-to-r from-blue-400 to-indigo-500 rounded-full flex items-center justify-center shadow-md">
                <span class="text-6xl text-white">👤</span>
            </div>
            <div class="flex-1 min-w-[200px]">
                <h1 class="text-3xl font-extrabold text-gray-800">romusha</h1>
                <p class="text-gray-600">rama1@gmail.com</p>
                <p class="text-gray-600">Karyawan Navisa Basic Collection</p>
            </div>
            <div class="flex gap-3">
                <button
                    class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300 shadow-md">Edit
                    Profile</button>
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit"
                        class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition duration-300 shadow-md">
                        Logout
                    </button>
                </form>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-8">
            <div>
                <label class="block text-gray-700 font-medium">Username</label>
                <div class="bg-gray-100 p-4 rounded-lg shadow-inner border border-gray-300">romusha</div>
            </div>
            <div>
                <label class="block text-gray-700 font-medium">No Telepon</label>
                <div class="bg-gray-100 p-4 rounded-lg shadow-inner border border-gray-300">08675468997</div>
            </div>
            <div>
                <label class="block text-gray-700 font-medium">Jabatan</label>
                <div class="bg-gray-100 p-4 rounded-lg shadow-inner border border-gray-300">Live</div>
            </div>
            <div>
                <label class="block text-gray-700 font-medium">Nama Lengkap</label>
                <div class="bg-gray-100 p-4 rounded-lg shadow-inner border border-gray-300">Romusha Sarif</div>
            </div>
            <div>
                <label class="block text-gray-700 font-medium">Gender</label>
                <div class="bg-gray-100 p-4 rounded-lg shadow-inner border border-gray-300">Laki-laki</div>
            </div>
            <div>
                <label class="block text-gray-700 font-medium">Tanggal Lahir</label>
                <div class="bg-gray-100 p-4 rounded-lg shadow-inner border border-gray-300">13-10-2007</div>
            </div>
            <div class="sm:col-span-2">
                <label class="block text-gray-700 font-medium">Umur</label>
                <div class="bg-gray-100 p-4 rounded-lg shadow-inner border border-gray-300">17 th</div>
            </div>
        </div>
    </div>
@endsection
