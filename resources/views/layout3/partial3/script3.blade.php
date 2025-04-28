<!-- plugin for scrollbar  -->
<script src="{{ asset('assets/js/perfect-scrollbar.js') }}"></script>
<!-- main script file  -->
<script src="{{ asset('assets/js/argon-dashboard-tailwind.js') }}"></script>
<script src="{{ asset('assets/js/argon-dashboard-tailwind.min.js') }}"></script>
<script src="{{ asset('assets/js/carousel.js') }}"></script>
<script src="{{ asset('assets/js/dropdown.js') }}"></script>
<script src="{{ asset('assets/js/fixed-plugin.js') }}"></script>


<!-- plugins js -->
<script src="{{ asset('assets/js/plugins/Chart.extension.js') }}"></script>
<script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>


<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
<script src="https://website-widgets.pages.dev/dist/sienna.min.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById("logout-button").addEventListener("click", function() {
        const isDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;

        Swal.fire({
            title: "Yakin ingin Logout?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Logout!",
            background: isDarkMode ? "#1f2937" : "#ffffff",
            color: isDarkMode ? "#ffffff" : "#000000",
            customClass: {
                confirmButton: 'font-medium py-2 px-4 rounded mr-2 ' + (isDarkMode ?
                    'bg-red-500 hover:bg-red-600 text-white' :
                    'bg-red-600 hover:bg-red-700 text-white'),
                cancelButton: 'font-medium py-2 px-4 rounded ' + (isDarkMode ?
                    'bg-gray-600 hover:bg-gray-700 text-white' :
                    'bg-gray-300 hover:bg-gray-400 text-black'),
            },
            willOpen: (popup) => {
                // Paksa background sesuai tema
                popup.style.background = isDarkMode ? "#1f2937" : "#ffffff";
                popup.style.color = isDarkMode ? "#ffffff" : "#000000";
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById("logout-form").submit();
            }
        });
    });
</script>
