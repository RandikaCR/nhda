@extends('layouts.frontend')

@section('page_title')
    Welcome
@endsection

@section('content')


    <div class="th-hero-wrapper hero-2 position-relative" id="hero" data-bg-src="{{ asset('assets/frontend/img/bg/hero_bg_2_1.jpg') }}">
        <div class="swiper th-slider hero-slider2" id="heroSlide" data-slider-options='{"effect":"fade"}'>
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="container">
                        <div class="row align-items-end">
                            <div class="col-lg-8">
                                <div class="hero-style2">
                                    <h1 class="hero-title text-white" data-ani="slideinleft" data-ani-delay="0.3s">
                                        World Leading University For Future Best Career </h1>
                                    <p class="hero-text text-white" data-ani="slideinleft" data-ani-delay="0.4s">
                                        We want every student and study partner to feel that they are part of a common good and cohesive team. We help our teams form stronger relationships.</p>
                                    <div class="btn-wrap justify-content-center justify-content-lg-start" data-ani="slideinup" data-ani-delay="0.9s">
                                        <a href="program.html" class="th-btn th-icon white-hover">find your program</a>
                                        <a href="contact.html" class="th-btn th-icon style-border1 white-hover">request info</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="swiper-slide">
                    <div class="container">
                        <div class="row align-items-end">
                            <div class="col-lg-8">
                                <div class="hero-style2">
                                    <h1 class="hero-title text-white" data-ani="slideinleft" data-ani-delay="0.3s">
                                        World Leading University For Future Best Career </h1>
                                    <p class="hero-text text-white" data-ani="slideinleft" data-ani-delay="0.4s">
                                        We want every student and study partner to feel that they are part of a common good and cohesive team. We help our teams form stronger relationships.</p>
                                    <div class="btn-wrap justify-content-center justify-content-lg-start" data-ani="slideinup" data-ani-delay="0.9s">
                                        <a href="program.html" class="th-btn th-icon white-hover">find your program</a>
                                        <a href="contact.html" class="th-btn th-icon style-border1 white-hover">request info</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="swiper-slide">
                    <div class="container">
                        <div class="row align-items-end">
                            <div class="col-lg-8">
                                <div class="hero-style2">
                                    <h1 class="hero-title text-white" data-ani="slideinleft" data-ani-delay="0.3s">
                                        World Leading University For Future Best Career </h1>
                                    <p class="hero-text text-white" data-ani="slideinleft" data-ani-delay="0.4s">
                                        We want every student and study partner to feel that they are part of a common good and cohesive team. We help our teams form stronger relationships.</p>
                                    <div class="btn-wrap justify-content-center justify-content-lg-start" data-ani="slideinup" data-ani-delay="0.9s">
                                        <a href="program.html" class="th-btn th-icon white-hover">find your program</a>
                                        <a href="contact.html" class="th-btn th-icon style-border1 white-hover">request info</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="swiper-slide">
                    <div class="container">
                        <div class="row align-items-end">
                            <div class="col-lg-8">
                                <div class="hero-style2">
                                    <h1 class="hero-title text-white" data-ani="slideinleft" data-ani-delay="0.3s">
                                        World Leading University For Future Best Career </h1>
                                    <p class="hero-text text-white" data-ani="slideinleft" data-ani-delay="0.4s">
                                        We want every student and study partner to feel that they are part of a common good and cohesive team. We help our teams form stronger relationships.</p>
                                    <div class="btn-wrap justify-content-center justify-content-lg-start" data-ani="slideinup" data-ani-delay="0.9s">
                                        <a href="program.html" class="th-btn th-icon white-hover">find your program</a>
                                        <a href="contact.html" class="th-btn th-icon style-border1 white-hover">request info</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="slider-pagination"></div>
        </div>
        {{--<div class="hero-2-social d-none d-xxl-block">
            <div class="th-social">
                <a href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a>
                <a href="https://www.youtube.com/"><i class="fa-brands fa-instagram"></i></a>
                <a href="https://www.twitter.com/"><i class="fab fa-twitter"></i></a>
                <a href="https://www.linkedin.com/"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>--}}
    </div>

    <section class="program-area position-relative overflow-hidden space" id="program-sec">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-xl-8 col-md-8">
                    <div class="title-area">
                        <span class="sub-title text-anim" data-cue="slideInLeft">{{ __('lang.projects') }}</span>
                    </div>
                </div>
            </div>
            <div class="slider-area">
                <div class="swiper th-slider has-shadow" id="programSlider2" data-slider-options='{ "autoplay": false,"breakpoints": {"0": {"slidesPerView": 1},"576": {"slidesPerView": "1"},"768": {"slidesPerView": 2}, "992": {"slidesPerView": 3},  "1200": {"slidesPerView": 3}, "1400": {"slidesPerView": 4}}}'>
                    <div class="swiper-wrapper">
                        @foreach($projects as $project)
                            <div class="swiper-slide fadeinup wow">
                                <div class="program-card">
                                    <div class="program-img">
                                        <a href="{{ url('projects/' . $project->slug) }}">
                                            <img src="{{ asset('assets/common/images/uploads/' .$project->primary_image) }}" alt="program image">
                                        </a>
                                    </div>
                                    <div class="program-content">
                                        <h3 class="box-title"><a href="{{ url('projects/' . $project->slug) }}">{{ $project->en_title }}</a></h3>
                                        <p class="box-text">{{ stringLimitLength($project->en_content, 300) }}</p>
                                        <div class="btn-wrap">
                                            <a href="{{ url('projects/' . $project->slug) }}">Read More</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section> <!--==============================
About Area
==============================-->
    <section class="about2-area position-relative overflow-hidden space-bottom" id="about-sec">
        <div class="container">
            <div class="row gy-60 align-items-center justify-content-center">
                <div class="col-xl-6">
                    <div class="img-box2">
                        <img src="{{ asset('assets/common/images/uploads/h_4.jpg') }}" alt="About">
                        <img src="{{ asset('assets/common/images/uploads/h_2.jpg') }}" alt="About">
                        <img src="{{ asset('assets/common/images/uploads/h_3.jpg') }}" alt="About">
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="about-content ms-xxl-4 ps-xxl-2 ms-xl-2">
                        <div class="title-area mb-0">
                            <span class="sub-title text-anim">{{ __('lang.about_us') }}</span>
                            <p class="sec-title text-anim2">The National Housing Development Authority strived to implement various housing development programmes targeting the poor families, who lived in estate line rooms, rural low income families and urban low income families as well.</p>
                        </div>
                        <div class="btn-wrap mt-50">
                            <a href="{{ url('about-us') }}" class="th-btn th-icon">{{ __('lang.read_more') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!--==============================
Video Area
==============================-->
    <div class="video-area-1 position-relative overflow-hidden " data-bg-src="{{ asset('assets/frontend/img/video-banner/video-bg-1-1.jpg') }}">
        <iframe id="home-video" src="https://player.vimeo.com/video/682960098?h=5c7e197a37&amp;badge=0&amp;autopause=0&amp;loop=1&amp;autoplay=1&amp;muted=1&amp;player_id=0&amp;app_id=58479" frameborder="0" allow="autoplay" allowfullscreen title="1"></iframe>
    </div>

    <section class="academic1-area space bg-gray overflow-hidden" id="academics-sec">
        <div class="container">
            <div class="row justify-content-lg-between justify-content-center align-items-center">
                <div class="col-lg-9 col-12">
                    <div class="title-area text-center text-lg-start mb-75">
                        <span class="sub-title text-anim">{{ __('lang.news_and_events') }}</span>
                    </div>
                </div>
                <div class="col-auto align-self-end">
                    <div class="sec-btn wow fadeInUp" data-wow-delay=".3s">
                        <a href="{{ url('news-and-events') }}" class="th-btn style-border1 th-icon"> {{ __('lang.view_all') }} </a>
                    </div>
                </div>
            </div>
            <div class="slider-area">
                <div class="swiper th-slider has-shadow" id="academicSlider2" data-slider-options='{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"1"},"992":{"slidesPerView":"2"},"1200":{"slidesPerView":"3"},"1400":{"slidesPerView":"3", "spaceBetween": "24"}},"autoHeight": "true", "autoplay" : "false"}'>
                    <div class="swiper-wrapper">
                        @foreach($home_news as $news)
                            <div class="swiper-slide">
                                <div class="academic-card style2">
                                    <div class="academic-img">
                                        <img src="{{ asset('assets/common/images/uploads/' .$news->primary_image) }}" alt="img">
                                    </div>

                                    <div class="academic-content">
                                        <h3 class="box-title">
                                            <a href="{{ url('news/' . $news->slug) }}">{{ $news->en_title }}</a>
                                        </h3>
                                        <p class="box-text style2 mt-2">{{ stringLimitLength($news->en_content, 300) }}</p>
                                    </div>
                                    <div class="academic-meta-wrap">
                                        <a href="{{ url('news/' . $news->slug) }}" class="th-btn style-border1 th-icon">{{ __('lang.read_more') }}</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')
    <script>
        $(document).ready(function (){

            $windowWidth = $(window).width();
            $videoHeight = ($windowWidth / 16 * 9);
            $('#home-video').css({'width': $windowWidth +'px', 'height': $videoHeight +'px'})

        });
    </script>
@endsection
