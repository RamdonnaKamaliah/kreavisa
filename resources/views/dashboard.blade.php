<x-layout-landing>
    <!-- Header -->
    <section
        class="relative w-full mx-auto min-h-screen bg-gradient-to-b from-gray-900 to-[#1D232A] flex flex-col items-center justify-center px-4 pt-24 pb-64">

        <!-- Teks Header di Atas Kotak -->
        <div class="text-center mb-8">
            <h2
                class="text-2xl md:text-4xl font-semibold bg-gradient-to-r from-purple-400 to-pink-500 text-transparent bg-clip-text">
                Management Karyawan
            </h2>
            <h1 class="text-3xl md:text-5xl font-bold text-white mt-2">
                Navisa Basic Collection
            </h1>
        </div>

        <!-- Kotak Utama -->
        <div
            class="relative w-full max-w-5xl bg-black/40 backdrop-blur-lg rounded-2xl p-8 shadow-[0_0_40px_rgba(165,95,255,0.4)] border border-white/10 flex items-center border-white">

            <!-- Gambar di Kiri (Animasi Mantul) -->
            <div class="w-1/2 flex justify-center">
                <img id="landingImage" src="{{ asset('asset-landing-page/img/gambar-landing3_.png') }}" alt="Landing Image"
                    class="w-5/6 rounded-lg opacity-90 shadow-lg bounce" />
            </div>

            <!-- Konten di Kanan -->
            <div class="w-1/2 pl-8">
                <h1 class="text-3xl font-bold text-white">
                    Start your US company in minutes
                </h1>
                <p class="text-gray-300 text-lg mt-3">
                    The simplest way to launch and run a business in the US. Incorporate your company in minutes.
                </p>

                <!-- Langkah-langkah -->
                <div class="mt-6">
                    <ul class="space-y-3">
                        <li class="flex items-center text-gray-300">
                            <span
                                class="w-6 h-6 flex items-center justify-center bg-purple-600 text-white rounded-full mr-3">1</span>
                            Company Type
                        </li>
                        <li class="flex items-center text-white font-semibold">
                            <span
                                class="w-6 h-6 flex items-center justify-center bg-pink-500 text-white rounded-full mr-3">2</span>
                            Registration State
                        </li>
                        <li class="flex items-center text-gray-300">
                            <span
                                class="w-6 h-6 flex items-center justify-center bg-purple-600 text-white rounded-full mr-3">3</span>
                            Company Name
                        </li>
                    </ul>
                </div>

                <!-- Pilihan Pendaftaran -->
                <div class="mt-6">
                    <h3 class="text-white font-semibold text-lg">Choose your registration state</h3>
                    <div class="mt-4 space-y-3">
                        <div class="p-3 bg-white/10 rounded-lg border border-white/20 text-gray-300">
                            <p class="font-semibold text-white">Delaware</p>
                            <p class="text-sm">Best for startups with legal protections.</p>
                        </div>
                        <div class="p-3 bg-white/10 rounded-lg border border-white/20 text-gray-300">
                            <p class="font-semibold text-white">Wyoming</p>
                            <p class="text-sm">Great for small businesses with lower costs.</p>
                        </div>
                    </div>
                    <button
                        class="mt-4 w-full px-4 py-2 bg-purple-500 text-white font-semibold rounded-lg hover:bg-purple-600 transition">
                        Continue
                    </button>
                </div>
            </div>
        </div>


    </section>

    <!-- Animasi Mantul -->
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
    </style>
</x-layout-landing>
