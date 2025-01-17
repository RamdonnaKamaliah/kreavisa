<x-layout-landing>
    <!-- Header -->
    <section class="relative w-full mx-auto min-h-screen bg-[#302C42]" id="home">
        <!-- Gelombang -->
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1323 199" fill="none"
            class="absolute bottom-0 left-0 right-0 w-full">
            <path fill-rule="evenodd" clip-rule="evenodd"
                d="M0 39.8L73.8675 59.7C146.632 79.6 294.367 119.4 441 142.617C587.633 165.833 735.367 172.467 882 145.933C1028.63 119.4 1176.37 59.7 1249.13 29.85L1323 0V199H1249.13C1176.37 199 1028.63 199 882 199C735.367 199 587.633 199 441 199C294.367 199 146.632 199 73.8675 199H0V39.8Z"
                fill="white" />
        </svg>

        <!-- Flex Container -->
        <div
            class="flex flex-col-reverse md:flex-row justify-between items-center text-black gap-8 md:gap-16 relative z-10 px-4 md:px-20 pt-12 md:pt-10">
            <!-- Kolom Kiri -->
            <div class="md:w-1/2 z-10 text-center md:text-left">
                <h1
                    class="font-bold font-montserrat text-4xl tracking-wide mb-5 bg-[#C0B7E8] text-transparent bg-clip-text">
                    Navisa Basic Collection <span class="text-white">System management</span></h1>
                <p class="text-2xl font-montserrat mb-5 text-white">
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Est a dolorem delectus commodi modi sit
                    reiciendis voluptates molestiae fugiat quos.
                </p>
            </div>

            <!-- Kolom Gambar -->
            <div class="md:w-1/2 z-10 text-center">
                <img id="landingImage" src="{{ asset('asset-landing-page/img/gambar-landing3_.png') }}"
                    alt="Landing Image"
                    class="w-full md:mr-20 max-w-full rounded-xl opacity-100 visibility-visible bounce" />
            </div>

        </div>

        <!-- Animasi Mantul-mantul -->
        <style>
            /* Animasi mantul-mantul */
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



    </section>

</x-layout-landing>
