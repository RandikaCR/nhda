@extends('layouts.backend')

@section('page_title')
    District Office

    @if(isset($office))
        #{{ $office->id }}
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
            <a href="{{ url('admin/district-offices') }}" class="btn btn-primary">
                <span class="mdi mdi-format-list-bulleted-square me-2"></span>
                All District Offices
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

        <form method="POST" action="{{ route('backend.districtOffices.store') }}">
            @csrf
            <input type="hidden" name="id" value="{{ isset($office) ? $office->id : '' }}">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h4 class="card-title">District Office Details</h4>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-secondary waves-effect waves-light save-this-form"><i class="mdi mdi-content-save me-1"></i>SAVE</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 mb-4">
                                    <label>Slug</label>
                                    <input class="form-control" type="text" id="slug" name="slug" placeholder="Enter here...." value="{{ isset($office) ? $office->slug : '' }}" readonly>
                                    <label class="text-danger fw-bold mt-1 d-none" id="slug-warning">Slug already exists!</label>
                                </div>

                                <div class="col-sm-6 mb-4">
                                    <label>Office *</label>
                                    <input class="form-control" type="text" id="main-title" name="office" placeholder="Enter here...." value="{{ isset($office) ? $office->office : '' }}">
                                </div>

                                <div class="col-sm-6 mb-4">
                                    <label>Manager Name</label>
                                    <input class="form-control" type="text" name="manager_name" placeholder="Enter here...." value="{{ isset($office) ? $office->manager_name : '' }}">
                                </div>

                                <div class="col-sm-3 mb-4">
                                    <label>Phone</label>
                                    <input class="form-control" type="text" name="phone" placeholder="Enter here...." value="{{ isset($office) ? $office->phone : '' }}">
                                </div>
                                <div class="col-sm-3 mb-4">
                                    <label>Mobile</label>
                                    <input class="form-control" type="text" name="mobile" placeholder="Enter here...." value="{{ isset($office) ? $office->mobile : '' }}">
                                </div>
                                <div class="col-sm-3 mb-4">
                                    <label>Email Address</label>
                                    <input class="form-control" type="text" name="email" placeholder="Enter here...." value="{{ isset($office) ? $office->email : '' }}">
                                </div>
                                <div class="col-sm-3 mb-4">
                                    <label>FAX</label>
                                    <input class="form-control" type="text" name="fax" placeholder="Enter here...." value="{{ isset($office) ? $office->fax : '' }}">
                                </div>
                                <div class="col-sm-8 mb-4">
                                    <label>Address</label>
                                    <textarea id="content-en" name="address">
                                    {{ isset($office) ? $office->address : '' }}
                                </textarea>
                                </div>
                                <div class="col-sm-4 mb-4">
                                    <label>Map</label>
                                    <input class="form-control" type="text" name="map" placeholder="Enter here...." value="{{ isset($office) ? $office->map : '' }}">
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


        ClassicEditor.create(document.querySelector("#content-en"), {
            toolbar: []
        })
            .then(function (e) {
                e.ui.view.editable.element.style.height = "60px";
            })
            .catch(function (e) {
                console.error(e);
            });


        $isSending = false;

        function getSlug(){
            $id = $('#temp_id').val();
            $title = $('#main-title').val();

            if(!$isSending){
                $.ajax({
                    url: "{{ route('backend.districtOffices.slugGenerator') }}",
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
