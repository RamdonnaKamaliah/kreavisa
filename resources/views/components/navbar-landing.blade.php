<header class="fixed top-0 right-0 left-0 md:py-1 transition-all duration-300 z-50">
    <nav class="w-full mx-0 bg-[#f0f0f0] p-5 fixed top-0 z-50 dark:bg-[#1F2937]">
        <div class="flex items-center justify-between max-w-7xl mx-auto">

            <!-- Logo -->
            <a href="{{ route('karyawan.dashboard') }}" class="flex justify-center">
                <div class="flex items-end space-x-1">
                    <h1 class="font-protest text-4xl text-transparent bg-clip-text bg-blue-500 leading-none">K</h1>
                    <div class="text-2xl text-gray-800 dark:text-white font-semibold leading-tight">reavisa</div>
                </div>
            </a>

            <!-- Right Menu (Login + Dark Mode) -->
            <div class="flex items-center space-x-4">
                @php
                    $redirectTo = '#';
                    if (auth()->check()) {
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
                    }
                @endphp

                @if (auth()->check())
                    <a href="{{ $redirectTo }}">
                        <button
                            class="bg-gradient-to-r from-[#8176AF] to-[#C0B7E8] text-[#343045] px-5 py-2 rounded-md shadow-md hover:from-[#C0B7E8] hover:to-[#8176AF] font-montserrat hover:shadow-lg transition-all duration-300">
                            Dashboard
                        </button>
                    </a>
                @else
                    <a href="/login-karyawan">
                        <button
                            class="bg-gradient-to-r from-[#8176AF] to-[#C0B7E8] text-[#343045] px-5 py-2 rounded-md shadow-md hover:from-[#C0B7E8] hover:to-[#8176AF] font-popins hover:shadow-lg transition-all duration-300">
                            Login
                        </button>
                    </a>
                @endif

                <!-- Dark Mode Toggle -->
                <label for="dark-toggle" class="cursor-pointer">
                    <input type="checkbox" id="dark-toggle" class="hidden">
                    <img src="{{ asset('asset-landing-page/img/sun_moon_toggle.svg.phase') }}" alt="toggle icon"
                        class="w-6 h-6 dark:invert" />
                </label>

            </div>

        </div>
    </nav>

    <!-- Script -->
    <script>
        // Dark mode toggle
        const darkToggle = document.getElementById('dark-toggle');
        darkToggle.addEventListener('change', () => {
            document.documentElement.classList.toggle('dark');
        });
    </script>
</header>
