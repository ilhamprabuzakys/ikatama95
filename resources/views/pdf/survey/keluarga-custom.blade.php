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
         width: 100%;
      }

      .akpol95 {
         position: absolute;
         right: 0;
         top: 0;
         z-index: 1;
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
         margin-top: 170px;
      }

      .narasi-keluarga {
         position: fixed;
         bottom: 0;
         width: 100%;
      }

      .narasi-keluarga img {
         width: 100%;
         height: auto;
         margin: 0;
      }

      .narasi-keluarga .narasi-text {
         position: absolute;
         top: 19%;
         padding: 20px;
         z-index: 99;
      }

      .narasi-keluarga .narasi-text p {
         color: white;
         z-index: 99;
      }

      .container-gambar-keluarga {
         flex: 1;
         /* Ini memastikan bahwa elemen ini akan mengambil seluruh ruang yang tersedia di antara header dan .container-narasi */
         display: flex;
         /* Ini memastikan kontennya berada di tengah */
         align-items: center;
         /* Ini akan memposisikan gambar secara vertikal ke tengah */
         justify-content: center;
         /* Ini akan memposisikan gambar secara horizontal ke tengah */
      }

      .container-gambar-keluarga img {
         max-width: 500px;
         max-height: 500px;
         position: relative;
      }

      body {
         display: flex;
         flex-direction: column;
         min-height: 100vh;
      }

      .container-narasi {
         margin-top: auto;
         background-color: #0A2259;
         position: relative;
         padding: 20px;
         min-height: 300px;
         /* Menetapkan tinggi minimal */
      }


      .container-narasi .narasi-text {
         margin-top: 20px;
         padding: 30px;
      }

      .container-narasi .header {
         text-align: center;
      }

      .container-narasi .header .text-header {
         color: #fff;
         font-size: 30px;
      }

      .container-narasi .header hr {
         color: yellow;
         border: 2px solid yellow;
         width: 200px;
         margin-left: auto;
         margin-right: auto;
      }

      .container-narasi .narasi-text p {
         color: #fff;
      }

      .narasi-keluarga {
         position: relative;
         /* Mengatur posisi relatif untuk elemen ini */
         width: 100%;
         margin-top: auto;
      }

      .narasi-keluarga img {
         width: 100%;
         /* Mengatur lebar gambar menjadi penuh */
         height: auto;
         display: block;
      }

      .narasi-text {
         position: absolute;
         /* Mengatur teks agar berada di atas gambar */
         top: 0;
         left: 0;
         width: 100%;
         padding: 20px;
         z-index: 1;
      }
   </style>
</head>

<body>
   <header class="header-container">
      <div class="image-container">
         <img src="http://ikatama95.test/assets/images/favicon-polos-segitiga.png" class="logoSegitiga">
         <img src="http://ikatama95.test/assets/images/AKPOL-95-TR.png" alt="" class="akpol95">
      </div>
   </header>
   <hr class="hr-header">

   <div class="container-gambar-keluarga">
      <img src="http://ikatama95.test/{{ $survey->foto_keluarga }}" alt="">
   </div>

   {{-- <div class="container-narasi">
      <div class="header">
         <h3 class="text-header">Profil Keluarga</h3>
         <hr>
      </div>
      <div class="narasi-text">
         <p>{{ $survey->narasi_keluarga }}</p>
      </div>
   </div> --}}

   <div class="narasi-keluarga">
      <img src="http://ikatama95.test/assets/images/KELUARGA-BIRU.png" alt="">
      <div class="narasi-text">
          <p>{{ $survey->narasi_keluarga }}</p>
      </div>
   </div>
</body>

</html>
