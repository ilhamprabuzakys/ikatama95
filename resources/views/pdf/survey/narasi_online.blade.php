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

      .header-container {
         height: 250px;
         width: 100%;
         background-color: #ECA019;
      }

      .header-container .image-container {
         width: 95%;
         height: 450px;
         background-color: #fff;
         border: 2px dashed black;
         margin: auto;
      }

      .header-container .image-container img {
         /* width: -webkit-fill-available; */
      }

      .header-container .image-container .akpol95 {
         position: absolute;
         top: 0;
         right: 3%;
         width: 13rem;
      }

      .header-container .image-container .logoSegitiga {
         width: 8rem;
         position: absolute;
         bottom: 55%;
         left: 79%;
         z-index: 99999 !important;
      }

      hr.main-hr {
         position: relative;
         border: none;
         height: 12px;
         width: 75%;
         background: #ffcf7c;
      }

      main {
         width: 100%;
         /* margin-left: 200px; */
         background-image: url("http://ikatama95.test/assets/images/favicon-polos-segitiga-opacity.png");
         /* background-color: #fff; */
         background-repeat: no-repeat;
         /* background-position: calc(50% - 100px) calc(50% - 15px); */
         background-position: center;
         height: 50%;

      }

      main .nama {
         margin-left: 3%;
      }

      main .nama h1 {
         font-family: 'Times New Roman', Times, serif;
         font-size: 2rem;
      }

      main .narasi {
         margin-top: 10px;
         margin-left: 3%;

      }

      main .narasi p {
         color: #3b3b3b;
         font-size: 1rem;
      }

      .imageTaruna {
         width: 100%;
         height: 448px;
         object-fit: contain;
         /* padding-left: 10px; */
      }
   </style>
</head>

<body>
   <header class="header-container">
      <div class="image-container">
         <img src="http://ikatama95.test/assets/images/AKPOL-95-TR.png" alt="" class="akpol95">
         <img src="http://ikatama95.test/assets/images/favicon-polos-segitiga.png" class="logoSegitiga">
         <img src="http://ikatama95.test/{{ $survey->foto_taruna }}" alt="" class="imageTaruna">
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
