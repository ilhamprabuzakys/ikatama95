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

      header img.header {
         width: 100%;
         height: 200px;
         position: relative;
      }

      main .keluarga-biru img {
         width: 100%;
         height: auto;
         position: relative;
         bottom: 0;
      }
      .container {
         padding-left: 120px;
      }
      .container .gambar-keluarga {
         width: 90%;
         height: auto;
         position: relative;
         margin-top: 290px;
      }
   </style>
</head>

<body>
   <header>
      <img src="{{ asset('assets/images/pdf/PAGE-4-HEADER.png') }}" alt="" class="header">
   </header>
   
   <div class="container">
      <img src="{{ asset('assets/images/KELUARGA.jpg') }}" alt="" class="gambar-keluarga">
   </div>
   <main style="margin-top: 220px">
      <div class="keluarga-biru">
         <img src="{{ asset('assets/images/KELUARGA-BIRU.png') }}" alt="">
      </div>
   </main>
</body>

</html>
