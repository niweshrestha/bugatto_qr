<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
                <div class="nav-profile-image">
                    <img src="{{ asset('dashboard/assets/images/admin.png') }}" alt="profile">
                    <span class="availability-status online"></span>
                    <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                    <span class="font-weight-bold mb-2">{{ auth()->user()->username }}</span>
                </div>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#brand" aria-expanded="false" aria-controls="brand">
                <span class="menu-title">Brands</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="brand">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.brand.lists') }}">Show Lists</a></li>
                    @if (Helper::is_super_admin())
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.brand.generate') }}">Add New
                                Brand</a></li>
                    @endif
                </ul>
            </div>
        </li>
        <li class="nav-item sidebar-actions">
            <span class="nav-link">
                <div class="border-bottom">
                    <h6 class="font-weight-normal mb-3">QR Code</h6>
                </div>
            </span>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#code" aria-expanded="false" aria-controls="code">
                <span class="menu-title">Codes</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="code">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.code.scanned.lists') }}">Show
                            Lists</a></li>
                    @if (Helper::is_super_admin())
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.code.generate.each') }}">Add New
                                Code</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.code.generate') }}">Bulk
                                Import</a>
                        </li>
                    @endif
                </ul>
            </div>
        </li>

        <li class="nav-item sidebar-actions">
            <span class="nav-link">
                <div class="border-bottom">
                    <h6 class="font-weight-normal mb-3">Lottery Generate</h6>
                </div>
            </span>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#lottery" aria-expanded="false" aria-controls="lottery">
                <span class="menu-title">Lotteries</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="lottery">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.lottery.lists') }}">Show Lists</a>
                    </li>
                    @if (Helper::is_super_admin())
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.lottery.create') }}">Create New
                                Lottery</a></li>
                    @endif
                </ul>
            </div>
        </li>
    </ul>
</nav>
