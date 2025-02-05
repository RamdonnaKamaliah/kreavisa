<div>
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('karyawan.dashboard') }}">
        <div class="sidebar-brand-icon">
            <h1 class="font-protest text-2xl">K</h1>
        </div>
        <div class="sidebar-brand-text mx-3">aryawan</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Profile Section -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center p-3" href="{{ route('profile.index') }}">
        <div class="sidebar-brand-icon mr-3">
            <img src="{{ asset('asset-landing-admin/img/download (16).jpeg') }}" alt="Logo"
                class="profile-image rounded-circle">
        </div>
        <div class="sidebar-brand-text text-left">
            <div class="font-montserrat text-capitalize">Karyawan</div>
            <div class="small text-muted text-lowercase">karyawan@gmail.com</div>
        </div>
    </a>





    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('karyawan.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('absen-karyawan.index') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Absensi</span>
        </a>
    </li>

    <!-- Absen Karyawan -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('jadwal-karyawan.index') }}">
            <i class="fas fa-fw fa-calendar-alt"></i>
            <span>Jadwal Kerja</span>
        </a>
    </li>

    <!-- Jabatan Karyawan -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('gaji-karyawan.index') }}">
            <i class="fas fa-fw fa-money-bill"></i>
            <span>Gaji</span>
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
            <nav class="navbar navbar-expand navbar-light topbar mb-4 static-top shadow" style="background: #212529;">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Dark Mode Toggle -->
                    <li class="nav-item">
                        <a class="nav-link" id="darkModeToggle" href="#">
                            <i class="fas fa-moon"></i>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- End of Topbar -->

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
