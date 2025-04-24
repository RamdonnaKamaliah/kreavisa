 <!-- plugin for scrollbar  -->
 <script src="{{ asset('assets/js/perfect-scrollbar.js') }}"></script>
 <!-- main script file  -->
 <script src="{{ asset('assets/js/argon-dashboard-tailwind.js') }}"></script>
 <script src="{{ asset('assets/js/argon-dashboard-tailwind.min.js') }}"></script>
 {{-- <script src="{{ asset('asset-user/js/sidenav-burger.js') }}"></script> --}}
 {{-- <script src="{{ asset('assets/js/navbar-sticky.js') }}"></script>
 <script src="{{ asset('assets/js/navbar-charts.js') }}"></script> --}}
 {{-- <script src="{{ asset('assets/js/nav-pills.js') }}"></script> --}}
 <script src="{{ asset('assets/js/carousel.js') }}"></script>
 <script src="{{ asset('assets/js/dropdown.js') }}"></script>
 <script src="{{ asset('assets/js/fixed-plugin.js') }}"></script>
 {{-- <script src="{{ asset('assets/js/navbar-collapse.js') }}"></script> --}}
 {{-- <script src="{{ asset('assets/js/tooltips.js') }}"></script> --}}

 <!-- plugins js -->
 <script src="{{ asset('assets/js/plugins/Chart.extension.js') }}"></script>
 <script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>
 {{-- <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script> --}}

 <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
 <script src="https://unpkg.com/lucide@latest"></script>
 <script src="https://website-widgets.pages.dev/dist/sienna.min.js" defer></script>
 <script src="{{ asset('asset-landing-page/js/navbar-fixed.js') }}"></script>
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 <script>
    document.getElementById("logout-button").addEventListener("click", function () {
        const isDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;

        Swal.fire({
            title: "Yakin ingin Logout?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Logout!",
            customClass: {
                popup: isDarkMode ? 'text-black' : '',
                confirmButton: 'bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded mr-2',
                cancelButton: 'bg-gray-300 hover:bg-gray-400 text-black font-medium py-2 px-4 rounded',
                title: 'text-black' // pastikan teks judul tampil
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById("logout-form").submit();
            }
        });
    });
</script>






 