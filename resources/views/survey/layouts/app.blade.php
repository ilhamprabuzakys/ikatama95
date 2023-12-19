<!doctype html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>{{ $title }}</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous">
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

   {{-- Vendor --}}
   <link href="https://unpkg.com/survey-jquery/defaultV2.min.css" type="text/css" rel="stylesheet">

   {{-- Fonts --}}
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@700&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
      integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">

   {{-- swal2 --}}
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <style>
      ::-webkit-scrollbar {
         width: 15px;
         background-color: #2f576d;
      }

      ::-webkit-scrollbar-thumb {
         height: 6px;
         border: 4px solid rgba(0, 0, 0, 0);
         background-clip: padding-box;
         -webkit-border-radius: 7px;
         background-color: #a9a9a9;
      }


      body {
         background-color: #2f576d;
      }

      .bg-patriatama {
         background-color: #003a5b;
      }

      .navbar-brand span {
         text-transform: uppercase;
         font-family: "Oswald";
         letter-spacing: 3px;
         color: #e8c84a;
      }

      span.maker {
         color: #e8c84a !important;
      }

      .header-survey h3 {
         text-transform: uppercase;
         font-family: "Oswald";
         letter-spacing: 3px;
         color: #ffd52b;
      }

      .sd-body.sd-body--static {
         max-width: 100%;
         padding-bottom: 10px;
      }

      .sv-components-column {
         padding-top: 0 !important;
         padding-bottom: 0 !important;
         margin: 0;
      }

      .sv-components-row {
         padding: 40px 0 0 0;
      }
   </style>
   @stack('styles')
   @livewireStyles

   <script src="
         https://cdn.jsdelivr.net/npm/sweetalert2@11.9.0/dist/sweetalert2.all.min.js
         "></script>
   <link href="
https://cdn.jsdelivr.net/npm/sweetalert2@11.9.0/dist/sweetalert2.min.css
" rel="stylesheet">

</head>

<body>
   <nav class="navbar navbar-expand-lg bg-patriatama navbar-dark">
      <div class="container-fluid">
         <a class="navbar-brand" href="{{ route('login') }}">
            <img src="{{ asset('assets/images/favicon.png') }}" alt="" style="width: 50px">
            {{-- <span class="logo-text">{{ config('app.name') }}</span> --}}
            <span class="logo-text" style="color: #ff7676; font-family: 'Oswald';">IKATAMA <span style="color: #e8c84a">95</span></span>
         </a>
         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
               <div class="gx-3">
                  <a href="https://www.facebook.com/ikatama95" target="_blank"><img src="{{ asset('assets/images/socials/facebook.png') }}"
                        alt="Follow me on Facebook" title="Follow me on Facebook"></a>

                  <a href="https://twitter.com/ikatama95" target="_blank"><img src="{{ asset('assets/images/socials/twitter.png') }}"
                        alt="Follow me on Twitter" title="Follow me on Twitter"></a>
                  <a href="https://www.instagram.com/ikatama95/" target="_blank"><img src="{{ asset('assets/images/socials/instagram.png') }}"
                        alt="Follow me on Instagram" title="Follow me on Instagram"></a>
                  <a href="https://www.youtube.com/channel/UCamlJXgVUdqLuyYmrxlu8TQ" target="_blank"><img
                        src="{{ asset('assets/images/socials/youtube.png') }}" alt="Follow me on Youtube" title="Follow me on Youtube"></a>
                  <a href="mailto:ikatama95@gmail.com" target="_blank"><img src="{{ asset('assets/images/socials/email.png') }}" alt="Send me a Email"
                        title="Send me a Email"></a>
               </div>
            </ul>
            <ul class="navbar-nav">
               <li class="nav-item">
                  <div>
                     @auth
                        <a class="nav-link text-white" href="{{ route('dashboard') }}">Kembali ke Dashboard <i class="fas fa-home ms-1"></i></a>
                     @else
                        <a class="nav-link text-white" href="{{ route('login') }}">Login <i class="fas fa-login ms-1"></i></a>
                     @endauth

                  </div>
               </li>
            </ul>
         </div>
      </div>
   </nav>

   <div class="container-lg container-sm-fluid">
      <div class="header-survey mt-5 text-white">
         <h3>Pengisian Survey Alumni Patriatama 95</h3>
         <hr>
      </div>
      {{ $slot }}
   </div>

   <div class="container">
      <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
         <div class="col-md-4 d-flex align-items-center">
            <a href="/" class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1">
               <svg class="bi" width="30" height="24">
                  <use xlink:href="#bootstrap" />
               </svg>
            </a>
            <div class="d-flex justify-content-between">
               <span class="text-white">Copyright © 2023.</span>
            </div>
         </div>

         <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
            <li class="ms-3">
               <span class="text-white">Proudly designed & developed by
               </span>
               <span class="maker">HS95™</span>
            </li>
         </ul>
      </footer>
   </div>
   @livewireScripts
   {{-- <script src="sweetalert2.min.js"></script> --}}
   @stack('scripts')
   @persist('custom-utils-js')
      <script src="{{ asset('assets/js/dashboard/utils.js') }}"></script>
   @endpersist
   @persist('survey')
      <script type="text/javascript" src="https://unpkg.com/survey-jquery/survey.jquery.min.js"></script>
   @endpersist
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
   </script>
</body>

</html>
