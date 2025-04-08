<a class="flex items-center justify-center" href="{{ route('karyawan.dashboard') }}">
    <div>
        <h1 class="font-protest text-4xl pb-5 text-gray-900">K</h1>
    </div>
    <div class="mx-4 text-2xl pb-5 text-gray-900">Karyawan</div>
</a>
<hr class="border-gray-300 mb-4">

<!-- Profile Section -->
<a href="{{ route('profile.index') }}">
    <div class="flex items-center space-x-3 p-3 bg-gray-200 rounded-lg mb-4 cursor-pointer">
        <img src="{{ asset('asset-landing-page/img/profile.png') }}" class="w-12 h-12 rounded-full cursor-pointer"
            alt="User Profile">
        <div>
            <span
                class="text-sm font-semibold block text-gray-900">{{ auth()->check() ? auth()->user()->name : 'Guest' }}</span>
            <span class="text-xs text-gray-600">Karyawan</span>
        </div>
    </div>
</a>

<!-- Menu -->

<ul class="space-y-2">
    <li>
        <a href="{{ route('karyawan.dashboard') }}"
            class="flex items-center space-x-2 p-2 rounded relative group transition duration-200 
                    {{ Request::routeIs('karyawan.dashboard') ? 'bg-gray-300 text-blue-600' : 'hover:bg-gray-300 hover:text-blue-600' }}">
            <span
                class="absolute left-0 top-0 bottom-0 w-1 bg-blue-500 
                    {{ Request::routeIs('karyawan.dashboard') ? 'block' : 'hidden group-hover:block' }}"></span>
            <i class='bx bx-home text-gray-900'></i>
            <span class="font-popins text-gray-900">Dashboard</span>
        </a>
    </li>

    <li>
        <a href="{{ route('karyawan.absen.index') }}"
            class="flex items-center space-x-2 p-2 rounded relative group transition duration-200 
                    {{ Request::routeIs('karyawan.absen.index') ? 'bg-gray-300 text-blue-600' : 'hover:bg-gray-300 hover:text-blue-600' }}">
            <span
                class="absolute left-0 top-0 bottom-0 w-1 bg-blue-500 
                    {{ Request::routeIs('karyawan.absen.index') ? 'block' : 'hidden group-hover:block' }}"></span>
            <i class='bx bx-check-circle text-gray-900'></i>
            <span class="text-gray-900">Absensi</span>
        </a>
    </li>
    <li>
        <a href="{{ route('karyawan.jadwal.index') }}"
            class="flex items-center space-x-2 p-2 rounded relative group transition duration-200 
                    {{ Request::routeIs('karyawan.jadwal.index') ? 'bg-gray-300 text-blue-600' : 'hover:bg-gray-300 hover:text-blue-600' }}">
            <span
                class="absolute left-0 top-0 bottom-0 w-1 bg-blue-500 
                    {{ Request::routeIs('karyawan.jadwal.index') ? 'block' : 'hidden group-hover:block' }}"></span>
            <i class='bx bx-calendar text-gray-900'></i>
            <span class="text-gray-900">Jadwal Kerja</span>
        </a>
    </li>
    <li>
        <a href="{{ route('gajiKaryawan.index') }}"
            class="flex items-center space-x-2 p-2 rounded relative group transition duration-200 
                        {{ Request::routeIs('gajiKaryawan.index') ? 'bg-gray-300 text-blue-600' : 'hover:bg-gray-300 hover:text-blue-600' }}">
            <span
                class="absolute left-0 top-0 bottom-0 w-1 bg-blue-500 
                        {{ Request::routeIs('gajiKaryawan.index') ? 'block' : 'hidden group-hover:block' }}"></span>
            <i class='bx bx-money text-gray-900'></i>
            <span class="text-gray-900">Rekap Gaji</span>
        </a>
    </li>
</ul>
