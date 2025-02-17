
<x-layout-admin>
    <div id="layoutSidenav_content">
        <!-- Card Container -->
        <main class="d-flex justify-content-center align-items-center" style="min-height: 100vh; padding-top: 2px;">
            <!-- Card Container -->
            <div class="card mx-auto shadow p-4"
                style="max-width: 600px; background-color: #f8f9fa; border-radius: 12px;">
                <div class="container">
                    <h1 class="text-center my-4"
                        style="font-family: 'Arial', sans-serif; color: #333; padding-top: 10px;">
                        View Jabatan Karyawan
                    </h1>
                        <div class="row g-3">
                            <!-- Nama Jabatan -->
                            <div class="col-12">
                                <p>
                                    {{ $jabatankaryawan->nama_jabatan }}
                                </p>
                            </div>
                        </div>
                        <a href="{{ route('jabatankaryawan.index') }}" class="btn btn-modern mt-4" style="background-color: #000000; color: white;">Back to List</a>
                </div>
            </div>
        </main>
    </div>
</x-layout-admin>
