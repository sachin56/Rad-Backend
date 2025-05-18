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


                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bi bi-app-indicator"></i>
                        <span data-key="t-dashboard">Shop Management</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        {{-- @can('e-book-view') --}}
                            <li>
                                <a href="{{route('categories.index')}}">
                                    <i class="fa fa-long-arrow-alt-right"></i>
                                    <span data-key="t-dashboard">Shop Categories</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('products.index')}}">
                                    <i class="fa fa-long-arrow-alt-right"></i>
                                    <span data-key="t-dashboard">Shop Product</span>
                                </a>
                            </li>
                        {{-- @endcan --}}
                    </ul>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
