@extends('layouts.frontend')

@section('page_title')
    {{ __('lang.Login') }} / {{ __('lang.Register') }}
@endsection

@section('content')

    <div class="th-checkout-wrapper space-top space-extra-bottom">
        <div class="container mb-30">
            <div class="row">
                <div class="col-sm-12">
                    @if($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">
                                {{$error}}
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-sm-5">
                    <div class="woocommerce-form-login-toggle">
                        <div class="woocommerce-info">LOGIN</div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <form action="{{ route('frontend.auth.login') }}" method="POST" class="woocommerce-form-login mb-3">
                                @csrf
                                <div class="form-group">
                                    <label>Email Address *</label>
                                    <input type="email" class="form-control" placeholder="Enter here" name="email">
                                </div>
                                <div class="form-group">
                                    <label>Password *</label>
                                    <input type="password" class="form-control" placeholder="Enter here" name="password">
                                </div>
                                <div class="form-group">
                                    <div class="custom-checkbox">
                                        <input type="checkbox" id="remembermylogin">
                                        <label for="remembermylogin">Remember Me</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="th-btn btn-sm btn-radius-8">LOGIN</button>
                                    <p class="mt-3 mb-0"><a class="text-reset" href="{{ route('password.request') }}">Lost your password?</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-7">
                    <div class="woocommerce-form-login-toggle">
                        <div class="woocommerce-info">REGISTER</div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    <form action="{{ route('frontend.auth.store') }}" method="POST"  class="woocommerce-form-login mb-3">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label>First Name *</label>
                                                <input type="text" class="form-control" placeholder="Enter here..." name="first_name">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label>Last Name *</label>
                                                <input type="text" class="form-control" placeholder="Enter here..." name="last_name">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 form-group">
                                                <div class="form-group">
                                                    <label>Email Address *</label>
                                                    <input type="email" class="form-control" placeholder="Enter here" name="email">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label>Password *</label>
                                                <input type="password" class="form-control" placeholder="Enter here" name="password">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label>Confirm Password *</label>
                                                <input type="password" class="form-control" placeholder="Enter here" name="password_confirmation">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="th-btn btn-sm btn-radius-8">REGISTER</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
<script>

</script>
@endsection
