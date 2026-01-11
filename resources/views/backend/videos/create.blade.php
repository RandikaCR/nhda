@extends('layouts.backend')

@section('page_title')
    Videos

    @if(isset($video))
        #{{ $video->id }}
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
            <a href="{{ url('admin/videos') }}" class="btn btn-primary">
                <span class="mdi mdi-format-list-bulleted-square me-2"></span>
                All Videos
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

        <form method="POST" action="{{ route('backend.videos.store') }}">
            @csrf
            <input type="hidden" name="id" value="{{ isset($video) ? $video->id : '' }}">
            <div class="row justify-content-center">
                <div class="col-sm-8">
                    <div class="card">
                        <div class="card-header">

                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h4 class="card-title">Video Details</h4>
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
                                    <input class="form-control" type="text" id="slug" name="slug" placeholder="Enter here...." value="{{ isset($video) ? $video->slug : '' }}" readonly>
                                    <label class="text-danger fw-bold mt-1 d-none" id="slug-warning">Slug already exists!</label>
                                </div>

                                <div class="col-sm-12 mb-4">
                                    <label>Title (ENGLISH) *</label>
                                    <input class="form-control" type="text" id="main-title" name="en_title" placeholder="Enter here...." value="{{ isset($video) ? $video->en_title : '' }}">
                                </div>

                                <div class="col-sm-12 mb-4">
                                    <label>Title (SINHALA)</label>
                                    <input class="form-control" type="text" id="title-si" name="si_title" placeholder="Enter here...." value="{{ isset($video) ? $video->si_title : '' }}">
                                </div>

                                <div class="col-sm-12 mb-4">
                                    <label>Title (TAMIL)</label>
                                    <input class="form-control" type="text" id="title-ta" name="ta_title" placeholder="Enter here...." value="{{ isset($video) ? $video->ta_title : '' }}">
                                </div>

                                <div class="col-sm-12 mb-4">
                                    <label>Video *</label>
                                    <input class="form-control" type="text" id="video" name="video" placeholder="Enter here...." value="{{ isset($video) ? $video->video : '' }}">
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

            $item = $('<div></div>').addClass('col-md-6 mb-3').attr('id', $img.id);

            if($img.is_primary == 1){
                $('<div></div>').addClass('d-flex align-items-center justify-content-center img-action')
                    .append($('<img>').addClass('img-fluid img-bordered').attr('src', $image))
                    .append($('<span></span>').addClass('badge bg-success').css({'position' : 'absolute', 'top' : '10px', 'right' : '10px'})
                        .append($('<i></i>').addClass('mdi mdi-key'))
                    ).appendTo($item);
            }
            else{
                $('<div></div>').addClass('d-flex align-items-center justify-content-center img-action img-border')
                    .append($('<img>').addClass('img-fluid img-bordered').attr('src', $image))
                    .append($('<div></div>').addClass('img-overlay-area d-flex justify-content-center align-items-center')
                        .append(
                            $('<a></a>').addClass('btn btn-danger btn-xs me-2 delete-image')
                                .attr('href', 'javascript:void(0);')
                                .attr('data-id', $img.id)
                                .attr('data-toggle', 'tooltip')
                                .attr('data-placement', 'top')
                                .attr('title', 'Delete')
                                .attr('data-original-title', 'Delete')
                                .append($('<i></i>').addClass('mdi mdi-delete'))
                        )
                        .append(
                            $('<a></a>').addClass('btn btn-success btn-xs primary-image')
                                .attr('href', 'javascript:void(0);')
                                .attr('data-id', $img.id)
                                .attr('data-toggle', 'tooltip')
                                .attr('data-placement', 'top')
                                .attr('title', 'Make this Primary Image?')
                                .attr('data-original-title', 'Make this Primary Image?')
                                .append($('<i></i>').addClass('mdi mdi-key'))
                        )
                    ).appendTo($item);
            }

            return $item;
        }

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


        $image_thumb = $('#thumb_image_demo').croppie({
            enableExif: true,
            viewport: {
                width:280,
                height:147,
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
                    width: 1200,
                    height: 630
                }
            }).then(function(response){

                $id = $('#temp_id').val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "{{ route('backend.projects.imageUpload') }}",
                    type: "POST",
                    data: {
                        image:response,
                        id: $id,
                    },
                    success: function ($data) {
                        $('#image-status').html($data.status);
                        $img = appendImage($data);
                        $('#uploaded_image').append($img);
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
                    url: "{{ route('backend.projects.slugGenerator') }}",
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



            $('#uploaded_image').on('click', '.delete-image', function ($e){
                $e.preventDefault();
                $this = $(this);
                $id = $($this).data('id');

                Swal.fire({
                    title: "Are you sure?",
                    text: "You want to delete this Image!",
                    icon: "warning",
                    showCancelButton: !0,
                    showLoaderOnConfirm: true,
                    confirmButtonText: "Yes, Do it!",
                    cancelButtonText: "No, cancel!",
                    confirmButtonClass: "btn btn-primary w-xs me-2 mt-2",
                    cancelButtonClass: "btn btn-danger w-xs mt-2",
                    buttonsStyling: !1,
                    showCloseButton: !0,
                }).then((result) => {
                    if (result.isConfirmed) {

                        setTimeout(function() {
                            $.ajax({
                                url: "{{ route('backend.projects.deleteImage') }}",
                                type: 'POST',
                                data: {
                                    id: $id,
                                    _token: csrf_token()
                                },
                                dataType: 'json',
                                beforeSend: function ($jqXHR, $obj) {
                                    Swal.fire({
                                        title: "Processing...",
                                        text: "Please wait",
                                        imageUrl: "{{ asset('assets/common/images/ajax-loader.gif') }}",
                                        showConfirmButton: false,
                                        allowOutsideClick: false
                                    });
                                },
                                success: function ($response, $textStatus, $jqXHR) {
                                    Swal.fire('Done!', 'Image has been deleted!', 'success');

                                    $($this).parent().parent().parent().fadeOut('slow');
                                    setTimeout(function (){
                                        $($this).parent().parent().parent().remove();
                                    },1000);
                                },
                                error: function ($jqXHR, $textStatus, $errorThrown) {
                                    Swal.fire('Oops...', 'Something went wrong with the System!', 'error');
                                }
                            });

                        }, 50);
                    }
                });

            });

            $('#uploaded_image').on('click', '.primary-image', function ($e){
                $e.preventDefault();
                $this = $(this);
                $id = $($this).data('id');

                Swal.fire({
                    title: "Are you sure?",
                    text: "You want to set this as a Primary Image!",
                    icon: "warning",
                    showCancelButton: !0,
                    showLoaderOnConfirm: true,
                    confirmButtonText: "Yes, Do it!",
                    cancelButtonText: "No, cancel!",
                    confirmButtonClass: "btn btn-primary w-xs me-2 mt-2",
                    cancelButtonClass: "btn btn-danger w-xs mt-2",
                    buttonsStyling: !1,
                    showCloseButton: !0,
                }).then((result) => {
                    if (result.isConfirmed) {

                        setTimeout(function() {
                            $.ajax({
                                url: "{{ route('backend.projects.setPrimaryImage') }}",
                                type: 'POST',
                                data: {
                                    id: $id,
                                    _token: csrf_token()
                                },
                                dataType: 'json',
                                beforeSend: function ($jqXHR, $obj) {
                                    Swal.fire({
                                        title: "Processing...",
                                        text: "Please wait",
                                        imageUrl: "{{ asset('assets/common/images/ajax-loader.gif') }}",
                                        showConfirmButton: false,
                                        allowOutsideClick: false
                                    });
                                },
                                success: function ($response, $textStatus, $jqXHR) {
                                    Swal.fire('Done!', 'Primary Image has been updated!', 'success');

                                    $('#uploaded_image').html('');

                                    setTimeout(function (){
                                        $.each($response.images, function ($index, $item){
                                            $img = appendImage($item);
                                            $('#uploaded_image').append($img);
                                        });
                                    }, 100);




                                },
                                error: function ($jqXHR, $textStatus, $errorThrown) {
                                    Swal.fire('Oops...', 'Something went wrong with the System!', 'error');
                                }
                            });

                        }, 50);
                    }
                });


            });

        });



    </script>
@endsection
