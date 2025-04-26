
<div class="fixed top-0 w-full min-h-75 bg-cover bg-no-repeat bg-center dark:hidden z-0 pointer-events-none"
    style="background-image: url('{{ asset('asset-landing-page/img/Animated Shape-1.svg') }}')">
</div>

<!-- Dark mode -->
<div class="fixed top-0 w-full min-h-75 bg-cover bg-no-repeat bg-center hidden dark:block z-0 pointer-events-auto"
    style="background-image: url('{{ asset('asset-landing-page/img/Animated Shape-2.svg') }}')">
</div>
<!-- sidenav  -->
<aside
    class="fixed inset-y-0 flex-wrap items-center justify-between block w-full p-0 my-4 overflow-y-auto antialiased transition-transform duration-200 -translate-x-full bg-white border-0 shadow-xl dark:shadow-none dark:bg-slate-850 max-w-64 ease-nav-brand z-990 xl:ml-6 rounded-2xl xl:left-0 xl:translate-x-0"
    aria-expanded="false">
    <x-nav-admin></x-nav-admin>
</aside>

<!-- end sidenav -->

<main class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-[17rem] rounded-xl">
    <!-- Navbar -->
    <nav class="relative flex flex-wrap items-center justify-between px-0 py-2 mx-6 transition-all ease-in shadow-none duration-250 rounded-2xl lg:flex-nowrap lg:justify-start"
        navbar-main navbar-scroll="false">
        <div class="flex items-center justify-between w-full px-4 py-1 mx-auto flex-wrap-inherit">
            <nav>
                <h2 class="text-black dark:text-white text-lg font-semibold mb-2">
                    @yield('page-title')
                </h2> 
                <h3 class="mb-0 font-bold text-black dark:text-white capitalize">Yo, {{ auth()->user()->name }}!
                    Waktunya nge-admin, mari kita buat semuanya lebih lancar! 😎</h3>
            </nav>

            <div class="flex items-center mt-2 grow sm:mt-0 sm:mr-6 md:mr-0 lg:flex lg:basis-auto">

            </div>
            <ul class="flex flex-row justify-end pl-0 mb-0 list-none md-max:w-full">

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

    <div id="navbarSpacer" class="h-40 lg:h-[110px] hidden"></div>

    <!-- end Navbar -->
