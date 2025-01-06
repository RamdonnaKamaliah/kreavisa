<div>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top py-3">
       <div class="container">
            <a class="navbar-brand" href="#header"><span class="fw-bolder text-primary">Portfolio</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 small fw-bolder">
                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-primary">
                            Logout
                        </button>
                    </form>
                    <li class="nav-item"><a class="nav-link" href="#landing1">Landing</a></li>  
                    @if (Route::has('login'))
    @auth
        @php
            $redirectTo = '#'; // Default route if no role matches
            if (auth()->user()->hasRole('admin')) {
                $redirectTo = url('/admin/dashboard');
            } elseif (auth()->user()->hasRole('karyawan')) {
                $redirectTo = url('/');
            } elseif (auth()->user()->hasRole('gudang')) {
                $redirectTo = url('/gudang/dashboard');
            }
        @endphp
        <a 
            href="{{ $redirectTo }}" 
            class="nav-item nav-link"
        >
            Dashboard
        </a>
    @else
        <a 
            href="{{ url('/login') }}" 
            class="nav-item nav-link"
        >
            Log in
        </a>

        @if (Route::has('register'))
            <a 
                href="{{ url('/register') }}" 
                class="nav-item nav-link"
            >
                Register
            </a>
        @endif
    @endauth
@endif
                                                                       
                </ul>
            </div>
       </div>
   </nav>
</div>
