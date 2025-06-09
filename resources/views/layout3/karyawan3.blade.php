<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Kreavisa</title>
    @include('layout3.partial3.link3')
</head>

<body
    class="max-w-screen m-0 font-sans text-base antialiased font-normal dark:bg-slate-900 leading-default bg-gray-50 text-slate-500 overflow-x-hidden">
    @include('layout3.partial3.header3')

    @yield('content')
nn    
    @include('layout3.partial3.footer3')
    </main>


</body>
@include('layout3.partial3.script3')

<script>
    // Offline/online seperti sebelumnya
    window.addEventListener('offline', () => {
        Swal.fire({
            icon: 'error',
            title: 'Oops!',
            text: 'Koneksi internet kamu terputus.',
            confirmButtonText: 'Oke, siap!',
        });
    });
    window.addEventListener('online', () => {
        Swal.fire({
            icon: 'success',
            title: 'Kembali Online!',
            text: 'Koneksi internet kamu udah nyambung lagi.',
            timer: 2000,
            showConfirmButton: false
        });
    });
</script>

@stack('scripts')

</html>
