@extends('layouts.backend')

@section('page_title')
    Screens
@endsection

@section('styles')

@endsection

@section('css')

@endsection

@section('header_buttons')

@endsection

@section('content')

    @if(!empty($is_screen_access))
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">All Screens</h4>
                        <div class="flex-shrink-0">
                        </div>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row">
                                <div class="col-xl-612">
                                    <div class="table-responsive mt-4 mt-xl-0">
                                        <table class="table table-hover table-striped align-middle table-nowrap mb-0">
                                            <thead>
                                            <tr>
                                                <th scope="col" style="width: 50%;">
                                                    <p class="mb-0">Screen</p>
                                                </th>
                                                <th scope="col">
                                                    <p class="mb-0">Screen Prefix</p>
                                                </th>
                                                <th class="text-center" scope="col">
                                                    <p class="mb-0">Status</p>
                                                </th>
                                                <th class="text-end" scope="col">
                                                    <p class="mb-0">Actions</p>
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($items as $item)
                                                <tr id="row-{{ $item->id }}">
                                                    <td>
                                                        <p class="mb-0">{{ $item->screen }}</p>
                                                    </td>
                                                    <td>
                                                        <p class="mb-0">{{ $item->screen_prefix }}</p>
                                                    </td>
                                                    <td class="text-center">
                                                        <p class="mb-0"><span class="badge {{ status($item->status)->class }}">{{ status($item->status)->text }}</span></p>
                                                    </td>
                                                    <td class="text-end">
                                                        <div class="d-flex justify-content-end align-items-center">
                                                            <div class="form-check form-switch form-switch-success form-switch-md">
                                                                <input class="form-check-input status" data-id="{{ $item->id }}" type="checkbox" role="switch"  {{ ($item->status == 1) ? 'checked': '' }} >
                                                            </div>
                                                            <div>
                                                                <a href="javascript:void(0);" data-id="{{ $item->id }}" class="btn btn-primary btn-sm waves-effect waves-light edit" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><span class="mdi mdi-pencil"></span></a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div>
                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div>


            <div class="col-md-4">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1"><span class="me-1">Create New</span><span>Screen</span></h4>
                        <div class="flex-shrink-0">
                        </div>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 mb-3">
                                <div>
                                    <label for="screen-input" class="form-label">Screen Name*</label>
                                    <input type="text" class="form-control" id="screen-input" placeholder="Enter here....">
                                </div>
                            </div>
                            <div class="col-sm-12 mb-3">
                                <div>
                                    <label for="prefix-input" class="form-label">Screen Prefix*</label>
                                    <input type="text" class="form-control" id="prefix-input" placeholder="Enter here....">
                                </div>
                            </div>
                            <input type="hidden" class="form-control" id="slug-input" placeholder="Enter here...." value="">
                            <div class="col-sm-12" id="form-alert-area">

                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm-12 d-flex justify-content-end">
                                <input type="hidden" id="edit-id" value="0">
                                <a href="{{ url('/admin/screens') }}" class="btn btn-outline-dark waves-effect waves-light me-2"><i class="mdi mdi-restore me-1"></i>Reset</a>
                                <button type="button" class="btn btn-secondary waves-effect waves-light save-this-form"><i class="mdi mdi-content-save me-1"></i>SAVE</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        @include('partials.backend.access-warning')
    @endif




@endsection


@section('scripts')
    <script src="{{ asset('assets/backend/packages/code.jquery.com/jquery-3.6.0.min.js') }}" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
@endsection

@section('custom_scripts')
    <script>
        $(document).ready(function (){
            $('.save-this-form').on('click', function (){
                $this = $(this);
                $($this).prop('disabled', true);

                $url = "{{ route('backend.screens.store') }}";

                $id = $('#edit-id').val();
                $screen = $.trim($('#screen-input').val());
                $prefix = $.trim($('#prefix-input').val());

                $isInvalid = 0;
                if($screen == ''){
                    $('#form-alert-area').html('');
                    $alert = alertDanger('Screen can not be empty!', 'Error');
                    $('#form-alert-area').html($alert);
                    $($this).prop('disabled', false);
                }else if($prefix == ''){
                    $('#form-alert-area').html('');
                    $alert = alertDanger('Screen Prefix can not be empty!', 'Error');
                    $('#form-alert-area').html($alert);
                    $($this).prop('disabled', false);
                }

                if($isInvalid == 0){
                    $.ajax({
                        url: $url,
                        dataType: 'json',
                        data: {
                            id: $id,
                            screen: $screen,
                            screen_prefix: $prefix,
                            _token: csrf_token()
                        },
                        method: 'POST',
                        beforeSend: function ($jqXHR, $obj) {
                            $('#form-alert-area').html('');
                            $('#form-alert-area').html(alertProcessing());
                        },
                        success: function ($res, $textStatus, $jqXHR) {
                            $('#edit-id').val(0);
                            $('#screen-input').val('');
                            $('#prefix-input').val('');
                            $('#form-alert-area').html('');
                            $alert = alertSuccess($res.message_text, $res.message_title);
                            $('#form-alert-area').html($alert);
                            $($this).prop('disabled', false);

                            setTimeout(function (){
                                location.reload();
                            }, 1000);
                        },
                        error: function ($jqXHR, $textStatus, $errorThrown) {

                        }
                    });
                }

            });


            $('.table').on('click', '.edit', function (){
                $id = $(this).data('id');
                $url = "{{ route('backend.screens.get') }}";
                $.ajax({
                    url: $url,
                    dataType: 'json',
                    data: {
                        id: $id,
                        _token: csrf_token()
                    },
                    method: 'POST',
                    beforeSend: function ($jqXHR, $obj) {
                        $('#form-alert-area').html('');
                        $('#form-alert-area').html(alertProcessing('Please Wait...', 'Getting Info'));

                        $('.save-this-form').prop('disabled', true);

                        $('#edit-id').val(0);
                        $('#screen-input').val('');
                        $('#prefix-input').val('');
                    },
                    success: function ($res, $textStatus, $jqXHR) {
                        $('#edit-id').val($res.id);
                        $('#screen-input').val($res.screen);
                        $('#prefix-input').val($res.screen_prefix);
                        $('#form-alert-area').html('');
                        $('.save-this-form').prop('disabled', false);

                    },
                    error: function ($jqXHR, $textStatus, $errorThrown) {

                    }
                });
            });

            $('.table').on('change', '.status', function (){
                $id = $(this).data('id');
                $url = "{{ route('backend.screens.status') }}";
                $rowId = '#row-' + $id;
                $.ajax({
                    url: $url,
                    dataType: 'json',
                    data: {
                        id: $id,
                        _token: csrf_token()
                    },
                    method: 'POST',
                    beforeSend: function ($jqXHR, $obj) {

                    },
                    success: function ($res, $textStatus, $jqXHR) {
                        $($rowId).find('.badge').removeClass('bg-success bg-warning').addClass($res.class);
                        $($rowId).find('.badge').html($res.text);
                    },
                    error: function ($jqXHR, $textStatus, $errorThrown) {

                    }
                });
            });
        });
    </script>


@endsection
