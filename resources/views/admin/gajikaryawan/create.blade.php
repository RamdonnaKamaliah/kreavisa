<x-layout-admin>
    <div id="layoutSidenav_content">
        <div id="layoutSidenav_content">
            <main>
                <div id="layoutSidenav_content">
                    <h1 class="container text-center my-4" style="font-family: 'Arial', sans-serif; color: #333;">
                        Create Gaji
                        Karyawan</h1>

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
                            <label for="position" class="form-label"
                                style="font-weight: bold; color: #495057;">Jabatan</label>
                            <input type="text" id="position" name="position" class="form-control form-control-sm"
                                required
                                style="border-radius: 8px; border-color: #007bff; box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.12);">
                        </div>

                        <div class="mb-3">
                            <label for="metode pembayaran" class="form-label"
                                style="font-weight: bold; color: #495057">Metode Pembayaran</label>
                            <input type="text" id="metode pembayaran" name="metode pembayaran"
                                class="form-control from-control-sm" required
                                style=style="border-radius: 8px; border-color: #007bff; box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.12);">

                        </div>

                        <div class="mb-3">
                            <label for="bonus" class="form-label" style="font-weight: bold; color:#495057">Bonus
                            </label>
                            <input type="number" name="bonus" id="bonus" class="form-control form-control-sm"
                                required
                                style="border-radius: 8px; border-color: #007bff; box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0, 0.12); ">
                        </div>

                        <div class="mb-3">
                            <label for="potongan gaji" class="form-label"
                                style="font-weight: bold; color:#495057">Potongan Gaji
                            </label>
                            <input type="text" name="potongan gaji" id="potongan gaji"
                                class="form-control form-control-sm" required
                                style="border-radius: 8px; border-color: #007bff; box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0, 0.12); ">
                        </div>
                        <div class="mb-3">
                            <label for="potongan gaji" class="form-label" style="font-weight: bold; color:#495057">Total
                                Gaji
                            </label>
                            <input type="number" name="potongan gaji" id="potongan gaji"
                                class="form-control form-control-sm" required
                                style="border-radius: 8px; border-color: #007bff; box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0, 0.12); ">
                        </div>


                        <button type="submit" class="btn btn-primary btn-sm"
                            style="padding: 8px 16px; border-radius: 5px; font-weight: bold; text-transform: uppercase; width: 100%;">Create</button>
                    </form>

                    <div class="container mt-4 text-center">
                        <a href="#" class="btn btn-link"
                            style="text-decoration: none; color: #007bff; font-weight: bold; text-transform: uppercase;">Back
                            to list</a>
                    </div>
                </div>
            </main>
        </div>
    </div>
</x-layout-admin>
