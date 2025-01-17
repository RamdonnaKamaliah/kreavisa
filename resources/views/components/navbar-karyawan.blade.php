<div>
    <!-- Navigation -->
    <nav class="bg-[#151D20] shadow-md fixed top-0 left-0 w-full z-10">
        <div class="container mx-auto px-4 flex items-center justify-between py-3">
            <!-- Brand -->
            <a href="#header" class="text-white font-bold text-lg">Karyawan</a>

            <!-- Hamburger Menu (Mobile) -->
            <button class="lg:hidden text-black focus:outline-none" id="navbarToggle">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>

            <!-- Navbar Links -->
            <div class="hidden lg:flex items-center space-x-6" id="navbarMenu">
                <a href="#dashboard" class="text-white hover:text-primary font-medium">Home</a>
                <a href="#profile" class="text-white hover:text-primary font-medium">Profile</a>
                <a href="#absensi" class="text-white hover:text-primary font-medium">Absensi</a>
                <a href="#jadwal" class="text-white hover:text-primary font-medium">Jadwal Kerja</a>
                <a href="#gaji" class="text-white hover:text-primary font-medium">Gaji</a>

                <!-- Logout Button -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="bg-blue-400 text-white px-4 py-2 rounded-md shadow-md hover:bg-blue-600">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>
</div>
