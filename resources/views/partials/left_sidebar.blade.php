<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu" style="color: #0c63e4;">
                <li class="menu-title" data-key="t-menu">Menu</li>

                <li>
                    <a href="{{route('dashboard.index')}}">
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
                        <span data-key="t-dashboard">General Parameters</span>
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
                    </ul>
                </li>
                @endcan

                {{-- @can('order-management')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i class="bi bi-cart"></i>
                            <span data-key="t-dashboard">Retail Orders</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @can('order-view')
                                <li>
                                    <a href="{{route('admin.orders')}}">
                                        <i class="fa fa-long-arrow-alt-right"></i>
                                        <span data-key="t-dashboard">All Orders</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('admin.cancel-requests')}}">
                                        <i class="fa fa-long-arrow-alt-right"></i>
                                        <span data-key="t-dashboard">Cancel Requests</span>
                                    </a>
                                </li>
                            @endcan
                            @can('order-confirmed-view')
                                <li>
                                    <a href="{{route('admin.confirmed-orders')}}">
                                        <i class="fa fa-long-arrow-alt-right"></i>
                                        <span data-key="t-dashboard">Ready to ship Orders</span>
                                    </a>
                                </li>
                            @endcan
                            @can('order-modified-view')
                                <li>
                                    <a href="{{route('admin.modified-orders')}}">
                                        <i class="fa fa-long-arrow-alt-right"></i>
                                        <span data-key="t-dashboard">Modified Orders</span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan --}}

                {{-- @can('order-management')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i class="bi bi-cart"></i>
                            <span data-key="t-dashboard">WholeSale Orders</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @can('order-view')
                                <li>
                                    <a href="{{route('admin.wholesale-orders')}}">
                                        <i class="fa fa-long-arrow-alt-right"></i>
                                        <span data-key="t-dashboard">All Orders</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('admin.wholesale-cancel-requests')}}">
                                        <i class="fa fa-long-arrow-alt-right"></i>
                                        <span data-key="t-dashboard">Cancel Requests</span>
                                    </a>
                                </li>
                            @endcan
                            @can('order-confirmed-view')
                                <li>
                                    <a href="{{route('admin.wholesale-readytoship-orders')}}">
                                        <i class="fa fa-long-arrow-alt-right"></i>
                                        <span data-key="t-dashboard">Ready to Ship Orders</span>
                                    </a>
                                </li>
                            @endcan
                            @can('order-modified-view')
                                <li>
                                    <a href="{{route('admin.modified-wholesale-orders')}}">
                                        <i class="fa fa-long-arrow-alt-right"></i>
                                        <span data-key="t-dashboard">Modified Orders</span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan --}}

            {{-- @can('general-management')
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bi bi-app-indicator"></i>
                        <span data-key="t-dashboard">General Parameters</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        @can('brand-view')
                            <li>
                                <a href="{{route('admin.brand')}}">
                                    <i class="fa fa-long-arrow-alt-right"></i>
                                    <span data-key="t-dashboard">Brands</span>
                                </a>
                            </li>
                        @endcan
                        @can('family-view')
                            <li>
                                <a href="{{route('admin.category')}}">
                                    <i class="fa fa-long-arrow-alt-right"></i>
                                    <span data-key="t-dashboard">Category</span>
                                </a>
                            </li>
                        @endcan
                        @can('sector-view')
                            <li>
                                <a href="{{route('admin.size')}}">
                                    <i class="fa fa-long-arrow-alt-right"></i>
                                    <span data-key="t-dashboard">Size</span>
                                </a>
                            </li>
                        @endcan --}}
                        {{-- @can('type-view')
                            <li>
                                <a href="{{route('admin.machine-type')}}">
                                    <i class="fa fa-long-arrow-alt-right"></i>
                                    <span data-key="t-dashboard">Home Manager</span>
                                </a>
                            </li>
                        @endcan --}}
                    {{-- </ul>
                </li>
            @endcan --}}

            {{-- @can('product-management')
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bi bi-newspaper"></i>
                        <span data-key="t-dashboard">News Management</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        @can('product-view')
                            <li>
                                <a href="{{route('admin.news-list')}}">
                                    <i class="fa fa-long-arrow-alt-right"></i>
                                    <span data-key="t-dashboard">All News</span>
                                </a>
                            </li>
                        @endcan
                        @can('product-create')
                            <li>
                                <a href="{{route('admin.create-news')}}">
                                    <i class="fa fa-long-arrow-alt-right"></i>
                                    <span data-key="t-dashboard">Add News</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan --}}

            {{-- @can('product-management')
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bi bi-grid-1x2-fill"></i>
                        <span data-key="t-dashboard">Product Management</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        @can('product-view')
                            <li>
                                <a href="{{route('admin.product-list')}}">
                                    <i class="fa fa-long-arrow-alt-right"></i>
                                    <span data-key="t-dashboard">All Products</span>
                                </a>
                            </li>
                        @endcan
                        @can('product-create')
                            <li>
                                <a href="{{route('admin.create-product')}}">
                                    <i class="fa fa-long-arrow-alt-right"></i>
                                    <span data-key="t-dashboard">Add Product</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan --}}

            {{-- @can('product-management')
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bi bi-grid-1x2-fill"></i>
                        <span data-key="t-dashboard">Home Management</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        @can('product-view')
                            <li>
                                <a href="{{route('admin.home-header-banner')}}">
                                    <i class="fa fa-long-arrow-alt-right"></i>
                                    <span data-key="t-dashboard">Header Banners</span>
                                </a>
                            </li>
                        @endcan
                        @can('product-create')
                            <li>
                                <a href="{{route('admin.home-header-side-banner')}}">
                                    <i class="fa fa-long-arrow-alt-right"></i>
                                    <span data-key="t-dashboard">Side Banner</span>
                                </a>
                            </li>
                        @endcan
                        @can('product-create')
                        <li>
                            <a href="{{route('admin.home-featured-side-banner')}}">
                                <i class="fa fa-long-arrow-alt-right"></i>
                                <span data-key="t-dashboard">Featured Side Banner</span>
                            </a>
                        </li>
                        @endcan
                        @can('product-create')
                        <li>
                            <a href="{{route('admin.sales-banner')}}">
                                <i class="fa fa-long-arrow-alt-right"></i>
                                <span data-key="t-dashboard">Sales Banner</span>
                            </a>
                        </li>
                        @endcan
                        @can('product-create')
                        <li>
                            <a href="{{route('admin.fotter-banner')}}">
                                <i class="fa fa-long-arrow-alt-right"></i>
                                <span data-key="t-dashboard">Fotter Banner</span>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
            @endcan --}}
{{-- 
                @can('product-management')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i class="bi-receipt"></i>
                            <span data-key="t-dashboard">Sales</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @can('product-view')
                                <li>
                                    <a href="{{route('admin.sales-list')}}">
                                        <i class="fa fa-long-arrow-alt-right"></i>
                                        <span data-key="t-dashboard">All Sales</span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan --}}

                {{-- @can('report-management')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i class="fa fa-book-open"></i>
                            <span data-key="t-dashboard">Reports</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @can('order-wise-sales-report-view')
                                <li>
                                    <a href="{{route('admin.order-wise-sales')}}">
                                        <i class="fa fa-long-arrow-alt-right"></i>
                                        <span data-key="t-dashboard">Order Wise Sales</span>
                                    </a>
                                </li>
                            @endcan
                            @can('product-wise-sales-report-view')
                                <li>
                                    <a href="{{route('admin.product-wise-sales')}}">
                                        <i class="fa fa-long-arrow-alt-right"></i>
                                        <span data-key="t-dashboard">Product Wise Sales</span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan --}}

                {{-- @can('customer-management')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i class="bi bi-people-fill"></i>
                            <span data-key="t-dashboard">Customer Management</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @can('customer-create')
                                <li>
                                    <a href="{{route('admin.create-customer')}}">
                                        <i class="fa fa-long-arrow-alt-right"></i>
                                        <span data-key="t-dashboard">Add Customer</span>
                                    </a>
                                </li>
                            @endcan
                            @can('customer-view')
                                <li>
                                    <a href="{{route('admin.customer-list')}}">
                                        <i class="fa fa-long-arrow-alt-right"></i>
                                        <span data-key="t-dashboard">All Customers</span>
                                    </a>
                                </li>
                            @endcan --}}
                            {{-- @can('customer-role-create')
                                <li>
                                    <a href="{{route('admin.customer-role-create')}}">
                                        <i class="fa fa-long-arrow-alt-right"></i>
                                        <span data-key="t-dashboard">Add Customer Roles</span>
                                    </a>
                                </li>
                            @endcan --}}
                            {{-- @can('customer-role-view')
                                <li>
                                    <a href="{{route('admin.customer-role')}}">
                                        <i class="fa fa-long-arrow-alt-right"></i>
                                        <span data-key="t-dashboard">Customer Roles</span>
                                    </a>
                                </li>
                            @endcan --}}
                        {{-- </ul>
                    </li>
                @endcan --}}

                {{-- @can('user-management')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i class="bi bi-people-fill"></i>
                            <span data-key="t-dashboard">User Management</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @can('role-view')
                                <li>
                                    <a href="{{route('admin.user-role')}}">
                                        <i class="fa fa-long-arrow-alt-right"></i>
                                        <span data-key="t-dashboard">Role List</span>
                                    </a>
                                </li>
                            @endcan
                            @can('role-create')
                                <li>
                                    <a href="{{route('admin.user-role-create')}}">
                                        <i class="fa fa-long-arrow-alt-right"></i>
                                        <span data-key="t-dashboard">Add Role</span>
                                    </a>
                                </li>
                            @endcan
                            @can('user-create')
                                <li>
                                    <a href="{{route('admin.user-create')}}">
                                        <i class="fa fa-long-arrow-alt-right"></i>
                                        <span data-key="t-dashboard">Add User</span>
                                    </a>
                                </li>
                            @endcan
                            @can('user-view')
                                <li>
                                    <a href="{{route('admin.users')}}">
                                        <i class="fa fa-long-arrow-alt-right"></i>
                                        <span data-key="t-dashboard">All Users</span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan --}}
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
