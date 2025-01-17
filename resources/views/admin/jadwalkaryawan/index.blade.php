<x-layout-admin>
    <div class="container my-5">
        <h2 class="mb-4">Jadwal Karyawan</h2>
        <div class="mb-3">
            <a href="{{ route('jadwalkaryawan.create') }}" class="btn btn-primary">
                + Tambah Data
            </a>
        </div>
        <div class="row mb-4">
            <div class="col-md-3">
                <label for="tahun" class="form-label">Tahun</label>
                <input type="number" class="form-control" id="tahun" value="2025">
            </div>
            <div class="col-md-3">
                <label for="bulan" class="form-label">Bulan</label>
                <select class="form-select" id="bulan">
                    <option value="January" selected>Januari</option>
                    <option value="February">Februari</option>
                    <option value="March">Maret</option>
                    <!-- Tambahkan opsi bulan lainnya -->
                </select>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button class="btn btn-success">Tampilkan</button>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>1</th>
                        <th>2</th>
                        <th>3</th>
                        <th>4</th>
                        <th>5</th>
                        <th>6</th>
                        <th>7</th>
                        <th>8</th>
                        <th>9</th>
                        <th>10</th>
                        <th>11</th>
                        <th>12</th>
                        <th>13</th>
                        <th>14</th>
                        <th>15</th>
                        <th>16</th>
                        <th>17</th>
                        <th>18</th>
                        <th>19</th>
                        <th>20</th>
                        <th>21</th>
                        <th>22</th>
                        <th>23</th>
                        <th>24</th>
                        <th>25</th>
                        <th>26</th>
                        <th>27</th>
                        <th>28</th>
                        <th>29</th>
                        <th>30</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Rizki</td>
                        <td colspan="30" class="text-center text-warning">Belum di input</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Eman</td>
                        <td colspan="30" class="text-center text-warning">Belum di input</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Angga</td>
                        <td colspan="30" class="text-center text-warning">Belum di input</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Samsul</td>
                        <td colspan="30" class="text-center text-warning">Belum di input</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Sundi</td>
                        <td colspan="30" class="text-center text-warning">Belum di input</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>Reva</td>
                        <td colspan="30" class="text-center text-warning">Belum di input</td>
                        <td>-</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-layout-admin>

<style>
    .table-responsive {
        overflow-x: auto;
        white-space: nowrap;
    }

    .table {
        border-collapse: collapse;
        width: 100%;
    }

    th,
    td {
        text-align: center;
        padding: 8px;
        border: 1px solid #ddd;
    }

    th {
        background-color: #f8f9fa;
    }

    tbody tr:nth-child(even) {
        background-color: #f2f2f2;
    }
</style>
