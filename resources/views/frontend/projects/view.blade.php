@extends('layouts.frontend')

@section('page_title')
    {{ $project->en_title }}
@endsection


@section('breadcrumb')
    @php
        $pageTitle = 'Projects & Programmes';
        $pageSubTitle = $project->en_title;
    @endphp
    @include('partials.frontend.breadcrumb')
@endsection

@section('content')
    <section class="th-blog-wrapper blog-details space-top space-extra2-bottom overflow-hidden">
        <div class="container th-container2">
            <div class="row justify-content-center">
                <div class="col-xl-9">
                    <div class="th-blog blog-single">
                        <div class="blog-img">
                            <img src="{{ asset('assets/common/images/uploads/' .$project->primary_image) }}" alt="Blog Image">
                        </div>
                        <div class="blog-content">
                            <div class="row justify-content-between mb-2">
                                <div class="col-md-auto">
                                    <div class="blog-meta">
                                        <a href="javascript:void(0);"><i class="far fa-clock"></i>{{ dateFormat($project->created_at) }}</a>
                                    </div>
                                </div>
                                <div class="col-md-auto text-xl-end">
                                    <div class="th-social style2 align-items-center">
                                        <a href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a>
                                        <a href="https://www.twitter.com/"><i class="fab fa-whatsapp"></i></a>
                                        <a href="https://www.instagram.com/"><i class="fa fa-envelope"></i></a>
                                    </div>
                                </div>
                            </div>
                            <h3 class="mb-4">{{ $project->en_title }}</h3>
                            <p class="fs-18">{!! $project->en_content !!}</p>
                            <div class="share-links clearfix ">
                                <div class="row justify-content-between">
                                    <div class="col-md-auto">
                                    </div>
                                    <div class="col-md-auto text-xl-end">
                                        <span class="share-links-title">Share this article:</span>
                                        <div class="th-social style2 align-items-center">
                                            <a href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a>
                                            <a href="https://www.twitter.com/"><i class="fab fa-whatsapp"></i></a>
                                            <a href="https://www.instagram.com/"><i class="fa fa-envelope"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--<div class="th-comments-wrap ">
                        <h2 class="blog-inner-title h4">Comments (3)</h2>
                        <ul class="comment-list">
                            <li class="th-comment-item">
                                <div class="th-post-comment">
                                    <div class="comment-avater">
                                        <img src="assets/img/blog/comment-author-1.jpg" alt="Comment Author">
                                    </div>
                                    <div class="comment-content">
                                        <h3 class="name">Adam Jhon</h3>
                                        <span class="commented-on">25 Nov, 2025<span class="ms-2">06:30pm</span></span>
                                        <p class="text">Through this blog, we aim to inspire readers to embrace education as a lifelong journey and to advocate for quality education</p>
                                        <div class="reply_and_edit">
                                            <a href="blog-details.html" class="reply-btn"><i class="fas fa-reply"></i>Reply</a>
                                        </div>
                                    </div>
                                </div>
                                <ul class="children">
                                    <li class="th-comment-item">
                                        <div class="th-post-comment">
                                            <div class="comment-avater">
                                                <img src="assets/img/blog/comment-author-2.jpg" alt="Comment Author">
                                            </div>
                                            <div class="comment-content">
                                                <h3 class="name">Jhon Abraham</h3>
                                                <span class="commented-on">15 Dec, 2025<span class="ms-2">04:30pm</span></span>
                                                <p class="text">Education News and Trends: We provide updates on the latest developments and trends in the education sector.</p>
                                                <div class="reply_and_edit">
                                                    <a href="blog-details.html" class="reply-btn"><i class="fas fa-reply"></i>Reply</a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li class="th-comment-item">
                                <div class="th-post-comment">
                                    <div class="comment-avater">
                                        <img src="assets/img/blog/comment-author-3.jpg" alt="Comment Author">
                                    </div>
                                    <div class="comment-content">
                                        <h3 class="name">Anadi Juila</h3>
                                        <span class="commented-on">20 Dec, 2025<span class="ms-2">02:30pm</span></span>
                                        <p class="text">We discuss strategies to help students make informed decisions about their educational and career paths.</p>
                                        <div class="reply_and_edit">
                                            <a href="blog-details.html" class="reply-btn"><i class="fas fa-reply"></i>Reply</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div> <!-- Comment end --> <!-- Comment Form -->
                    <div class="th-comment-form ">
                        <div class="form-title">
                            <h3 class="blog-inner-title h4 mb-30">Leave your tought</h3>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group style-border">
                                <input type="text" placeholder="Name*" class="form-control">
                                <i class="fal fa-user"></i>
                            </div>
                            <div class="col-md-6 form-group style-border">
                                <input type="tel" placeholder="Phone*" class="form-control">
                                <i class="fal fa-user"></i>
                            </div>
                            <div class="col-12 form-group style-border">
                                <input type="text" placeholder="e-mail address*" class="form-control">
                                <i class="fal fa-envelope"></i>
                            </div>
                            <div class="form-group style-border col-12">
                                <select name="subject" id="subject" class="form-select nice-select">
                                    <option value="" disabled selected hidden>Subject</option>
                                    <option value="Computer Science">Computer Science</option>
                                    <option value="Biochemistry">Biochemistry</option>
                                    <option value="Business Admistration">Business Admistration</option>
                                    <option value="Biology">Biology</option>
                                </select>
                            </div>
                            <div class="col-12 form-group style-border">
                                <input type="text" placeholder="Website" class="form-control">
                                <i class="fal fa-globe"></i>
                            </div>
                            <div class="col-12 form-group style-border">
                                <textarea placeholder="Comment*" class="form-control"></textarea>
                                <i class="fal fa-pencil"></i>
                            </div>
                            <div class="col-12 form-group">
                                <input id="reviewcheck" name="reviewcheck" type="checkbox">
                                <label for="reviewcheck">Save my name, email, and website in this browser for the next time I comment.<span class="checkmark"></span></label>
                            </div>
                            <div class="col-12 form-group mb-0">
                                <button class="th-btn">Send Message</button>
                            </div>
                        </div>
                    </div>--}}
                </div>
            </div>
        </div>

    </section>
@endsection

@section('script')
    <script>

    </script>
@endsection
