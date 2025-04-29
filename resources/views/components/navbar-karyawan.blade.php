<aside id="nav-menu"
    class="w-64 h-screen fixed left-0 top-0 bg-white dark:bg-[#1D232A] text-gray-900 shadow-md p-4 flex flex-col overflow-y-auto md:z-[10000]">
    <style>
        aside::-webkit-scrollbar {
            display: none;
        }
    </style>

    <!-- Logo / Header -->
    <a href="{{ route('karyawan.dashboard') }}" class="flex justify-center pb-5">
        <div class="flex items-end space-x-1">
            <h1 class="font-protest text-4xl text-transparent bg-clip-text bg-blue-500 leading-none">
                K
            </h1>
            <div class="text-2xl text-gray-800 dark:text-white font-semibold leading-tight">
                reavisa
            </div>
        </div>
    </a>
    <hr class="border-gray-300 dark:border-white mb-4">

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
                    Karyawan {{ auth()->user()?->jabatan?->nama_jabatan ?? '' }}
                </span>
            </div>
        </div>
    </a>

    <!-- Menu -->
    <ul class="space-y-2">
        @php
            $menus = [
                [
                    'route' => 'karyawan.dashboard',
                    'prefix' => 'karyawan.dashboard',
                    'icon' => 'bx-home',
                    'label' => 'Dashboard',
                    'color' => 'text-blue-500',
                ],
                [
                    'route' => 'karyawan.absen.index',
                    'prefix' => 'karyawan.absen',
                    'icon' => 'bx-check-circle',
                    'label' => 'Absensi',
                    'color' => 'text-green-500',
                ],
                [
                    'route' => 'karyawan.jadwal.index',
                    'prefix' => 'karyawan.jadwal',
                    'icon' => 'bx-calendar',
                    'label' => 'Jadwal Kerja',
                    'color' => 'text-purple-500',
                ],
                [
                    'route' => 'gajiKaryawan.index',
                    'prefix' => 'gajiKaryawan',
                    'icon' => 'bx-wallet',
                    'label' => 'Rekap Gaji',
                    'color' => 'text-amber-500',
                ],
                [
                    'route' => 'kinerja.index',
                    'prefix' => 'kinerja',
                    'icon' => 'bx-bar-chart',
                    'label' => 'Kinerja',
                    'color' => 'text-lime-500',
                ],
            ];
        @endphp
    
        @foreach ($menus as $menu)
            @php
                $currentRoute = Route::currentRouteName();
                $isActive = str_starts_with($currentRoute, $menu['prefix']);
            @endphp
            <li>
                <a href="{{ route($menu['route']) }}"
                    class="flex items-center space-x-3 p-3 rounded-lg relative group transition duration-200
                    {{ $isActive ? 'bg-blue-100 dark:bg-blue-800 text-blue-600 dark:text-blue-300' : 'hover:bg-gray-200 dark:hover:bg-gray-700' }}">
    
                    <span
                        class="absolute left-0 top-0 bottom-0 w-1 bg-blue-500 rounded-r
                        {{ $isActive ? 'block' : 'hidden group-hover:block' }}">
                    </span>
    
                    <i class='bx {{ $menu['icon'] }} w-5 h-5 {{ $menu['color'] }}'></i>
                    <span class="font-medium text-gray-800 dark:text-white">{{ $menu['label'] }}</span>
                </a>
            </li>
        @endforeach
    </ul>
    


    <!-- Logout Button -->
    <div class="pt-4 mt-2">
        <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="button" id="logout-button"
                class="w-full flex items-center space-x-3 p-3 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 transition border border-red-200">
                <i class="fa fa-sign-out-alt w-5 h-5 text-red-500"></i>
                <span class="font-medium">Logout</span>
            </button>
        </form>
    </div>


</aside>
