<!-- BEGIN Left Aside -->
<aside class="page-sidebar">
    <div class="page-logo">
        <a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative" >
            <img src="{{ url('/back/img/logo.png') }}" alt="SmartAdmin Laravel" aria-roledescription="logo">
            <span class="mr-1 page-logo-text">Sri Buddy</span>
        </a>
    </div>
    <!-- BEGIN PRIMARY NAVIGATION -->
    <nav id="js-primary-nav" class="primary-nav" role="navigation">
        <div class="nav-filter">
            <div class="position-relative">
                <a href="#" onclick="return false;" class="btn-primary btn-search-close js-waves-off" data-action="toggle" data-class="list-filter-active" data-target=".page-sidebar">
                    <i class="fal fa-chevron-up"></i>
                </a>
            </div>
        </div>
        <div class="info-card">
            @if(isset(Auth::user()->profile_image))
                <a href="#" data-toggle="dropdown" title="drlantern@gotbootstrap.com" class="ml-2 header-icon d-flex align-items-center justify-content-center">
                    <img src="{{ asset('storage/userprofile/' . Auth::user()->profile_image) }}" class="profile-image rounded-circle" alt="Dr. Codex Lantern" style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%;">
                </a>
            @else
                <a href="#" data-toggle="dropdown" title="drlantern@gotbootstrap.com" class="ml-2 header-icon d-flex align-items-center justify-content-center">
                    <img src="{{ url('public/assets/img/profileicon.jpg') }}" class="profile-image rounded-circle" alt="Dr. Codex Lantern" style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%;">
                </a>
            @endif
            <div class="info-card-text">
                <a href="#" class="text-white d-flex align-items-center">
                    <span class="text-truncate text-truncate-sm d-inline-block">
                        {{ Auth::user()->name }}
                    </span>
                </a>
                <span class="d-inline-block text-truncate text-truncate-sm"></span>
            </div>
            <img src="{{ url('/back/img/backgrounds/bg-3.png') }}" class="cover" alt="cover">
            <a href="#" onclick="return false;" class="pull-trigger-btn" data-action="toggle" data-class="list-filter-active" data-target=".page-sidebar" data-focus="nav_filter_input">
                <i class="fal fa-angle-down"></i>
            </a>
        </div>

        <ul id="js-nav-menu" class="nav-menu">
            @foreach ($menuItems as $item)
                @if(in_array($item->id, $arrParentID))
                    @if($item->is_parent == 1 && $item->child_order == 1)
                        <li class="{{ request()->is($item->url) ? 'active' : '' }}">
                            <a href="{{ url($item->url) }}" title="{{ $item->title }}" data-filter-tags="{{ $item->title }}">
                                <i class="{{ $item->icon }}"></i>
                                <span class="nav-link-text">
                                    {{ $item->title }}
                                </span>
                            </a>
                        </li>
                    @else
                        @php
                            // Check if the current item is active
                            $isActive = request()->is($item->url) || 
                                        request()->is("$item->url/create") || 
                                        (strpos(request()->fullUrl(), "$item->url/edit") !== false);

                            // Determine if any submenu is active
                            $hasActiveSubmenu = collect($subMenuItems)->contains(function ($subItem) use ($item, $permissionHave) {
                                return $item->id == $subItem->parent_id &&
                                    in_array($subItem->id, $permissionHave) &&
                                    (request()->is($subItem->url) || 
                                        request()->is("$subItem->url/create") || 
                                        strpos(request()->fullUrl(), "$subItem->url/edit") !== false);
                            });
                        @endphp

                        <li class="{{ $isActive || $hasActiveSubmenu ? 'active' : '' }}{{ $item->is_parent && $hasActiveSubmenu ? ' open' : '' }}">
                            <a href="{{ $item->is_parent ? 'javascript:void(0);' : url($item->url) }}" title="{{ $item->title }}" data-filter-tags="{{ $item->title }}">
                                <i class="{{ $item->icon }}"></i>
                                <span class="nav-link-text">{{ $item->title }}</span>
                            </a>

                            @if($item->is_parent)
                                <ul class="nav submenu {{ $hasActiveSubmenu ? 'show' : '' }}">
                                    @foreach($subMenuItems as $subItem)
                                        @if($item->id == $subItem->parent_id && in_array($subItem->id, $permissionHave))
                                            <li class="{{ request()->is($subItem->url) || request()->is("$subItem->url/create") || strpos(request()->fullUrl(), "$subItem->url/edit") !== false ? 'active' : '' }}">
                                                <a href="{{ url($subItem->url) }}" title="{{ $subItem->title }}" data-filter-tags="{{ $subItem->title }}">
                                                    <span class="nav-link-text">{{ $subItem->title }}</span>
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endif
                @endif
            @endforeach
        </ul>
        <div class="filter-message js-filter-message bg-success-600"></div>
    </nav>
</aside>
<!-- END Left Aside -->