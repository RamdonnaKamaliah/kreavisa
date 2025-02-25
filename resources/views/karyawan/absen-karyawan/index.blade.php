@extends('layout3.karyawan3')
@section('content')
    <section class="flex-grow flex items-center justify-center min-h-screen md:ml-16 md:mr-0 md:pl-40 pt-20">
        <div class="p-6 rounded-xl shadow-lg text-center max-w-4xl w-full mx-auto md:ml-auto md:mr-auto bg-gray-800">
            <h1>Jabatan Karyawan</h1>
            <a href="{{ route('absen-karyawan.create') }}">
                + Tambah Data
            </a>

        </div>
        <script>
            @if (Session::has('success'))
                <
                div class = "bg-green-500 text-white p-4 rounded-lg mb-4" >
                {{ Session::get('success') }}
                    <
                    /div>
            @endif

            @if (Session::has('error'))
                <
                div class = "bg-red-500 text-white p-4 rounded-lg mb-4" >
                {{ Session::get('error') }}
                    <
                    /div>
            @endif
        </script>
    @endsection
