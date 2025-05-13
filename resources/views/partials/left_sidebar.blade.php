<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu" style="color: #0c63e4;">
                <li class="menu-title" data-key="t-menu">Menu</li>

                <li>
                    <a href="{{route('dashboard')}}">
                        <i class="bi bi-house-door-fill"></i>
                        <span data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>

                @can('cutomer-view')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i class="bi bi-newspaper"></i>
                            <span data-key="t-dashboard">Customer Management</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @can('cutomer-view')
                                <li>
                                    <a href="{{route('customer.index')}}">
                                        <i class="fa fa-long-arrow-alt-right"></i>
                                        <span data-key="t-dashboard">All Customer</span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @can('general-management')
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bi bi-app-indicator"></i>
                        <span data-key="t-dashboard">General Management</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        @can('menu-view')
                            <li>
                                <a href="{{route('menu.index')}}">
                                    <i class="fa fa-long-arrow-alt-right"></i>
                                    <span data-key="t-dashboard">Menu</span>
                                </a>
                            </li>
                        @endcan
                        @can('menu-view')
                        <li>
                            <a href="{{route('clinics.index')}}">
                                <i class="fa fa-long-arrow-alt-right"></i>
                                <span data-key="t-dashboard">Clinics</span>
                            </a>
                        </li>
                    @endcan
                    </ul>
                </li>
                @endcan


                @can('pet-management')
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bi bi-app-indicator"></i>
                        <span data-key="t-dashboard">Pet Management</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        @can('register-pet-view')
                            <li>
                                <a href="{{route('registerd-pet.index')}}">
                                    <i class="fa fa-long-arrow-alt-right"></i>
                                    <span data-key="t-dashboard">Registerd Pet</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
                @endcan

                @can('e-book-view')
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bi bi-app-indicator"></i>
                        <span data-key="t-dashboard">E Book Management</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        @can('e-book-view')
                            <li>
                                <a href="{{route('e-book.index')}}">
                                    <i class="fa fa-long-arrow-alt-right"></i>
                                    <span data-key="t-dashboard">View E Book</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
                @endcan

                @can('e-book-view')
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bi bi-app-indicator"></i>
                        <span data-key="t-dashboard">Vet Management</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        @can('e-book-view')
                            <li>
                                <a href="{{route('doctor.index')}}">
                                    <i class="fa fa-long-arrow-alt-right"></i>
                                    <span data-key="t-dashboard">Doctor</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
                @endcan
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
