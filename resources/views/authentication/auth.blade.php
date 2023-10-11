<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
   <base href="../../../" />
   <title>{{ $title ?? config('app.name') }} - {{ config('app.name') }}</title>
   <meta charset="utf-8" />
   <meta name="description"
      content="SIPARELNEW." />
   <meta name="keywords"
      content="SIPARELNEW" />
   <meta name="viewport" content="width=device-width, initial-scale=1" />
   <meta property="og:locale" content="en_US" />
   <meta property="og:type" content="article" />
   <meta property="og:title"
      content="SIPARELNEW" />
   <meta property="og:url" content="{{ config('app.url') }}" />
   <meta property="og:site_name" content="Keenthemes | Metronic" />
   <link rel="canonical" href="{{ config('app.url') }}" />
   <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />
   <!--begin::Fonts(mandatory for all pages)-->
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
   <!--end::Fonts-->
   <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
   <link href="assets/dist/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
   <link href="assets/dist/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
   <!--end::Global Stylesheets Bundle-->

   {{-- Three JS --}}
   <script async src="https://ga.jspm.io/npm:es-module-shims@1.7.3/dist/es-module-shims.js"></script>
   <script type="importmap">
   {
      "imports": {
         "three": "https://unpkg.com/three@0.145.0/build/three.module.js"
      }
   }
   </script>
   <script type="module" src="{{ asset('assets/js/pages/authentication/three.js') }}"></script>
   @livewireStyles
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="app-blank bgi-size-cover bgi-attachment-fixed bgi-position-center">
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
   <!--end::Theme mode setup on page load-->
   <!--begin::Root-->
   <div class="d-flex flex-column flex-root" id="kt_app_root">
      <!--begin::Page bg image-->
      <style>
         body {
            background-image: url('assets/dist/assets/media/auth/bg10.jpeg');
         }

         [data-bs-theme="dark"] body {
            background-image: url('assets/dist/assets/media/auth/bg10-dark.jpeg');
         }
      </style>
      <!--end::Page bg image-->
      <!--begin::Authentication - Sign-in -->
      <div class="d-flex flex-column flex-lg-row flex-column-fluid">
         <!--begin::Aside-->
         <div class="d-flex flex-lg-row-fluid">
            <!--begin::Content-->
            <div class="d-flex flex-column flex-center pb-0 pb-lg-10 p-10 w-100">

               <div class="mx-auto">
                  <div id="3dLogo" style="width: 400px; height: 400px;"></div>
               </div>

               <!--begin::Title-->
               <h1 class="text-gray-800 fs-2qx fw-bold text-center mb-7">Sistem Informasi Pelaporan Relawan</h1>
               <!--end::Title-->
               <!--begin::Text-->
               <div class="text-gray-600 fs-base text-center fw-semibold">
                  Sistem yang memudahkan relawan dalam membuat laporan kegiatan,<br>
                  Dan ini merupakan sebuah wadah untuk mengelola Laporan kegiatan tersebut.
               </div>
               <!--end::Text-->
            </div>
            <!--end::Content-->
         </div>
         <!--begin::Aside-->
         <!--begin::Body-->
         <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12">
            <!--begin::Wrapper-->
            <div class="bg-body d-flex flex-column flex-center rounded-4 w-md-600px p-10">
               <!--begin::Content-->
               <div class="d-flex flex-center flex-column align-items-stretch h-lg-100 w-md-400px">
                  <!--begin::Wrapper-->
                  <div class="d-flex flex-center flex-column flex-column-fluid pb-15 pb-lg-20">
                     {{ $slot }}
                  </div>
                  <!--end::Wrapper-->
                  <!--begin::Footer-->
                  <div class="d-flex">
                     <!--begin::Links-->
                     <div class="d-flex fw-semibold text-primary fs-base gap-5 mx-auto">
                        <a href="../../demo39/dist/pages/team.html" target="_blank">Pesyaratan dan Ketentuan</a>
                        <a href="../../demo39/dist/pages/contact.html" target="_blank">Hubungi Kami</a>
                     </div>
                     <!--end::Links-->
                  </div>
                  <!--end::Footer-->
               </div>
               <!--end::Content-->
            </div>
            <!--end::Wrapper-->
         </div>
         <!--end::Body-->
      </div>
      <!--end::Authentication - Sign-in-->
   </div>
   <!--end::Root-->
   <!--begin::Javascript-->
   @livewireScripts
   <script>
      var hostUrl = "assets/dist/assets/";
   </script>
   <!--begin::Global Javascript Bundle(mandatory for all pages)-->
   <script src="{{ asset('assets/dist/assets/plugins/global/plugins.bundle.js') }}"></script>
   <script src="{{ asset('assets/dist/assets/js/scripts.bundle.js') }}"></script>
   <!--end::Global Javascript Bundle-->

   {{-- Vendor --}}
   <script src="{{ asset('assets/src/js/vendors/plugins/sweetalert2.init.js') }}"></script>

   <!--begin::Custom Javascript(used for this page only)-->
   <script src="{{ asset('assets/dist/assets/js/custom/authentication/sign-in/general.js') }}"></script>
   <!--end::Custom Javascript-->
   <!--end::Javascript-->

   {{-- Custom --}}
   {{-- <script src="{{ asset('assets/js/pages/authentication/general.js') }}"></script> --}}
   <script>
      Livewire.on('swal:modal', data => {
         Swal.fire({
            title: data[0].title,
            html: data[0].text,
            icon: data[0].icon,
            showConfirmButton: true,
            // confirmButtonText: 'Okay',
            timer: data[0].duration ?? 2500,
            timerProgressBar: true,
            allowOutsideClick: false,
         })
      });
   </script>
   @stack('js')
</body>
<!--end::Body-->

</html>
