<x-layout-gudang>

    <x-layout-class>
    </x-layout-class>
    <div class="mb-1">
        <h1 class="text-center text-black font-bold text-2xl pt-3 mb-5">Absensi Karyawan</h1>
    </div>
    <main class="flex-grow flex justify-center items-center mt-[-10px]">
        <div class="bg-[#343A40] p-8 rounded-xl shadow-lg text-center max-w-md">
            <h1 class="text-2xl font-bold text-white mb-4">
                Anda Belum Melakukan Absensi Hari Ini
            </h1>

            <img alt="Sad emoji with rain cloud" class="mx-auto mb-4 w-28 h-28"
                src="{{ asset('asset-landing-page/img/belumabsen-removebg-preview.png') }}" />
            <a href="{{ route('absen-gudang.create') }}" class="w-full">
                <button
                    class="bg-black text-white px-6 py-3 rounded-lg flex items-center justify-center space-x-2 transition-all duration-300 hover:bg-gray-900 w-full">
                    <span class="text-lg font-semibold">Absen Sekarang</span>
                    <i class="fas fa-arrow-right text-lg"></i>
                </button>
            </a>

        </div>
    </main>


</x-layout-gudang>
