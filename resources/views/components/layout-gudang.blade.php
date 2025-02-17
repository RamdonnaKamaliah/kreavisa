<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kreavisa</title>

    <!-- Google Fonts -->
    <link rel="precon nect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Protest+Riot&family=Montserrat:wght@100..900&display=swap"
        rel="stylesheet">

    <!-- Boxicons -->
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>


<body class="bg-[#191E24] overflow-x-hidden">
    <main class="flex min-h-screen">
        <!-- Sidebar -->
        <x-navbar-gudang></x-navbar-gudang>

        <!-- Content Container -->
        <div class="flex-1 flex flex-col">
            <nav
                class="bg-gray-900 text-white p-4 flex justify-between items-center fixed top-0 left-64 right-0 z-50 shadow-lg">
                <h1 class="text-2xl font-bold">Dashboard</h1>
                <button id="darkModeToggle" class="p-2 rounded-full hover:bg-gray-700 transition">
                    <i class="bx bx-moon text-2xl"></i>
                </button>
            </nav>

            <!-- Slot untuk konten -->
            <div class="p-6 pt-16">
                <!-- Wrapper untuk tabel -->
                <div class="overflow-x-auto">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </main>

    <!-- jQuery -->
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>


    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                responsive: true,
                scrollX: true,
            });
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
    <style>
        html,
        body {
            max-width: 100%;
            overflow-x: hidden;
        }
    
        .dataTables_wrapper {
            overflow-x: auto;
        }
    
        table.dataTable {
            width: 100% !important;
        }
    </style>
    
</body>

</html>