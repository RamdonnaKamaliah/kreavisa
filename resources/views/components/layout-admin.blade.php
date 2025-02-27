<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>

    

    <!-- Boxicons -->
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

   
    <!-- Tailwind -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<style>
    /* Style dropdown entries per page agar sesuai dengan tema dark */
    .dataTables_length select {
        background-color: #1e1e1e;
        color: #ffffff;
        border: 1px solid #444;
        padding: 5px;
        border-radius: 5px;
        max-height: 200px;
        /* Atur tinggi maksimum */
        overflow-y: auto;
        /* Tambahkan scroll jika opsi banyak */
    }

    /* Pastikan dropdown muncul di atas elemen lain */
    .dataTables_length {
        position: relative;
        z-index: 1000;
    }

    /* Hover dan focus effect */
    .dataTables_length select:focus,
    .dataTables_length select:hover {
        background-color: #292929;
        color: #ffffff;
    }
</style>

{{-- <body class="bg-[#191E24]">
    <main class="flex min-h-screen">

        <!-- Content Container -->
        <div class="flex-1 flex flex-col">
            <!-- Navbar -->
            <nav
                class="bg-gray-900 text-white p-4 px-6 flex justify-between items-center fixed top-0 left-0 w-full md:left-64 md:w-[calc(100%-16rem)] z-50 shadow-lg">

                <!-- Tombol Toggle Sidebar -->
                <button id="sidebarToggle" class="md:hidden p-2 rounded-full hover:bg-gray-700 transition">
                    <i class='bx bx-menu text-2xl'></i>
                </button>


                <h1 class="text-xl font-bold">Dashboard</h1>

                <button id="darkModeToggle" class="p-2 rounded-full hover:bg-gray-700 transition">
                    <i class="bx bx-moon text-2xl"></i>
                </button>
            </nav> --}}

            <div class="p-6 pt-20">
                {{ $slot }}
            </div>
        {{-- </div>
    </main> --}}

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
    <!-- Script DataTables -->
    <script>
        // $(document).ready(function() {
        //     $('#stokMasukTable').DataTable({
        //         "paging": true,
        //         "lengthMenu": [
        //             [10, 25, 50, -1],
        //             [10, 25, 50, "All"]
        //         ],
        //         "lengthChange": true,
        //         "searching": true,
        //         "ordering": true,
        //         "info": true,
        //         "autoWidth": false,
        //         "responsive": true,
        //         "language": {
        //             "lengthMenu": " _MENU_ entries per page"
        //         }
        //     });
        //     $('.dataTables_wrapper').addClass('mt-4');
        // });
        let table = new DataTable('#stokMasukTable');
    </script>

    

</body>




</html>
