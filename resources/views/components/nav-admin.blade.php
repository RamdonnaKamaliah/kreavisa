<a class="flex items-center justify-center mt-5" href="{{ route('admin.dashboard') }}">
    <h1 class="font-protest text-4xl pb-5">K</h1>
    <span class="text-2xl pb-5 font-popins relative top-0">admin</span>
</a>
<hr class="border-t border-gray-700 mb-4">


<!-- Menu -->

<ul class="space-y-2">
    <li>
        <a href="{{ route('admin.dashboard') }}"
            class="flex items-center space-x-2 p-2 rounded relative group transition duration-200 
                    {{ Request::routeIs('admin.dashboard') ? 'bg-gray-100 text-blue-600' : 'hover:bg-blue-300 hover:text-blue-600' }}">
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
                    {{ Request::routeIs('datakaryawan.index') ? 'bg-gray-100 text-blue-600' : 'hover:bg-blue-300 hover:text-blue-600' }}">
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
                    {{ Request::routeIs('jabatankaryawan.index') ? 'bg-gray-100 text-blue-600' : 'hover:bg-blue-300 hover:text-blue-600' }}">
            <span
                class="absolute left-0 top-0 bottom-0 w-1 bg-blue-500 
                    {{ Request::routeIs('jabatankaryawan.index') ? 'block' : 'hidden group-hover:block' }}"></span>
            <i class='bx bx-vector'></i>
            <span>Jabatan Karyawan</span>
        </a>
    </li>

    <li>
        <a href="{{ route('absenkaryawan.index') }}"
            class="flex items-center space-x-2 p-2 rounded relative group transition duration-200 
                        {{ Request::routeIs('absenkaryawan.index') ? 'bg-gray-100 text-blue-600' : 'hover:bg-blue-300 hover:text-blue-600' }}">
            <span
                class="absolute left-0 top-0 bottom-0 w-1 bg-blue-500 
                        {{ Request::routeIs('absenkaryawan.index') ? 'block' : 'hidden group-hover:block' }}"></span>
            <i class='bx bx-bell'></i>
            <span>Absensi</span>
        </a>
    </li>

    <li>
        <a href="{{ route('jadwalkaryawan.index') }}"
            class="flex items-center space-x-2 p-2 rounded relative group transition duration-200 
                    {{ Request::routeIs('jadwalkaryawan.index') || Request::routeIs('shiftkaryawan.index') ? 'bg-gray-100 text-blue-600' : 'hover:bg-blue-300 hover:text-blue-600' }}">
            <span
                class="absolute left-0 top-0 bottom-0 w-1 bg-blue-500 
                        {{ Request::routeIs('jadwalkaryawan.index') || Request::routeIs('shiftkaryawan.index') ? 'block' : 'hidden group-hover:block' }}"></span>
            <i class='bx bx-calendar'></i>
            <span>Jadwal Karyawan</span>
        </a>
    </li>

    <li>
        <a href="{{ route('gajikaryawan.index') }}"
            class="flex items-center space-x-2 p-2 rounded relative group transition duration-200 
                    {{ Request::routeIs('gajikaryawan.index') || Request::routeIs('gajipokok.index') ? 'bg-gray-100 text-blue-600' : 'hover:bg-blue-300 hover:text-blue-600' }}">
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
                    {{ Request::routeIs('stokbarang.index') || Request::routeIs('stokbarang.stokmasuk') || Request::routeIs('stokbarang.stokkeluar') || Request::routeIs('stokbarang.create') ? 'bg-gray-100 text-blue-600' : 'hover:bg-blue-300 hover:text-blue-600' }}">
            <span
                class="absolute left-0 top-0 bottom-0 w-1 bg-blue-500 
                        {{ Request::routeIs('stokbarang.index') || Request::routeIs('stokbarang.stokmasuk') || Request::routeIs('stokbarang.stokkeluar') || Request::routeIs('stokbarang.create') ? 'block' : 'hidden group-hover:block' }}"></span>
            <i class='bx bx-package'></i>
            <span>Stok Barang</span>
        </a>
    </li>
</ul>


{{-- <div class="mx-4">
    <!-- load phantom colors for card after: -->
    <p
        class="invisible hidden text-gray-800 text-red-500 text-red-600 text-blue-500 bg-gray-500/30 bg-cyan-500/30 bg-emerald-500/30 bg-orange-500/30 bg-red-500/30 after:bg-gradient-to-tl after:from-zinc-800 after:to-zinc-700 dark:bg-gradient-to-tl dark:from-slate-750 dark:to-gray-850 after:from-blue-700 after:to-cyan-500 after:from-orange-500 after:to-yellow-500 after:from-green-600 after:to-lime-400 after:from-red-600 after:to-orange-600 after:from-slate-600 after:to-slate-300 text-emerald-500 text-cyan-500 text-slate-400">
    </p>
    <div class="relative flex flex-col min-w-0 break-words bg-transparent border-0 shadow-none rounded-2xl bg-clip-border"
        sidenav-card>
        <img class="w-1/2 mx-auto" src="{{ asset('assets/img/illustrations/icon-documentation.svg') }}"
            alt="sidebar illustrations" />
        <div class="flex-auto w-full p-4 pt-0 text-center">
            <div class="transition-all duration-200 ease-nav-brand">
                <h6 class="mb-0 dark:text-white text-slate-700">Need help?</h6>
                <p class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-60">Please check our
                    docs</p>
            </div>
        </div>
    </div>
</div> --}}
