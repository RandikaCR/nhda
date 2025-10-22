<input type="hidden" id="auth-user-id" value="{{ !empty(Auth::user()) ? Auth::user()->id : 0 }}">
<input type="hidden" id="_csrf_token" value="{{ csrf_token() }}">

<!-- Jquery -->
<script src="{{ asset('assets/frontend/js/vendor/jquery-3.7.1.min.js') }}"></script>
<!-- Swiper Js -->
<script src="{{ asset('assets/frontend/js/swiper-bundle.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('assets/frontend/js/bootstrap.min.js') }}"></script>
<!-- Magnific Popup -->
<script src="{{ asset('assets/frontend/js/jquery.magnific-popup.min.js') }}"></script>
<!-- Counter Up -->
<script src="{{ asset('assets/frontend/js/jquery.counterup.min.js') }}"></script>
<!-- Range Slider -->
<script src="{{ asset('assets/frontend/js/jquery-ui.min.js') }}"></script>
<!-- Isotope Filter -->
<script src="{{ asset('assets/frontend/js/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/isotope.pkgd.min.js') }}"></script>
<!-- Wow Js -->
<script src="{{ asset('assets/frontend/js/wow.min.js') }}"></script>

<!-- Gsap Animation -->
<script src="{{ asset('assets/frontend/js/gsap.min.js') }}"></script>
<!-- ScrollTrigger -->
<script src="{{ asset('assets/frontend/js/ScrollTrigger.min.js') }}"></script>
<!-- SplitText -->
<script src="{{ asset('assets/frontend/js/SplitText.min.js') }}"></script>
<!-- Lenis Js -->
<script src="{{ asset('assets/frontend/js/lenis.min.js') }}"></script>
<!-- Main Js File -->
<script src="{{ asset('assets/frontend/js/main.js') }}"></script>

<script src="{{ asset('assets/common/js/app.js') }}"></script>
<script src="{{ asset('assets/common/js/common.js') }}"></script>

<script src="{{ asset('assets/backend/libs/sweetalert2/sweetalert2.min.js') }}"></script>

<script>
    $(document).ready(function (){
        $('.logout').on('click', function ($e){
            $e.preventDefault();

            Swal.fire({
                title: "Are you sure?",
                text: "You want to end this session!",
                icon: "warning",
                showCancelButton: !0,
                showLoaderOnConfirm: true,
                confirmButtonText: "Yes, Log Out!",
                cancelButtonText: "No, cancel!",
                confirmButtonClass: "btn btn-danger w-xs me-2 mt-2",
                cancelButtonClass: "btn btn-secondary w-xs mt-2",
                buttonsStyling: !1,
                showCloseButton: !0,
            }).then((result) => {
                if (result.isConfirmed) {

                    setTimeout(function() {
                        $.ajax({
                            url: "{{ route('frontend.appLogout') }}",
                            type: 'POST',
                            data: {
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
                                Swal.fire('Done!', 'Logged Out!', 'success');
                                setTimeout(function(){
                                    location.reload();
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

@yield('script')
