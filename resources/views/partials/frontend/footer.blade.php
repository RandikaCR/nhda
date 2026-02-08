<footer class="footer-wrapper footer-layout1" data-bg-src="{{ asset('assets/frontend/img/bg/footer-bg-2.png') }}">
    <div class="container">
        <div class="widget-area">
            <div class="row justify-content-between">
                <div class="col-md-6 col-xl-auto">
                    <div class="widget footer-widget">
                        <div class="th-widget-about">
                            <h3 class="widget_title">{{ __('lang.head_office') }}</h3>
                            <p class="about-text">National Housing Development Authority
                                <br>Sir Chitampalam A Gardiner Mawatha,
                                <br>P.O Box 1826,
                                <br>Colombo 02.
                                <br>Sri Lanka.
                            </p>
                            <div class="footer-info">
                                <a href="tel:+94112431722">
                                    <span class="footer-info-icon"><i class="fa-solid fa-phone"></i></span> +94 11-2431722
                                </a>
                                <a href="mailto:nhdaemp@gmail.com">
                                    <span class="footer-info-icon"><i class="fa-solid fa-envelope"></i></span> nhdaemp@gmail.com
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-auto">
                    <div class="widget widget_nav_menu footer-widget">
                        <h3 class="widget_title">{{ __('lang.quick_access') }}</h3>
                        <div class="menu-all-pages-container">
                            <ul class="menu">
                                <li><a href="{{ url('/about-us') }}">{{ __('lang.about_us') }}</a></li>
                                <li><a href="{{ url('/district-network') }}">{{ __('lang.district_network') }}</a></li>
                                <li><a href="{{ url('/contact-head-office') }}">{{ __('lang.contact') .' - '.__('lang.head_office') }}</a></li>
                                <li><a href="{{ url('/contact-senior-staff') }}">{{ __('lang.contact') .' - '.__('lang.senior_staff') }}</a></li>
                                <li><a href="{{ url('/contact-district-offices') }}">{{ __('lang.contact') .' - '.__('lang.district_offices') }}</a></li>
                                <li><a href="{{ url('/circuit-bungalows') }}">{{ __('lang.circuit_bungalows') }}</a></li>
                                <li><a href="{{ url('/services') }}">{{ __('lang.services') }}</a></li>
                                <li><a href="{{ url('/press-releases') }}">{{ __('lang.press_releases') }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-auto">
                    <div class="widget widget_nav_menu footer-widget">
                        <h3 class="widget_title">{{ __('lang.downloads') }}</h3>
                        <div class="menu-all-pages-container">
                            <ul class="menu">
                                @foreach($navDownloadCategories as $navCat)
                                    <li><a href="{{ url('downloads/' . $navCat['slug']) }}">{{ $navCat['download_category'] }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-wrap z-index-common">
        <div class="container">
            <div class="row justify-content-between gy-3 align-items-center">
                <div class="col-lg-auto">
                    <div class="footer-logo">
                        <img src="{{ asset('assets/common/images/nhda-logo.png') }}" alt="NHDA">
                    </div>
                </div>
                <div class="col-md-auto">
                    <p class="copyright-text">
                        <i class="fal fa-copyright"></i> Copyright {{ date('Y', time()) }} <a href="{{ url('/') }}">National Housing Development Authority</a>. All Rights Reserved.
                    </p>
                </div>
                {{--<div class="col-md-auto text-md-end text-center">
                    <div class="th-social">
                        <a href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://www.youtube.com/"><i class="fa-brands fa-instagram"></i></a>
                        <a href="https://www.twitter.com/"><i class="fab fa-twitter"></i></a>
                        <a href="https://www.linkedin.com/"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>--}}
            </div>
        </div>
    </div>
</footer>
