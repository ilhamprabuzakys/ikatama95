<!DOCTYPE html>
<!--
Author: Ilham Prabu Zaky Setiawan
Vendor Company: Inti Optima Teknologi
Product Name: SIDAMAS
Product Version: 1.0.0
Contact: ilhamprabuzakys@gmail.com
Follow: www.instagram.com/ilhamprabuzakyyys
-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
   <base href="" />
   <title>{{ $title ?? '' }} | {{ config('app.name') }}</title>
   <meta charset="utf-8" />
   <meta name="description"
      content="SIDAMAS." />
   <meta name="keywords"
      content="SIDAMAS" />
   <meta name="viewport" content="width=device-width, initial-scale=1" />
   <meta property="og:locale" content="en_US" />
   <meta property="og:type" content="article" />
   <meta property="og:title"
      content="SIDAMAS" />
   <meta property="og:url" content="{{ config('app.url') }}" />
   <meta property="og:site_name" content="SIDAMAS" />
   <link rel="canonical" href="{{ config('app.url') }}" />
   <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon" />
   <!--begin::Fonts(mandatory for all pages)-->
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
   <!--end::Fonts-->
   <!--begin::Vendor Stylesheets(used for this page only)-->
   <link href="{{ asset('assets/dist/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />
   <link href="{{ asset('assets/dist/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />

   {{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
   <link href="https://unpkg.com/survey-jquery/defaultV2.min.css" type="text/css" rel="stylesheet">
   <!--end::Vendor Stylesheets-->
   <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
   <link href="{{ asset('assets/dist/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
   <link href="{{ asset('assets/dist/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
   <!--end::Global Stylesheets Bundle-->
   @stack('css')
   @stack('style')
   @livewireStyles
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_app_body" data-kt-app-header-fixed="true" data-kt-app-header-fixed-mobile="true" data-kt-app-sidebar-enabled="true"
   data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true"
   data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true"class="app-default">
   <!--begin::Theme mode setup on page load-->
   <script>
      var defaultThemeMode = "light";
      var themeMode;
      if (document.documentElement) {
         if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
            themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
         } else {
            if (localStorage.getItem("data-bs-theme") !== null) {
               themeMode = localStorage.getItem("data-bs-theme");
            } else {
               themeMode = defaultThemeMode;
            }
         }
         if (themeMode === "system") {
            themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
         }
         document.documentElement.setAttribute("data-bs-theme", themeMode);
      }
   </script>

   {{--    <!--begin::loader-->
   <div class="app-page-loader">
      <span class="spinner-border text-primary" role="status">
         <span class="visually-hidden">Loading...</span>
      </span>
   </div>
   <!--end::Loader--> --}}

   <!--begin::loader-->
   <div class="page-loader flex-column">
      <img alt="Logo" class="theme-light-show max-h-20px" style="width: 120px;" src="{{ asset('assets/images/header.png') }}" />
      <img alt="Logo" class="theme-dark-show max-h-20px" style="width: 120px;" src="{{ asset('assets/images/header.png') }}" />

      <div class="d-flex align-items-center mt-5">
         <span class="spinner-border text-primary" role="status"></span>
         <span class="text-muted fs-6 fw-semibold ms-5">Tunggu sebentar ya...</span>
      </div>
   </div>
   <!--end::Theme mode setup on page load-->

   <!--begin::App-->
   <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
      <!--begin::Page-->
      <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
         @include('layouts.partials.header')
         <!--begin::Wrapper-->
         <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
            @include('layouts.partials.sidebar')
            <!--begin::Main-->
            <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
               <!--begin::Content wrapper-->
               <div class="d-flex flex-column flex-column-fluid">
                  <!--begin::Content-->
                  <div id="kt_app_content" class="app-content flex-column-fluid">
                     <!--begin::Content container-->
                     <div id="kt_app_content_container" class="app-container container-fluid">
                        @stack('breadcrumb')
                        {{ $slot }}
                     </div>
                     <!--end::Content container-->
                  </div>
                  <!--end::Content-->
               </div>
               <!--end::Content wrapper-->
               @include('layouts.partials.footer')
            </div>
            <!--end:::Main-->
            <!--begin::aside-->
            {{-- <div id="kt_app_aside" class="app-aside flex-column" data-kt-drawer="true" data-kt-drawer-name="app-aside" data-kt-drawer-activate="{default: true, lg: false}"
               data-kt-drawer-overlay="true" data-kt-drawer-width="auto" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_app_aside_mobile_toggle">
               <!--begin::Wrapper-->
               <div id="kt_app_aside_wrapper" class="d-flex flex-column align-items-center hover-scroll-y mt-lg-n3 py-5 py-lg-0 gap-4" data-kt-scroll="true"
                  data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_header" data-kt-scroll-wrappers="#kt_app_aside_wrapper"
                  data-kt-scroll-offset="5px">
                  <a href="../../demo39/dist/apps/calendar.html" class="btn btn-icon btn-color-primary bg-hover-body h-45px w-45px flex-shrink-0" data-bs-toggle="tooltip" title="Calendar"
                     data-bs-custom-class="tooltip-inverse">
                     <i class="ki-outline ki-calendar fs-2x"></i>
                  </a>
                  <a href="../../demo39/dist/account/overview.html" class="btn btn-icon btn-color-warning bg-hover-body h-45px w-45px flex-shrink-0" data-bs-toggle="tooltip" title="Profile"
                     data-bs-custom-class="tooltip-inverse">
                     <i class="ki-outline ki-address-book fs-2x"></i>
                  </a>
                  <a href="../../demo39/dist/apps/ecommerce/catalog/products.html" class="btn btn-icon btn-color-success bg-hover-body h-45px w-45px flex-shrink-0" data-bs-toggle="tooltip"
                     title="Messages" data-bs-custom-class="tooltip-inverse">
                     <i class="ki-outline ki-tablet-ok fs-2x"></i>
                  </a>
                  <a href="../../demo39/dist/apps/inbox/listing.html" class="btn btn-icon btn-color-dark bg-hover-body h-45px w-45px flex-shrink-0" data-bs-toggle="tooltip" title="Products"
                     data-bs-custom-class="tooltip-inverse">
                     <i class="ki-outline ki-calendar-add fs-2x"></i>
                  </a>
               </div>
               <!--end::Wrapper-->
            </div> --}}
            <!--end::aside-->
         </div>
         <!--end::Wrapper-->
      </div>
      <!--end::Page-->
   </div>
   <!--end::App-->
   <!--begin::Drawers-->
   @include('layouts.partials.drawer')
   <!--end::Drawers-->
   <!--begin::Scrolltop-->
   <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
      <i class="ki-outline ki-arrow-up"></i>
   </div>
   <!--end::Scrolltop-->

   @stack('modals')
   @include('layouts.partials.modals')
   <!--begin::Javascript-->
   <script>
      var hostUrl = "assets/dist/assets/";
   </script>
   <!--begin::Global Javascript Bundle(mandatory for all pages)-->
   <script src="{{ asset('assets/dist/assets/plugins/global/plugins.bundle.js') }}"></script>
   <script src="{{ asset('assets/dist/assets/js/scripts.bundle.js') }}"></script>
   @persist('survey')
   <script type="text/javascript" src="https://unpkg.com/survey-jquery/survey.jquery.min.js"></script>
   @endpersist
   <!--end::Global Javascript Bundle-->
   <!--begin::Vendors Javascript(used for this page only)-->
   <script src="{{ asset('assets/dist/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
   {{--    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
   <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
   <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
   <script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
   <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
   <script src="https://cdn.amcharts.com/lib/5/map.js"></script>
   <script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
   <script src="https://cdn.amcharts.com/lib/5/geodata/continentsLow.js"></script>
   <script src="https://cdn.amcharts.com/lib/5/geodata/usaLow.js"></script>
   <script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZonesLow.js"></script>
   <script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZoneAreasLow.js"></script> --}}

   <script src="{{ asset('assets/dist/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
   {{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <link href="https://unpkg.com/survey-jquery/defaultV2.min.css" type="text/css" rel="stylesheet">
   <script type="text/javascript" src="https://unpkg.com/survey-jquery/survey.jquery.min.js"></script> --}}
   <!--begin::Custom Javascript(used for this page only)-->
   <script src="{{ asset('assets/dist/assets/js/widgets.bundle.js') }}"></script>
   <script src="{{ asset('assets/dist/assets/js/custom/widgets.js') }}"></script>
   <script src="{{ asset('assets/dist/assets/js/custom/apps/chat/chat.js') }}"></script>
   <script src="{{ asset('assets/dist/assets/js/custom/utilities/modals/upgrade-plan.js') }}"></script>
   <script src="{{ asset('assets/dist/assets/js/custom/utilities/modals/users-search.js') }}"></script>
   <!--end::Custom Javascript-->
   <!--end::Javascript-->
   @stack('js')
   @stack('javascript')
   @stack('scripts')
   @livewireScripts
   @stack('script')
</body>
<!--end::Body-->

</html>
