<!DOCTYPE html>
<html>

<head>
   <style>
      * {
         margin: 0;
         padding: 0;
         box-sizing: border-box;
         list-style: none;
         text-decoration: none;
         font-family: sans-serif;
      }

      body {
         display: flex;
         flex-direction: column;
         min-height: 100vh;
      }

      .favicon-polos {
         position: absolute;
         width: 66px;
         height: 68px;
         top: 15px;
         left: 51px;
         object-fit: cover;
      }

      .AKPOL-TR {
         position: absolute;
         width: 174px;
         height: 48px;
         top: 10px;
         right: 10px;
         object-fit: cover;
      }

      .overlap-group {
         position: relative;
         margin: 100px auto 0 auto;
         padding: 20px;
      }

      .text-wrapper {
         position: relative;
         width: max-content;
         font-family: "Monomaniac One-Regular", Helvetica;
         font-weight: 600;
         color: #000000;
         font-size: 36px;
         /* text-align: center; */
         margin: auto;
         letter-spacing: 0;
         line-height: normal;
      }

      .container-image {
         width: 221px;
         position: relative;
         height: 194px;
         background-color: #ffffff;
         border-radius: 25px;
         border: 3px solid rgb(196, 196, 196);
         box-shadow: 0px 4px 4px #00000040;
         /* opacity: 0.2; */
         padding: 10px;
      }


      .container-image-long {
         width: 473px;
         position: relative;
         height: 250px;
         background-color: #ffffff;
         border-radius: 25px;
         border: 3px solid rgb(196, 196, 196);
         box-shadow: 0px 4px 4px #00000040;
         padding: 10px;
      }

      .gallery {
         display: flex;
         flex-wrap: wrap;
         justify-content: space-between;
         gap: 20px;
         width: 480px;
         margin: 20px auto 0 auto;
      }

      .container-image,
      .container-image-long {
         margin-bottom: 20px;
         /* Memberikan jarak di bawah setiap kontainer */
      }

      .container-image-long {
         flex: 2;
         /* Membuat container-image-long dua kali lebar dari container-image */
      }

      .container-image img {
         width: 100%;
         height: 100%;
         border-radius: 25px;
      }

      .container-image-long img {
         width: 100%;
         height: 100%;
         border-radius: 25px;
         object-fit: contain;
      }

      .line {
         position: relative;
         width: 453px;
         height: 10px;
         background-color: #505050;
         box-shadow: 0px 4px 4px #00000040;
         margin: 0 auto 0 auto;
      }


      .red {
         color: red;
      }

      .detail-image {
         background-color: #00235D;
         padding: 10px 30px;
         border-radius: 15px;
         margin: 25px 0 0 0;
         width: auto;
      }

      .detail-image .detail-text {
         width: 100%;
         font-size: 1rem;
         color: white;
         text-align: center;
      }
   </style>
</head>

<body>
   <img class="favicon-polos" src="http://ikatama95.test/assets/images/favicon-polos-segitiga.png" />
   <img class="AKPOL-TR" src="http://ikatama95.test/assets/images/AKPOL-95-TR.png" />
   <div class="overlap-group">
      <p class="BERKARYA-UNTUK">
         <span class="text-wrapper">BERKARYA UNTUK
            <span class="red">P</span>ATRIATAMA
         </span>
      </p>
      <div class="gallery">
         <div class="container-image-long">
            {{-- <img src="{{ secure_asset('assets/images/KELUARGA.jpg') }}" alt=""> --}}
            @foreach ($paths as $berkarya)
               <img src="http://ikatama95.test/{{ $berkarya }}" alt="">
               <div class="detail-image">
                  <h5 class="detail-text">{{ $survey->nama_karya }}</h5>
               </div>
            @endforeach
         </div>
         {{-- <div class="line"></div> --}}
      </div>
   </div>
</body>

</html>
