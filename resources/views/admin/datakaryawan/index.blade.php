@extends('layout.main')
@section('content')
@if (session('email_error'))
    <div class="alert alert-warning">
        {{ session('email_error') }}
    </div>
@endif

    <div class="p-4 md:p-6 overflow-x-hidden">
        <!-- Laporan Stok Masuk -->
        <div class="bg-white text-black p-4 rounded-lg shadow-md border border-gray-300">
            <h2 class="text-center text-xl font-bold mb-4 text-gray-800">Laporan Data Karyawan</h2>
            <div class="flex flex-wrap gap-2 justify-center md:justify-start">
                <a href="{{ route('datakaryawan.create') }}">
                    <button
                        class="bg-blue-500 text-white px-3 py-1.5 text-sm md:px-4 md:py-2 md:text-base rounded-md hover:bg-blue-600">
                        Tambah Data
                    </button>
                </a>
            </div>
            <div class="overflow-x-auto mt-4">
                <table id="stokMasukTable" class="w-full border border-gray-300 text-xs md:text-sm">
                    <thead class="bg-gray-200 text-gray-800">
                        <tr>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Foto</th>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Nama Lengkap</th>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Username</th>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Email</th>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Usia</th>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Jenis Kelamin</th>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Tanggal Lahir</th>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">No HP</th>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Jabatan</th>
                            <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataKaryawan as $row)
                        <tr>
                            <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2 text-center">
                                @php
                                    // Cek jika foto adalah full path (hasil create) atau hanya nama file (hasil edit)
                                    $fotoPath = $row->foto;
                                    
                                    // Jika mengandung 'uploads/datakaryawan/' berarti sudah format benar
                                    if (strpos($fotoPath, 'uploads/datakaryawan/') !== false) {
                                        $photoUrl = asset($fotoPath);
                                    } 
                                    // Jika hanya nama file (hasil edit)
                                    elseif (!empty($fotoPath)) {
                                        $photoUrl = asset('uploads/datakaryawan/' . $fotoPath);
                                    } 
                                    // Default jika tidak ada foto
                                    else {
                                        $photoUrl = asset('asset-landing-page/img/profile.png');
                                    }
                                    
                                    // Tambahkan parameter cache busting
                                    $photoUrl .= '?v=' . time();
                                @endphp
                                
                                <img src="{{ $photoUrl }}"
                                     class="w-12 h-12 md:w-14 md:h-14 rounded-full object-cover border border-gray-300"
                                     alt="Foto profil {{ $row->nama_lengkap }}">
                            </td>
                            <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">{{ $row->nama_lengkap }}
                            </td>
                            <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">{{ $row->name }}
                            </td>
                            <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">{{ $row->email }}
                            </td>
                            <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">{{ $row->usia }} th
                            </td>
                            <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">{{ $row->gender }}
                            </td>
                            <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">
                                {{ \Carbon\Carbon::parse($row->tanggal_lahir)->format('d M Y') }}
                            </td>
                            <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">{{ $row->no_telepon }}
                            </td>
                            <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2">
                                {{ $row->jabatan->nama_jabatan ?? '-' }}
                            </td>
                            <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-2 text-center">
                                <div
                                    class="flex flex-col md:flex-row justify-center space-y-1 md:space-y-0 md:space-x-2">
                                    <a href="{{ route('datakaryawan.edit', $row->id) }}"
                                        class="px-2 py-1 text-yellow-600 border border-yellow-600 rounded-full hover:bg-yellow-100 flex items-center gap-1 text-xs md:text-sm md:inline-flex w-full md:w-auto justify-center">
                                        <i class="fas fa-edit"></i> <span class="ml-2">Edit</span>
                                    </a>
                                    <a href="{{ route('datakaryawan.show', $row->id) }}"
                                        class="px-2 py-1 text-blue-600 border border-blue-600 rounded-full hover:bg-blue-100 flex items-center gap-1 text-xs md:text-sm md:inline-flex w-full md:w-auto justify-center">
                                        <i class="fas fa-eye"></i> <span class="ml-2">View</span>
                                    </a>
                                    <form action="{{ route('datakaryawan.destroy', $row->id) }}" method="POST"
                                        class="inline w-full md:w-auto">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="deleted(this)"
                                            class="px-2 py-1 text-red-600 border border-red-600 rounded-full hover:bg-red-100 flex items-center gap-1 text-xs md:text-sm md:inline-flex w-full md:w-auto justify-center">
                                            <i class="fas fa-trash-alt"></i> <span class="ml-2">Delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
@endsection
