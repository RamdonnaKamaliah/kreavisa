            <div>
                
                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                    <div class="sidebar-brand-icon">
                        <h1 class="font-protest">K</h1>
                    </div>
                    <div class="sidebar-brand-text mx-3">Admin</div>
                </a>

                <!-- Divider -->
                <hr class="sidebar-divider my-0">

                <!-- Nav Item - Dashboard -->
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider my-0" />
                
                <!-- Data Karyawan -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('datakaryawan.index') }}">
                        <i class="fas fa-fw fa-users"></i>
                        <span>Data Karyawan</span>
                    </a>
                </li>

                <!-- Absen Karyawan -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('absenkaryawan.index') }}">
                        <i class="fas fa-fw fa-calendar-check"></i>
                        <span>Absen Karyawan</span>
                    </a>
                </li>

                <!-- Jabatan Karyawan -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('jabatankaryawan.index') }}">
                        <i class="fas fa-fw fa-briefcase"></i>
                        <span>Jabatan Karyawan</span>
                    </a>
                </li>

                <!-- Jadwal Karyawan -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('jadwalkaryawan.index') }}">
                        <i class="fas fa-fw fa-calendar-alt"></i>
                        <span>Jadwal Karyawan</span>
                    </a>
                </li>

                <!-- Gaji Karyawan -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('gajikaryawan.index') }}">
                        <i class="fas fa-fw fa-money-bill"></i>
                        <span>Gaji Karyawan</span>
                    </a>
                </li>

                <!-- Stok Barang -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('stokkaryawan.index') }}">
                        <i class="fas fa-fw fa-boxes"></i>
                        <span>Stok Barang</span>
                    </a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">

                <!-- Sidebar Toggler (Sidebar) -->
                <center>
                    <div class="text-center d-none d-md-inline">
                        <button class="rounded-circle border-0" id="sidebarToggle"></button>
                    </div>
                </center>


            </ul>
            <!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light topbar mb-4 static-top shadow" style="background: #302c42;">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Search -->
                <form
                    class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                            aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn" style="background-color: #ffffff;" type="button">
                                <i class="fa-solid fa-magnifying-glass" style="color: rgb(0, 0, 0);"></i>
                            </button>
                        </div>
                    </div>
                </form>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                    <li class="nav-item dropdown no-arrow d-sm-none">
                        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-search fa-fw"></i>
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                            aria-labelledby="searchDropdown">
                            <form class="form-inline mr-auto w-100 navbar-search">
                                <div class="input-group">
                                    <input type="text" class="form-control bg-light border-0 small"
                                        placeholder="Search for..." aria-label="Search"
                                        aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>

                    <div class="topbar-divider d-none d-sm-block"></div>

                 <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="{{ route('profile.index') }}" role="button">
                            <!-- Menampilkan Nama Pengguna yang Login -->
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ auth()->user()->name }}</span>
                            <img class="img-profile rounded-circle" src="{{ asset('asset-landing-admin/img/undraw_profile.svg') }}" alt="User Profile">
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- Logout Modal-->
            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Yakin untuk keluar?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Tekan "Logout" untuk keluar</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <!-- Form Logout -->
                        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-primary">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>