@extends('layouts.backend')

@section('page_title')
    User

    @if(isset($user))
        #{{ $user->id }}
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
            <a href="{{ url('admin/users') }}" class="btn btn-primary">
                <span class="mdi mdi-format-list-bulleted-square me-2"></span>
                All Users
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

        <form method="POST" action="{{ route('backend.users.store') }}">
            @csrf
            <input type="hidden" name="id" value="{{ isset($user) ? $user->id : '' }}">
            <input type="hidden" id="temp_id" name="temp_id" value="{{ $temp_id }}">
            <div class="row">
                <div class="col-sm-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">User Details</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4 mb-4">
                                    <label>First Name</label>
                                    <input class="form-control" type="text" id="first_name" name="first_name" placeholder="Enter here...." value="{{ isset($user) ? $user->first_name : '' }}">
                                </div>
                                <div class="col-sm-4 mb-4">
                                    <label>Last Name</label>
                                    <input class="form-control" type="text" id="last_name" name="last_name" placeholder="Enter here...." value="{{ isset($user) ? $user->last_name : '' }}">
                                </div>
                                <div class="col-sm-4 mb-4">
                                    <label>Email Address</label>
                                    <input class="form-control" type="text" id="email" name="email" placeholder="Enter here...." value="{{ isset($user) ? $user->email : '' }}">
                                </div>

                                @if(empty($user))
                                    <div class="col-sm-4 mb-4">
                                        <label>Password</label>
                                        <input class="form-control" type="password" id="password" name="password" placeholder="Enter here....">
                                    </div>
                                    <div class="col-sm-4 mb-4">
                                        <label>Re-Enter Password</label>
                                        <input class="form-control" type="password" id="password" name="password_confirmation" placeholder="Enter here....">
                                    </div>
                                @endif

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
                                <div class="col-sm-12 mb-4">
                                    <div class="form-group">
                                        <label>User Role</label>
                                        <select class="form-control" name="user_role_id">
                                            <option>Select User Role</option>
                                            @foreach($user_roles as $role)
                                                <option value="{{ $role->id }}" {{ (!empty($user) && $user->user_role_id == $role->id) ? 'selected' : '' }}>{{ $role->user_role }}</option>
                                            @endforeach
                                        </select>
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
@endsection
