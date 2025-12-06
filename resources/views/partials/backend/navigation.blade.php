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
                    <a class="nav-link menu-link {{ (request()->segment(2) == '') ? 'active' : '' }}" href="{{ url('/admin') }}">
                        <i class="mdi mdi-speedometer"></i> <span data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link {{ (request()->segment(2) == 'reservations') ? 'active' : '' }}" href="{{ url('/admin/reservations') }}">
                        <i class="mdi mdi-truck"></i> <span data-key="t-admin-reservations">Reservations</span>
                        @if(!empty($navReservationsCount))
                            <span class="badge badge-pill bg-danger" data-key="t-new">{{ $navReservationsCount }}</span>
                        @endif
                    </a>
                </li>

                <li class="menu-title"><span data-key="t-menu">Main Pages</span></li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarNews" data-bs-toggle="collapse" role="button" aria-expanded="{{ (request()->segment(2) == 'news') ? 'true' : 'false' }}" aria-controls="sidebarNews">
                        <i class="mdi mdi-gift"></i> <span data-key="t-raffles-main">NEWS</span>
                    </a>
                    <div class="collapse menu-dropdown {{ (request()->segment(2) == 'news') ? 'show' : '' }}" id="sidebarNews">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ url('/admin/news') }}" class="nav-link {{ (request()->segment(2) == 'news' && request()->segment(3) == '') ? 'active' : '' }}" data-key="t-news">All News</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/admin/news/create') }}" class="nav-link {{ (request()->segment(2) == 'news' && request()->segment(3) == 'create') ? 'active' : '' }}" data-key="t-news-add">Add New</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarPressReleases" data-bs-toggle="collapse" role="button" aria-expanded="{{ (request()->segment(2) == 'press-releases') ? 'true' : 'false' }}" aria-controls="sidebarPressReleases">
                        <i class="mdi mdi-gift"></i> <span data-key="t-raffles-main">Press Releases</span>
                    </a>
                    <div class="collapse menu-dropdown {{ (request()->segment(2) == 'press-releases') ? 'show' : '' }}" id="sidebarPressReleases">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ url('/admin/press-releases') }}" class="nav-link {{ (request()->segment(2) == 'press-releases' && request()->segment(3) == '') ? 'active' : '' }}" data-key="t-press-releases">All Press Releases</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/admin/press-releases/create') }}" class="nav-link {{ (request()->segment(2) == 'press-releases' && request()->segment(3) == 'create') ? 'active' : '' }}" data-key="t-press-release-add">Add New</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarProjects" data-bs-toggle="collapse" role="button" aria-expanded="{{ (request()->segment(2) == 'projects') ? 'true' : 'false' }}" aria-controls="sidebarProjects">
                        <i class="mdi mdi-gift"></i> <span data-key="t-raffles-main">Projects</span>
                    </a>
                    <div class="collapse menu-dropdown {{ (request()->segment(2) == 'projects') ? 'show' : '' }}" id="sidebarProjects">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ url('/admin/projects') }}" class="nav-link {{ (request()->segment(2) == 'projects' && request()->segment(3) == '') ? 'active' : '' }}" data-key="t-projects">All Projects</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/admin/projects/create') }}" class="nav-link {{ (request()->segment(2) == 'projects' && request()->segment(3) == 'create') ? 'active' : '' }}" data-key="t-projects-add">Add New</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarVideos" data-bs-toggle="collapse" role="button" aria-expanded="{{ (request()->segment(2) == 'videos') ? 'true' : 'false' }}" aria-controls="sidebarVideos">
                        <i class="mdi mdi-gift"></i> <span data-key="t-raffles-main">Videos</span>
                    </a>
                    <div class="collapse menu-dropdown {{ (request()->segment(2) == 'videos') ? 'show' : '' }}" id="sidebarVideos">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ url('/admin/videos') }}" class="nav-link {{ (request()->segment(2) == 'videos' && request()->segment(3) == '') ? 'active' : '' }}" data-key="t-videos">All Videos</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/admin/videos/create') }}" class="nav-link {{ (request()->segment(2) == 'videos' && request()->segment(3) == 'create') ? 'active' : '' }}" data-key="t-videos-add">Add New</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarDownloads" data-bs-toggle="collapse" role="button" aria-expanded="{{ (request()->segment(2) == 'downloads') ? 'true' : 'false' }}" aria-controls="sidebarDownloads">
                        <i class="mdi mdi-gift"></i> <span data-key="t-raffles-main">Downloads</span>
                    </a>
                    <div class="collapse menu-dropdown {{ (request()->segment(2) == 'downloads') ? 'show' : '' }}" id="sidebarDownloads">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ url('/admin/downloads') }}" class="nav-link {{ (request()->segment(2) == 'downloads' && request()->segment(3) == '') ? 'active' : '' }}" data-key="t-downloads">All Downloads</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/admin/downloads/create') }}" class="nav-link {{ (request()->segment(2) == 'downloads' && request()->segment(3) == 'create') ? 'active' : '' }}" data-key="t-downloads-add">Add New</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link {{ (request()->segment(2) == 'services') ? 'active' : '' }}" href="{{ url('/admin/services') }}">
                        <i class="mdi mdi-account-details"></i> <span data-key="t-services">Services</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarServiceFunctions" data-bs-toggle="collapse" role="button" aria-expanded="{{ (request()->segment(2) == 'service-functions') ? 'true' : 'false' }}" aria-controls="sidebarServiceFunctions">
                        <i class="mdi mdi-gift"></i> <span data-key="t-raffles-main">Service Functions</span>
                    </a>
                    <div class="collapse menu-dropdown {{ (request()->segment(2) == 'service-functions') ? 'show' : '' }}" id="sidebarServiceFunctions">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ url('/admin/service-functions') }}" class="nav-link {{ (request()->segment(2) == 'service-functions' && request()->segment(3) == '') ? 'active' : '' }}" data-key="t-service-functions">All Service Functions</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/admin/service-functions/create') }}" class="nav-link {{ (request()->segment(2) == 'service-functions' && request()->segment(3) == 'create') ? 'active' : '' }}" data-key="t-service-functions-add">Add New</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarCircuitBungalows" data-bs-toggle="collapse" role="button" aria-expanded="{{ (request()->segment(2) == 'circuit-bungalows') ? 'true' : 'false' }}" aria-controls="sidebarCircuitBungalows">
                        <i class="mdi mdi-gift"></i> <span data-key="t-raffles-main">Circuit Bungalows</span>
                    </a>
                    <div class="collapse menu-dropdown {{ (request()->segment(2) == 'circuit-bungalows') ? 'show' : '' }}" id="sidebarCircuitBungalows">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ url('/admin/circuit-bungalows') }}" class="nav-link {{ (request()->segment(2) == 'circuit-bungalows' && request()->segment(3) == '') ? 'active' : '' }}" data-key="t-circuit-bungalows">All Circuit Bungalows</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/admin/circuit-bungalows/create') }}" class="nav-link {{ (request()->segment(2) == 'circuit-bungalows' && request()->segment(3) == 'create') ? 'active' : '' }}" data-key="t-circuit-bungalows-add">Add New</a>
                            </li>
                        </ul>
                    </div>
                </li>


                <li class="menu-title"><span data-key="t-system">Page Setup</span></li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarDistrictOfficeContacts" data-bs-toggle="collapse" role="button" aria-expanded="{{ (request()->segment(2) == 'district-office-contacts') ? 'true' : 'false' }}" aria-controls="sidebarDistrictOfficeContacts">
                        <i class="mdi mdi-gift"></i> <span data-key="t-raffles-main">District Office Contacts</span>
                    </a>
                    <div class="collapse menu-dropdown {{ (request()->segment(2) == 'district-office-contacts') ? 'show' : '' }}" id="sidebarDistrictOfficeContacts">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ url('/admin/district-office-contacts') }}" class="nav-link {{ (request()->segment(2) == 'district-office-contacts' && request()->segment(3) == '') ? 'active' : '' }}" data-key="t-district-office-contacts">All District Office Contacts</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/admin/district-office-contacts/create') }}" class="nav-link {{ (request()->segment(2) == 'district-office-contacts' && request()->segment(3) == 'create') ? 'active' : '' }}" data-key="t-district-office-contacts-add">Add New</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarSeniorStaff" data-bs-toggle="collapse" role="button" aria-expanded="{{ (request()->segment(2) == 'senior-staff') ? 'true' : 'false' }}" aria-controls="sidebarSeniorStaff">
                        <i class="mdi mdi-gift"></i> <span data-key="t-raffles-main">Senior Staff</span>
                    </a>
                    <div class="collapse menu-dropdown {{ (request()->segment(2) == 'senior-staff') ? 'show' : '' }}" id="sidebarSeniorStaff">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ url('/admin/senior-staff') }}" class="nav-link {{ (request()->segment(2) == 'senior-staff' && request()->segment(3) == '') ? 'active' : '' }}" data-key="t-senior-staff">All Senior Staff</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/admin/senior-staff/create') }}" class="nav-link {{ (request()->segment(2) == 'senior-staff' && request()->segment(3) == 'create') ? 'active' : '' }}" data-key="t-senior-staff-add">Add New</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarBoardOfDirectors" data-bs-toggle="collapse" role="button" aria-expanded="{{ (request()->segment(2) == 'board-of-directors') ? 'true' : 'false' }}" aria-controls="sidebarBoardOfDirectors">
                        <i class="mdi mdi-gift"></i> <span data-key="t-raffles-main">Board Of Directors</span>
                    </a>
                    <div class="collapse menu-dropdown {{ (request()->segment(2) == 'board-of-directors') ? 'show' : '' }}" id="sidebarBoardOfDirectors">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ url('/admin/board-of-directors') }}" class="nav-link {{ (request()->segment(2) == 'board-of-directors' && request()->segment(3) == '') ? 'active' : '' }}" data-key="t-board-of-directors">All Board Of Directors</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/admin/board-of-directors/create') }}" class="nav-link {{ (request()->segment(2) == 'board-of-directors' && request()->segment(3) == 'create') ? 'active' : '' }}" data-key="t-board-of-directors-add">Add New</a>
                            </li>
                        </ul>
                    </div>
                </li>


                <li class="menu-title"><span data-key="t-system">Settings</span></li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarDownloadCategories" data-bs-toggle="collapse" role="button" aria-expanded="{{ (request()->segment(2) == 'download-categories') ? 'true' : 'false' }}" aria-controls="sidebarDownloadCategories">
                        <i class="mdi mdi-gift"></i> <span data-key="t-raffles-main">Download Categories</span>
                    </a>
                    <div class="collapse menu-dropdown {{ (request()->segment(2) == 'download-categories') ? 'show' : '' }}" id="sidebarDownloadCategories">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ url('/admin/download-categories') }}" class="nav-link {{ (request()->segment(2) == 'download-categories' && request()->segment(3) == '') ? 'active' : '' }}" data-key="t-download-categories">All Download Categories</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/admin/download-categories/create') }}" class="nav-link {{ (request()->segment(2) == 'download-categories' && request()->segment(3) == 'create') ? 'active' : '' }}" data-key="t-download-categories-add">Add New</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link {{ (request()->segment(2) == 'users') ? 'active' : '' }}" href="{{ url('/admin/users') }}">
                        <i class="mdi mdi-account-details"></i> <span data-key="t-users">Users</span>
                    </a>
                </li>



            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
