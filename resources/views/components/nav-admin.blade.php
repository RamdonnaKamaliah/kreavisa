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


        <!-- Profile Section -->
    <a href="{{ route('profile.index') }}">
        <div
            class="flex items-center space-x-3 p-3 bg-gray-100 dark:bg-gray-500 rounded-lg mb-4 cursor-pointer hover:bg-gray-200 transition">
            @php
                $defaultPhoto = asset('asset-landing-page/img/profile.png');
                $userPhoto = auth()->user()?->foto;
                $photoUrl = $defaultPhoto;

                // Check if user has a photo
                if (!empty($userPhoto)) {
                    // Determine the correct path
                    $photoPath =
                        strpos($userPhoto, 'uploads/datakaryawan/') !== false
                            ? $userPhoto
                            : 'uploads/datakaryawan/' . $userPhoto;

                    // Check if file exists
                    if (file_exists(public_path($photoPath))) {
                        $photoUrl = asset($photoPath);
                    }
                }

                // Add cache busting
                $photoUrl .= '?v=' . time();
            @endphp

            <img src="{{ $photoUrl }}" class="w-12 h-12 rounded-full object-cover" alt="User Profile"
                onerror="this.onerror=null;this.src='{{ $defaultPhoto }}'">

            <div>
                <span class="text-sm font-semibold block dark:text-white">
                    {{ auth()->check() ? auth()->user()->nama_lengkap : 'Guest' }}
                </span>
                <span class="text-xs text-gray-400 dark:text-gray-300">
                {{ auth()->check() ? auth()->user()->email : 'admin@gmail.com' }}
                </span>
            </div>
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
                    {{ Request::routeIs('datakaryawan.*') ? 'bg-blue-100 dark:bg-blue-800 text-blue-600 dark:text-blue-300' : 'hover:bg-gray-200 dark:hover:bg-gray-700' }}">
                <span
                    class="absolute left-0 top-0 bottom-0 w-1 bg-blue-500 rounded-r 
                    {{ Request::routeIs('datakaryawan.*') ? 'block' : 'hidden group-hover:block' }}"></span>
                <i class='bx bx-archive text-indigo-500'></i>
                <span class="font-medium {{ Request::routeIs('datakaryawan.*') ? 'text-blue-600 dark:text-blue-300' : 'text-gray-800 dark:text-white' }}">Data Karyawan</span>
            </a>
        </li>
        

        <li>
            <a href="{{ route('jabatankaryawan.index') }}"
                class="flex items-center space-x-3 p-3 rounded-lg relative group transition duration-200
                    {{ Request::routeIs('jabatankaryawan.*') ? 'bg-blue-100 dark:bg-blue-800 text-blue-600 dark:text-blue-300' : 'hover:bg-gray-200 dark:hover:bg-gray-700' }}">
                <span
                    class="absolute left-0 top-0 bottom-0 w-1 bg-blue-500 rounded-r 
                    {{ Request::routeIs('jabatankaryawan.*') ? 'block' : 'hidden group-hover:block' }}"></span>
                <i class='bx bx-vector text-purple-500'></i>
                <span class="font-medium text-gray-800 dark:text-white">Jabatan Karyawan</span>
            </a>
        </li>

        <li>
            <a href="{{ route('absenkaryawan.index') }}"
                class="flex items-center space-x-3 p-3 rounded-lg relative group transition duration-200
                    {{ Request::routeIs('absenkaryawan.*') ? 'bg-blue-100 dark:bg-blue-800 text-blue-600 dark:text-blue-300' : 'hover:bg-gray-200 dark:hover:bg-gray-700' }}">
                <span
                    class="absolute left-0 top-0 bottom-0 w-1 bg-blue-500 rounded-r 
                    {{ Request::routeIs('absenkaryawan.*') ? 'block' : 'hidden group-hover:block' }}"></span>
                <i class='bx bx-bell text-green-500'></i>
                <span class="font-medium text-gray-800 dark:text-white">Absensi Karyawan</span>
            </a>
        </li>

        <li>
            <a href="{{ route('jadwalkaryawan.index') }}"
                class="flex items-center space-x-3 p-3 rounded-lg relative group transition duration-200
                    {{ Request::routeIs('jadwalkaryawan.*') || Request::routeIs('shiftkaryawan.*') ? 'bg-blue-100 dark:bg-blue-800 text-blue-600 dark:text-blue-300' : 'hover:bg-gray-200 dark:hover:bg-gray-700' }}">
                <span
                    class="absolute left-0 top-0 bottom-0 w-1 bg-blue-500 rounded-r 
                    {{ Request::routeIs('jadwalkaryawan.*') || Request::routeIs('shiftkaryawan.*') ? 'block' : 'hidden group-hover:block' }}"></span>
                <i class='bx bx-calendar text-yellow-500'></i>
                <span class="font-medium text-gray-800 dark:text-white">Jadwal Karyawan</span>
            </a>
        </li>

        <li>
            <a href="{{ route('gajikaryawan.index') }}"
                class="flex items-center space-x-3 p-3 rounded-lg relative group transition duration-200
                    {{ Request::routeIs('gajikaryawan.*') || Request::routeIs('gajipokok.*') ? 'bg-blue-100 dark:bg-blue-800 text-blue-600 dark:text-blue-300' : 'hover:bg-gray-200 dark:hover:bg-gray-700' }}">
                <span
                    class="absolute left-0 top-0 bottom-0 w-1 bg-blue-500 rounded-r 
                    {{ Request::routeIs('gajikaryawan.*') || Request::routeIs('gajipokok.*') ? 'block' : 'hidden group-hover:block' }}"></span>
                <i class='bx bx-dollar text-amber-500'></i>
                <span class="font-medium text-gray-800 dark:text-white">Gaji Karyawan</span>
            </a>
        </li>

        <li>
            <a href="{{ route('kinerjakaryawan.index') }}"
                class="flex items-center space-x-3 p-3 rounded-lg relative group transition duration-200
                    {{ Request::routeIs('kinerjakaryawan.*') ? 'bg-blue-100 dark:bg-blue-800 text-blue-600 dark:text-blue-300' : 'hover:bg-gray-200 dark:hover:bg-gray-700' }}">
                <span
                    class="absolute left-0 top-0 bottom-0 w-1 bg-blue-500 rounded-r 
                    {{ Request::routeIs('kinerjakaryawan.*') ? 'block' : 'hidden group-hover:block' }}"></span>
                <i class='bx bx-bar-chart text-lime-500'></i>
                <span class="font-medium text-gray-800 dark:text-white">Kinerja Karyawan</span>
            </a>
        </li>


    </ul>
</aside>
