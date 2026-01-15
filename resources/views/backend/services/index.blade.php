@extends('layouts.backend')

@section('page_title')
    Services
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

        <form method="POST" action="{{ route('backend.services.store') }}">
            @csrf
            <input type="hidden" name="id" value="{{ isset($services) ? $services->id : '' }}">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h4 class="card-title">Services</h4>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-secondary waves-effect waves-light save-this-form"><i class="mdi mdi-content-save me-1"></i>SAVE</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 mb-4">
                                    <label>Title (ENGLISH)</label>
                                    <input class="form-control" type="text" id="main-title" name="en_title" placeholder="Enter here...." value="{{ isset($services) ? $services->en_title : '' }}">
                                </div>

                                <div class="col-sm-12 mb-4">
                                    <label>Content (ENGLISH)</label>
                                    <textarea id="content-en" name="en_content">
                                    {{ isset($services) ? $services->en_content : '' }}
                                    </textarea>
                                </div>

                                <hr class="my-4">

                                <div class="col-sm-12 mb-4">
                                    <label>Title (SINHALA)</label>
                                    <input class="form-control" type="text" id="title-si" name="si_title" placeholder="Enter here...." value="{{ isset($services) ? $services->si_title : '' }}">
                                </div>

                                <div class="col-sm-12 mb-4">
                                    <label>Content (SINHALA)</label>
                                    <textarea id="content-si" name="si_content">
                                    {{ isset($services) ? $services->si_content : '' }}
                                    </textarea>
                                </div>

                                <hr class="my-4">

                                <div class="col-sm-12 mb-4">
                                    <label>Title (TAMIL)</label>
                                    <input class="form-control" type="text" id="title-ta" name="ta_title" placeholder="Enter here...." value="{{ isset($services) ? $services->ta_title : '' }}">
                                </div>

                                <div class="col-sm-12 mb-4">
                                    <label>Content (TAMIL)</label>
                                    <textarea id="content-ta" name="ta_content">
                                    {{ isset($services) ? $services->ta_content : '' }}
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
        ClassicEditor.create(document.querySelector("#content-en"))
            .then(function (e) {
                e.ui.view.editable.element.style.height = "200px";
            })
            .catch(function (e) {
                console.error(e);
            });

        ClassicEditor.create(document.querySelector("#content-si"))
            .then(function (e) {
                e.ui.view.editable.element.style.height = "200px";
            })
            .catch(function (e) {
                console.error(e);
            });

        ClassicEditor.create(document.querySelector("#content-ta"))
            .then(function (e) {
                e.ui.view.editable.element.style.height = "200px";
            })
            .catch(function (e) {
                console.error(e);
            });



    </script>
@endsection
