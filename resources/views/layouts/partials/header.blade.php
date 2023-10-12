<div id="kt_app_header" class="app-header d-flex flex-column flex-stack">
   <!--begin::Header main-->
   <div class="d-flex flex-stack flex-grow-1">
      @persist('header-logo')
         <div class="app-header-logo d-flex align-items-center ps-lg-12" id="kt_app_header_logo">
            {{--             <!--begin::Sidebar toggle-->
            <div id="kt_app_sidebar_toggle" class="app-sidebar-toggle btn btn-sm btn-icon bg-body btn-color-gray-500 btn-active-color-primary w-30px h-30px ms-n2 me-4 d-none d-lg-flex"
               data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="app-sidebar-minimize">
               <i class="ki-outline ki-abstract-14 fs-3 mt-1"></i>
            </div>
            <!--end::Sidebar toggle-->
            <!--begin::Sidebar mobile toggle-->
            <div class="btn btn-icon btn-active-color-primary w-35px h-35px ms-3 me-2 d-flex d-lg-none" id="kt_app_sidebar_mobile_toggle">
               <i class="ki-outline ki-abstract-14 fs-2"></i>
            </div>
            <!--end::Sidebar mobile toggle--> --}}

            <div id="kt_app_sidebar_toggle" class="app-sidebar-toggle btn btn-sm btn-icon bg-transparent btn-color-danger btn-active-color-danger w-30px h-30px ms-n2 me-4 d-none d-lg-flex"
               data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="app-sidebar-minimize">
               <span class="svg-icon svg-icon-2">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                     <path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="currentColor" />
                     <path opacity="0.3"
                        d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z"
                        fill="currentColor" />
                  </svg>
               </span>
            </div>
            <div class="btn btn-icon btn-active-color-primary w-35px h-35px ms-3 me-2 d-flex d-lg-none" id="kt_app_sidebar_mobile_toggle">
               <span class="svg-icon svg-icon-2">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                     <path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="currentColor" />
                     <path opacity="0.3"
                        d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z"
                        fill="currentColor" />
                  </svg>
               </span>
            </div>

            <!--begin::Logo-->

            {{-- <a href="{{ route('dashboard') }}" class="app-sidebar-logo me-2">
               <img alt="Logo" src="{{ asset('assets/images/favicon.png') }}" class="h-50px w-100 theme-light-show" />
               <img alt="Logo" src="{{ asset('assets/images/favicon.png') }}" class="h-50px w-100 theme-dark-show" />
            </a>
            <h3 class="d-flex align-self-end my-auto" style="color: #ff7676; letter-spacing: 3px;">ITAMA 95</h3> --}}
            <a href="https://siparelnew.id/" class="text-white" style="font-weight: bold;">
               <img alt="Logo" src="{{ asset('assets/images/favicon.png') }}" class="h-50px w-100" />
            </a>
            <span class="m-2 h1" style="color: #ff7676; letter-spacing: 2px;">ITAMA 95</span>
            <!--end::Logo-->
         </div>
      @endpersist

      <!--begin::Navbar-->
      <div class="app-navbar flex-grow-1 justify-content-end" id="kt_app_header_navbar">
         {{-- <div class="app-navbar-item d-flex align-items-stretch flex-lg-grow-1">
            <!--begin::Search-->
            @include('layouts.partials.header.search')
            <!--end::Search-->
         </div> --}}


         {{--  <!--begin::Menu toggle-->
         <a href="javascript:void(0);" class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px" data-kt-menu-trigger="{default:'click', lg: 'click'}"
            data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
            <i class="ki-duotone ki-night-day theme-light-show fs-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span
                  class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span></i> <i
               class="ki-duotone ki-moon theme-dark-show fs-1"><span class="path1"></span><span class="path2"></span></i></a>
         <!--begin::Menu toggle-->

         <!--begin::Theme Changer Menu-->
         @include('layouts.partials.header.theme-changer')
         <!--end::Theme Changer Menu--> --}}


         <!--begin::User menu-->
         @include('layouts.partials.header.users-dropdown')
         <!--end::Header menu toggle-->
      </div>
      <!--end::Navbar-->
   </div>
   <!--end::Header main-->
   <!--begin::Separator-->
   <div class="app-header-separator"></div>
   <!--end::Separator-->
</div>

@push('js')
   <script></script>
@endpush
