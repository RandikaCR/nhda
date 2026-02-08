@extends('layouts.frontend')

@section('page_title')
    News
@endsection


@section('breadcrumb')
    @php
        $pageTitle = 'News & Events';
        $pageSubTitle = 'News & Events';
    @endphp
    @include('partials.frontend.breadcrumb')
@endsection

@section('content')

    <section class="event-area-1 position-relative space" id="event-sec">
        <div class="event-shape shape-mockup d-none d-xxl-block" data-top="0%" data-left="0%">
            <img src="{{ asset('assets/frontend/img/shape/shape-2.png') }}" alt="">
        </div>
        <div class="container th-container4">
            <div class="event-card-wrap">
                @foreach($all_news as $news)
                    <div class="event-card style2 wow fadeInUp" data-wow-delay=".2s">
                        <div class="col-sm-6">
                            <a class="" href="{{ url('news/' . $news->slug) }}">
                            <div class="event-card-img global-img">
                                <img src="{{ asset('assets/common/images/uploads/' .$news->primary_image) }}" alt="event">
                                <p class="event-card-tag"><span class="tag-number">{{ dateFormatDate($news->created_at) }}</span>{{ dateFormatMonthSmall($news->created_at) }}<br><span class="tag-year">{{ dateFormatYear($news->created_at) }}</span></p>
                            </div>
                            </a>
                        </div>
                        <div class="col-sm-6">
                            <div class="event-content">
                                <div class="event-wrapp">
                                    <h3 class="box-title text-anim2"><a href="{{ url('news/' . $news->slug) }}">{{ $news->en_title }}</a></h3>
                                    <p class="box-text wow fadeInUp" data-wow-delay=".2s">{{ stringLimitLength($news->en_content, 400) }}</p>
                                    <div class="blog-meta wow fadeInUp" data-wow-delay=".3s">
                                        <a class="date" href="#"> <i class="fa-regular fa-calendar-days"></i> {{ dateFormat($news->created_at) }} </a>
                                    </div>
                                </div>
                                <div class="btn-wrap wow fadeInUp" data-wow-delay=".4s">
                                    <a class="th-btn style-border1 th-icon" href="{{ url('news/' . $news->slug) }}">{{ __('lang.read_more') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {!! $all_news->links('vendor.pagination.frontend') !!}

    </section>
@endsection

@section('script')
    <script>

    </script>
@endsection
