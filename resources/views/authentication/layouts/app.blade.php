<!DOCTYPE html>
<!--
Author: Ilham Prabu Zaky Setiawan
Vendor Company: Inti Optima Teknologi
Product Name: IKATAMA 95
Product Version: 1.0.0
Contact: ilhamprabuzakys@gmail.com
Follow: www.instagram.com/ilhamprabuzakyyys
-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!--begin::Head-->
<head>
   <base href="" />
   <title>{{ $title ?? '' }} | {{ config('app.name') }}</title>
   <meta charset="utf-8" />
   <meta name="description"
      content="IKATAMA 95" />
   <meta name="keywords"
      content="IKATAMA 95" />
   <meta name="viewport" content="width=device-width, initial-scale=1" />
   <meta property="og:locale" content="en_US" />
   <meta property="og:type" content="article" />
   <meta property="og:title"
      content="IKATAMA 95" />
   <meta property="og:url" content="{{ config('app.url') }}" />
   <meta property="og:site_name" content="IKATAMA 95" />
   <link rel="canonical" href="{{ config('app.url') }}" />
   <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />
   <!--begin::Fonts(mandatory for all pages)-->
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
   <!--end::Fonts-->
   <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
   <link href="{{ asset('assets/dist/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
   <link href="{{ asset('assets/dist/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
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

<body id="kt_body" class="app-blank">
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
      <!--begin::Authentication - Sign-in -->
      <div class="d-flex flex-column flex-lg-row flex-column-fluid">
         <!--begin::Body-->
         <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1 bg-light">
            <!--begin::Form-->
            <div class="d-flex flex-center flex-column flex-lg-row-fluid">
               <!--begin::Wrapper-->
               <div class="w-lg-500px p-10">
                  {{ $slot }}
               </div>
               <!--end::Wrapper-->
            </div>
            <!--end::Form-->
            <!--begin::Footer-->
            <div class="w-lg-500px d-flex flex-stack px-10 mx-auto">
               <!--begin::Languages-->
               <div class="me-10">
               </div>
               <!--end::Languages-->
               <!--begin::Links-->
               <div class="d-flex fw-semibold text-primary fs-base gap-5">
                  {{-- <a href="{{ route('survey.isi') }}">Isi Survey Disini</a> --}}
               </div>
               <div class="d-flex fw-semibold text-primary fs-base gap-5">
                  <a href="javascript:void(0);" data-bs-target="#eulaModal" data-bs-toggle="modal" target="_blank">Persyaratan dan Kondisi</a>
               </div>
               <!--end::Links-->
            </div>
            <!--end::Footer-->
         </div>
         <!--end::Body-->
         <!--begin::Aside-->
         <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2" style="background-image: url(assets/images/auth/background.png2)">
            <!--begin::Content-->
            <div class="d-flex flex-column flex-center py-7 py-lg-15 px-5 px-md-15 w-100">
               <!--begin::Logo-->
               @persist('logo')
               <a href="javascript:void(0);" class="mb-0 mb-lg-0">
                  <img alt="Logo" src="{{ asset('assets/images/favicon.png') }}" class="h-60px h-lg-75px" />
                  {{-- <h2 class="text">IKATAMA 95</h2> --}}
               </a>
               @endpersist
               <!--end::Logo-->
               <!--begin::Image-->
               {{-- <img class="d-none d-lg-block mx-auto w-275px w-md-50 w-xl-500px mb-10 mb-lg-20" src="assets/images/auth/background.png" alt="" /> --}}
               @persist('3dlogo')
               <div id="3dLogo" style="width: 400px; height: 400px;"></div>
               {{-- <div class="bg-dark">
               </div> --}}
               @endpersist
               {{-- <div class="mx-auto">
               </div> --}}
               <!--end::Image-->
               <!--begin::Title-->
               {{-- <h1 class="d-none d-lg-block text-white fs-2qx fw-bolder text-center mb-7">Fast, Efficient and Productive</h1>
               <!--end::Title-->
               <!--begin::Text-->
               <div class="d-none d-lg-block text-white fs-base text-center">In this kind of post,
                  <a href="#" class="opacity-75-hover text-warning fw-bold me-1">the blogger</a>introduces a person they’ve interviewed
                  <br />and provides some background information about
                  <a href="#" class="opacity-75-hover text-warning fw-bold me-1">the interviewee</a>and their
                  <br />work following this is a transcript of the interview.
               </div>
               <!--end::Text--> --}}
            </div>
            <!--end::Content-->
         </div>
         <!--end::Aside-->
      </div>
      <!--end::Authentication - Sign-in-->
   </div>
   <!--end::Root-->

   {{-- Modal --}}
   <div class="modal fade" tabindex="-1" id="eulaModal">
      <div class="modal-dialog modal-xl modal-dialog-scrollable">
         <div class="modal-content">
            <div class="modal-header">
               <h2 class="modal-title">Persyaratan dan Kondisi</h2>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body ">
               <!-- Hover added -->
               <h1>Perjanjian Lisensi Pengguna Akhir</h1>
               <hr>

               <h2>Pengantar</h2>
               <p>Selamat datang di Perjanjian Lisensi Pengguna Akhir (EULA) untuk perangkat lunak ini. Harap baca dengan seksama sebelum menggunakan perangkat lunak ini.</p>

               <h2>Definisi</h2>
               <ul>
                  <li><strong>Perangkat Lunak:</strong> Merujuk kepada perangkat lunak yang disediakan oleh instansi pemerintah ini.</li>
                  <li><strong>Pengguna:</strong> Merujuk kepada pengguna akhir yang menggunakan perangkat lunak ini.</li>
               </ul>

               <h2>Perjanjian</h2>
               <p>Dengan menggunakan perangkat lunak ini, Anda menyetujui syarat dan ketentuan dalam EULA ini. Jika Anda tidak menyetujui EULA ini, Anda tidak diperbolehkan untuk menggunakan perangkat
                  lunak ini.</p>

               <h2>Hak dan Kewajiban</h2>
               <ul>
                  <li><strong>Hak:</strong> Anda memiliki hak untuk menggunakan perangkat lunak ini sesuai dengan pedoman yang diberikan oleh instansi pemerintah.</li>
                  <li><strong>Kewajiban:</strong> Anda berkewajiban untuk mengikuti semua pedoman dan ketentuan yang diberikan oleh instansi pemerintah terkait penggunaan perangkat lunak ini.</li>
                  <li><strong>Ketentuan Tambahan:</strong> Anda juga setuju untuk:
                     <ul>
                        <li>Menjaga kerahasiaan informasi yang diberikan oleh perangkat lunak ini.</li>
                        <li>Tidak menggandakan, mendistribusikan, atau menjual perangkat lunak ini tanpa izin tertulis dari instansi pemerintah.</li>
                        <li>Menggunakan perangkat lunak ini sesuai dengan hukum yang berlaku.</li>
                        <li>Memberikan umpan balik dan laporan ke instansi pemerintah sesuai dengan permintaan mereka.</li>
                     </ul>
                  </li>
               </ul>

               <h2>Pembaruan dan Perubahan</h2>
               <p>Instansi pemerintah berhak untuk melakukan pembaruan dan perubahan pada perangkat lunak ini tanpa pemberitahuan sebelumnya.</p>

               <h2>Batasan Tanggung Jawab</h2>
               <ul>
                  <li>Perangkat lunak ini disediakan "apa adanya," dan instansi pemerintah tidak bertanggung jawab atas kerugian atau kerusakan yang timbul dari penggunaan perangkat lunak ini.</li>
                  <li>Instansi pemerintah tidak memberikan jaminan eksplisit atau implisit terkait performa atau keandalan perangkat lunak ini.</li>
               </ul>

               <h2>Penutup</h2>
               <p>Perjanjian ini berlaku sejak Anda mulai menggunakan perangkat lunak ini. Instansi pemerintah berhak untuk mengakhiri perjanjian ini jika Anda melanggar ketentuan yang disebutkan di
                  atas.</p>

               <p><em>Terima kasih telah menggunakan perangkat lunak ini.</em></p>

            </div>
         </div>
      </div>
   </div>
   {{-- END Modal --}}

   @livewireScripts
   <!--begin::Javascript-->
   <script>
      var hostUrl = "assets/dist/assets/";
   </script>
   <!--begin::Global Javascript Bundle(mandatory for all pages)-->
   <script src="{{ asset('assets/dist/assets/plugins/global/plugins.bundle.js') }}"></script>
   <script src="{{ asset('assets/dist/assets/js/scripts.bundle.js') }}"></script>
   <!--end::Global Javascript Bundle-->
   <!--begin::Custom Javascript(used for this page only)-->
   <script src="{{ asset('assets/dist/assets/js/custom/authentication/sign-in/general.js') }}"></script>
   <!--end::Custom Javascript-->
   @stack('js')
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
   <!--end::Javascript-->
</body>
<!--end::Body-->

</html>
