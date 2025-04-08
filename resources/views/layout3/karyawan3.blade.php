
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/png" href="{{ asset('asset-landing-admin/img/Kreavisa Logo.png') }}" />

    <title>Kreavisa</title>
    @include('layout3.partial3.link3')
</head>

<body
    class="m-0 font-sans text-base antialiased font-normal dark:bg-slate-900 leading-default bg-gray-50 text-slate-500 overflow-x-hidden">
    @include('layout3.partial3.header3')

    @yield('content')


    {{-- @include('layout3.partial3.footer3') --}}
    </main>

</body>
@include('layout3.partial3.script3')



</html>
