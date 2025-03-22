<?php
$headerMenuJson =
    '{ "quickShortcutJson":[{"title" : "Services","item1" : "base-2 icon-stack-3x color-primary-600","item2" : "base-3 icon-stack-2x color-primary-700", "item3" : "ni ni-settings icon-stack-1x text-white fs-lg" },{"title" : "Account", "item1" : "base-2 icon-stack-3x color-primary-400","item2" : "base-10 text-white icon-stack-1x", "item3" : "ni md-profile color-primary-800 icon-stack-2x"} ,{"title" : "Security", "item1" : "base-9 icon-stack-3x color-success-400","item2":"base-2 icon-stack-2x color-success-500", "item3" : "ni ni-shield icon-stack-1x text-white" },{ "isSpan" : "true","item1" : "base-18 icon-stack-3x color-info-700", "title" : "Calendar", "spanClass" : "position-absolute pos-top pos-left pos-right color-white fs-md mt-2 fw-400","spanText" : "28" },{"title" : "Stats","item1" : "base-7 icon-stack-3x color-info-500","item2" : "base-7 icon-stack-2x color-info-700", "item3" : "ni ni-graph icon-stack-1x text-white" },{"title" : "Messages","item1" : "base-4 icon-stack-3x color-danger-500","item2" : "base-4 icon-stack-1x color-danger-400", "item3" : "ni ni-envelope icon-stack-1x text-white" },{"title" : "Notes","item1" : "base-4 icon-stack-3x color-fusion-400","item2" : "base-5 icon-stack-2x color-fusion-200", "item3" : "fal fa-keyboard icon-stack-1x color-info-50" },{"title" : "Photos","item1" : "base-16 icon-stack-3x color-fusion-500","item2" : "base-10 icon-stack-1x color-primary-50 opacity-30", "item3" : "fal fa-dot-circle icon-stack-1x text-white opacity-85" },{"title" : "Maps","item1" : "base-19 icon-stack-3x color-primary-400","item2" : "base-7 icon-stack-1x fs-xxl color-primary-200", "item3" : "base-7 icon-stack-1x color-primary-500", "item4" : "fal fa-globe icon-stack-1x text-white opacity-85" },{"title" : "Chat","item1" : "base-5 icon-stack-3x color-success-700 opacity-80","item2" : "base-12 icon-stack-2x color-success-700 opacity-30", "item3" : "fal fa-comment-alt icon-stack-1x text-white" },{"title" : "Phone","item1" : "base-5 icon-stack-3x color-warning-600","item2" : "base-7 icon-stack-2x color-warning-800 opacity-50", "item3" : "fal fa-phone icon-stack-1x text-white" },{"title" : "Projects","item1" : "base-6 icon-stack-3x color-danger-600","item2" : "fal fa-chart-line icon-stack-1x text-white" }] }';

$notificationMenuJson =
    '{ "notificationJson":[{"liClass" : "unread","avatar" : "public/back/img/demo/avatars/avatar-a.png","title" : "Adison Lee","desc" : "Msed quia non numquam eius","min":"2 minutes ago" },{"liClass" : "","avatar" : "public/back/img/demo/avatars/avatar-b.png","title" : "Oliver Kopyuv","desc" : "Msed quia non numquam eius","min":"3 minutes ago" },{"liClass" : "","avatar" : "public/back/img/demo/avatars/avatar-e.png","title" : "Dr. John Cook PhD","desc" : "Msed quia non numquam eius","min":"2 minutes ago" },{"liClass" : "","avatar" : "public/back/img/demo/avatars/avatar-h.png","title" : "Sarah McBrook","desc" : "Msed quia non numquam eius","min":"3 minutes ago" },{"liClass" : "","avatar" : "public/back/img/demo/avatars/avatar-m.png","title" : "Anothony Bezyeth","desc" : "Msed quia non numquam eius","min":"one minutes ago" },{"liClass" : "","avatar" : "public/back/img/demo/avatars/avatar-j.png","title" : "Lisa Hatchensen","desc" : "Msed quia non numquam eius","min":"one minutes ago" }] }';

$profileJson = '{ "profileList":[{"dataAction":"app-reset","i18n" : "drpdwn.reset_layout","title" : "Reset Layout" },{"isModal" : "true", "dataTarget":".js-modal-profile","i18n" : "drpdwn.settings","title" : "View Profile" },{ "isModal" : "true", "dataTarget":".js-modal-settings","i18n" : "drpdwn.settings","title" : "Settings" },{ "isDivider" : "true" },{"dataAction":"app-fullscreen","i18n" : "drpdwn.fullscreen","title" : "Fullscreen", "iClass" : "float-right text-muted fw-n", "iText" : "F11" },{"dataAction":"app-print","i18n" : "drpdwn.print","title" : "Print", "iClass" : "float-right text-muted fw-n", "iText" : "Ctrl + P" }] }';
?>
<style>




</style>
<!-- BEGIN Page Header -->
<header class="page-header" role="banner">
    <!-- we need this logo when user switches to nav-function-top -->
    <div class="page-logo">
        <a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative"
            data-toggle="modal" data-target="#modal-shortcut">
            <img src="{{ url('public/assets/img/logo.png') }}" alt="SmartAdmin Laravel" aria-roledescription="logo">
            <span class="mr-1 page-logo-text">Si Buddy</span>
            <span class="mr-2 text-white opacity-50 position-absolute small pos-top pos-right mt-n2"></span>
            {{-- <i class="ml-1 fal fa-angle-down d-inline-block fs-lg color-primary-300"></i> --}}
        </a>
    </div>
    <!-- DOC: nav menu layout change shortcut -->
    <div class="hidden-md-down dropdown-icon-menu position-relative">
        <a href="#" class="header-btn btn js-waves-off" data-action="toggle" data-class="nav-function-hidden"
            title="Hide Navigation">
            <i class="ni ni-menu"></i>
        </a>
        <ul>
            <li>
                <a href="#" class="btn js-waves-off" data-action="toggle" data-class="nav-function-minify"
                    title="Minify Navigation">
                    <i class="ni ni-minify-nav"></i>
                </a>
            </li>
            <li>
                <a href="#" class="btn js-waves-off" data-action="toggle" data-class="nav-function-fixed"
                    title="Lock Navigation">
                    <i class="ni ni-lock-nav"></i>
                </a>
            </li>
        </ul>
    </div>
    <!-- DOC: mobile button appears during mobile width -->
    <div class="hidden-lg-up">
        <a href="#" class="header-btn btn press-scale-down" data-action="toggle" data-class="mobile-nav-on">
            <i class="ni ni-menu"></i>
        </a>
    </div>
    <div class="search">
        <form class="app-forms hidden-xs-down" role="search" action="/#" autocomplete="off">
            <input type="text" id="search-field" placeholder="Search for anything" class="form-control"
                tabindex="1">
            <a href="#" onclick="return false;" class="btn-danger btn-search-close js-waves-off d-none"
                data-action="toggle" data-class="mobile-search-on">
                <i class="fal fa-times"></i>
            </a>
        </form>
    </div>
    <div class="ml-auto d-flex">
        <!-- activate app search icon (mobile) -->
        <div class="hidden-sm-up">
            <a href="#" class="header-icon" data-action="toggle" data-class="mobile-search-on"
                data-focus="search-field" title="Search">
                <i class="fal fa-search"></i>
            </a>
        </div>
        <!-- app settings -->
        <div class="hidden-md-down">
            <a href="#" class="header-icon" data-toggle="modal" data-target=".js-modal-settings">
                <i class="fal fa-cog"></i>
            </a>
        </div>
        <!-- app shortcuts -->


        <div>
            {{-- <a href="#" class="header-icon" data-toggle="dropdown" title="My Apps">
                <i class="fal fa-cube"></i>
            </a> --}}
            <div class="w-auto h-auto dropdown-menu dropdown-menu-animated">
                <div
                    class="dropdown-header bg-trans-gradient d-flex justify-content-center align-items-center rounded-top">
                    <h4 class="m-0 text-center color-white">
                        Quick Shortcut
                        <small class="mb-0 opacity-80">User Applications & Addons</small>
                    </h4>
                </div>
                <div class="custom-scroll h-100">
                    <ul class="app-list">


                        <?php
                        $decodedMenu = json_decode($headerMenuJson);
                        ?>
                        @foreach ($decodedMenu->{'quickShortcutJson'} as $key => $value)
                            @if (isset($value->isSpan) && $value->isSpan === 'true')
                                <li>
                                    <a href="#" class="app-list-item hover-white">
                                        <span class="icon-stack">
                                            <i class="{{ $value->item1 }}"></i>
                                            <span class="{{ $value->spanClass }}">
                                                {{ $value->spanText }}
                                            </span>
                                        </span>
                                        <span class="app-list-name">
                                            {{ $value->title }}
                                        </span>
                                    </a>
                                </li>
                            @else
                                <li>
                                    <a href="#" class="app-list-item hover-white">
                                        <span class="icon-stack">
                                            <i class="{{ $value->item1 }}"></i>
                                            <i class="{{ $value->item2 }}"></i>
                                            @if (isset($value->item3))
                                                <i class="{{ $value->item3 }}"></i>
                                            @endif
                                            @if (isset($value->item4))
                                                <i class="{{ $value->item4 }}"></i>
                                            @endif
                                        </span>
                                        <span class="app-list-name">
                                            {{ $value->title }}
                                        </span>
                                    </a>
                                </li>
                            @endif
                        @endforeach
                        <li class="w-100">
                            <a href="#" class="pl-5 pr-5 mt-4 mb-2 btn btn-default"> Add more apps </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- app message -->
        {{-- <a href="#" class="header-icon" data-toggle="modal" data-target=".js-modal-messenger">
            <i class="fal fa-globe"></i>
            <span class="badge badge-icon">!</span>
        </a> --}}
        <!-- app notification -->
        <div>
            <a href="#" class="header-icon" data-toggle="dropdown"
                title="You got {{ auth()->user()->unreadNotifications->count() }} unread notifications">
                <i class="fal fa-bell"></i>
                @if (auth()->user()->unreadNotifications->count() > 0)

                <span class="badge badge-icon" id="new_order_count">{{ auth()->user()->unreadNotifications()->count() }}</span>
                @endif
            </a>
            @if (auth()->user()->unreadNotifications->count() > 0)
                <div class="p-0 dropdown-menu dropdown-menu-lg dropdown-menu-end"
                    aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-0">New Notifications</h6>
                            </div>
                        </div>
                    </div>
                    <div id="order_notification_box" style="max-height: 700px; overflow-y: auto;">
                        <!-- Notifications will be appended here -->
                    </div>
                </div>
            @else
                <div class="p-0 dropdown-menu dropdown-menu-lg dropdown-menu-end"
                    aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-0">No Notifications</h6>
                            </div>
                        </div>
                    </div>
                    <div id="order_notification_box" style="max-height: 700px; overflow-y: auto;">
                        <!-- Notifications will be appended here -->
                    </div>
                </div>
            @endif

        </div>
        <!-- app user menu -->
        <div>
            @if (isset(Auth::user()->profile_image))
                <a href="#" data-toggle="dropdown" title="drlantern@gotbootstrap.com"
                    class="ml-2 header-icon d-flex align-items-center justify-content-center">
                    <img src="{{ asset('storage/userprofile/' . Auth::user()->profile_image) }}"
                        class="profile-image rounded-circle" alt="Dr. Codex Lantern"
                        style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%;">
                </a>
            @else
                <a href="#" data-toggle="dropdown" title="drlantern@gotbootstrap.com"
                    class="ml-2 header-icon d-flex align-items-center justify-content-center">
                    <img src="{{ url('public/assets/img/profileicon.jpg') }}" class="profile-image rounded-circle"
                        alt="Dr. Codex Lantern"
                        style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%;">
                </a>
            @endif

            <div class="dropdown-menu dropdown-menu-animated dropdown-lg">
                <div class="flex-row py-4 dropdown-header bg-trans-gradient d-flex rounded-top">
                    <div class="flex-row mt-1 mb-1 d-flex align-items-center color-white">
                        <span class="mr-2">
                            @if (isset(Auth::user()->profile_image))
                                <img src="{{ asset('storage/userprofile/' . Auth::user()->profile_image) }}"
                                    class="profile-image rounded-circle" alt="Dr. Codex Lantern"
                                    style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%;">
                            @else
                                <img src="{{ url('public/assets/img/profileicon.jpg') }}" class="profile-image rounded-circle"
                                    alt="Dr. Codex Lantern"
                                    style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%;">
                            @endif
                        </span>
                        <div class="info-card-text">
                            <div class="fs-lg text-truncate text-truncate-lg">
                                {{ ucfirst(auth()->user()->name) }}
                            </div>
                            <span class="text-truncate text-truncate-md opacity-80">
                                {{ auth()->user()->email }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="m-0 dropdown-divider"></div>
                <?php $decodedProfile = json_decode($profileJson); ?>

                @foreach ($decodedProfile->{'profileList'} as $key => $value)
                    @if (isset($value->isModal) && $value->isModal === 'true')
                        <a href="#" class="dropdown-item" data-toggle="modal"
                            data-target="{{ $value->dataTarget }}">
                            <span data-i18n="{{ $value->i18n }}">{{ $value->title }}</span>
                        </a>
                    @elseif(isset($value->isDivider) && $value->isDivider === 'true')
                        <div class="m-0 dropdown-divider"></div>
                    @else
                        <a href="#" class="dropdown-item" data-action="{{ $value->dataAction }}">
                            <span data-i18n="{{ $value->i18n }}">{{ $value->title }}</span>
                            @if (isset($value->iClass))
                                <i class="{{ $value->iClass }}">{{ $value->iText }}</i>
                            @endif
                        </a>
                    @endif
                @endforeach

                <div class="m-0 dropdown-divider"></div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

                <a class="pt-3 pb-3 dropdown-item fw-500" href="#"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <span data-i18n="drpdwn.page-logout">Logout</span>
                    {{-- <span class="float-right fw-n">&commat;codexlantern</span> --}}
                </a>

            </div>
        </div>
    </div>
</header>
<!-- END Page Header -->
