<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kreavisa</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Protest+Riot&family=Montserrat:wght@100..900&display=swap"
        rel="stylesheet">

    <!-- Boxicons -->
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <script src="https://unpkg.com/feather-icons"></script>


    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#191E24]">

    <main class="flex min-h-screen">
        <!-- Sidebar -->
        <x-navbar-karyawan></x-navbar-karyawan>

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
                {{ $slot }}
            </div>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anony    mous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
    <script>
        let table = new DataTable('#myTable');
    </script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- SweetAlert for Success Notification -->
    <script>
        @if (session('added'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Berhasil Menambah Data!',
                showConfirmButton: false,
                timer: 1500 // Close automatically after 1.5 seconds
            });
        @endif

        @if (session('edited'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Berhasil Mengedit Data!',
                showConfirmButton: false,
                timer: 1500 // Close automatically after 1.5 seconds
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
                };
            });
        }

        @if (session('deleted'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Berhasil Menghapus Data!',
                showConfirmButton: false,
                timer: 1500 // Close automatically after 1.5 seconds
            });
        @endif
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>
