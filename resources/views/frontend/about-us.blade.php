@extends('layouts.frontend')

@section('page_title')
{{ __('lang.about_us') }}
@endsection


@section('breadcrumb')
    @php
        $pageTitle = __('lang.about_us');
        $pageSubTitle = __('lang.about_us');
    @endphp
    @include('partials.frontend.breadcrumb')
@endsection

@section('content')
    <div class="about1-area position-relative overflow-hidden space overflow-hidden" id="about-sec">
        <div class="about-shep-2 shape-mockup d-none d-xxl-block" data-bottom="0%" data-right="0%">
            <img src="{{ asset('assets/frontend/img/shape/feature-shep-2-home-1.png') }}" alt="shape">
        </div>
        <div class="container th-container4">
            <div class="about-wrap1 position-relative z-index-2">
                <div class="row gy-60 align-items-center justify-content-center">
                    <div class="col-sm-8">
                        <div class="about-content ms-xxl-4 pe-xxl-2 me-xl-2">
                            <div class="title-area">
                                <span class="sub-title text-anim">{{ __('lang.about_us') }}</span>
                                <h2 class="sec-title text-anim2 pe-xl-5 me-xl-5 mb-4">{{ $about['title'] }}</h2>

                                <p class="sec-text mt-25 mb-0 wow fadeInUp" data-wow-delay=".2s">{!! $about['content'] !!}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="img-content position-relative">
                            <div class="img-box4">
                                <div class="img1 reveal">
                                    <img src="{{ asset('assets/common/images/nhda-logo-dark.png') }}" alt="nhda">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row gy-60 my-5 align-items-center justify-content-center">
                    <div class="col-sm-8">
                        <div class="about-content ms-xxl-4 pe-xxl-2 me-xl-2">
                            <div class="title-area">
                                <h2 class="sec-title text-anim2 pe-xl-5 me-xl-5 mb-4">{{ $about['objective_title'] }}</h2>

                                <p class="sec-text mt-25 mb-0 wow fadeInUp" data-wow-delay=".2s">{!! $about['objective_content'] !!}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row gy-60 my-5 align-items-center justify-content-center">
                    <div class="col-sm-6">
                        <div class="about-content ms-xxl-4 pe-xxl-2 me-xl-2">
                            <div class="title-area">
                                <h2 class="sec-title text-anim2 pe-xl-5 me-xl-5 mb-4">{{ $about['vision_title'] }}</h2>
                                <p class="sec-text mt-25 mb-0 wow fadeInUp" data-wow-delay=".2s">{!! $about['vision_content'] !!}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="about-content ms-xxl-4 pe-xxl-2 me-xl-2">
                            <div class="title-area">
                                <h2 class="sec-title text-anim2 pe-xl-5 me-xl-5 mb-4">{{ $about['mission_title'] }}</h2>
                                <p class="sec-text mt-25 mb-0 wow fadeInUp" data-wow-delay=".2s">{!! $about['mission_content'] !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>

    </script>
@endsection
