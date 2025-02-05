<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="sweetalert2.min.css">
    <title>Kreavisa User</title>

    <!-- Custom fonts for this template-->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('asset-landing-admin/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <style>
        /* Action button styles */
        .btn-outline-primary,
        .btn-outline-warning,
        .btn-outline-danger {
            border-radius: 30px;
            transition: all 0.3s ease;
        }

        .btn-outline-primary:hover {
            background-color: #5a67d8;
            color: #fff;
        }

        .btn-outline-warning:hover {
            background-color: #ecc94b;
            color: #fff;
        }

        .btn-outline-danger:hover {
            background-color: #e53e3e;
            color: #fff;
        }

        /* Footer styles */
        .sticky-footer {
            width: 100%;
            text-align: center;
            padding: 10px 0;
            background-color: #ffffff;
        }
    </style>
</head>



<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background: #212529;">
        <x-navbar-gudang></x-navbar-gudang>
    </ul>

    <!-- Begin Page Content -->
    <div class="container-fluid">
        {{ $slot }}
    </div>
    <!-- End of Main Content -->

    <!-- Footer -->
    <footer class="sticky-footer bg-white text-center">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright &copy; Kreavisa</span>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="login.html">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    let table = new DataTable('#myTable');

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
            };
        });
    }

    @if (session('deleted'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: 'Berhasil Mengedit Data!',
            showConfirmButton: false,
            timer: 1500
        });
    @endif
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('asset-landing-admin/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('asset-landing-admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('asset-landing-admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('asset-landing-admin/js/sb-admin-2.min.js') }}"></script>
<script src="{{ asset('asset-landing-admin/vendor/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('asset-landing-admin/js/demo/chart-area-demo.js') }}"></script>
<script src="{{ asset('asset-landing-admin/js/demo/chart-pie-demo.js') }}"></script>


</html>
