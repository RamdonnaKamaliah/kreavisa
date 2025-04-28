<footer class="mt-10 py-6 text-center text-sm text-gray-600 dark:text-gray-400">
    <p class="mb-2">
        &copy; {{ date('Y') }} <span class="font-semibold text-blue-600 dark:text-blue-400">Kreavisa</span>. All
        rights reserved.
    </p>
    <div class="flex justify-center space-x-4 text-sm">
        <a href="#" class="hover:underline hover:text-blue-500 dark:hover:text-blue-300 transition">Privacy
            Policy</a>
        <a href="#" class="hover:underline hover:text-blue-500 dark:hover:text-blue-300 transition">Terms</a>
        <a href="#" class="hover:underline hover:text-blue-500 dark:hover:text-blue-300 transition">Contact</a>
    </div>
</footer>
<div fixed-plugin>
    <a fixed-plugin-button id="settingsButto"
        class="fixed px-4 py-2 text-xl bg-white shadow-lg cursor-pointer bottom-8 right-8 z-990 rounded-circle text-slate-700">
        <i class="py-2 pointer-events-none fa fa-cog"> </i>
    </a>
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
</div>

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
</div>

