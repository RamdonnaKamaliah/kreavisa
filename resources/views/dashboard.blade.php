<x-layout-landing>

    <section id="themeContainer"
        class="relative w-full mx-auto min-h-screen flex flex-col items-center justify-center px-4 pt-24 pb-64">

        <!-- Tombol Toggle Theme -->
        <button id="toggleTheme"
            class="absolute top-6 right-6 px-4 py-2 rounded-lg text-white bg-blue-600 hover:bg-blue-700">
            Toggle Theme
        </button>

        <!-- Konten -->
        <div class="text-center mb-8">
            <h2 id="titleGradient" class="text-2xl md:text-4xl font-semibold text-transparent bg-clip-text z-50">
                Management Karyawan
            </h2>
            <h1 id="titleText" class="text-3xl md:text-5xl font-bold mt-2 z-10">
                Navisa Basic Collection
            </h1>
        </div>

        <!-- Kotak Utama -->
        <div
            class="relative w-full max-w-5xl bg-[#D9D9D9] dark:bg-black/40 backdrop-blur-lg rounded-2xl p-8 shadow-[0_0_40px_rgba(165,95,255,0.4)] border border-white/10 flex flex-col md:flex-row items-center md:items-start">

            <!-- Gambar -->
            <div class="w-full md:w-1/2 flex justify-center mb-6 md:mb-0">
                <img id="landingImage" src="{{ asset('asset-landing-page/img/gambar-landing3_.png') }}"
                    alt="Landing Image" class="w-5/6 rounded-lg opacity-90 bounce" />
            </div>

            <!-- Konten -->
            <div class="w-full md:w-1/2 md:pl-8 text-center md:text-left">
                <h1 id="subTitle" class="text-3xl font-bold font-popins">
                    Solusi Digital Untuk UMKM Maju
                </h1>
                <p id="description" class="text-lg mt-3">
                    Cara termudah untuk mengelola data karyawan, absensi, dan informasi lainnya dengan cepat.
                </p>

                <!-- Langkah-langkah -->
                <div class="mt-6">
                    <ul class="space-y-3">
                        <li class="flex items-center justify-center md:justify-start">
                            <span
                                class="w-6 h-6 flex items-center justify-center bg-purple-600 text-white rounded-full mr-3">1</span>
                            Data Karyawan
                        </li>
                        <li class="flex items-center justify-center md:justify-start font-semibold">
                            <span
                                class="w-6 h-6 flex items-center justify-center bg-pink-500 text-white rounded-full mr-3">2</span>
                            Absensi
                        </li>
                        <li class="flex items-center justify-center md:justify-start">
                            <span
                                class="w-6 h-6 flex items-center justify-center bg-purple-600 text-white rounded-full mr-3">3</span>
                            Jadwal Kerja
                        </li>
                        <li class="flex items-center justify-center md:justify-start">
                            <span
                                class="w-6 h-6 flex items-center justify-center bg-purple-600 text-white rounded-full mr-3">4</span>
                            Rekap Gaji
                        </li>
                    </ul>
                </div>

                <!-- Tombol -->
                <div class="mt-6">
                    <button
                        class="mt-4 w-full px-4 py-2 bg-purple-500 text-white font-semibold rounded-lg hover:bg-purple-600 transition">
                        Lanjutan
                    </button>
                </div>
            </div>
        </div>


    </section>

    <!-- Animasi -->
    <style>
        .bounce {
            animation: bounce 4s infinite;
        }

        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        /* Dark Mode */
        .dark #themeContainer {
            background-image: url('{{ asset('asset-landing-page/img/Moon (12).svg') }}');
        }


        .dark #titleGradient {
            background: linear-gradient(to right, #5475f2, #91a8f6);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .dark #titleText,
        .dark #subTitle {
            color: white;
        }

        .dark #description {
            color: #D1D5DB;
        }

        .dark ul li {
            color: white;
        }

        .dark nav {
            background-color: linear-gradient(to bottom, #111827, #1D232A) !important;
        }

        .dark login {
            background-color: #4B5563 !important;
            /* Abu-abu gelap */
            color: white !important;
        }

        /* Light Mode */
        /* Light Mode */
        #themeContainer {
            background-image: url('{{ asset('asset-landing-page/img/Moon_.svg') }}');
        }

        #titleGradient {
            background: linear-gradient(to right, #5475f2, #91a8f6);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        #titleText,
        #subTitle {
            color: #1e2a4a;
        }

        #description {
            color: #4a5a7a;
        }

        .light nav {
            background-color: #ffffff !important;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            color: #1e2a4a;
        }

        .light login {
            background-color: #f5f8ff !important;
            color: #1e2a4a !important;
        }

        .light ul li {
            color: #1e2a4a;
        }

        /* Tombol tambahan biar lebih hidup */
        button,
        .btn {
            background-color: #5475f2;
            color: white;
            border-radius: 8px;
            padding: 10px 16px;
            transition: 0.3s ease;
        }

        button:hover,
        .btn:hover {
            background-color: #3f5ae0;
        }
    </style>

    <script>
        const darkToggle = document.querySelector('#dark-toggle');
        const darkIcon = document.querySelector('#dark-icon');
        const html = document.querySelector('html');

        darkToggle.addEventListener("click", function() {
            if (darkToggle.checked) {
                html.classList.add('dark');
                localStorage.theme = 'dark';
                darkIcon.classList.replace('bx-sun', 'bx-moon');
            } else {
                html.classList.remove('dark');
                localStorage.theme = 'light';
                darkIcon.classList.replace('bx-moon', 'bx-sun');
            }
        });

        // Move Toggle Mode
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
            darkToggle.checked = true;
            darkIcon.classList.replace('bx-sun', 'bx-moon');
        } else {
            darkToggle.checked = false;
            darkIcon.classList.replace('bx-moon', 'bx-sun');
        }
    </script>

</x-layout-landing>
