<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8"/>
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description"/>
    <meta content="Themesbrand" name="author"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{url('assets/images/favicon.ico')}}">

    <!-- preloader css -->
    <link rel="stylesheet" href="{{url('assets/css/preloader.min.css')}}" type="text/css"/>

    <!-- Bootstrap Css -->
    <link href="{{url('assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css"/>
    <!-- Icons Css -->
    <link href="{{url('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- App Css-->
    <link href="{{url('assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css"/>

</head>

<body>

<!-- <body data-layout="horizontal"> -->
<div class="auth-page">
    <div class="container-fluid p-0">
        <div class="row g-0">
            <div class="col-xxl-3 col-lg-4 col-md-5">
                <div class="auth-full-page-content d-flex p-sm-5 p-4">
                    <div class="w-100">
                        <div class="d-flex flex-column h-100">
                            <div class="mb-4 mb-md-5 text-center">
                                <a href="" class="d-block auth-logo">
                                    <img src="{{url('assets/images/os.png')}}" alt="" height="28"> <span
                                        class="logo-txt"></span>
                                </a>
                            </div>
                            <div class="auth-content my-auto">
                                <div class="text-center">
                                    <h5 class="mb-0">Reset Password</h5>
                                    <p class="text-muted mt-2">Reset Password with Osmosiasia.</p>
                                </div>
                                <div class="alert alert-success text-center my-4" role="alert">
                                            Enter your Email and instructions will be sent to you!
                                        </div>

                                @include('partials.validation_errors')

                                @yield('content')


                            </div>
                            <div class="mt-4 mt-md-5 text-center">
                                <p class="mb-0"> All Rights received © Osmosisasia (Pvt) Ltd. <br> Design & Develop by
                                    <a href="#!" class="https://capricon.biz">Capricon Solutions (Pvt) Ltd.</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end auth full page content -->
            </div>
            <!-- end col -->
            <div class="col-xxl-9 col-lg-8 col-md-7">
                <div class="auth-bg pt-md-5 p-4 d-flex">
                    <div class="bg-overlay" style="background-image: url("{{url('assets/images/kt.jpg')}}");
                    background-size: cover;" >
                </div>
                <ul class="bg-bubbles">
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                </ul>
                <!-- end bubble effect -->
                <div class="row justify-content-center align-items-center">
                    <div class="col-xl-7">
                        <div class="p-0 p-sm-4 px-xl-0">
                            <div id="reviewcarouselIndicators" class="carousel slide" data-bs-ride="carousel">
                                <div
                                    class="carousel-indicators carousel-indicators-rounded justify-content-start ms-0 mb-0">
                                    <button type="button" data-bs-target="#reviewcarouselIndicators"
                                            data-bs-slide-to="0" class="active" aria-current="true"
                                            aria-label="Slide 1"></button>
                                    <button type="button" data-bs-target="#reviewcarouselIndicators"
                                            data-bs-slide-to="1" aria-label="Slide 2"></button>
                                    <button type="button" data-bs-target="#reviewcarouselIndicators"
                                            data-bs-slide-to="2" aria-label="Slide 3"></button>
                                </div>
                                <!-- end carouselIndicators -->

                                <!-- end carousel-inner -->
                            </div>
                            <!-- end review carousel -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
</div>
<!-- end container fluid -->
</div>


<!-- JAVASCRIPT -->
<script src="{{url('assets/libs/jquery/jquery.min.js')}}"></script>
<script src="{{url('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{url('assets/libs/metismenu/metisMenu.min.js')}}"></script>
<script src="{{url('assets/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{url('assets/libs/node-waves/waves.min.js')}}"></script>
<script src="{{url('assets/libs/feather-icons/feather.min.js')}}"></script>
<!-- pace js -->
<script src="{{url('assets/libs/pace-js/pace.min.js')}}"></script>
<!-- password addon init -->
<script src="{{url('assets/js/pages/pass-addon.init.js')}}"></script>

</body>


</html>
