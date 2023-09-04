<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
      <a class="navbar-brand brand-logo" href="index.html"><img src="{{asset('dashboard/assets/images/logo.webp')}}" alt="logo" /></a>
      <a class="navbar-brand brand-logo-mini" href="index.html"><img src="{{asset('dashboard/assets/images/logo.webp')}}" alt="logo" /></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-stretch">
      <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
        <span class="mdi mdi-menu"></span>
      </button>
      <ul class="navbar-nav navbar-nav-right"> 
        <li class="nav-item nav-logout d-none d-lg-block">
          <a class="nav-link" href="{{ route('admin.signout') }}" title="Log Out">
            <i class="mdi mdi-power text-danger"></i>
          </a>
        </li>
        <li class="nav-item d-none d-lg-block full-screen-link">
            <a class="nav-link">
                <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
            </a>
        </li>
      </ul>
      <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
        <span class="mdi mdi-menu"></span>
      </button>
    </div>
  </nav>