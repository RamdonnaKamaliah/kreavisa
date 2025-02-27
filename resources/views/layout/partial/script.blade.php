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
             confirmButtonColor: "#3085d6",
             cancelButtonColor: "#d33",
             confirmButtonText: "Yes, delete it!"
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
 
 <!-- plugin for scrollbar  -->
 <script src="{{ asset('assets/js/perfect-scrollbar.js') }}"></script>
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
 <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
 