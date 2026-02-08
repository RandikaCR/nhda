@extends('layouts.backend')

@section('page_title')
    About Us Details
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/backend/libs/croppie/croppie.min.css') }}">

@endsection

@section('css')

    <style type="text/css">

        .img-overlay-area{
            position: absolute;
            background: rgba(0,0,0,0.2);
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            opacity: 0;
            -webkit-transition: all .5s ease-in-out;
            -o-transition: all .5s ease-in-out;
            -moz-transition: all .5s ease-in-out;
            transition: all .5s ease-in-out;
        }

        .img-action:hover .img-overlay-area{
            opacity: 1;
            -webkit-transition: all .5s ease-in-out;
            -o-transition: all .5s ease-in-out;
            -moz-transition: all .5s ease-in-out;
            transition: all .5s ease-in-out;
            cursor: pointer;
        }

        .img-border{
            border: 1px solid #eee;
        }

    </style>

@endsection

@section('header_buttons')
@endsection

@section('content')

    @if(!empty($is_screen_access))

        @if($errors->any())
            <div class="row">
                <div class="col-sm-12">
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">
                            {{$error}}
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <form method="POST" action="{{ route('backend.generalAboutDetails.store') }}">
            @csrf
            <input type="hidden" name="id" value="{{ isset($about) ? $about->id : '' }}">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h4 class="card-title">About Us Details</h4>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-secondary waves-effect waves-light save-this-form"><i class="mdi mdi-content-save me-1"></i>SAVE</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 mb-4">
                                    <label>Title (ENGLISH)</label>
                                    <input class="form-control" type="text" id="main-title" name="en_title" placeholder="Enter here...." value="{{ isset($about) ? $about->en_title : '' }}">
                                </div>

                                <div class="col-sm-12 mb-4">
                                    <label>Content (ENGLISH)</label>
                                    <textarea id="content-en" name="en_content">
                                    {{ isset($about) ? $about->en_content : '' }}
                                    </textarea>
                                </div>

                                <hr class="my-4">

                                <div class="col-sm-12 mb-4">
                                    <label>Title (SINHALA)</label>
                                    <input class="form-control" type="text" id="title-si" name="si_title" placeholder="Enter here...." value="{{ isset($about) ? $about->si_title : '' }}">
                                </div>

                                <div class="col-sm-12 mb-4">
                                    <label>Content (SINHALA)</label>
                                    <textarea id="content-si" name="si_content">
                                    {{ isset($about) ? $about->si_content : '' }}
                                    </textarea>
                                </div>

                                <hr class="my-4">

                                <div class="col-sm-12 mb-4">
                                    <label>Title (TAMIL)</label>
                                    <input class="form-control" type="text" id="title-ta" name="ta_title" placeholder="Enter here...." value="{{ isset($about) ? $about->ta_title : '' }}">
                                </div>

                                <div class="col-sm-12 mb-4">
                                    <label>Content (TAMIL)</label>
                                    <textarea id="content-ta" name="ta_content">
                                    {{ isset($about) ? $about->ta_content : '' }}
                                    </textarea>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 mb-4">
                                    <label>Objective Title (ENGLISH)</label>
                                    <input class="form-control" type="text" name="en_objective_title" placeholder="Enter here...." value="{{ isset($about) ? $about->en_objective_title : '' }}">
                                </div>

                                <div class="col-sm-12 mb-4">
                                    <label>Objective Content (ENGLISH)</label>
                                    <textarea id="objective-content-en" name="en_objective_content">
                                    {{ isset($about) ? $about->en_objective_content : '' }}
                                    </textarea>
                                </div>

                                <hr class="my-4">

                                <div class="col-sm-12 mb-4">
                                    <label>Objective Title (SINHALA)</label>
                                    <input class="form-control" type="text" name="si_objective_title" placeholder="Enter here...." value="{{ isset($about) ? $about->si_objective_title : '' }}">
                                </div>

                                <div class="col-sm-12 mb-4">
                                    <label>Objective Content (SINHALA)</label>
                                    <textarea id="objective-content-si" name="si_objective_content">
                                    {{ isset($about) ? $about->si_objective_content : '' }}
                                    </textarea>
                                </div>

                                <hr class="my-4">

                                <div class="col-sm-12 mb-4">
                                    <label>Objective Title (TAMIL)</label>
                                    <input class="form-control" type="text" name="ta_objective_title" placeholder="Enter here...." value="{{ isset($about) ? $about->ta_objective_title : '' }}">
                                </div>

                                <div class="col-sm-12 mb-4">
                                    <label>Objective Content (TAMIL)</label>
                                    <textarea id="objective-content-ta" name="ta_objective_content">
                                    {{ isset($about) ? $about->ta_objective_content : '' }}
                                    </textarea>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 mb-4">
                                    <label>Vision Title (ENGLISH)</label>
                                    <input class="form-control" type="text" name="en_vision_title" placeholder="Enter here...." value="{{ isset($about) ? $about->en_vision_title : '' }}">
                                </div>

                                <div class="col-sm-12 mb-4">
                                    <label>Vision Content (ENGLISH)</label>
                                    <textarea id="vision-content-en" name="en_vision_content">
                                    {{ isset($about) ? $about->en_vision_content : '' }}
                                    </textarea>
                                </div>

                                <hr class="my-4">

                                <div class="col-sm-12 mb-4">
                                    <label>Vision Title (SINHALA)</label>
                                    <input class="form-control" type="text" name="si_vision_title" placeholder="Enter here...." value="{{ isset($about) ? $about->si_vision_title : '' }}">
                                </div>

                                <div class="col-sm-12 mb-4">
                                    <label>Vision Content (SINHALA)</label>
                                    <textarea id="vision-content-si" name="si_vision_content">
                                    {{ isset($about) ? $about->si_vision_content : '' }}
                                    </textarea>
                                </div>

                                <hr class="my-4">

                                <div class="col-sm-12 mb-4">
                                    <label>Vision Title (TAMIL)</label>
                                    <input class="form-control" type="text" name="ta_vision_title" placeholder="Enter here...." value="{{ isset($about) ? $about->ta_vision_title : '' }}">
                                </div>

                                <div class="col-sm-12 mb-4">
                                    <label>Vision Content (TAMIL)</label>
                                    <textarea id="vision-content-ta" name="ta_vision_content">
                                    {{ isset($about) ? $about->ta_vision_content : '' }}
                                    </textarea>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 mb-4">
                                    <label>Mission Title (ENGLISH)</label>
                                    <input class="form-control" type="text" name="en_mission_title" placeholder="Enter here...." value="{{ isset($about) ? $about->en_mission_title : '' }}">
                                </div>

                                <div class="col-sm-12 mb-4">
                                    <label>Mission Content (ENGLISH)</label>
                                    <textarea id="mission-content-en" name="en_mission_content">
                                    {{ isset($about) ? $about->en_mission_content : '' }}
                                    </textarea>
                                </div>

                                <hr class="my-4">

                                <div class="col-sm-12 mb-4">
                                    <label>Mission Title (SINHALA)</label>
                                    <input class="form-control" type="text" name="si_mission_title" placeholder="Enter here...." value="{{ isset($about) ? $about->si_mission_title : '' }}">
                                </div>

                                <div class="col-sm-12 mb-4">
                                    <label>Mission Content (SINHALA)</label>
                                    <textarea id="mission-content-si" name="si_mission_content">
                                    {{ isset($about) ? $about->si_mission_content : '' }}
                                    </textarea>
                                </div>

                                <hr class="my-4">

                                <div class="col-sm-12 mb-4">
                                    <label>Mission Title (TAMIL)</label>
                                    <input class="form-control" type="text" name="ta_mission_title" placeholder="Enter here...." value="{{ isset($about) ? $about->ta_mission_title : '' }}">
                                </div>

                                <div class="col-sm-12 mb-4">
                                    <label>Mission Content (TAMIL)</label>
                                    <textarea id="mission-content-ta" name="ta_mission_content">
                                    {{ isset($about) ? $about->ta_mission_content : '' }}
                                    </textarea>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    @else
        @include('partials.backend.access-warning')
    @endif

@endsection


@section('scripts')

    <!--jquery cdn-->
    <script src="{{ asset('assets/backend/packages/code.jquery.com/jquery-3.6.0.min.js') }}" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


    <!-- ckeditor -->
    <script src="{{ asset('assets/backend/libs/%40ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}"></script>

    <!-- croppie -->
    <script src="{{ asset('assets/backend/libs/croppie/croppie.min.js') }}"></script>


@endsection

@section('custom_scripts')
    <script>
        ClassicEditor.create(document.querySelector("#content-en"), {
            toolbar: []
        })
            .then(function (e) {
                e.ui.view.editable.element.style.height = "200px";
            })
            .catch(function (e) {
                console.error(e);
            });

        ClassicEditor.create(document.querySelector("#content-si"), {
            toolbar: []
        })
            .then(function (e) {
                e.ui.view.editable.element.style.height = "200px";
            })
            .catch(function (e) {
                console.error(e);
            });

        ClassicEditor.create(document.querySelector("#content-ta"), {
            toolbar: []
        })
            .then(function (e) {
                e.ui.view.editable.element.style.height = "200px";
            })
            .catch(function (e) {
                console.error(e);
            });

        ClassicEditor.create(document.querySelector("#objective-content-en"), {
            toolbar: []
        })
            .then(function (e) {
                e.ui.view.editable.element.style.height = "200px";
            })
            .catch(function (e) {
                console.error(e);
            });

        ClassicEditor.create(document.querySelector("#objective-content-si"), {
            toolbar: []
        })
            .then(function (e) {
                e.ui.view.editable.element.style.height = "200px";
            })
            .catch(function (e) {
                console.error(e);
            });

        ClassicEditor.create(document.querySelector("#objective-content-ta"), {
            toolbar: []
        })
            .then(function (e) {
                e.ui.view.editable.element.style.height = "200px";
            })
            .catch(function (e) {
                console.error(e);
            });


        ClassicEditor.create(document.querySelector("#vision-content-en"), {
            toolbar: []
        })
            .then(function (e) {
                e.ui.view.editable.element.style.height = "200px";
            })
            .catch(function (e) {
                console.error(e);
            });

        ClassicEditor.create(document.querySelector("#vision-content-si"), {
            toolbar: []
        })
            .then(function (e) {
                e.ui.view.editable.element.style.height = "200px";
            })
            .catch(function (e) {
                console.error(e);
            });

        ClassicEditor.create(document.querySelector("#vision-content-ta"), {
            toolbar: []
        })
            .then(function (e) {
                e.ui.view.editable.element.style.height = "200px";
            })
            .catch(function (e) {
                console.error(e);
            });

        ClassicEditor.create(document.querySelector("#mission-content-en"), {
            toolbar: []
        })
            .then(function (e) {
                e.ui.view.editable.element.style.height = "200px";
            })
            .catch(function (e) {
                console.error(e);
            });

        ClassicEditor.create(document.querySelector("#mission-content-si"), {
            toolbar: []
        })
            .then(function (e) {
                e.ui.view.editable.element.style.height = "200px";
            })
            .catch(function (e) {
                console.error(e);
            });

        ClassicEditor.create(document.querySelector("#mission-content-ta"), {
            toolbar: []
        })
            .then(function (e) {
                e.ui.view.editable.element.style.height = "200px";
            })
            .catch(function (e) {
                console.error(e);
            });



    </script>
@endsection
