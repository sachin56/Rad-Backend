@include('veterinarian.layouts.top')

<body>

<!-- <body data-layouts="horizontal"> -->

<!-- Begin page -->
<div id="layout-wrapper">

    @include('veterinarian.partials.header')

    <!-- ========== Left Sidebar Start ========== -->
    @include('veterinarian.partials.left_sidebar')
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

        @include('veterinarian.partials.footer')
    </div>
    <!-- end main content-->

</div>
<!-- END layouts-wrapper -->


<!-- Right Sidebar -->
@include('veterinarian.partials.right_sidebar')
<!-- /Right-bar -->

<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>

@include('veterinarian.layouts.bottom')

@yield('scripts')

@include('veterinarian.partials.notification_alerts')

</body>
</html>
