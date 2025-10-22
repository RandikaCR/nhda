<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="{{ url('/admin') }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('assets/common/images/logo.png') }}" alt="" height="40">
                    </span>
            <span class="logo-lg">
                        <img src="{{ asset('assets/common/images/logo.png') }}" alt="" height="40">
                    </span>
        </a>
        <!-- Light Logo-->
        <a href="{{ url('/admin') }}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset('assets/common/images/logo.png') }}" alt="" height="40">
                    </span>
            <span class="logo-lg">
                        <img src="{{ asset('assets/common/images/logo.png') }}" alt="" height="40">
                    </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ url('/admin') }}">
                        <i class="mdi mdi-speedometer"></i> <span data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ url('/admin/orders') }}">
                        <i class="mdi mdi-truck"></i> <span data-key="t-orders">Orders</span>
                        @if(!empty($navOrderCount))
                            <span class="badge badge-pill bg-info" data-key="t-new">{{ $navOrderCount }}</span>
                        @endif
                    </a>
                </li>

                <li class="menu-title"><span data-key="t-menu">Menu</span></li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarProducts" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarProducts">
                        <i class="mdi mdi-gift"></i> <span data-key="t-raffles-main">Products</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarProducts">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ url('/admin/products') }}" class="nav-link" data-key="t-products">All Products</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/admin/products/create') }}" class="nav-link" data-key="t-products-add">Add New</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="menu-title"><span data-key="t-system">System</span></li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ url('/admin/users') }}">
                        <i class="mdi mdi-account-details"></i> <span data-key="t-users">Users</span>
                    </a>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
