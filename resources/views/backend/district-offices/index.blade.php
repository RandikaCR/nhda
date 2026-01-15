@extends('layouts.backend')

@section('page_title')
    All District Offices
@endsection

@section('breadcrumb')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">District Offices</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">NHDA Admin</a></li>
                        <li class="breadcrumb-item active">District Offices</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

@endsection

@section('header_buttons')
    <div class="row">
        <div class="col-sm-12 d-flex justify-content-end mb-3">
            <a href="{{ url('admin/district-offices/create') }}" class="btn btn-primary">
                <span class="mdi mdi-plus-box me-2"></span>
                Add New
            </a>
        </div>
    </div>
@endsection

@section('content')

    @if(!empty($is_screen_access))

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form method="GET" action="">
                            @csrf
                            <div class="row">
                                <div class="col-sm-5">
                                    <label>Search</label>
                                    <input class="form-control" type="text" name="keyword" placeholder="Enter keyword here...." value="{{ $keyword }}">
                                </div>
                                {{--<div class="col-sm-2">
                                    <h6 class="fw-semibold">Category</h6>
                                    <select class="js-example-basic-single" name="category_id">
                                        <option value="">All</option>
                                        <option value="01">Category 01</option>
                                        <option value="02">Category 02</option>
                                        <option value="03">Category 03</option>
                                        <option value="04">Category 04</option>
                                        <option value="05">Category 05</option>
                                    </select>
                                </div>--}}

                                <div class="col-sm-3 d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary">
                                        <span class="mdi mdi-magnify me-2"></span>
                                        Search
                                    </button>
                                    <a href="{{ url('admin/district-offices') }}" class="btn btn-outline-dark waves-effect waves-light ms-2">
                                        <span class="mdi mdi-restore me-2"></span>
                                        Clear
                                    </a>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">All District Offices</h4>
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
                                                <th class="text-center" scope="col">
                                                    <p class="mb-0">ID</p>
                                                </th>
                                                <th scope="col" style="width: 40%;">
                                                    <p class="mb-0">District Office</p>
                                                </th>
                                                <th scope="col">
                                                    <p class="mb-0">Manager</p>
                                                </th>
                                                <th scope="col">
                                                    <p class="mb-0">Phone/Mobile/Email</p>
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
                                            @foreach($district_offices as $office)
                                                <tr>
                                                    <td class="fw-medium text-center">
                                                        <p class="mb-0">{{ $office->id }}</p>
                                                    </td>
                                                    <td>
                                                        <p class="mb-1">{{ $office->office }}</p>
                                                    </td>
                                                    <td>
                                                        <p class="mb-1">{{ $office->manager_name }}</p>
                                                    </td>
                                                    <td>
                                                        <p class="mb-1">{{ $office->phone }}</p>
                                                        <p class="mb-1">{{ $office->mobile }}</p>
                                                        <p class="mb-1">{{ $office->email }}</p>
                                                    </td>
                                                    <td class="text-center">
                                                        <p class="mb-0"><span class="badge {{ status($office->status)->class }}">{{ status($office->status)->text }}</span></p>
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="{{ route('backend.districtOffices.edit', $office->uuid) }}" class="btn btn-primary btn-sm waves-effect waves-light" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><span class="mdi mdi-pencil"></span></a>
                                                        <a href="javascript:void(0);" class="btn btn-danger btn-sm waves-effect waves-light delete" data-id="{{ $office->id }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><span class="mdi mdi-delete"></span></a>
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

                            <div class="mt-5">
                                {{--Paginaiton--}}
                                {!! $district_offices->links('vendor.pagination.backend') !!}
                            </div>
                        </div>
                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div>
            <!-- end col -->
        </div>

    @else
        @include('partials.backend.access-warning')
    @endif

@endsection

@section('scripts')

    <!--jquery cdn-->
    <script src="{{ asset('assets/backend/packages/code.jquery.com/jquery-3.6.0.min.js') }}" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!--select2 cdn-->
    <script src="{{ asset('assets/backend/packages/cdn.jsdelivr.net/npm/select2%404.1.0-rc.0/dist/js/select2.min.js') }}"></script>

    <script src="{{ asset('assets/backend/js/pages/select2.init.js') }}"></script>

@endsection

@section('custom_scripts')

    <script>
        $(document).ready(function (){

            $('.table').on('click', '.delete', function ($e){
                $e.preventDefault();
                $this = $(this);
                $id = $($this).data('id');

                Swal.fire({
                    title: "Are you sure?",
                    text: "You want to delete this!",
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
                                url: "{{ route('backend.districtOffices.delete') }}",
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
                                    Swal.fire('Done!', 'District Office has been deleted!', 'success');

                                    $($this).parent().parent().fadeOut('slow');
                                    setTimeout(function (){
                                        $($this).parent().parent().remove();
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

        });
    </script>

@endsection
