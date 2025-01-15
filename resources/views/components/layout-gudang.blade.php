<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Kreavisa</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Custom Google font-->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@100;200;300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ asset('asset-landing-page/css/styles.css') }}" rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    </head>
    <style>
         .text-gradient {
        background: linear-gradient(90deg, #6a11cb, #2575fc);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Optional: Additional spacing adjustments */
    h1 {
        margin-bottom: 1rem; /* Adjust the space between <h1> and buttons */
    }

    .btn {
        margin-top: 0; /* Ensure no extra margin is added */
    }
    .navbar-nav .nav-link.active {
        border-bottom: 2px solid #000000;
        padding-bottom: 10px;
    }
    @media (max-width: 768px) {
        .about-description {
            font-size: 0.9rem; /* Ukuran teks lebih kecil untuk mobile */
            line-height: 1.4; /* Menyesuaikan tinggi baris agar tetap nyaman dibaca */
        }
    }
    body, html {
    margin: 0;
    padding: 0;
    overflow-x: hidden; /* Cegah scroll horizontal */
}


.navbar {
    width: 100%; /* Pastikan navbar tidak melebihi viewport */
    box-sizing: border-box; /* Pastikan padding termasuk dalam lebar elemen */
}

    </style>
    <body class="d-flex flex-column h-100">

        <main class="flex-shrink-0">
           <x-navbar-gudang></x-navbar-gudang>
           <!-- In your parent Blade view -->

            {{ $slot }}
        </main>
        <!-- Footer-->
        <footer class="bg-white py-4 mt-auto">
            <div class="container px-5">
                <div class="row align-items-center justify-content-between flex-column flex-sm-row">
                    <div class="col-auto"><div class="small m-0">Copyright &copy; Rifdahtul Aisya</div></div>
                    <div class="col-auto">
                        <a class="small" href="#contact">Contact</a>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{ asset('asset-landing-page/js/scripts.js') }}"></script>
        <script>
                        // Fungsi untuk menambahkan class active pada link yang sesuai dengan id section
            function setActiveLink() {
            const sections = document.querySelectorAll('section');
            const links = document.querySelectorAll('.nav-link');

            sections.forEach((section) => {
                const id = section.id;
                const link = document.querySelector(`.nav-link[href="#${id}"]`);

                if (link) {
                if (window.scrollY >= section.offsetTop - 100 && window.scrollY < section.offsetTop + section.offsetHeight - 100) {
                    links.forEach((link) => link.classList.remove('active'));
                    link.classList.add('active');
                } else {
                    link.classList.remove('active');
                }
                }
            });
            }

            // Jalankan fungsi setActiveLink saat scroll
            window.addEventListener('scroll', setActiveLink);

            // Jalankan fungsi setActiveLink saat halaman dimuat
            document.addEventListener('DOMContentLoaded', setActiveLink);
        </script>
    </body>
</html>