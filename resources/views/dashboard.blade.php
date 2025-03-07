<x-layout-landing>
    <!-- Header -->
    <section id="themeContainer"
        class="relative w-full mx-auto min-h-screen flex flex-col items-center justify-center px-4 pt-24 pb-64">

        <!-- Tombol Toggle Theme -->
        <button id="toggleTheme"
            class="absolute top-6 right-6 px-4 py-2 rounded-lg text-white bg-blue-600 hover:bg-blue-700">
            Toggle Theme
        </button>

        <!-- Konten -->
        <div class="text-center mb-8">
            <h2 id="titleGradient" class="text-2xl md:text-4xl font-semibold text-transparent bg-clip-text">
                Management Karyawan
            </h2>
            <h1 id="titleText" class="text-3xl md:text-5xl font-bold mt-2">
                Navisa Basic Collection
            </h1>
        </div>

        <!-- Kotak Utama -->
        <div
            class="relative w-full max-w-5xl bg-black/40 backdrop-blur-lg rounded-2xl p-8 shadow-[0_0_40px_rgba(165,95,255,0.4)] border border-white/10 flex items-center">
            <!-- Gambar -->
            <div class="w-1/2 flex justify-center">
                <img id="landingImage" src="{{ asset('asset-landing-page/img/gambar-landing3_.png') }}"
                    alt="Landing Image" class="w-5/6 rounded-lg opacity-90 bounce" />
            </div>

            <!-- Konten -->
            <div class="w-1/2 pl-8">
                <h1 id="subTitle" class="text-3xl font-bold">
                    Solusi Digital Untuk UMKM Maju
                </h1>
                <p id="description" class="text-lg mt-3">
                    Cara termudah untuk mengelola data karyawan, absensi, dan informasi lainnya dengan cepat.
                </p>
                <!-- Langkah-langkah -->
                <div class="mt-6">
                    <ul class="space-y-3">
                        <li class="flex items-center">
                            <span
                                class="w-6 h-6 flex items-center justify-center bg-purple-600 text-white rounded-full mr-3">1</span>
                            Data Karyawan
                        </li>
                        <li class="flex items-center font-semibold">
                            <span
                                class="w-6 h-6 flex items-center justify-center bg-pink-500 text-white rounded-full mr-3">2</span>
                            Absensi
                        </li>
                        <li class="flex items-center">
                            <span
                                class="w-6 h-6 flex items-center justify-center bg-purple-600 text-white rounded-full mr-3">3</span>
                            Jadwal Kerja
                        </li>
                        <li class="flex items-center">
                            <span
                                class="w-6 h-6 flex items-center justify-center bg-purple-600 text-white rounded-full mr-3">4</span>
                            Rekap Gaji
                        </li>
                    </ul>
                </div>

                <!-- Pilihan Pendaftaran -->
                <div class="mt-6">
                    <button
                        class="mt-4 w-full px-4 py-2 bg-purple-500 text-white font-semibold rounded-lg hover:bg-purple-600 transition">
                        Continue
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
            background: linear-gradient(to bottom, #111827, #1D232A);
        }

        .dark #titleGradient {
            background: linear-gradient(to right, #a855f7, #ec4899);
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
        #themeContainer {
            background: #F3F4F6;
        }

        #titleGradient {
            background: linear-gradient(90deg, #FFD700, #FFA500);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        #titleText,
        #subTitle {
            color: black;
        }

        #description {
            color: #4B5563;
        }

        .light nav {
            background-color: #FFD700 !important;
        }

        .light login {
            background-color: #E5E7EB !important;
            /* Abu-abu terang */
            color: black !important;
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const toggleButton = document.getElementById("toggleTheme");
            const rootElement = document.documentElement;

            // Tunggu sampai semua elemen selesai dimuat
            window.onload = function() {
                const navbar = document.querySelector("nav");
                const loginButton = document.getElementById("loginButton");

                // Fungsi untuk update style navbar & tombol login
                function updateThemeElements() {
                    if (rootElement.classList.contains("dark")) {
                        navbar?.classList.remove("light-nav");
                        navbar?.classList.add("dark-nav");

                        loginButton?.classList.remove("light-login");
                        loginButton?.classList.add("dark-login");
                    } else {
                        navbar?.classList.remove("dark-nav");
                        navbar?.classList.add("light-nav");

                        loginButton?.classList.remove("dark-login");
                        loginButton?.classList.add("light-login");
                    }
                }

                // Cek localStorage untuk tema sebelumnya
                if (localStorage.getItem("theme") === "dark") {
                    rootElement.classList.add("dark");
                } else {
                    rootElement.classList.add("light");
                }
                updateThemeElements(); // Panggil agar navbar langsung sesuai tema saat load

                // Function untuk toggle theme
                function toggleTheme() {
                    rootElement.classList.toggle("dark");
                    rootElement.classList.toggle("light");

                    localStorage.setItem("theme", rootElement.classList.contains("dark") ? "dark" : "light");
                    updateThemeElements(); // Update navbar & tombol login setiap kali toggle
                }

                // Event listener untuk tombol toggle
                toggleButton.addEventListener("click", toggleTheme);
            };
        });
    </script>

</x-layout-landing>
