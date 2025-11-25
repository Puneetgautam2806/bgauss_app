<!-- Menu -->
@php
$currentPath = request()->path(); 

// for active state
@endphp
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
      <a href="javascript:void(0)" class="app-brand-link">
        <span class="app-brand-logo demo">
            <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" width="25">
        </span>
        <span class="app-brand-text demo menu-text fw-bold ms-2">Repair Panel</span>
      </a>

      <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
        <i class="bx bx-chevron-left bx-sm d-flex align-items-center justify-content-center"></i>
      </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        @foreach ($parentMenus as $parentMenu)
            @php
            // dd($parentMenu->path);
                $isActiveMenu = !empty($parentMenu->path) && str_contains($currentPath, $parentMenu->path) ? 'active' : '';
                $isOpenMenu = !empty($parentMenu->path) && str_contains($currentPath, $parentMenu->path) ? 'open' : '';
            @endphp

            @if ($parentMenu->is_parent && $parentMenu->children->count() > 0)
                <!-- Parent Menu with Children -->
                <li class="menu-item  {{ $isOpenMenu  }} {{ $isActiveMenu }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        @if ($parentMenu->icon)
                            <i class="menu-icon tf-icons {{ $parentMenu->icon }}"></i>
                        @endif
                        <div class="text-truncate" data-i18n="{{ $parentMenu->menu_name }}">{{ $parentMenu->menu_name }}</div>
                    </a>

                    <ul class="menu-sub">
                        @foreach ($parentMenu->children as $subMenu)
                            @php
            $isActiveSub = str_contains($currentPath, $subMenu->path ?? '') ? 'active' : '';
                            @endphp
                            <li class="menu-item {{ $isActiveSub }}">
                                <a href="{{ $subMenu->path ? url($subMenu->path) : '#' }}" class="menu-link">
                                    <div class="text-truncate" data-i18n="{{ $subMenu->menu_name }}">{{ $subMenu->menu_name }}</div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @else
                <!-- Single Menu Item -->
                <li class="menu-item {{ $isActiveMenu }}">
                    <a href="{{ $parentMenu->path ? url($parentMenu->path) : '#' }}" class="menu-link">
                        @if ($parentMenu->icon)
                            <i class="menu-icon tf-icons {{ $parentMenu->icon }}"></i>
                        @endif
                        <div class="text-truncate" data-i18n="{{ $parentMenu->menu_name }}">{{ $parentMenu->menu_name }}</div>
                    </a>
                </li>
            @endif
        @endforeach
    </ul>
</aside>
<!-- / Menu -->
