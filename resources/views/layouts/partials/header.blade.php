<div id="kt_app_header" class="app-header d-flex flex-column flex-stack">
   <!--begin::Header main-->
   <div class="d-flex flex-stack flex-grow-1">
      @persist('header-logo')
         <div class="app-header-logo d-flex align-items-center ps-lg-12" id="kt_app_header_logo">
            <!--begin::Sidebar toggle-->
            <div id="kt_app_sidebar_toggle" class="app-sidebar-toggle btn btn-sm btn-icon bg-body btn-color-gray-500 btn-active-color-primary w-30px h-30px ms-n2 me-4 d-none d-lg-flex"
               data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="app-sidebar-minimize">
               <i class="ki-outline ki-abstract-14 fs-3 mt-1"></i>
            </div>
            <!--end::Sidebar toggle-->
            <!--begin::Sidebar mobile toggle-->
            <div class="btn btn-icon btn-active-color-primary w-35px h-35px ms-3 me-2 d-flex d-lg-none" id="kt_app_sidebar_mobile_toggle">
               <i class="ki-outline ki-abstract-14 fs-2"></i>
            </div>
            <!--end::Sidebar mobile toggle-->
            <!--begin::Logo-->
            <a href="{{ route('dashboard') }}" class="app-sidebar-logo me-2">
               <img alt="Logo" src="{{ asset('assets/images/favicon.png') }}" class="h-50px w-100 theme-light-show" />
               {{-- <img alt="Logo" src="{{ asset('assets/images/header.png') }}" class="h-50px w-100 theme-light-show" /> --}}
               {{-- <img alt="Logo" src="{{ asset('assets/images/favicon.png') }}" class="h-25px theme-dark-show" /> --}}
            </a>
            <h3 class="d-flex align-self-end my-auto" style="color: #ff7676; letter-spacing: 3px;">ITAMA 95</h3>
            <!--end::Logo-->
         </div>
      @endpersist

      <!--begin::Navbar-->
      <div class="app-navbar flex-grow-1 justify-content-end" id="kt_app_header_navbar">
         <div class="app-navbar-item d-flex align-items-stretch flex-lg-grow-1">
            <!--begin::Search-->
            @include('layouts.partials.header.search')
            <!--end::Search-->
         </div>
         
         <!--begin::User menu-->
         @include('layouts.partials.header.users-dropdown')
         <!--end::User menu-->
         <!--begin::Header menu toggle-->
         <div class="app-navbar-item ms-2 ms-lg-6 ms-n2 me-3 d-flex d-lg-none">
            <div class="btn btn-icon btn-custom btn-color-gray-600 btn-active-color-primary w-35px h-35px w-md-40px h-md-40px" id="kt_app_aside_mobile_toggle">
               {{-- <i class="ki-outline ki-burger-menu-2 fs-2"></i> --}}
            </div>
         </div>
         <!--end::Header menu toggle-->
      </div>
      <!--end::Navbar-->
   </div>
   <!--end::Header main-->
   <!--begin::Separator-->
   <div class="app-header-separator"></div>
   <!--end::Separator-->
</div>