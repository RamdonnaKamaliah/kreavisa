<div class="flex min-h-screen">
    <!-- Tombol Toggle untuk Sidebar (Muncul hanya di layar mobile) -->
    <button id="sidebarToggle" class="md:hidden fixed top-4 left-4 p-2 bg-gray-900 text-white rounded">
        <i class='bx bx-menu'></i>
    </button>

    <!-- Sidebar -->
    <aside id="sidebar"
        class="w-64 bg-gray-900 text-white h-screen p-4 fixed top-0 left-0 z-40 transition-transform transform md:translate-x-0 -translate-x-full">
        <a class="flex items-center justify-center" href="index.html">
            <div>
                <h1 class="font-protest text-4xl pb-5">A</h1> <!-- Ukuran teks lebih besar -->
            </div>
            <div class="mx-4 text-2xl pb-5">dmin</div>
            <!-- Ukuran teks lebih besar dan margin horizontal lebih lebar -->
        </a>
        <hr class="border-gray-700 mb-4">

        <!-- Profile Section -->
        <a href="{{ route('profile.index') }}">
            <div class="flex items-center space-x-3 p-3 bg-gray-800 rounded-lg mb-4 cursor-pointer">
                <img src="{{ asset('asset-landing-admin/img/undraw_profile.svg') }}"
                    class="w-12 h-12 rounded-full cursor-pointer" alt="User Profile">
                <div>
                    <span
                        class="text-sm font-semibold block">{{ auth()->check() ? auth()->user()->name : 'Guest' }}</span>
                    <span class="text-xs text-gray-400">Karyawan</span>
        </a>
</div>
</div>

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
                    {{ Request::routeIs('gajikaryawan.index') ? 'bg-gray-700 text-blue-400' : 'hover:bg-gray-700 hover:text-blue-400' }}">
            <span
                class="absolute left-0 top-0 bottom-0 w-1 bg-blue-500 
                    {{ Request::routeIs('gajikaryawan.index') ? 'block' : 'hidden group-hover:block' }}"></span>
            <i class='bx bx-dollar'></i>
            <span>Gaji Karyawan</span>
        </a>
    </li>
    <li>
        <a href="{{ route('stokkaryawan.index') }}"
            class="flex items-center space-x-2 p-2 rounded relative group transition duration-200 
                    {{ Request::routeIs('stokkaryawan.index') ? 'bg-gray-700 text-blue-400' : 'hover:bg-gray-700 hover:text-blue-400' }}">
            <span
                class="absolute left-0 top-0 bottom-0 w-1 bg-blue-500 
                    {{ Request::routeIs('stokkaryawan.index') ? 'block' : 'hidden group-hover:block' }}"></span>
            <i class='bx bx-package'></i>
            <span>Stok Barang</span>
        </a>
    </li>
</ul>
</aside>
</div>

<script>
    // Toggle Sidebar
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('sidebar');

    sidebarToggle.addEventListener('click', function() {
        sidebar.classList.toggle('-translate-x-full');
    });

    // Menutup Sidebar Saat Mengklik di Luar Sidebar
    document.addEventListener('click', function(event) {
        const isClickInsideSidebar = sidebar.contains(event.target);
        const isClickOnToggle = sidebarToggle.contains(event.target);

        if (!isClickInsideSidebar && !isClickOnToggle && !sidebar.classList.contains('-translate-x-full')) {
            sidebar.classList.add('-translate-x-full');
        }
    });
</script>
