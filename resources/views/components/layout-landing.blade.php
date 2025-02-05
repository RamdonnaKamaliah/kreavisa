<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kreavisa</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Protest+Riot&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,400..800;1,400..800&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    @vite('resources/css/app.css')


</head>
<main>
    <x-navbar-landing></x-navbar-landing>
    <!-- In your parent Blade view -->

    {{ $slot }}
</main>
<!-- Footer-->
<footer class="max-w-7xl mx-auto px-6 py-12  text-black">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Kolom Logo atau Info Perusahaan -->
        <div>
            <h4 class="text-2xl font-bold text-gray-800">Kreavisa</h4>
            <p class="text-sm mt-2 text-gray-600">Your Creative Partner</p>
            <p class="mt-4 text-gray-500 text-sm">&copy; 2025 Kreavisa. All rights reserved.</p>
        </div>

        <!-- Kolom Resources -->
        <div>
            <h5 class="text-lg font-semibold text-gray-800 mb-4">Resources</h5>
            <ul class="space-y-2">
                <li><a href="#" class="text-gray-600 hover:text-black transition">Privacy Policy</a></li>
                <li><a href="#" class="text-gray-600 hover:text-black transition">Terms and Condition</a></li>
                <li><a href="#" class="text-gray-600 hover:text-black transition">Blog</a></li>
                <li><a href="#" class="text-gray-600 hover:text-black transition">Contact Us</a></li>
            </ul>
        </div>

        <!-- Kolom Company -->
        <div>
            <h5 class="text-lg font-semibold text-gray-800 mb-4">Company</h5>
            <ul class="space-y-2">
                <li><a href="#" class="text-gray-600 hover:text-black transition">About Us</a></li>
                <li><a href="#" class="text-gray-600 hover:text-black transition">Why Choose Us</a></li>
                <li><a href="#" class="text-gray-600 hover:text-black transition">Pricing</a></li>
                <li><a href="#" class="text-gray-600 hover:text-black transition">Testimonial</a></li>
            </ul>
        </div>
    </div>

    <!-- Media Sosial -->
    <div class="mt-8 flex justify-center items-center gap-6">
        <!-- Shopee -->
        <a href="https://shopee.co.id/username_anda" target="_blank" rel="noopener noreferrer" class="group">
            <img src="{{ asset('asset-landing-page/img/logo-shopee.png') }}" alt="Shopee"
                class="w-8 h-8 hover:opacity-80 transition">
        </a>
        <!-- TikTok -->
        <a href="https://www.tiktok.com/@username_anda" target="_blank" rel="noopener noreferrer" class="group">
            <i class='bx bxl-tiktok text-3xl text-black group-hover:text-gray-800 transition'></i>
        </a>
        <!-- Instagram -->
        <a href="https://www.instagram.com/username_anda" target="_blank" rel="noopener noreferrer" class="group">
            <i class='bx bxl-instagram text-3xl text-pink-500 group-hover:text-pink-600 transition'></i>
        </a>
    </div>
</footer>
<script src="{{ asset('asset-landing-page/js/app.js') }}"></script>
</body>

</html>
