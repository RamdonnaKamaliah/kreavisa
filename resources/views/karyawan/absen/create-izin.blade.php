@extends('layout3.karyawan3')
@section('content')
    <div class="p-4 md:p-6 md:ml-[250px] overflow-x-hidden">
        <div class="bg-gray-900 text-white p-4 rounded-lg shadow-md">
            <h1>Absen Izin</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('karyawan.absen.izin.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Input Lokasi -->
                <div class="form-group mb-3">
                    <label for="lokasi">Lokasi</label>
                    <input type="text" name="lokasi" id="lokasi" class="form-control" required>
                </div>

                <div class="form-group mb-3">
                    <label for="file">Upload Bukti Izin (JPG, PNG, PDF)</label>
                    <input type="file" name="file" id="file" class="form-control" accept=".jpg,.png,.pdf"
                        required>
                </div>

                <button type="submit" class="btn btn-primary">Simpan Absen</button>
            </form>
        </div>
    </div>
    <script>
        // Ambil lokasi otomatis
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                document.getElementById('lokasi').value = position.coords.latitude + ', ' + position.coords
                    .longitude;
            });
        } else {
            alert('Geolocation tidak didukung di browser Anda.');
        }
    </script>
@endsection
