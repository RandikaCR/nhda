<div class="sidemenu-wrapper ">
    <div class="sidemenu-content">
        <button class="closeButton sideMenuCls"><i class="far fa-times"></i></button>
        <div class="widget footer-widget">
            <div class="th-widget-about">
                <div class="about-logo">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('assets/common/images/nhda-logo.png') }}" alt="NHDA">
                    </a>
                </div>
                <p class="about-text">Since 1999, when the newly minted Stadum team embraced its mandate to breathe new life into the downtrodden neighbourhood, East Village’s transformation has been nothing short of remarkable. </p>
                <div class="footer-info">
                    <a href="#">
                        <span class="footer-info-icon"><i class="fa-solid fa-location-dot"></i></span> 45 New Eskaton Road, Austria
                    </a>
                    <a href="mailto:infomail@example.com">
                        <span class="footer-info-icon"><i class="fa-solid fa-envelope"></i></span> infomail@example.com
                    </a>
                </div>
            </div>
        </div>
        <div class="widget footer-widget">
            <h3 class="widget_title">Recent Posts</h3>
            <div class="recent-post-wrap">
                <div class="recent-post">
                    <div class="media-img">
                        <a href="blog-details.html"><img src="{{ asset('assets/frontend/img/blog/recent-post-1-1.jpg') }}" alt="Blog Image"></a>
                    </div>
                    <div class="media-body">
                        <h4 class="post-title">
                            <a class="text-inherit" href="blog-details.html">Trailblazers in Faculty Perspectives</a>
                        </h4>
                        <div class="recent-post-meta">
                            <a href="blog.html"><i class="far fa-calendar"></i>26/6/2025</a>
                        </div>
                    </div>
                </div>
                <div class="recent-post">
                    <div class="media-img">
                        <a href="blog-details.html"><img src="{{ asset('assets/frontend/img/blog/recent-post-1-2.jpg') }}" alt="Blog Image"></a>
                    </div>
                    <div class="media-body">
                        <h4 class="post-title"><a class="text-inherit" href="blog-details.html">Future Focus Preparing for Tomorrow</a></h4>
                        <div class="recent-post-meta">
                            <a href="blog.html"><i class="far fa-calendar"></i>24/6/2025</a>
                        </div>
                    </div>
                </div>
                <div class="recent-post">
                    <div class="media-img">
                        <a href="blog-details.html"><img src="{{ asset('assets/frontend/img/blog/recent-post-1-3.jpg') }}" alt="Blog Image"></a>
                    </div>
                    <div class="media-body">
                        <h4 class="post-title">
                            <a class="text-inherit" href="blog-details.html">The Green Initiative Sustainability in Action</a>
                        </h4>
                        <div class="recent-post-meta">
                            <a href="blog.html"><i class="far fa-calendar"></i>24/6/2025</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="widget footer-widget">
            <h3 class="widget_title">Popular Tags</h3>
            <div class="th-social">
                <a href="https://facebook.com"><i class="fab fa-facebook-f"></i></a>
                <a href="https://twitter.com"><i class="fab fa-twitter"></i></a>
                <a href="https://pinterest.com"><i class="fab fa-pinterest-p"></i></a>
                <a href="https://linkedin.com"><i class="fab fa-linkedin-in"></i></a>
                <a href="https://linkedin.com"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </div>
</div>
<div class="popup-search-box">
    <button class="searchClose"><i class="far fa-times"></i></button>
    <form action="#">
        <input type="text" placeholder="What are you looking for?">
        <button type="submit"><i class="fal fa-search"></i></button>
    </form>
</div><!--==============================
    Mobile Menu
  ============================== -->
<div class="th-menu-wrapper">
    <div class="th-menu-area text-center">
        <button class="th-menu-toggle"><i class="fal fa-times"></i></button>
        <div class="mobile-logo">
            <a href="{{ url('/') }}"><img src="{{ asset('assets/common/images/nhda-logo.png') }}" alt="NHDA"></a>
        </div>
        <div class="th-mobile-menu">
            <ul>
                <li class="menu-item-has-children">
                    <a href="{{ url('/') }}">{{ __('navigation.home') }}</a>
                    <ul class="sub-menu">
                        <li><a href="index.html">University Home</a></li>
                        <li><a href="home-admission.html">Admission Home</a></li>
                        <li><a href="home-courses.html">Course Home</a></li>
                    </ul>
                </li>
                <li><a href="about.html">About Us</a></li>
                <li class="menu-item-has-children">
                    <a href="#">Programs</a>
                    <ul class="sub-menu">
                        <li><a href="program.html">Programs Style 1</a></li>
                        <li><a href="program-2.html">Programs Style 2</a></li>
                        <li><a href="program-details.html">Program Details</a></li>
                        <li><a href="program-details-sidebar.html">Program Details With Sidebar</a></li>
                    </ul>
                </li>
                <li class="menu-item-has-children">
                    <a href="#">Pages</a>
                    <ul class="sub-menu">
                        <li class="menu-item-has-children">
                            <a href="#">Shop</a>
                            <ul class="sub-menu">
                                <li><a href="shop.html">Shop</a></li>
                                <li><a href="shop-details.html">Shop Details</a></li>
                                <li><a href="cart.html">Cart Page</a></li>
                                <li><a href="checkout.html">Checkout</a></li>
                                <li><a href="wishlist.html">Wishlist</a></li>
                            </ul>
                        </li>

                        <li class="menu-item-has-children">
                            <a href="#">Faculties</a>
                            <ul class="sub-menu">
                                <li><a href="faculty.html">Faculty</a></li>
                                <li><a href="faculty-details.html">Faculty Details</a></li>
                            </ul>
                        </li>
                        <li><a href="alumni.html">Alumni Page</a></li>
                        <li class="menu-item-has-children">
                            <a href="#">Researches</a>
                            <ul class="sub-menu">
                                <li><a href="research.html">Research</a></li>
                                <li><a href="research-details.html">Research Details</a></li>
                            </ul>
                        </li>
                        <li class="menu-item-has-children">
                            <a href="#">Teachers</a>
                            <ul class="sub-menu">
                                <li><a href="teacher.html">Teacher</a></li>
                                <li><a href="teacher-details.html">Teacher Details</a></li>
                            </ul>
                        </li>
                        <li><a href="campus.html">Campus Life</a></li>
                        <li><a href="pricing.html">Pricing Plan</a></li>
                        <li><a href="faq.html">Faqs Page</a></li>
                        <li><a href="error.html">Error Page</a></li>
                    </ul>
                </li>
                <li class="menu-item-has-children">
                    <a href="#">Events</a>
                    <ul class="sub-menu">
                        <li><a href="event.html">Events Page</a></li>
                        <li><a href="event-details.html">Event Details</a></li>
                    </ul>
                </li>
                <li class="menu-item-has-children">
                    <a href="#">Blogs</a>
                    <ul class="sub-menu">
                        <li><a href="blog.html">Blog</a></li>
                        <li><a href="blog-details.html">Blog Details</a></li>
                        <li><a href="blog-details-sidebar.html">Blog Details With Sidebar</a></li>
                    </ul>
                </li>
                <li>
                    <a href="contact.html">Contact Us</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!--==============================
Header Area
==============================-->
<header class="th-header header-layout1">
    <div class="header-top">
        <div class="container th-container4">
            <div class="row justify-content-center justify-content-lg-between align-items-center gy-2">
                <div class="col-auto d-none d-lg-block">
                </div>
                <div class="col-auto">
                    <div class="header-links">
                        <ul class="header-right-wrap">
                            <li><i class="fa-solid fa-user"></i><a href="#login-form" class="popup-content">Login / Register</a></li>
                            <li>
                                <div class="dropdown-link">
                                    @if(Session::get('locale') == 'en')
                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink2" data-bs-toggle="dropdown" aria-expanded="false">English </a>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink2">
                                        <li>
                                            <a href="{{ url('set-localization/si') }}">සිංහල</a>
                                            <a href="{{ url('set-localization/ta') }}">தமிழ்</a>
                                        </li>
                                    @elseif(Session::get('locale') == 'si')
                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink2" data-bs-toggle="dropdown" aria-expanded="false">සිංහල </a>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink2">
                                        <li>
                                            <a href="{{ url('set-localization/en') }}">English</a>
                                            <a href="{{ url('set-localization/ta') }}">தமிழ்</a>
                                        </li>
                                    @elseif(Session::get('locale') == 'ta')
                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink2" data-bs-toggle="dropdown" aria-expanded="false">தமிழ் </a>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink2">
                                        <li>
                                            <a href="{{ url('set-localization/en') }}">English</a>
                                            <a href="{{ url('set-localization/si') }}">සිංහල</a>
                                        </li>
                                    @else
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink2" data-bs-toggle="dropdown" aria-expanded="false">English </a>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink2">
                                            <li>
                                                <a href="{{ url('set-localization/si') }}">සිංහල</a>
                                                <a href="{{ url('set-localization/ta') }}">தமிழ்</a>
                                            </li>
                                    @endif
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-info d-none d-sm-block">
        <div class="container th-container2">
            <div class="row justify-content-between align-items-center">
                <div class="col-auto">
                    <div class="header-logo">
                        <a href="{{ url('/') }}">
                            <img src="{{ asset('assets/common/images/nhda-logo.png') }}" alt="NHDA">
                        </a>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="header-info-right">
                        <div class="header-info-item">
                            <div class="header-info-icon">
                                <i class="fa-solid fa-envelope"></i>
                            </div>
                            <div class="header-info-content">
                                <span class="header-info-text">Email</span>
                                <h3 class="header-info-title">
                                    <a href="mailto:nhdaemp@gmail.com">nhdaemp@gmail.com</a>
                                </h3>
                            </div>
                        </div>
                        <div class="header-info-item">
                            <div class="header-info-icon">
                                <i class="fa-solid fa-phone"></i>
                            </div>
                            <div class="header-info-content">
                                <span class="header-info-text">Phone Number</span>
                                <h3 class="header-info-title">
                                    <a href="tel:+94112431722">+94 11-2431722</a>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="sticky-wrapper">
        <!-- Main Menu Area -->
        <div class="menu-area">
            <div class="container th-container2">
                <div class="menu-wrapp">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto">
                            <div class="header-left d-flex align-items-center">
                                <div class="header-logo d-block d-sm-none">
                                    <a href="{{ url('/') }}">
                                        <img src="{{ asset('assets/common/images/nhda-logo.png') }}" alt="NHDA">
                                    </a>
                                </div>
                                <div class="header-button d-none d-sm-block">
                                    <a href="{{ url('/contact-us') }}" class="th-btn">
                                        Get More Info
                                        <img src="{{ asset('assets/frontend/img/icon/right-icon.svg') }}" class="th-arrow" alt="icon">
                                    </a>
                                </div>
                                <nav class="main-menu d-none d-xl-block">
                                    <ul>
                                        <li><a href="{{ url('/') }}">{{ __('navigation.home') }}</a></li>
                                        <li><a href="{{ url('/about-us') }}">About Us</a></li>
                                        <li class="menu-item-has-children">
                                            <a href="#">Programs</a>
                                            <ul class="sub-menu">
                                                <li><a href="program.html">Programs Style 1</a></li>
                                                <li><a href="program-2.html">Programs Style 2</a></li>
                                                <li><a href="program-details.html">Program Details</a></li>
                                                <li><a href="program-details-sidebar.html">Program Details With Sidebar</a></li>
                                            </ul>
                                        </li>
                                        <li class="menu-item-has-children">
                                            <a href="#">Pages</a>
                                            <ul class="sub-menu">
                                                <li class="menu-item-has-children">
                                                    <a href="#">Shop</a>
                                                    <ul class="sub-menu">
                                                        <li><a href="shop.html">Shop</a></li>
                                                        <li><a href="shop-details.html">Shop Details</a></li>
                                                        <li><a href="cart.html">Cart Page</a></li>
                                                        <li><a href="checkout.html">Checkout</a></li>
                                                        <li><a href="wishlist.html">Wishlist</a></li>
                                                    </ul>
                                                </li>

                                                <li class="menu-item-has-children">
                                                    <a href="#">Faculties</a>
                                                    <ul class="sub-menu">
                                                        <li><a href="faculty.html">Faculty</a></li>
                                                        <li><a href="faculty-details.html">Faculty Details</a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="alumni.html">Alumni Page</a></li>
                                                <li class="menu-item-has-children">
                                                    <a href="#">Researches</a>
                                                    <ul class="sub-menu">
                                                        <li><a href="research.html">Research</a></li>
                                                        <li><a href="research-details.html">Research Details</a></li>
                                                    </ul>
                                                </li>
                                                <li class="menu-item-has-children">
                                                    <a href="#">Teachers</a>
                                                    <ul class="sub-menu">
                                                        <li><a href="teacher.html">Teacher</a></li>
                                                        <li><a href="teacher-details.html">Teacher Details</a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="campus.html">Campus Life</a></li>
                                                <li><a href="pricing.html">Pricing Plan</a></li>
                                                <li><a href="faq.html">Faqs Page</a></li>
                                                <li><a href="error.html">Error Page</a></li>
                                            </ul>
                                        </li>
                                        <li class="menu-item-has-children">
                                            <a href="#">Events</a>
                                            <ul class="sub-menu">
                                                <li><a href="event.html">Events Page</a></li>
                                                <li><a href="event-details.html">Event Details</a></li>
                                            </ul>
                                        </li>
                                        <li class="menu-item-has-children">
                                            <a href="#">Blogs</a>
                                            <ul class="sub-menu">
                                                <li><a href="blog.html">Blog</a></li>
                                                <li><a href="blog-details.html">Blog Details</a></li>
                                                <li><a href="blog-details-sidebar.html">Blog Details With Sidebar</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="contact.html">Contact Us</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="col-auto ms-lg-auto">
                            <div class="header-button">
                                <form class="search-form">
                                    <input type="text" placeholder="Search...">
                                    <button type="submit"><i class="fa-light fa-magnifying-glass"></i></button>
                                </form>
                                <a href="#" class="icon-btn sideMenuToggler d-none d-xl-block"><img src="{{ asset('assets/frontend/img/icon/grid2.svg') }}" alt=""></a>

                                <button type="button" class="th-menu-toggle d-inline-block d-xl-none"><i class="far fa-bars"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
