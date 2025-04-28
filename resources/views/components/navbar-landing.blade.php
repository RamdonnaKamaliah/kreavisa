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
                    <input type="checkbox" id="dark-toggle" class="hidden peer">

                    <!-- Matahari (light mode) -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-yellow-400 peer-checked:hidden"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 3v1m0 16v1m8.66-8.66l-.707.707M4.05 4.05l-.707.707M21 12h-1M4 12H3m16.95 7.95l-.707-.707M4.05 19.95l-.707-.707M12 8a4 4 0 100 8 4 4 0 000-8z" />
                    </svg>

                    <!-- Bulan (dark mode) -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white hidden peer-checked:block"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z" />
                    </svg>
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
