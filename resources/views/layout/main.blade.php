<!--

=========================================================
* Argon Dashboard 2 Tailwind - v1.0.1
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard-tailwind
* Copyright 2022 Creative Tim (https://www.creative-tim.com)

* Coded by www.creative-tim.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Admin Kreavisa</title>
    @include('layout.partial.link')
</head>

<body
    class="m-0 font-sans text-base antialiased font-normal dark:bg-slate-900 leading-default bg-gray-50 text-slate-500 overflow-x-hidden">
    @include('layout.partial.header')
    <title>@yield('page-title', 'Default Title')</title>

    @yield('content')


    @include('layout.partial.footer')
    </main>

</body>
@include('layout.partial.script')

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

</html>
