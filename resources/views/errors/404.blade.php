{{-- resources/views/errors/404.blade.php --}}
<!DOCTYPE html>
<html lang="id">
@include('layout3.partial3.link3')

<head>
    <title>404 - Halaman Tidak Ditemukan</title>
</head>

<body class="bg-blue-50 text-gray-800">
    <div class="flex flex-col items-center justify-center min-h-screen p-6 text-center">
        <img src="{{ asset('asset-landing-page/img/404-removebg-preview.png') }}" alt="404 Illustration" class="w-64 mb-2">

        <h1 class="text-4xl font-bold mb-2">Oops! Halaman tidak ditemukan</h1>
        <p class="text-lg mb-4">Sepertinya kamu tersesat...</p>

        <a href="{{ url('/') }}"
            class="px-6 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition duration-300">
            Kembali ke Beranda
        </a>
    </div>
</body>

</html>
