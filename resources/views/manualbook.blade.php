@extends('layout3.karyawan3')
{{-- @section('page-title', 'Kinerja') --}}

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Manual Book</h1>

    <div class="w-full h-[80vh]">
        <iframe src="{{ asset('asset-landing-page/img/Manual Book Kreavisa.pdf') }}" 
                class="w-full h-full rounded-lg shadow" 
                frameborder="0"></iframe>
    </div>

    <div class="mt-4">
        <a href="{{ route('dashboard') }}" class="text-blue-500 hover:underline">
            ← Kembali ke Dashboard
        </a>
    </div>
</div>
@endsection
