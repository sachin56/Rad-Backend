<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="index.php" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="{{url(env('ASSETS_PATH').'/images/logo.jpg')}}" alt="" height="24">
                                </span>
                    <span class="logo-lg">
                                    <img src="{{url(env('ASSETS_PATH').'/images/logo.jpg')}}" alt="" height="24"> <span class="logo-txt"></span>
                                </span>
                </a>

                <a href="index-2.html" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="{{url(env('ASSETS_PATH').'/images/logo.jpg')}}" alt="" height="24">
                                </span>
                    <span class="logo-lg">
                                    <img src="{{url(env('ASSETS_PATH').'/images/logo.jpg')}}" alt="" height="24"> <span class="logo-txt"></span>
                                </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 header-item" id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>

            <!-- App Search-->
            <!--<form class="app-search d-none d-lg-block">
                <div class="position-relative">
                    <input type="text" class="form-control" placeholder="Search...">
                    <button class="btn btn-primary" type="button"><i class="bx bx-search-alt align-middle"></i></button>
                </div>
            </form>-->
        </div>

        <div class="d-flex">

            <div class="dropdown d-inline-block d-lg-none ms-2">
                <button type="button" class="btn header-item" id="page-header-search-dropdown"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i data-feather="search" class="icon-lg"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                     aria-labelledby="page-header-search-dropdown">
                </div>
            </div>

            @can('notification-view')
                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item noti-icon position-relative" id="page-header-notifications-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i data-feather="bell" class="fa fa-bell icon-lg"></i>
                        <span class="badge bg-danger rounded-pill" id="new_order_count"></span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                         aria-labelledby="page-header-notifications-dropdown">
                        <div class="p-3">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="m-0"> New Orders </h6>
                                </div>

                                <div class="col-auto">

                                </div>

                            </div>
                        </div>
                        <div data-simplebar id="order_notification_box">

                        </div>
                    </div>
                </div>

                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item noti-icon position-relative" id="page-header-notifications-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i data-feather="bell" class="fa fa-bell-slash icon-lg"></i>
                        <span class="badge bg-danger rounded-pill" id="cancel_request_count"></span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                         aria-labelledby="page-header-notifications-dropdown">
                        <div class="p-3">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="m-0"> Cancel Requests </h6>
                                </div>

                                <div class="col-auto">

                                </div>

                            </div>
                        </div>
                        <div data-simplebar id="cancel_request_notification_box">

                        </div>
                    </div>
                </div>
            @endcan

            <div class="dropdown d-none d-sm-inline-block" style="margin-right: 8%;">
                {{--<button type="button" class="btn header-item" id="mode-setting-btn">
                    <i data-feather="moon" class="fa fa-sun icon-lg layout-mode-dark"></i>
                    <i data-feather="sun" class="fa fa-moon icon-lg layout-mode-light"></i>
                </button>--}}
            </div>

            {{--<div class="dropdown d-inline-block">
                <button type="button" class="btn header-item right-bar-toggle me-2">
                    <i data-feather="settings" class="icon-lg"></i>
                </button>
            </div>--}}

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item bg-soft-light border-start border-end" id="page-header-user-dropdown"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="{{url(env('ASSETS_PATH').'/images/users/avatar-1.jpg')}}"
                         alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ms-1 fw-medium">{{ Auth::guard('petsitter')->user()->name ?? null }}</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    {{-- <a class="dropdown-item" href="{{ route('admin.profile') }}"><i class="mdi mdi-face-profile font-size-16 align-middle me-1"></i> Profile</a> --}}
                    <div class="dropdown-divider"></div>
                    <form method="post" action="{{route('pet-sitter.logout')}}">
                        @csrf
                        <button class="dropdown-item">
                            <i class="mdi mdi-logout font-size-16 align-middle me-1"></i>
                            Logout
                        </button>
                    </form>
                    <a href="{{ route('shop-vendor.profile') }}" class="dropdown-item">
                        <i class="mdi mdi-logout font-size-16 align-middle me-1"></i>
                        Profile
                    </a>
                </div>
            </div>

        </div>
    </div>
</header>
