<!-- Light mode -->
<div class="absolute w-full min-h-75 bg-cover bg-no-repeat bg-center dark:hidden"
    style="background-image: url('{{ asset('asset-landing-page/img/Animated Shape-1.svg') }}')">
</div>

<!-- Dark mode -->
<div class="absolute w-full min-h-75 bg-cover bg-no-repeat bg-center hidden dark:block"
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
                <h1 class="text-2xl text-black dark:text-white font-montserrat font-bold mb-2">Selamat Datang !</h1>
                <h3 class="mb-0 font-bold text-black dark:text-white capitalize">Yo, {{ auth()->user()->name }}!
                    Waktunya nge-admin, mari kita buat semuanya lebih lancar! 😎</h3>
            </nav>

            <div class="flex items-center mt-2 grow sm:mt-0 sm:mr-6 md:mr-0 lg:flex lg:basis-auto">

            </div>
            <ul class="flex flex-row justify-end pl-0 mb-0 list-none md-max:w-full">

                <li class="flex items-center pl-4 xl:hidden">
                    <a href="javascript:;" class="block p-0 text-sm text-white transition-all ease-nav-brand"
                        sidenav-trigger>
                        <div class="w-4.5 overflow-hidden">
                            <i class="ease mb-0.75 relative block h-0.5 rounded-sm bg-white transition-all"></i>
                            <i class="ease mb-0.75 relative block h-0.5 rounded-sm bg-white transition-all"></i>
                            <i class="ease relative block h-0.5 rounded-sm bg-white transition-all"></i>
                        </div>
                    </a>
                </li>
                <li class="flex items-center px-4">
                    <button id="toggleDark"
                        class="group p-3 rounded-full bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-yellow-300 transition-all duration-500 shadow-md hover:shadow-lg hover:scale-110 hover:bg-yellow-100 dark:hover:bg-gray-600">
                        <i id="darkIcon" data-lucide="moon" class="w-5 h-5 transition-transform duration-500"></i>
                    </button>
                </li>

                <li class="relative flex items-center px-4">
                    <button id="settingsToggle" class="text-white hover:text-yellow-300 focus:outline-none">
                        <i class="fas fa-cog text-xl"></i>
                    </button>

                    <!-- Dropdown Settings -->
                    <div id="settingsDropdown"
                        class="hidden absolute top-12 right-0 mt-2 w-48 bg-white dark:bg-slate-700 text-black dark:text-white rounded-lg shadow-lg p-4 z-50">
                        <label class="flex items-center justify-between">
                            <span>Navbar Fixed</span>
                            <input type="checkbox" id="toggleNavbarFixed" class="form-checkbox h-5 w-5 text-blue-600">
                        </label>
                    </div>
                </li>

                <!-- Garis Pemisah -->
                <li class="border-l border-gray-300 mx-4 h-8"></li>
            </ul>
            <a href="{{ route('profile.index') }}">
                <div
                    class="inline-flex items-center p-3 px-5 rounded-lg mb-4 cursor-pointer bg-white shadow-md gap-3 w-fit">
                    <div>
                        <span class="text-sm font-semibold block text-black">
                            {{ auth()->check() ? auth()->user()->name : 'Guest' }}
                        </span>
                        <span class="text-xs text-gray-900">Admin@gmail.com</span>
                    </div>
                    <img src="{{ asset('assets/img/carousel-1.jpg') }}"
                        class="w-12 h-12 rounded-full cursor-pointer border-2 border-white shadow-lg"
                        alt="User Profile">
                </div>
            </a>
        </div>
        </div>
    </nav>

    <!-- end Navbar -->
