<div class="flex min-h-screen">
    <!-- Sidebar -->
    <aside id="sidebar"
        class="w-64 bg-gray-900 text-white h-screen p-4 fixed top-0 left-0 z-40 transition-transform transform md:translate-x-0 -translate-x-full">
        
        <a class="flex items-center justify-center" href="{{ route('admin.dashboard') }}">
            <div>
                <h1 class="font-protest text-4xl pb-5">K</h1>
            </div>
            <div class="mx-4 text-2xl pb-5">admin</div>
        </a>
        <hr class="border-gray-700 mb-4">

        <!-- Profile Section -->
        <a href="{{ route('profile.index') }}">
            <div class="flex items-center space-x-3 p-3 bg-gray-800 rounded-lg mb-4 cursor-pointer">
                <img src="{{ asset('asset-landing-admin/img/undraw_profile.svg') }}" class="w-12 h-12 rounded-full cursor-pointer" alt="User Profile">
                <div>
                    <span class="text-sm font-semibold block">{{ auth()->check() ? auth()->user()->name : 'Guest' }}</span>
                    <span class="text-xs text-gray-400">Admin</span>
                </div>
            </div>
        </a>

        <!-- Menu -->
        
<ul class="space-y-2">
    <li>
        <a href="{{ route('admin.dashboard') }}"
            class="flex items-center space-x-2 p-2 rounded relative group transition duration-200 
                    {{ Request::routeIs('admin.dashboard') ? 'bg-gray-700 text-blue-400' : 'hover:bg-gray-700 hover:text-blue-400' }}">
            <span
                class="absolute left-0 top-0 bottom-0 w-1 bg-blue-500 
                    {{ Request::routeIs('admin.dashboard') ? 'block' : 'hidden group-hover:block' }}"></span>
            <i class='bx bx-home'></i>
            <span class="font-popins">Dashboard</span>
        </a>
    </li>

    <li>
        <a href="{{ route('datakaryawan.index') }}"
            class="flex items-center space-x-2 p-2 rounded relative group transition duration-200 
                    {{ Request::routeIs('datakaryawan.index') ? 'bg-gray-700 text-blue-400' : 'hover:bg-gray-700 hover:text-blue-400' }}">
            <span
                class="absolute left-0 top-0 bottom-0 w-1 bg-blue-500 
                    {{ Request::routeIs('datakaryawan.index') ? 'block' : 'hidden group-hover:block' }}"></span>
            <i class='bx bx-archive'></i>
            <span>Data Karyawan</span>
        </a>
    </li>
    <li>
        <a href="{{ route('jabatankaryawan.index') }}"
            class="flex items-center space-x-2 p-2 rounded relative group transition duration-200 
                    {{ Request::routeIs('jabatankaryawan.index') ? 'bg-gray-700 text-blue-400' : 'hover:bg-gray-700 hover:text-blue-400' }}">
            <span
                class="absolute left-0 top-0 bottom-0 w-1 bg-blue-500 
                    {{ Request::routeIs('jabatankaryawan.index') ? 'block' : 'hidden group-hover:block' }}"></span>
            <i class='bx bx-vector'></i>
            <span>Jabatan Karyawan</span>
        </a>
    </li>
    <li>
    <li>
        <a href="{{ route('absenkaryawan.index') }}"
            class="flex items-center space-x-2 p-2 rounded relative group transition duration-200 
                        {{ Request::routeIs('absenkaryawan.index') ? 'bg-gray-700 text-blue-400' : 'hover:bg-gray-700 hover:text-blue-400' }}">
            <span
                class="absolute left-0 top-0 bottom-0 w-1 bg-blue-500 
                        {{ Request::routeIs('absenkaryawan.index') ? 'block' : 'hidden group-hover:block' }}"></span>
            <i class='bx bx-bell'></i>
            <span>Absensi</span>
        </a>
    </li>
    <a href="{{ route('jadwalkaryawan.index') }}"
        class="flex items-center space-x-2 p-2 rounded relative group transition duration-200 
                    {{ Request::routeIs('jadwalkaryawan.index') ? 'bg-gray-700 text-blue-400' : 'hover:bg-gray-700 hover:text-blue-400' }}">
        <span
            class="absolute left-0 top-0 bottom-0 w-1 bg-blue-500 
                    {{ Request::routeIs('jadwalkaryawan.index') ? 'block' : 'hidden group-hover:block' }}"></span>
        <i class='bx bx-calendar'></i>
        <span>Jadwal Kerja</span>
    </a>
    </li>


    <li>
        <a href="{{ route('gajikaryawan.index') }}"
            class="flex items-center space-x-2 p-2 rounded relative group transition duration-200 
                    {{ Request::routeIs('gajikaryawan.index') || Request::routeIs('gajipokok.index') ? 'bg-gray-700 text-blue-400' : 'hover:bg-gray-700 hover:text-blue-400' }}">
            <span
                class="absolute left-0 top-0 bottom-0 w-1 bg-blue-500 
                    {{ Request::routeIs('gajikaryawan.index') || Request::routeIs('gajipokok.index') ? 'block' : 'hidden group-hover:block' }}"></span>
            <i class='bx bx-dollar'></i>
            <span>Gaji Karyawan</span>
        </a>
    </li>
    
    <li>
        <a href="{{ route('stokbarang.index') }}"
            class="flex items-center space-x-2 p-2 rounded relative group transition duration-200 
                    {{ Request::routeIs('stokbarang.index') || Request::routeIs('stokbarang.stokmasuk') || Request::routeIs('stokbarang.stokkeluar') || Request::routeIs('stokbarang.create') ? 'bg-gray-700 text-blue-400' : 'hover:bg-gray-700 hover:text-blue-400' }}">
            <span
                class="absolute left-0 top-0 bottom-0 w-1 bg-blue-500 
                    {{ Request::routeIs('stokbarang.index') || Request::routeIs('stokbarang.stokmasuk') || Request::routeIs('stokbarang.stokkeluar') || Request::routeIs('stokbarang.create')? 'block' : 'hidden group-hover:block' }}"></span>
                    <i class='bx bx-package'></i>
            <span>Stok Barang</span>
        </a>
    </li>
</ul>
    </aside>
</div>

