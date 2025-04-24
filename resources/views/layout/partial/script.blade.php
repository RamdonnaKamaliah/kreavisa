<script> let table = new DataTable('#myTable');</script>
 <!-- SweetAlert2 -->
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 <script>
     @if (session('added'))
         Swal.fire({
             icon: 'success',
             title: 'Berhasil',
             text: 'Berhasil Menambah Data!',
             showConfirmButton: false,
             timer: 1500
         });
     @endif

     @if (session('edited'))
         Swal.fire({
             icon: 'success',
             title: 'Berhasil',
             text: 'Berhasil Mengedit Data!',
             showConfirmButton: false,
             timer: 1500
         });
     @endif

     function deleted(button) {
    Swal.fire({
        icon: "warning",
        title: "Yakin ingin menghapus?",
        text: "You won't be able to revert this!",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "Cancel",
        customClass: {
            confirmButton: 'bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded mr-2',
            cancelButton: 'bg-gray-300 hover:bg-gray-400 text-black font-medium py-2 px-4 rounded'
        },
        buttonsStyling: false
    }).then((result) => {
        if (result.isConfirmed) {
            button.parentElement.submit();
        }
    });
}


     @if (session('deleted'))
         Swal.fire({
             icon: 'success',
             title: 'Berhasil',
             text: 'Berhasil Menghapus Data!',
             showConfirmButton: false,
             timer: 1500
         });
     @endif
 </script>
 
<!-- Sebelum penutup body -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
 <!-- plugin for scrollbar  -->
 {{-- <script src="{{ asset('assets/js/perfect-scrollbar.js') }}"></script>
 <!-- main script file  -->
 <script src="{{ asset('assets/js/argon-dashboard-tailwind.js') }}"></script>
 <script src="{{ asset('assets/js/argon-dashboard-tailwind.min.js') }}"></script>
 <script src="{{ asset('assets/js/sidenav-burger.js') }}"></script>
 <script src="{{ asset('assets/js/navbar-sticky.js') }}"></script>
 <script src="{{ asset('assets/js/navbar-charts.js') }}"></script>
 <script src="{{ asset('assets/js/nav-pills.js') }}"></script>
 <script src="{{ asset('assets/js/carousel.js') }}"></script>
 <script src="{{ asset('assets/js/dropdown.js') }}"></script>
 <script src="{{ asset('assets/js/fixed-plugin.js') }}"></script>
 <script src="{{ asset('assets/js/navbar-collapse.js') }}"></script>
 <script src="{{ asset('assets/js/tooltips.js') }}"></script>

 <!-- plugins js -->
 <script src="{{ asset('assets/js/plugins/Chart.extension.js') }}"></script>
 <script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>
 <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script> --}}
 <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
 <script src="https://unpkg.com/lucide@latest"></script>
 <script src="https://website-widgets.pages.dev/dist/sienna.min.js" defer></script>
 <script src="{{ asset('asset-landing-page/js/navbar-fixed.js') }}"></script>
 <script src="{{ asset('asset-landing-page/js/darkmood-karyawan.js') }}"></script>
 