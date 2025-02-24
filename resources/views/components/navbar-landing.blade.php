<header class="fixed top-0 right-0 left-0 md:py-1 transition-all duration-300 z-50">
    <nav class="w-full mx-0 bg-gray-900 p-5 fixed top-0 z-50 ">
        <div class="flex items-center justify-between max-w-7xl mx-auto">
            <!-- Logo -->
            <a href="/" class="flex items-center gap-3 text-white">
                <!-- Logo Image -->
                <img src="{{ asset('asset-landing-page/img/logo kreavisa.png') }}" alt="Kreavisa Logo" class="h-10 w-auto">
                <!-- Logo Text -->
                <span class="text-3xl font-montserrat">Kreavisa</span>
            </a>
            <div class="hidden md:flex md:items-center md:space-x-8">
                @if (auth()->check())
                    @php
                        // Tentukan URL berdasarkan usertype
                        $redirectTo = '#'; // Default URL jika usertype tidak cocok
                        switch (auth()->user()->usertype) {
                            case 'admin':
                                $redirectTo = url('/admin/dashboard');
                                break;
                            case 'karyawan':
                                $redirectTo = url('/karyawan/dashboard');
                                break;
                            case 'gudang':
                                $redirectTo = url('/gudang/dashboard');
                                break;
                        }
                    @endphp
                    <!-- Tombol Landing -->
                    <a href="{{ $redirectTo }}">
                        <button
                            class="bg-gradient-to-r from-[#8176AF] to-[#C0B7E8] text-[#343045] px-6 py-2 rounded-md shadow-md hover:from-[#C0B7E8] hover:to-[#8176AF] font-montserrat hover:shadow-lg transition-all duration-300">
                            Dahboard
                        </button>
                    </a>
                @else
                    <!-- Tombol Login -->
                    <a href="/login-karyawan-gudang">
                        <button
                            class="bg-gradient-to-r from-[#8176AF] to-[#C0B7E8] text-[#343045] px-6 py-2 rounded-md shadow-md hover:from-[#C0B7E8] hover:to-[#8176AF] font-montserrat hover:shadow-lg transition-all duration-300">
                            LOGIN
                        </button>
                    </a>
                @endif


            </div>

            <!-- Mobile Menu Button -->
            <button id="mobile-menu-button" class="md:hidden text-white text-2xl">
                <i class="bx bx-menu"></i>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu"
            class="hidden md:hidden bg-gradient-to-r from-[#8176AF] to-[#C0B7E8] text-white mt-4 rounded-lg p-4 space-y-4">
            <a href="#home"
                class="block text-white font-medium hover:text-gray-200 transition-all duration-200">Home</a>
            <button
                class="bg-gradient-to-r from-pink-500 to-red-400 text-white w-full py-2 rounded-md shadow-md hover:from-red-400 hover:to-pink-500 hover:shadow-lg transition-all duration-300">
                Login
            </button>
        </div>
    </nav>


    <!-- only for large device -->
    {{-- <div class="hidden md:flex space-x-10">
                <a href="#home" class="text-primary hover:text-gray-300">Home</a>
                <a href="#projects" class="text-white hover:text-gray-300">Projects</a>
                <a href="#resume" class="text-white hover:text-gray-300">Resume</a>
            </div> --}}
    <!-- menu btn, only disply on mobile -->
    <div class="md:hidden">
        <button id="mobile-menu-button" class="text-white text-2xl">
            <i class="bx bx-menu"></i>
        </button>
    </div>
    </div>
    </nav>

</header>
