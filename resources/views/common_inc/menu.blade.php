<!-- Menu -->

@php
$currentPath = request()->path(); // for active state
@endphp
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
      <a href="javascript:void(0)" class="app-brand-link">
        <span class="app-brand-logo demo">
          <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" width="25">
        </span>
        <span class="app-brand-text demo menu-text fw-bold ms-2">Naive Panel</span>
      </a>

      <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
        <i class="bx bx-chevron-left bx-sm d-flex align-items-center justify-content-center"></i>
      </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
      <!-- Dashboards -->
      <li class="menu-item active">
        <a href="{{route('dashboard')}}" class="menu-link   ">
          <i class="menu-icon tf-icons bx bx-home-smile"></i>
          <div class="text-truncate" data-i18n="Dashboards">Dashboards</div>
          
        </a>
        
      </li>

      <!-- Layouts -->
     
      {{-- @foreach ($categories as $category) --}}
      <li class="menu-header small text-uppercase">
        <span class="menu-header-text"></span>
      </li>
      {{-- @foreach ($parent_menus->where('category', $category->category) as $parent)
      @php
          $isActiveMenu = Str::contains($currentPath, $parent->path) ? 'active open' : '';
      @endphp --}}
      <li class="menu-item ">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx "></i>
          <div class="text-truncate" data-i18n=""></div>
        </a>

        <ul class="menu-sub">
          {{-- @foreach ($sub_menus->where('parent_id', $parent->id) as $sub)
                    @php
                        $isActiveSub = Str::contains($currentPath, $sub->path) ? 'active' : '';
                    @endphp --}}
          <li class="menu-item">
            <a href="#" class="menu-link">
              <div class="text-truncate" data-i18n=""></div>
            </a>
          </li>
          {{-- @endforeach --}}
          
        </ul>
      </li>
      {{-- @endforeach
      @endforeach --}}
     

    </ul>
  </aside>
  <!-- / Menu -->