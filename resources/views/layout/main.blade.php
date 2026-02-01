
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Admin Kreavisa</title>
    @include('layout.partial.link')
</head>

<body
    class="m-0 font-sans text-base antialiased font-normal dark:bg-slate-900 leading-default bg-gray-50 text-slate-500 overflow-x-hidden">
    @include('layout.partial.header')
    <title>@yield('page-title', 'Default Title')</title>

    @yield('content')


    @include('layout.partial.footer')
    </main>

</body>
@include('layout.partial.script')



</html>
