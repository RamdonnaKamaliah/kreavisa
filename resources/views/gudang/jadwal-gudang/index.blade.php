@push('page-title')
    Jadwal Karyawan
@endpush
<x-layout-gudang>
    <div class="flex justify-center items-center min-h-screen px-4 md:ml-64 pt-20">
        <div class="bg-white shadow-lg rounded-2xl p-6 w-full max-w-4xl">
            <h2 class="mb-4 text-2xl font-semibold text-center text-gray-800">Jadwal Karyawan</h2>
            <div class="overflow-hidden rounded-lg border border-gray-300">
                <iframe
                    src="https://calendar.google.com/calendar/embed?height=600&wkst=1&ctz=Asia%2FJakarta&hl=id&src=OTU2ZDQ2N2Y5MjljNGQwMzYyOTdkOTM4NmE4OGFmNDRlMGEyOGQzNGE2YzhjNTlhZmQyYTdhNDg5ODQ4MGFkNkBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&color=%233F51B5"
                    class="w-full h-[600px]">
                </iframe>
            </div>
        </div>
    </div>
</x-layout-gudang>
