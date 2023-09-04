<!-- Navigation-->
<nav class="navbar navbar-expand-lg bg-light text-uppercase fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="#page-top"><img src="{{asset('landing/assets/img/logo.webp')}}"></a>
        <button class="navbar-toggler text-uppercase font-weight-bold" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item mx-0 mx-lg-1"><a class="text-dark nav-link py-3 px-0 px-lg-3 rounded" href="#about">About</a></li>
                @if($lottery)
                <li class="nav-item mx-0 mx-lg-1">
                    <a class="text-dark nav-link py-3 px-0 px-lg-3 rounded" href="#contact">Join Lottery</a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</nav>