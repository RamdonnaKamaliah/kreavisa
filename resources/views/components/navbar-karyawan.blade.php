<div class="flex min-h-screen">
    <!-- Sidebar -->
    <aside id="sidebar"
        class="w-64 bg-gray-900 text-white h-screen p-4 fixed top-0 left-0 z-40 transition-transform transform md:translate-x-0 -translate-x-full">
        
        <a class="flex items-center justify-center" href="{{ route('karyawan.dashboard') }}">
            <div>
                <h1 class="font-protest text-4xl pb-5">K</h1>
            </div>
            <div class="mx-4 text-2xl pb-5">Karyawan</div>
        </a>
        <hr class="border-gray-700 mb-4">

        <!-- Profile Section -->
        <a href="{{ route('profile.index') }}">
            <div class="flex items-center space-x-3 p-3 bg-gray-800 rounded-lg mb-4 cursor-pointer">
                <img src="{{ asset('asset-landing-page/img/profile.png') }}" class="w-12 h-12 rounded-full cursor-pointer" alt="User Profile">
                <div>
                    <span class="text-sm font-semibold block">{{ auth()->check() ? auth()->user()->name : 'Guest' }}</span>
                    <span class="text-xs text-gray-400">Karyawan</span>
                </div>
            </div>
        </a>

        <!-- Menu -->
        
<ul class="space-y-2">
    <li>
        <a href="{{ route('karyawan.dashboard') }}"
            class="flex items-center space-x-2 p-2 rounded relative group transition duration-200 
                    {{ Request::routeIs('karyawan.dashboard') ? 'bg-gray-700 text-blue-400' : 'hover:bg-gray-700 hover:text-blue-400' }}">
            <span
                class="absolute left-0 top-0 bottom-0 w-1 bg-blue-500 
                    {{ Request::routeIs('karyawan.dashboard') ? 'block' : 'hidden group-hover:block' }}"></span>
            <i class='bx bx-home'></i>
            <span class="font-popins">Dashboard</span>
        </a>
    </li>

    <li>
        <a href="{{ route('karyawan.absen.index') }}"
            class="flex items-center space-x-2 p-2 rounded relative group transition duration-200 
                    {{ Request::routeIs('karyawan.absen.index') ? 'bg-gray-700 text-blue-400' : 'hover:bg-gray-700 hover:text-blue-400' }}">
            <span
                class="absolute left-0 top-0 bottom-0 w-1 bg-blue-500 
                    {{ Request::routeIs('karyawan.absen.index') ? 'block' : 'hidden group-hover:block' }}"></span>
            <i class='bx bx-check-circle'></i>
            <span>Absensi</span>
        </a>
    </li>
    <li>
        <a href="{{ route('jadwal-karyawan.index') }}"
            class="flex items-center space-x-2 p-2 rounded relative group transition duration-200 
                    {{ Request::routeIs('jadwal-karyawan.index') ? 'bg-gray-700 text-blue-400' : 'hover:bg-gray-700 hover:text-blue-400' }}">
            <span
                class="absolute left-0 top-0 bottom-0 w-1 bg-blue-500 
                    {{ Request::routeIs('jadwal-karyawan.index') ? 'block' : 'hidden group-hover:block' }}"></span>
            <i class='bx bx-calendar'></i>
            <span>Jadwal Kerja</span>
        </a>
    </li>
    <li>
        <a href="{{ route('gaji-karyawan.index') }}"
            class="flex items-center space-x-2 p-2 rounded relative group transition duration-200 
                        {{ Request::routeIs('gaji-karyawan.index') ? 'bg-gray-700 text-blue-400' : 'hover:bg-gray-700 hover:text-blue-400' }}">
            <span
                class="absolute left-0 top-0 bottom-0 w-1 bg-blue-500 
                        {{ Request::routeIs('gaji-karyawan.index') ? 'block' : 'hidden group-hover:block' }}"></span>
            <i class='bx bx-money'></i>
            <span>Rekap Gaji</span>
        </a>
    </li>
</ul>
    </aside>
</div>
