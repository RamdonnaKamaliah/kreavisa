<x-layout-admin>
    <div id="layoutSidenav_content">
        <div id="layoutSidenav_content">
            <main>
                <div id="layoutSidenav_content">
                    <h1 class="container text-center my-4" style="font-family: 'Arial', sans-serif; color: #333;">
                        Create Absen</h1>

                    <form class="admin-form container" action="#" method="POST" enctype="multipart/form-data"
                        style="background-color: #f8f9fa; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); max-width: 600px; margin: 0 auto;">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label"
                                style="font-weight: bold; color: #495057;">Nama</label>
                            <input type="text" id="name" name="name" class="form-control form-control-sm"
                                required
                                style="border-radius: 8px; border-color: #007bff; box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.12);">
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label" style="font-weight: bold; color: #495057;">No
                                HP</label>
                            <input type="tel" id="phone" name="phone" class="form-control form-control-sm"
                                required
                                style="border-radius: 8px; border-color: #007bff; box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.12);">
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label"
                                style="font-weight: bold; color: #495057;">Alamat</label>
                            <textarea id="address" name="address" class="form-control form-control-sm" required
                                style="border-radius: 8px; border-color: #007bff; box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.12);"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="position" class="form-label"
                                style="font-weight: bold; color: #495057;">Jabatan</label>
                            <input type="text" id="position" name="position" class="form-control form-control-sm"
                                required
                                style="border-radius: 8px; border-color: #007bff; box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.12);">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label"
                                style="font-weight: bold; color: #495057;">Email</label>
                            <input type="email" id="email" name="email" class="form-control form-control-sm"
                                required
                                style="border-radius: 8px; border-color: #007bff; box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.12);">
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label"
                                style="font-weight: bold; color: #495057;">Password</label>
                            <input type="password" id="password" name="password" class="form-control form-control-sm"
                                required
                                style="border-radius: 8px; border-color: #007bff; box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.12);">
                        </div>

                        <button type="submit" class="btn btn-primary btn-sm"
                            style="padding: 8px 16px; border-radius: 5px; font-weight: bold; text-transform: uppercase; width: 100%;">Create</button>
                    </form>

                    <div class="container mt-4 text-center">
                        <a href="{{ route('absenkaryawan.index') }}" class="btn btn-link"
                            style="text-decoration: none; color: #007bff; font-weight: bold; text-transform: uppercase;">Back
                            to list</a>
                    </div>
                </div>
            </main>
        </div>
    </div>
</x-layout-admin>
