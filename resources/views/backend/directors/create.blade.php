@extends('layouts.backend')

@section('page_title')
    Director

    @if(isset($member))
        #{{ $member->id }}
    @endif
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
    <div class="row">
        <div class="col-sm-12 d-flex justify-content-end mb-3">
            <a href="{{ url('admin/directors') }}" class="btn btn-primary">
                <span class="mdi mdi-format-list-bulleted-square me-2"></span>
                All Directors
            </a>
        </div>
    </div>
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

        <form method="POST" action="{{ route('backend.directors.store') }}">
            @csrf
            <input type="hidden" name="id" value="{{ isset($member) ? $member->id : '' }}">
            <div class="row">
                <div class="col-sm-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Director Details</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 mb-4">
                                    <label>Slug</label>
                                    <input class="form-control" type="text" id="slug" name="slug" placeholder="Enter here...." value="{{ isset($member) ? $member->slug : '' }}" readonly>
                                    <label class="text-danger fw-bold mt-1 d-none" id="slug-warning">Slug already exists!</label>
                                </div>

                                <div class="col-sm-6 mb-4">
                                    <label>Name *</label>
                                    <input class="form-control" type="text" id="main-title" name="name" placeholder="Enter here...." value="{{ isset($member) ? $member->name : '' }}">
                                </div>
                                <div class="col-sm-6 mb-4">
                                    <label>Designation</label>
                                    <input class="form-control" type="text" name="designation" placeholder="Enter here...." value="{{ isset($member) ? $member->designation : '' }}">
                                </div>
                                <div class="col-sm-3 mb-4">
                                    <label>Phone</label>
                                    <input class="form-control" type="text" name="phone" placeholder="Enter here...." value="{{ isset($member) ? $member->phone : '' }}">
                                </div>
                                <div class="col-sm-3 mb-4">
                                    <label>Mobile</label>
                                    <input class="form-control" type="text" name="mobile" placeholder="Enter here...." value="{{ isset($member) ? $member->mobile : '' }}">
                                </div>
                                <div class="col-sm-3 mb-4">
                                    <label>Email Address</label>
                                    <input class="form-control" type="text" name="email" placeholder="Enter here...." value="{{ isset($member) ? $member->email : '' }}">
                                </div>
                                <div class="col-sm-3 mb-4">
                                    <label>FAX</label>
                                    <input class="form-control" type="text" name="fax" placeholder="Enter here...." value="{{ isset($member) ? $member->fax : '' }}">
                                </div>
                                <div class="col-sm-6 mb-4">
                                    <label>Qualifications</label>
                                    <input class="form-control" type="text" name="qualifications" placeholder="Enter here...." value="{{ isset($member) ? $member->qualifications : '' }}">
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-end align-items-center">
                                <div>
                                    <button type="submit" class="btn btn-secondary waves-effect waves-light save-this-form"><i class="mdi mdi-content-save me-1"></i>SAVE</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <input type="hidden" name="image" id="image" value="{{ isset($member) ? $member->image : '' }}">
                                <div class="col-sm-12 mb-4">
                                    <label>Images</label>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="file">
                                                    <input type="file" accept="image/*" class="file-styled-primary" id="thumb_image" >
                                                </label>
                                            </div>
                                            <div class="row" style="">
                                                <div class="col-12" id="uploaded_thumb">
                                                    <div id="thumb_image_demo" style=""></div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <p class="text-success" id="image-status"></p>
                                                </div>
                                                <div class="col-md-4 text-right">
                                                    <span class="btn btn-info btn-sm thumb_crop">Apply</span>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-sm-12 d-flex mt-5">
                                            <div class="row" id="uploaded_image">
                                                @if(!empty($member))
                                                    <div class="col-md-12 mb-3">
                                                        <div class="d-flex align-items-center justify-content-center img-action img-border">
                                                            <img class="img-fluid img-bordered" src="{{ url('assets/common/images/uploads/'.$member->image) }}">
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>

                                        </div>
                                    </div>

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
        var $lastActivityTime = 0;
        var $timer = null;
        function lastActivityTimer(){

            if( typeUnd($timer) && $timer !== null ){
                clearInterval($timer);
                $lastActivityTime = 0;
            }

            $timer = setInterval(function(){
                $lastActivityTime++;
            }, 1000);

        }

        function appendImage($img){

            $image = "{{ url('assets/common/images/uploads') }}/" + $img.filename;

            $item = $('<div></div>').addClass('col-md-12 mb-3').attr('id', $img.id);
            $('<div></div>').addClass('d-flex align-items-center justify-content-center img-action')
                .append($('<img>').addClass('img-fluid img-bordered').attr('src', $image)
                ).appendTo($item);

            return $item;
        }



        $image_thumb = $('#thumb_image_demo').croppie({
            enableExif: true,
            viewport: {
                width:250,
                height:250,
                type:'square' //circle
            },
            boundary:{
                width:300,
                height:300
            }
        });

        $('#thumb_image').on('change', function(){
            var reader = new FileReader();
            reader.onload = function (event) {
                $image_thumb.croppie('bind', {
                    url: event.target.result
                });
            };
            reader.readAsDataURL(this.files[0]);
            $('#uploaded_thumb').show();
        });


        $('.thumb_crop').click(function(event){

            $image_thumb.croppie('result', {
                type: 'canvas',
                /*size: 'original'*/
                size: {
                    width: 1000,
                    height: 1000
                }
            }).then(function(response){

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "{{ route('backend.directors.imageUpload') }}",
                    type: "POST",
                    data: {
                        image:response,
                    },
                    success: function ($data) {
                        $('#image-status').html($data.status);
                        $img = appendImage($data);
                        $('#uploaded_image').html($img);
                        $('#image').val($data.filename);
                    }
                });

            })
        });


        $isSending = false;

        function getSlug(){
            $id = $('#temp_id').val();
            $title = $('#main-title').val();

            if(!$isSending){
                $.ajax({
                    url: "{{ route('backend.directors.slugGenerator') }}",
                    dataType: 'json',
                    data: {
                        id: $id,
                        title: $title,
                        _token: csrf_token()
                    },
                    method: 'POST',
                    beforeSend: function ($jqXHR, $obj) {
                        $isSending = true;
                        $('#slug-warning').addClass('d-none');
                    },
                    success: function ($res, $textStatus, $jqXHR) {
                        $isSending = false;
                        $('#slug').val($res.slug);
                        if($res.is_exist == 1){
                            $('#slug-warning').removeClass('d-none');
                        }

                    },
                    error: function ($jqXHR, $textStatus, $errorThrown) {

                    }
                });
            }
        }

        $(document).ready(function (){
            /*$('#main-title').on('blur', function ($e){
                setTimeout(function (){
                    getSlug();
                }, 400);
            });*/

            $('#main-title').on('keyup change', function ($e){
                lastActivityTimer();

                setInterval(function(){
                    if ($timer !== null) {
                        if ($lastActivityTime >= 1) {
                            clearInterval($timer);
                            $lastActivityTime = 0;
                            $timer = null;
                            getSlug();
                        }
                    }
                }, 400);
            });


        });



    </script>
@endsection
