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
<footer class="max-w-7xl mx-auto px-6 py-8 text-center text-gray-600">
    <h4 class="text-xl font-bold text-gray-800 mb-2">Kreavisa</h4>
    <p class="text-sm mb-4">Your Creative Partner</p>

    <div class="flex justify-center gap-6 mb-4">
        <a href="https://shopee.co.id/username_anda" target="_blank" rel="noopener noreferrer">
            <img src="{{ asset('asset-landing-page/img/logo-shopee.png') }}" alt="Shopee"
                class="w-6 h-6 hover:opacity-80 transition">
        </a>
        <a href="https://www.tiktok.com/@username_anda" target="_blank" rel="noopener noreferrer">
            <i class='bx bxl-tiktok text-2xl hover:text-black transition'></i>
        </a>
        <a href="https://www.instagram.com/username_anda" target="_blank" rel="noopener noreferrer">
            <i class='bx bxl-instagram text-2xl text-pink-500 hover:text-pink-600 transition'></i>
        </a>
    </div>

    <p class="text-xs">&copy; 2025 Kreavisa. All rights reserved.</p>
</footer>


<script src="{{ asset('asset-landing-page/js/darkmood.js') }}"></script>
</body>

</html>
