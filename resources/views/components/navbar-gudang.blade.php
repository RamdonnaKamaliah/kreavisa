<a class="flex items-center justify-center mt-5" href="{{ route('admin.dashboard') }}">
    <h1 class="font-protest text-4xl pb-5">K</h1>
    <span class="text-2xl pb-5 font-popins relative top-0">Karyawan</span>
</a>
<hr class="border-t border-gray-700 mb-4">

<!-- Profile Section -->
<a href="{{ route('profile.index') }}">
    <div class="flex items-center space-x-3 p-3 bg-gray-100 rounded-lg mb-4 cursor-pointer">
        @php
            $foto = auth()->user()?->foto;

            if (strpos($foto, 'uploads/datakaryawan/') !== false) {
                $photoUrl = asset($foto);
            } elseif (!empty($foto)) {
                $photoUrl = asset('uploads/datakaryawan/' . $foto);
            } else {
                $photoUrl = asset('asset-landing-page/img/profile.png');
            }

            $photoUrl .= '?v=' . time();
        @endphp

        <img src="{{ $photoUrl }}" class="w-12 h-12 rounded-full object-cover cursor-pointer" alt="User Profile">

        <div>
            <span
                class="text-sm font-semibold block">{{ auth()->check() ? auth()->user()->nama_lengkap : 'Guest' }}</span>
            <span class="text-xs text-gray-400">
                Karyawan {{ auth()->user()?->jabatan?->nama_jabatan ?? '' }}
            </span>
        </div>
    </div>
</a>


<!-- Menu -->
<ul class="space-y-2">
    <li>
        <a href="{{ route('gudang.dashboard') }}"
            class="flex items-center space-x-2 p-2 rounded relative group transition duration-200 
                    {{ Request::routeIs('gudang.dashboard') ? 'bg-gray-100 text-blue-600' : 'hover:bg-blue-300 hover:text-blue-600' }}">
            <span
                class="absolute left-0 top-0 bottom-0 w-1 bg-blue-500 
                    {{ Request::routeIs('gudang.dashboard') ? 'block' : 'hidden group-hover:block' }}"></span>
            <i class='bx bx-home'></i>
            <span class="font-popins">Dashboard</span>
        </a>
    </li>

    <li>
        <a href="{{ route('gudang.absen.index') }}"
            class="flex items-center space-x-2 p-2 rounded relative group transition duration-200 
                    {{ Request::routeIs('gudang.absen.index') ? 'bg-gray-100 text-blue-600' : 'hover:bg-blue-300 hover:text-blue-600' }}">
            <span
                class="absolute left-0 top-0 bottom-0 w-1 bg-blue-500 
                    {{ Request::routeIs('gudang.absen.index') ? 'block' : 'hidden group-hover:block' }}"></span>
            <i class='bx bx-check-circle'></i>
            <span>Absensi</span>
        </a>
    </li>

    <li>
        <a href="{{ route('gudang.jadwal.index') }}"
            class="flex items-center space-x-2 p-2 rounded relative group transition duration-200 
                    {{ Request::routeIs('gudang.jadwal.index') ? 'bg-gray-100 text-blue-600' : 'hover:bg-blue-300 hover:text-blue-600' }}">
            <span
                class="absolute left-0 top-0 bottom-0 w-1 bg-blue-500 
                    {{ Request::routeIs('gudang.jadwal.index') ? 'block' : 'hidden group-hover:block' }}"></span>
            <i class='bx bx-calendar'></i>
            <span>Jadwal Kerja</span>
        </a>
    </li>

    <li>
        <a href="{{ route('gajiGudang.index') }}"
            class="flex items-center space-x-2 p-2 rounded relative group transition duration-200 
                    {{ Request::routeIs('gajiGudang.index') ? 'bg-gray-100 text-blue-600' : 'hover:bg-blue-300 hover:text-blue-600' }}">
            <span
                class="absolute left-0 top-0 bottom-0 w-1 bg-blue-500 
                    {{ Request::routeIs('gajiGudang.index') ? 'block' : 'hidden group-hover:block' }}"></span>
            <i class='bx bx-money'></i>
            <span>Rekap Gaji</span>
        </a>
    </li>

    <li>
        <a href="{{ route('gudang.stok.index') }}"
            class="flex items-center space-x-2 p-2 rounded relative group transition duration-200 
                    {{ Request::routeIs('gudang.stok.index') || Request::routeIs('gudang.stok.create-masuk') || Request::routeIs('gudang.stok.create-keluar') || Request::routeIs('gudang.stok.masuk') || Request::routeIs('gudang.stok.keluar') ? 'bg-gray-100 text-blue-600' : 'hover:bg-blue-300 hover:text-blue-600' }}">
            <span
                class="absolute left-0 top-0 bottom-0 w-1 bg-blue-500 
                    {{ Request::routeIs('gudang.stok.index') || Request::routeIs('gudang.stok.create-masuk') || Request::routeIs('gudang.stok.create-keluar') || Request::routeIs('gudang.stok.masuk') || Request::routeIs('gudang.stok.keluar') ? 'block' : 'hidden group-hover:block' }}"></span>
            <i class='bx bx-package'></i>
            <span>Stok Barang</span>
        </a>
    </li>
</ul>
