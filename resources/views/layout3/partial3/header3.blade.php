<!-- Light mode -->
<div class="fixed top-0 w-full min-h-75 bg-cover bg-no-repeat bg-center dark:hidden z-0 pointer-events-none"
    style="background-image: url('{{ asset('asset-landing-page/img/Animated Shape-1.svg') }}')">
</div>

<!-- Dark mode -->
<div class="fixed top-0 w-full min-h-75 bg-cover bg-no-repeat bg-center hidden dark:block z-0 pointer-events-auto"
    style="background-image: url('{{ asset('asset-landing-page/img/Animated Shape-2.svg') }}')">
</div>

<!-- sidenav  -->
<aside id="mobile-sidenav"
    class="fixed top-0 bottom-0 left-0 w-64 transform -translate-x-full xl:translate-x-0
        bg-white dark:bg-[#1D232A] shadow-xl p-4 flex flex-col overflow-y-auto
        transition-transform duration-200 ease-in-out z-50

        xl:m-6 xl:rounded-2xl">
    {{-- <a fixed-plugin-button
            class="fixed px-4 py-2 text-xl bg-white shadow-lg cursor-pointer bottom-8 right-8 z-990 rounded-circle text-slate-700">
            <i class="py-2 pointer-events-none fa fa-cog"> </i>
        </a> --}}
    <x-navbar-karyawan></x-navbar-karyawan>
</aside>

<!-- end sidenav -->

<main class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-68 rounded-xl pt-[5px]">
    <!-- Navbar -->
    <nav class="relative flex flex-wrap items-center justify-between top-4 px-0 py-2 mx-6 transition-all ease-in shadow-none duration-250 rounded-2xl lg:flex-nowrap lg:justify-start"
        navbar-main navbar-scroll="false" id="navbar-main">
        <div class="flex items-center justify-between w-full px-4 py-1 mx-auto flex-wrap-inherit">
            <nav>
                <h2 class="text-white text-lg font-semibold mb-2">
                    @yield('page-title')
                </h2>

                <h3 class="mb-0 text-black dark:text-white capitalize">Yo, {{ auth()->user()->name }}!
                    Semangat bekerja hari ini! Jangan lupa untuk selalu memberikan yang <br> terbaik dan menjaga
                    keseimbangan
                    antara kerja dan istirahat. 🚀"

                </h3>
            </nav>

            {{-- <div id="navbar-placeholder"
                class="flex items-center mt-2 grow sm:mt-0 sm:mr-6 md:mr-0 lg:flex lg:basis-auto h-0">

            </div> --}}
            <ul class="flex flex-row justify-end pl-0 mb-0 list-none md-max:w-full">
                <!-- online builder btn  -->
                <!-- <li class="flex items-center">
            <a class="inline-block px-8 py-2 mb-0 mr-4 text-xs font-bold text-center text-blue-500 uppercase align-middle transition-all ease-in bg-transparent border border-blue-500 border-solid rounded-lg shadow-none cursor-pointer leading-pro hover:-translate-y-px active:shadow-xs hover:border-blue-500 active:bg-blue-500 active:hover:text-blue-500 hover:text-blue-500 tracking-tight-rem hover:bg-transparent hover:opacity-75 hover:shadow-none active:text-white active:hover:bg-transparent" target="_blank" href="https://www.creative-tim.com/builder/soft-ui?ref=navbar-dashboard&amp;_ga=2.76518741.1192788655.1647724933-1242940210.1644448053">Online Builder</a>
          </li> -->

                <!-- Hamburger Menu (Mobile Only) -->
                <li class="flex items-center pl-2 xl:hidden">
                    <button id="hamburger" aria-label="Toggle menu"
                        class="flex flex-col justify-center items-center w-8 h-8 text-gray-800 dark:text-slate-50 focus:outline-none">
                        <span class="bar block h-0.5 w-5 bg-current rounded-sm mb-1 transition-all duration-300"></span>
                        <span class="bar block h-0.5 w-5 bg-current rounded-sm mb-1 transition-all duration-300"></span>
                        <span class="bar block h-0.5 w-5 bg-current rounded-sm transition-all duration-300"></span>
                    </button>
                </li>

                <!-- Dark Mode Toggle -->
                <li class="flex items-center px-2">
                    <button id="toggleDark"
                        class="flex items-center justify-center text-yellow-300 dark:text-slate-50 hover:scale-110 transition-transform duration-300">
                        <i id="darkIcon" class='bx bx-moon text-2xl'></i>
                    </button>
                </li>

                <!-- Settings Icon -->
                <li class="flex items-center px-2">
                    <button id="settingsToggle"
                        class="flex items-center justify-center text-gray-800 dark:text-slate-50 transition duration-300">
                        <i class="fas fa-cog text-lg"></i>
                    </button>

                    <!-- Dropdown Settings -->
                    <div id="settingsDropdown"
                        class="hidden absolute top-12 right-0 mt-2 w-48 bg-white dark:bg-slate-700 text-black dark:text-white rounded-lg shadow-lg p-4 z-[9999] space-y-4">
                        <label class="flex items-center justify-between">
                            <span>Navbar Fixed</span>
                            <input type="checkbox" id="toggleNavbarFixed" class="form-checkbox h-5 w-5 text-blue-600">
                        </label>
                        <a href="#"
                            class="block text-sm text-blue-600 hover:text-blue-800 dark:text-yellow-300 dark:hover:text-yellow-400 transition duration-200">
                            <i class="fas fa-question-circle mr-2"></i>Bantuan
                        </a>
                    </div>
                </li>

            </ul>

        </div>
        </div>
    </nav>

    <div id="navbarSpacer" class="h-52 lg:h-[100px] hidden"></div>


    <script>
        const hamburger = document.getElementById('hamburger');
        const sidebar = document.getElementById('mobile-sidenav');

        hamburger.addEventListener('click', function(e) {
            e.stopPropagation();
            // toggle icon active (optional)
            hamburger.classList.toggle('hamburger-active');
            // slide sidebar in/out
            sidebar.classList.toggle('-translate-x-full');
        });

        // Klik di luar untuk menutup
        window.addEventListener('click', function(e) {
            if (!sidebar.contains(e.target) && !hamburger.contains(e.target)) {
                hamburger.classList.remove('hamburger-active');
                if (!sidebar.classList.contains('-translate-x-full')) {
                    sidebar.classList.add('-translate-x-full');
                }
            }
        });
    </script>

    <!-- end Navbar -->
