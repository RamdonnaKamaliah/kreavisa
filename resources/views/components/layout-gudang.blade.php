<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Karyawan</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Protest+Riot&family=Montserrat:wght@100..900&display=swap"
        rel="stylesheet">

    <!-- Boxicons -->
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<!-- jQuery dan DataTables JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>


    <!-- Tailwind -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<style>
    
    /* Style dropdown entries per page agar sesuai dengan tema dark */
.dataTables_length select {
    background-color: #1e1e1e; /* Warna latar belakang dropdown */
    color: #ffffff; /* Warna teks */
    border: 1px solid #444; /* Border agar sesuai dengan tema */
    padding: 5px;
    border-radius: 5px;
}

/* Hover dan focus effect */
.dataTables_length select:focus, 
.dataTables_length select:hover {
    background-color: #292929;
    color: #ffffff;
}

</style>
<body class="bg-[#191E24]">
    <main class="flex min-h-screen">
        <x-navbar-gudang></x-navbar-gudang>

        <!-- Content Container -->
        <div class="flex-1 flex flex-col">
            <!-- Navbar -->
            <nav class="bg-gray-900 text-white p-4 px-6 flex justify-between items-center fixed top-0 left-0 w-full md:left-64 md:w-[calc(100%-16rem)] z-50 shadow-lg">
                
                <!-- Tombol Toggle Sidebar -->
                <button id="sidebarToggle" class="md:hidden p-2 rounded-full hover:bg-gray-700 transition">
                    <i class='bx bx-menu text-2xl'></i>
                </button>

                <h1 class="text-xl font-bold">@stack('page-title', 'Dashboard')</h1>
                
                <button id="darkModeToggle" class="p-2 rounded-full hover:bg-gray-700 transition">
                    <i class="bx bx-moon text-2xl"></i>
                </button>
            </nav>

            <div class="p-6 pt-20">
                {{ $slot }}
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebar = document.getElementById('sidebar');

            sidebarToggle.addEventListener('click', function (event) {
                event.stopPropagation(); // Mencegah event menyebar
                sidebar.classList.toggle('-translate-x-full');
            });

            document.addEventListener('click', function (event) {
                if (!sidebar.contains(event.target) && !sidebarToggle.contains(event.target)) {
                    sidebar.classList.add('-translate-x-full');
                }
            });
        });
    </script>
     <!-- Script DataTables -->
     <script>
        $(document).ready(function() {
       $('#stokMasukTable').DataTable({
           "paging": true,
           "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]], // Dropdown "entries per page"
           "lengthChange": true, // Memunculkan dropdown
           "searching": true,
           "ordering": true,
           "info": true,
           "autoWidth": false,
           "responsive": true,
           "language": {
               "lengthMenu": " _MENU_ entries per page"
           }
       });

       // Tambahkan jarak antara DataTable dan tabel
       $('.dataTables_wrapper').addClass('mt-4');
   });
   </script>
 
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
 
</body>




</html>
