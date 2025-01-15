<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link
    href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,400..800;1,400..800&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Protest+Riot&display=swap"
    rel="stylesheet">
<meta name="description" content="">
<meta name="author" content="">

<title>Kreavisa-Admin</title>

<!-- Custom fonts for this template-->
<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

<!-- Custom styles for this template-->
<link href="{{ asset('asset-landing-admin/css/sb-admin-2.css') }}" rel="stylesheet">
<style>
    /* Sidebar background color */
    .bg-custom-red {
        background-color: #302C42;
        color: white;
    }

    /* Sidebar text color */
    .sidebar-light .nav-link {
        color: white;
    }

    /* Hover effect for nav links */
    .sidebar-light .nav-link:hover {
        color: #FFEDED;
        /* Sedikit lebih terang saat hover */
    }

    /* Sidebar brand */
    .sidebar-light .sidebar-brand {
        color: white;
        font-weight: bold;
    }
</style>

<body>
    <x-nav-admin></x-nav-admin>
    <div>
        {{ $slot }}
    </div>
    <div>
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Your Website 2021</span>
                </div>
            </div>
        </footer>
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>
        
    </div>

</body>
<!-- Bootstrap core JavaScript-->
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('asset-landing-admin/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('asset-landing-admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript -->
<script src="{{ asset('asset-landing-admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages -->
<script src="{{ asset('asset-landing-admin/js/sb-admin-2.min.js') }}"></script>

<!-- Page level plugins -->
<script src="{{ asset('asset-landing-admin/vendor/chart.js/Chart.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('asset-landing-admin/js/demo/chart-area-demo.js') }}"></script>
<script src="{{ asset('asset-landing-admin/js/demo/chart-pie-demo.js') }}"></script>



</html>
