<x-layout-admin>
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-white text-center">
                <h5 class="m-0 text-black">Tambah Jadwal</h5>
            </div>
            <div class="card-body">
                <form>
                    <div class="row mb-3">
                        <div class="col-md-4 col-12">
                            <label for="employeeName" class="form-label">Nama Karyawan</label>
                            <select class="form-select" id="employeeName">
                                <option selected>Pilih</option>
                                <option value="1">Karyawan 1</option>
                                <option value="2">Karyawan 2</option>
                                <option value="3">Karyawan 3</option>
                            </select>
                        </div>
                        <div class="col-md-4 col-12">
                            <label for="year" class="form-label">Tahun</label>
                            <select class="form-select" id="year">
                                <option selected>Pilih</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                            </select>
                        </div>
                        <div class="col-md-4 col-12">
                            <label for="month" class="form-label">Bulan</label>
                            <select class="form-select" id="month">
                                <option selected>Pilih</option>
                                <option value="january">Januari</option>
                                <option value="february">Februari</option>
                                <option value="march">Maret</option>
                                <!-- Add other months -->
                            </select>
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="button" class="btn btn-secondary me-2">Kembali</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout-admin>
