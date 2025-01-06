
<div>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top py-3">
       <div class="container">
            <a class="navbar-brand" href="#header"><span class="fw-bolder text-primary">gudang</span></a>
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
                    <li class="nav-item"><a class="nav-link" href="#gudang1">Gudang</a></li> 
          
                                                                       
                </ul>
            </div>
       </div>
   </nav>
</div>
