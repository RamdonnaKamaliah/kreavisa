@extends('layout.main')

@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <div id="layoutSidenav_content pt-1">
        <div class="flex justify-center items-center min-h-[80vh] py-6 px-4">
            
            <div class="w-full max-w-4xl bg-white dark:bg-slate-800 p-6 rounded-lg shadow-lg">

                <div class="mb-4">
                    <a href="{{ route('shiftkaryawan.index') }}" class="text-blue-600 hover:text-blue-800">
                        <i class='bx bx-arrow-back text-2xl'></i>
                    </a>
                </div>

                <h1 class="text-center text-2xl font-bold text-gray-800 mb-6 dark:text-white">Create Shift Karyawan</h1>
                <form action="{{ route('shiftkaryawan.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="user_id" class="block text-gray-700 font-semibold mb-2 dark:text-gray-300">Karyawan</label>
                        <select id="user_id" name="user_id" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:border-blue-500 transition" required>
                            <option value="">Pilih Karyawan</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" data-jabatan="{{ $user->jabatan_id }}">
                                    {{ $user->nama_lengkap }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="jabatan_id" class="block text-gray-700 font-semibold mb-2">Jabatan</label>
                        <select id="jabatan_id" class="w-full p-3 border border-gray-300 rounded-lg bg-gray-100 cursor-not-allowed" disabled>
                            <option value="">Pilih Jabatan</option>
                            @foreach ($jabatans as $jabatan)
                                <option value="{{ $jabatan->id }}">{{ $jabatan->nama_jabatan }}</option>
                            @endforeach
                        </select>
                        <input type="hidden" name="jabatan_id" id="hidden_jabatan_id">
                    </div>

                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            let userSelect = document.getElementById("user_id");
                            let jabatanSelect = document.getElementById("jabatan_id");
                            let hiddenJabatanId = document.getElementById("hidden_jabatan_id");

                            userSelect.addEventListener("change", function() {
                                let selectedOption = this.options[this.selectedIndex];
                                let jabatanId = selectedOption.getAttribute("data-jabatan");

                                jabatanSelect.value = jabatanId;
                                hiddenJabatanId.value = jabatanId;
                            });
                        });
                    </script>

                    <div class="mb-4">
                        <h2 class="text-lg font-semibold text-gray-700">Shift 1</h2>
                        <label for="shift_1_masuk" class="block text-gray-700 font-semibold mt-2">Jam Masuk</label>
                        <input type="text" id="shift_1_masuk" name="shift_1_masuk" class="timepicker w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:border-blue-500 transition" required>

                        <label for="shift_1_pulang" class="block text-gray-700 font-semibold mt-2">Jam Pulang</label>
                        <input type="text" id="shift_1_pulang" name="shift_1_pulang" class="timepicker w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:border-blue-500 transition" required>
                    </div>

                    <div class="mb-4">
                        <h2 class="text-lg font-semibold text-gray-700">Shift 2</h2>
                        <label for="shift_2_masuk" class="block text-gray-700 font-semibold mt-2">Jam Masuk</label>
                        <input type="text" id="shift_2_masuk" name="shift_2_masuk" class="timepicker w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:border-blue-500 transition" required>

                        <label for="shift_2_pulang" class="block text-gray-700 font-semibold mt-2">Jam Pulang</label>
                        <input type="text" id="shift_2_pulang" name="shift_2_pulang" class="timepicker w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:border-blue-500 transition" required>
                    </div>

                    <script>
                        document.addEventListener("DOMContentLoaded", function () {
                            flatpickr(".timepicker", {
                                enableTime: true,
                                noCalendar: true,
                                dateFormat: "H:i", // Format 24 jam
                                time_24hr: true
                            });
                        });
                    </script>

                    <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition">
                        Create
                    </button>
                </form>
            </div>
        </div>
    </div>
    @if ($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let errorMessages = "";
            @foreach ($errors->all() as $error)
                errorMessages += "{{ $error }}\n";
            @endforeach

            Swal.fire({
    icon: 'error',
    title: 'Oops... Terjadi Kesalahan',
    text: errorMessages,
    confirmButtonText: 'OK',
    confirmButtonColor: '#d33',
    customClass: {
        confirmButton: 'bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700'
    }
}).then(() => {
    window.location.href = "{{ route('shiftkaryawan.create') }}";
});

        });
    </script>
@endif
@endsection
