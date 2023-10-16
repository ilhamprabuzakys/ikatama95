<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
   <style>
      * {
         margin: 0;
         padding: 0;
         box-sizing: border-box;
         list-style: none;
         text-decoration: none;
         font-family: sans-serif;
      }
   </style>
</head>

<body>
   <header class="header-container">
      <div class="image-container">
         <img src="{{ asset('assets/images/AKPOL-95.png') }}" alt="" class="akpol95">
         {{-- <img src="{{ asset($survey->foto_keluarga) }}" alt=""> --}}
         <img src="{{ asset('assets/images/favicon-polos-segitiga.png') }}" class="logoSegitiga">

      </div>
   </header>
   <main style="margin-top: 220px">
      <div class="nama">
         <h1>{{ $survey->nama }}</h1>
      </div>
      <hr class="main-hr">
      <div class="narasi">
         <p>{{ $survey->narasi_personal }}</p>
      </div>
   </main>
</body>

</html>
