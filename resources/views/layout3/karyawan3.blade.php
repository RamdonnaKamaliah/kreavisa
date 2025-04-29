<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Kreavisa</title>
    @include('layout3.partial3.link3')
</head>

<body
    class="m-0 font-sans text-base antialiased font-normal dark:bg-slate-900 leading-default bg-gray-50 text-slate-500 overflow-x-hidden">
    @include('layout3.partial3.header3')

    @yield('content')

    <!-- Loading Screen -->



    @include('layout3.partial3.footer3')
    </main>
    <!-- LOADER OVERLAY -->
    <div id="loader" class="fixed inset-0 flex items-center justify-center bg-white z-[9999]">
        <div class="animate-spin rounded-full h-16 w-16 border-t-4 border-blue-500"></div>
    </div>


</body>
@include('layout3.partial3.script3')

<script>
    const connection = navigator.connection || navigator.mozConnection || navigator.webkitConnection;
    const slowTypes = ['slow-2g', '2g'];

    // Fungsi untuk show loader + Swal
    function showLoader() {
        document.getElementById('loader').classList.remove('hidden');
        Swal.fire({
            title: 'Memuat...',
            text: 'Mohon tunggu sebentar',
            allowOutsideClick: false,
            didOpen: () => Swal.showLoading(),
        });
    }

    // Cek koneksi, kalau slow baru tampilkan
    document.addEventListener('DOMContentLoaded', () => {
        const isSlow = connection && slowTypes.includes(connection.effectiveType);
        if (isSlow) {
            showLoader();
        }
    });

    // Di load (semua asset selesai), tutup modal dan sembunyikan overlay
    window.addEventListener('load', () => {
        Swal.close();
        document.getElementById('loader').classList.add('hidden');
    });

    // Offline/online seperti sebelumnya
    window.addEventListener('offline', () => {
        Swal.fire({
            icon: 'error',
            title: 'Oops!',
            text: 'Koneksi internet kamu terputus.',
            confirmButtonText: 'Oke, siap!',
        });
    });
    window.addEventListener('online', () => {
        Swal.fire({
            icon: 'success',
            title: 'Kembali Online!',
            text: 'Koneksi internet kamu udah nyambung lagi.',
            timer: 2000,
            showConfirmButton: false
        });
    });
</script>

@stack('scripts')

</html>
