@extends('layouts.backend')

@section('page_title')
    Downloads

    @if(isset($download))
        #{{ $download->id }}
    @endif
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/backend/libs/croppie/croppie.min.css') }}">

@endsection

@section('header_buttons')
    <div class="row">
        <div class="col-sm-12 d-flex justify-content-end mb-3">
            <a href="{{ url('admin/downloads') }}" class="btn btn-primary">
                <span class="mdi mdi-format-list-bulleted-square me-2"></span>
                All Downloads
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

        <form method="POST" action="{{ route('backend.downloads.store') }}">
            @csrf
            <input type="hidden" name="id" value="{{ isset($download) ? $download->id : '' }}">
            <div class="row justify-content-center">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">

                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h4 class="card-title">Download Details</h4>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-secondary waves-effect waves-light save-this-form"><i class="mdi mdi-content-save me-1"></i>SAVE</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4 mb-4">
                                    <label>Download Category</label>
                                    <select class="form-control" name="download_category_id">
                                        <option value="">Select Download Category</option>
                                        @foreach($download_categories as $category)
                                            <option value="{{ $category->id }}" {{ isset($download) && $download->download_category_id == $category->id ? 'selected' : '' }} >{{ $category->download_category }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-2 d-flex align-items-center">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="is_end_date_available" name="is_end_date_available" {{ isset($download) && !empty($download->is_end_date_available) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_end_date_available">
                                            Is end date available?
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-2 mb-4">
                                    <div>
                                        <label for="end-date" class="form-label">End Date</label>
                                        <input type="date" class="form-control" name="end_date" id="end-date">
                                    </div>
                                </div>

                            </div>
                            <hr>
                            <div class="row mt-4">
                                <div class="col-sm-7 mb-4">
                                    <label>Title (ENGLISH)</label>
                                    <input class="form-control" type="text" id="main-title" name="en_title" placeholder="Enter here...." value="{{ isset($download) ? $download->en_title : '' }}">
                                </div>
                                <div class="col-sm-3 mb-4">
                                    <label>File (ENGLISH)</label>
                                    <input type="hidden" name="en_file" id="en_file" value="{{ isset($download) ? $download->en_file : '' }}">
                                    <h5 class="text-primary" id="en-file">{{ isset($download) ? $download->en_file : '' }}</h5>
                                </div>
                                <div class="col-sm-2 mb-4 d-flex justify-content-end align-items-center">
                                    <a href="javascript:void(0);" class="btn btn-primary waves-effect waves-light open-file-upload-modal" data-bs-toggle="modal" data-bs-target="#fileUploadModal" data-lang="en"><i class="mdi mdi-cloud-upload me-1"></i>Upload</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-7 mb-4">
                                    <label>Title (SINHALA)</label>
                                    <input class="form-control" type="text" id="title-si" name="si_title" placeholder="Enter here...." value="{{ isset($download) ? $download->si_title : '' }}">
                                </div>
                                <div class="col-sm-3 mb-4">
                                    <label>File (SINHALA)</label>
                                    <input type="hidden" name="si_file" id="si_file" value="{{ isset($download) ? $download->si_file : '' }}">
                                    <h5 class="text-primary" id="si-file">{{ isset($download) ? $download->si_file : '' }}</h5>
                                </div>
                                <div class="col-sm-2 mb-4 d-flex justify-content-end align-items-center">
                                    <a href="javascript:void(0);" class="btn btn-primary waves-effect waves-light open-file-upload-modal" data-bs-toggle="modal" data-bs-target="#fileUploadModal" data-lang="si"><i class="mdi mdi-cloud-upload me-1"></i>Upload</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-7 mb-4">
                                    <label>Title (TAMIL)</label>
                                    <input class="form-control" type="text" id="ta_title" name="ta_title" placeholder="Enter here...." value="{{ isset($download) ? $download->ta_title : '' }}">
                                </div>
                                <div class="col-sm-3 mb-4">
                                    <label>File (TAMIL)</label>
                                    <input type="hidden" name="ta_file" id="ta_file" value="{{ isset($download) ? $download->ta_file : '' }}">
                                    <h5 class="text-primary" id="ta-file">{{ isset($download) ? $download->ta_file : '' }}</h5>
                                </div>
                                <div class="col-sm-2 mb-4 d-flex justify-content-end align-items-center">
                                    <a href="javascript:void(0);" class="btn btn-primary waves-effect waves-light open-file-upload-modal" data-bs-toggle="modal" data-bs-target="#fileUploadModal" data-lang="ta"><i class="mdi mdi-cloud-upload me-1"></i>Upload</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </form>



        <div class="modal fade" id="fileUploadModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body text-center p-5">
                        <form id="upload-form" method="POST" action="{{ route('backend.downloads.fileUpload') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12">
                                    <h4 class="mb-3">Upload File</h4>
                                </div>
                                <div class="col-sm-12">
                                    <div>
                                        <label>Select PDF File</label>
                                        <input class="form-control" id="file-input" name="file" type="file" accept=".pdf">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div id="file-upload-msg"></div>
                            </div>
                            <input type="hidden" id="file-selected-lang" name="language" >
                            <div class="mt-4">
                                <div class="hstack gap-2 justify-content-center">
                                    <a href="javascript:void(0);" class="btn btn-dark" data-bs-dismiss="modal"> Close</a>
                                    <button type="submit" class="btn btn-primary file-upload-btn">Upload</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>



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

        $('.open-file-upload-modal').on('click', function ($e){
            $lang = $(this).data('lang');
            $('#file-selected-lang').val($lang);
            $('#file-input').val('');
            $('#file-upload-msg').html('');
        });

        $('#upload-form').on('submit', function ($e){
            $e.preventDefault();
            $fromData = new FormData(this);

            $selectedLang = $('#file-selected-lang').val();

            log($selectedLang)

            $isInvalid = 0;
            if($('#file-input').get(0).files.length === 0){
                $isInvalid++;
                $('#file-upload-msg').html('');
                $alert = alertDanger('File can not be empty!', 'Error');
                $('#file-upload-msg').html($alert);
            }

            if($isInvalid == 0){
                $.ajax({
                    url: "{{ route('backend.downloads.fileUpload') }}",
                    dataType: 'json',
                    data: $fromData,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    beforeSend: function ($jqXHR, $obj) {
                        $('#file-upload-msg').html(alertProcessing('', 'Uploading'));
                    },
                    success: function ($res, $textStatus, $jqXHR) {
                        $alert = alertSuccess('File uploaded successfully.!', 'Done!');
                        $('#file-upload-msg').html($alert);

                        $('#' + $selectedLang + '_file').val($res.file_name);
                        $('#' + $selectedLang + '-file').html($res.file_name);

                    },
                    error: function ($jqXHR, $textStatus, $errorThrown) {

                    }
                });
            }

        });


    </script>
@endsection
