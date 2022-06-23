<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="#!">Toko Kita</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="colapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span></button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
            <li class="nav-item"><a class="nav-link active" aria-current="page" href="{{url('')}}">Home</a></li>
            @if(getCustSessions())
            <li class="nav-item dropdown">
                <a class="nav-Link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">{{getCustSessions()->name}}</a>
                <ul class="dropdown-menu" arial-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="{{url('logout')}}">Keluar</a></li>
                </ul>
            </li>
            @endif
        </ul>
        @if(getCustSessions())
        <a href="{{url('cart')}}" style="...">
            <button class="btn btn-outline-dark" type="submit">
                <i class="bi-cart-fill me-1"></i>
                Cart
                <span class="badge bg-dark text-white ms-1 rounded-pill">{{getCountCart()}}</span>
            </button>
        </a>
        @else
            <button class="btn btn-outline-dark">
                Login
            </button>
        @endif
    </div>
    </div>
</nav>