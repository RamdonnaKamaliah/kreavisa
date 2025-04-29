<link href="{{ asset('kreavisa.png') }}" rel="icon"><!--     Fonts and icons     -->
 <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
 <!-- Google Fonts -->
 <link rel="preconnect" href="https://fonts.googleapis.com">
 <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
 <link href="https://fonts.googleapis.com/css2?family=Protest+Riot&family=Montserrat:wght@100..900&display=swap"
     rel="stylesheet">
 <!-- Font Awesome Icons -->
 <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
 <!-- Nucleo Icons -->
 <link rel="stylesheet" href="{{ asset('asset-landing-admin/css/nucleo-icons.css') }}">
 <link rel="stylesheet" href="{{ asset('asset-landing-admin/css/nucleo-svg.css') }}">

 <!-- Popper -->
 <script src="https://unpkg.com/@popperjs/core@2"></script>
 <!-- Main Styling -->
 <link href="{{ asset('assets/css/argon-dashboard-tailwind.css') }}" rel="stylesheet" />
 <link href="{{ asset('assets/css/argon-dashboard-tailwind.min.css') }}" rel="stylesheet" />
 {{-- <link href="{{ asset('assets/css/perfect-scrollbar.css') }}" rel="stylesheet" /> --}}
 <link href="{{ asset('assets/css/tooltips.css') }}" rel="stylesheet" />
 <link rel="preconnect" href="https://fonts.googleapis.com">
 <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
 <link href="https://fonts.googleapis.com/css2?family=Protest+Riot&family=Montserrat:wght@100..900&display=swap"
     rel="stylesheet">

 <!-- Boxicons -->
 <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
 <script src="https://unpkg.com/feather-icons"></script>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

 <!-- Di head -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

 <!-- DataTables CSS -->
 <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css">
 <!-- jQuery dan DataTables JS -->
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script src="https://cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
 

 <!-- Tailwind -->
 @vite(['resources/css/app.css', 'resources/js/app.js'])


 <script>
     document.addEventListener('DOMContentLoaded', function() {
         const sidebarToggle = document.getElementById('sidebarToggle');
         const sidebar = document.getElementById('sidebar');

         sidebarToggle.addEventListener('click', function(event) {
             event.stopPropagation(); // Mencegah event menyebar
             sidebar.classList.toggle('-translate-x-full');
         });

         document.addEventListener('click', function(event) {
             if (!sidebar.contains(event.target) && !sidebarToggle.contains(event.target)) {
                 sidebar.classList.add('-translate-x-full');
             }
         });
     });
 </script>


 <!-- SweetAlert2 -->
 {{-- <script>
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
 </script> --}}
