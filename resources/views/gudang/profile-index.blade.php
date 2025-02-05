<x-layout-karyawan2>
    <x-layout-class></x-layout-class>
    <div style="background: #F0F0F0; padding: 20px; border-radius: 10px; max-width: 900px; margin: 20px auto;">
        <!-- Header -->

        <!-- Foto Profil dan Info -->
        <div style="display: flex; align-items: center; gap: 20px; padding: 20px; flex-wrap: wrap;">
            <label for="photoUpload" style="cursor: pointer;">
                <img src="{{ asset('asset-landing-admin/img/profile1.jpeg') }}" alt="Upload Foto"
                    class="rounded-circle shadow" style="width: 120px; height: 120px;">
            </label>
            <div>
                <h2 style="margin: 0; font-weight: bold;">romusha</h2>
                <p style="margin: 5px 0; font-size: 1.1em; color: #555;">rama1@gmail.com</p>
                <p style="margin: 5px 0; font-size: 1em;">Karyawan Navisa Basic Collection</p>
            </div>
            <a href="{{ route('profile.edit') }}"
                style="margin-left: auto; padding: 8px 16px; background: #D3D3D3; color: black; border-radius: 5px; text-decoration: none; font-weight: bold;">
                Edit Profile
            </a>
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-primary">
                    Logout
                </button>
            </form>
        </div>

        <input type="file" id="photoUpload" name="photo" class="d-none">

        <!-- Data Profile -->
        <div
            style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 15px; padding: 20px; border-radius: 10px; color: white;">
            <div>
                <label class="form-label text-black fw-bold">Username</label>
                <div class="form-control text-white" style="background: #1E1E1E; padding: 10px; border-radius: 5px;">
                    romusha</div>
            </div>
            <div>
                <label class="form-label text-black fw-bold">No Telepon</label>
                <div class="form-control text-white" style="background: #1E1E1E; padding: 10px; border-radius: 5px;">
                    08675468997
                </div>
            </div>
            <div>
                <label class="form-label text-black fw-bold">Password</label>
                <div class="form-control text-white" style="background: #1E1E1E; padding: 10px; border-radius: 5px;">
                    ********</div>
            </div>
            <div>
                <label class="form-label text-black fw-bold">Jabatan</label>
                <div class="form-control text-white" style="background: #1E1E1E; padding: 10px; border-radius: 5px;">
                    Live</div>
            </div>
            <div>
                <label class="form-label text-black fw-bold">Nama Lengkap</label>
                <div class="form-control text-white" style="background: #1E1E1E; padding: 10px; border-radius: 5px;">
                    Romusha Sarif
                </div>
            </div>
            <div>
                <label class="form-label text-black fw-bold">Gender</label>
                <div class="form-control text-white" style="background: #1E1E1E; padding: 10px; border-radius: 5px;">
                    Laki-laki
                </div>
            </div>
            <div>
                <label class="form-label text-black fw-bold">Umur</label>
                <div class="form-control text-white" style="background: #1E1E1E; padding: 10px; border-radius: 5px;">17
                    th</div>
            </div>
            <div>
                <label class="form-label text-black fw-bold">Tanggal Lahir</label>
                <div class="form-control text-white" style="background: #1E1E1E ; padding: 10px; border-radius: 5px;">
                    13-10-2007
                </div>
            </div>
        </div>
    </div>

    <style>
        @media (max-width: 768px) {
            .form-control {
                width: 100%;
            }

            div[style*="grid-template-columns: repeat(2, 1fr)"] {
                grid-template-columns: 1fr !important;
            }

            div[style*="display: flex; align-items: center; gap: 20px; padding: 20px;"] {
                flex-direction: column;
                align-items: flex-start;
            }

            a[style*="margin-left: auto;"] {
                margin-left: 0 !important;
                margin-top: 10px;
            }
        }
    </style>
</x-layout-karyawan2>
