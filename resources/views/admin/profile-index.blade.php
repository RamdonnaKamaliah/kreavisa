@extends('layout.main')
@section('content')
    @push('page-title')
        Profile Admin
    @endpush
    <div
        class="max-w-4xl mx-auto py-16 px-6 bg-white dark:bg-gray-800 rounded-2xl shadow-2xl md:mr-20 mt-10 border border-gray-300">
        <div class="flex flex-wrap items-center gap-6">
            <div
                class="w-32 h-32 bg-gradient-to-r from-blue-400 to-indigo-500 rounded-full flex items-center justify-center shadow-lg">
                <span class="text-6xl text-white">👤</span>
            </div>
            <div class="flex-1 min-w-[200px]">
                <h1 class="text-3xl font-extrabold text-gray-900 dark:text-gray-200">{{ $user->name }}</h1>
                <p class="text-gray-600 dark:text-gray-400">{{ $user->email }}</p>
                <p class="text-gray-600 dark:text-gray-400">Admin Navisa Basic Collection</p>
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
                <label class="block text-gray-600 dark:text-gray-400 font-medium">Username</label>
                <div class="bg-gray-200 dark:bg-gray-700 p-4 rounded-lg shadow-inner">{{ $user->name }}</div>
            </div>
            <div>
                <label class="block text-gray-600 dark:text-gray-400 font-medium">Email</label>
                <div class="bg-gray-200 dark:bg-gray-700 p-4 rounded-lg shadow-inner">{{ $user->email }}</div>
            </div>
            <div>
                <label class="block text-gray-600 dark:text-gray-400 font-medium">User Type</label>
                <div class="bg-gray-200 dark:bg-gray-700 p-4 rounded-lg shadow-inner">{{ $user->usertype }}</div>
            </div>
        </div>
    </div>
@endsection
