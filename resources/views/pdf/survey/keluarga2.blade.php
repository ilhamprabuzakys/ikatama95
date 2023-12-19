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

      .akpol95 {
         position: absolute;
         right: 0;
         top: 0;
      }

      .logoSegitiga {
         position: absolute;
         left: 3%;
         top: 8%;
         width: 150px;
         height: 150px;
      }

      hr.hr-header {
         width: -moz-available;
         height: auto;
         position: absolute;
         top: 13%;
         z-index: -1;
         border: 2px solid black;
      }

      .narasi-keluarga {
         position: absolute;
         bottom: 0;
      }
      
      .narasi-keluarga img {
         width: -moz-available;
      }

      .gambar-keluarga {
         width: 90%;
         max-height: 500px;
         position: relative;
         margin-top: 290px;
      }
   </style>
</head>

<body>
   <header class="header-container">
      <div class="image-container">
         <img src="{{ asset('assets/images/favicon-polos-segitiga.png') }}" class="logoSegitiga">
         <img src="{{ asset('assets/images/AKPOL-95-TR.png') }}" alt="" class="akpol95">
         <hr class="hr-header">
      </div>
   </header>
   <main>
      <div class="container-gambar-keluarga">
         <img src="{{ asset('assets/images/KELUARGA.jpg') }}" alt="" class="gambar-keluarga">
      </div>
      <div class="narasi-keluarga">
         <img src="{{ asset('assets/images/KELUARGA-BIRU.png') }}" alt="">
      </div>
   </main>
</body>

</html>
