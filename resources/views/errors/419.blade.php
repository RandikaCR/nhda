@extends('layouts.frontend')

@section('content')

    <div class="breadcumb-wrapper position-relative " data-bg-src="{{ asset('assets/frontend/img/shape/breadcrumb-shep.png') }}">
        <div class="breadcumb-banner">
            <img src="{{ asset('assets/frontend/img/breadcrumb/breadcumb-banner.png') }}" alt="bg-banner">
        </div>
        <div class="breadcumb-shape">
            <img src="{{ asset('assets/frontend/img/shape/triangle-light.png') }}" alt="shape" class="jump">
        </div>
        <div class="container th-container4">
            <div class="row">
                <div class="col-xxl-5">
                    <div class="breadcumb-content">
                        <h1 class="breadcumb-title">Error</h1>
                        <ul class="breadcumb-menu">
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li>Something went wrong</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="space">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="error-page">
                        <div class="error-img">
                            <img src="{{ asset('assets/frontend/img/normal/error.png') }}" alt="error image">
                        </div>
                        <div class="error-content">
                            <h5 class="">uh-oh! Nothing here...</h5>
                            <h2 class="page-title mt-n2">The page doesn’t exit</h2>
                            <p class="error-text mb-35">The page you are looking for doesn't exist or has been moved.</p>
                            <a href="{{ url('/') }}" class="th-btn">Back To Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
