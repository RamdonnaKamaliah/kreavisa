<aside
    class="w-64 h-screen fixed left-0 top-0 bg-white dark:bg-[#1D232A] text-gray-900 shadow-md p-4 flex flex-col overflow-y-auto">
    <style>
        aside::-webkit-scrollbar {
            display: none;
        }
    </style>

    <!-- Logo / Header -->
    <a href="{{ route('admin.dashboard') }}" class="flex justify-center pb-5">
        <div class="flex items-end space-x-1">
            <h1 class="font-protest text-4xl text-transparent bg-clip-text bg-blue-500 leading-none">K</h1>
            <div class="text-2xl text-gray-800 dark:text-white font-semibold leading-tight">admin</div>
        </div>
    </a>
    <hr class="border-gray-300 dark:border-white mb-4">

    <!-- Menu -->
    <ul class="space-y-2">
        <a href="{{ route('profile.index') }}"
            class="flex items-center bg-white dark:bg-[#2C2F36] shadow-md rounded-lg p-3 gap-3 mb-6 hover:shadow-lg transition">
            <img src="{{ asset('assets/img/carousel-1.jpg') }}"
                class="w-10 h-10 rounded-full border-2 border-white shadow" alt="User">
            <div x-show="expanded" class="text-sm">
                <div class="font-semibold text-black dark:text-white">
                    {{ auth()->check() ? auth()->user()->name : 'Guest' }}
                </div>
                <div class="text-xs text-gray-600 dark:text-gray-300">Admin@gmail.com</div>
            </div>
        </a>
        <li>
            <a href="{{ route('admin.dashboard') }}"
                class="flex items-center space-x-3 p-3 rounded-lg relative group transition duration-200
                    {{ Request::routeIs('admin.dashboard') ? 'bg-blue-100 dark:bg-blue-800 text-blue-600 dark:text-blue-300' : 'hover:bg-gray-200 dark:hover:bg-gray-700' }}">
                <span
                    class="absolute left-0 top-0 bottom-0 w-1 bg-blue-500 rounded-r 
                    {{ Request::routeIs('admin.dashboard') ? 'block' : 'hidden group-hover:block' }}"></span>
                <i class='bx bx-home text-blue-500'></i>
                <span class="font-medium text-gray-800 dark:text-white">Dashboard</span>
            </a>
        </li>

        <li>
            <a href="{{ route('datakaryawan.index') }}"
                class="flex items-center space-x-3 p-3 rounded-lg relative group transition duration-200
                    {{ Request::routeIs('datakaryawan.index') ? 'bg-blue-100 dark:bg-blue-800 text-blue-600 dark:text-blue-300' : 'hover:bg-gray-200 dark:hover:bg-gray-700' }}">
                <span
                    class="absolute left-0 top-0 bottom-0 w-1 bg-blue-500 rounded-r 
                    {{ Request::routeIs('datakaryawan.index') ? 'block' : 'hidden group-hover:block' }}"></span>
                <i class='bx bx-archive text-indigo-500'></i>
                <span class="font-medium text-gray-800 dark:text-white">Data Karyawan</span>
            </a>
        </li>

        <li>
            <a href="{{ route('jabatankaryawan.index') }}"
                class="flex items-center space-x-3 p-3 rounded-lg relative group transition duration-200
                    {{ Request::routeIs('jabatankaryawan.index') ? 'bg-blue-100 dark:bg-blue-800 text-blue-600 dark:text-blue-300' : 'hover:bg-gray-200 dark:hover:bg-gray-700' }}">
                <span
                    class="absolute left-0 top-0 bottom-0 w-1 bg-blue-500 rounded-r 
                    {{ Request::routeIs('jabatankaryawan.index') ? 'block' : 'hidden group-hover:block' }}"></span>
                <i class='bx bx-vector text-purple-500'></i>
                <span class="font-medium text-gray-800 dark:text-white">Jabatan Karyawan</span>
            </a>
        </li>

        <li>
            <a href="{{ route('absenkaryawan.index') }}"
                class="flex items-center space-x-3 p-3 rounded-lg relative group transition duration-200
                    {{ Request::routeIs('absenkaryawan.index') ? 'bg-blue-100 dark:bg-blue-800 text-blue-600 dark:text-blue-300' : 'hover:bg-gray-200 dark:hover:bg-gray-700' }}">
                <span
                    class="absolute left-0 top-0 bottom-0 w-1 bg-blue-500 rounded-r 
                    {{ Request::routeIs('absenkaryawan.index') ? 'block' : 'hidden group-hover:block' }}"></span>
                <i class='bx bx-bell text-green-500'></i>
                <span class="font-medium text-gray-800 dark:text-white">Absensi Karyawan</span>
            </a>
        </li>

        <li>
            <a href="{{ route('jadwalkaryawan.index') }}"
                class="flex items-center space-x-3 p-3 rounded-lg relative group transition duration-200
                    {{ Request::routeIs('jadwalkaryawan.index') || Request::routeIs('shiftkaryawan.index') ? 'bg-blue-100 dark:bg-blue-800 text-blue-600 dark:text-blue-300' : 'hover:bg-gray-200 dark:hover:bg-gray-700' }}">
                <span
                    class="absolute left-0 top-0 bottom-0 w-1 bg-blue-500 rounded-r 
                    {{ Request::routeIs('jadwalkaryawan.index') || Request::routeIs('shiftkaryawan.index') ? 'block' : 'hidden group-hover:block' }}"></span>
                <i class='bx bx-calendar text-yellow-500'></i>
                <span class="font-medium text-gray-800 dark:text-white">Jadwal Karyawan</span>
            </a>
        </li>

        <li>
            <a href="{{ route('gajikaryawan.index') }}"
                class="flex items-center space-x-3 p-3 rounded-lg relative group transition duration-200
                    {{ Request::routeIs('gajikaryawan.index') || Request::routeIs('gajipokok.index') ? 'bg-blue-100 dark:bg-blue-800 text-blue-600 dark:text-blue-300' : 'hover:bg-gray-200 dark:hover:bg-gray-700' }}">
                <span
                    class="absolute left-0 top-0 bottom-0 w-1 bg-blue-500 rounded-r 
                    {{ Request::routeIs('gajikaryawan.index') || Request::routeIs('gajipokok.index') ? 'block' : 'hidden group-hover:block' }}"></span>
                <i class='bx bx-dollar text-amber-500'></i>
                <span class="font-medium text-gray-800 dark:text-white">Gaji Karyawan</span>
            </a>
        </li>

        <li>
            <a href="{{ route('kinerjakaryawan.index') }}"
                class="flex items-center space-x-3 p-3 rounded-lg relative group transition duration-200
                    {{ Request::routeIs('kinerjakaryawan.index') ? 'bg-blue-100 dark:bg-blue-800 text-blue-600 dark:text-blue-300' : 'hover:bg-gray-200 dark:hover:bg-gray-700' }}">
                <span
                    class="absolute left-0 top-0 bottom-0 w-1 bg-blue-500 rounded-r 
                    {{ Request::routeIs('kinerjakaryawan.index') ? 'block' : 'hidden group-hover:block' }}"></span>
                <i class='bx bx-vector text-purple-500'></i>
                <span class="font-medium text-gray-800 dark:text-white">Kinerja Karyawan</span>
            </a>
        </li>


    </ul>
</aside>
