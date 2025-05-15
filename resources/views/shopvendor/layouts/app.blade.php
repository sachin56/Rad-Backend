@include('shopvendor.layouts.top')

<body>

<!-- <body data-layouts="horizontal"> -->

<!-- Begin page -->
<div id="layout-wrapper">

    @include('shopvendor.partials.header')

    <!-- ========== Left Sidebar Start ========== -->
    @include('shopvendor.partials.left_sidebar')
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

        @include('shopvendor.partials.footer')
    </div>
    <!-- end main content-->

</div>
<!-- END layouts-wrapper -->


<!-- Right Sidebar -->
@include('shopvendor.partials.right_sidebar')
<!-- /Right-bar -->

<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>

@include('shopvendor.layouts.bottom')

@yield('scripts')

@include('shopvendor.partials.notification_alerts')

</body>
</html>
