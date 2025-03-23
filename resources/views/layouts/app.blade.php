@include('layouts.top')

<body>

<!-- <body data-layouts="horizontal"> -->

<!-- Begin page -->
<div id="layout-wrapper">

    @include('partials.header')

    <!-- ========== Left Sidebar Start ========== -->
    @include('partials.left_sidebar')
    <!-- Left Sidebar End -->

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <!-- breadcrumb -->
        @yield('breadcrumb')
        <!-- End Page-content -->

{{--        @include('partials.validation_errors')--}}
        @yield('content')

        @include('partials.footer')
    </div>
    <!-- end main content-->

</div>
<!-- END layouts-wrapper -->


<!-- Right Sidebar -->
@include('partials.right_sidebar')
<!-- /Right-bar -->

<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>

@include('layouts.bottom')

@yield('scripts')

@include('partials.notification_alerts')

</body>
</html>
