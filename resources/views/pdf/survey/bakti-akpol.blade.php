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
         font-weight: 900;
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

      .container-image-long.xl {
         width: 500px;
         height: 500px;
      }

      .container-image img {
         width: 100%;
         height: 100%;
         border-radius: 25px;
         object-fit: contain;
      }

      .container-image-long img {
         width: 100%;
         height: 100%;
         border-radius: 25px;
         object-fit: contain;
      }

      .vector {
         position: absolute;
         width: 178px;
         height: 247px;
         top: 0;
         left: 1px;
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
   <img class="vector" src="http://ikatama95.test/assets/images/pdf/PAGE-PROFIL-MERAH.svg" />
   <div class="overlap-group">
      <p class="text-wrapper">BAKTI AKPOL 95 UNTUK NEGERI</p>

      {{-- @dump($paths) --}}
      <div class="gallery">
         @if (count($paths) == 1)
            <div class="container-image-long xl">
               <img src="http://ikatama95.test/{{ $paths[0] }}" alt="Bakti Photo">
               <div class="detail-image">
                  <h5 class="detail-text">{{ $survey->nama_bakti }}</h5>
               </div>
            </div>
         @elseif(count($paths) == 2)
            @foreach ($paths as $path)
               <div class="container-image">
                  <img src="http://ikatama95.test/{{ $path }}" alt="Bakti Photo">
                  <div class="detail-image">
                     <h5 class="detail-text">{{ $survey->nama_bakti }}</h5>
                  </div>
               </div>
            @endforeach
         @elseif(count($paths) >= 3)
            @for ($i = 0; $i < 2; $i++)
               <div class="container-image">
                  <img src="http://ikatama95.test/{{ $paths[$i] }}" alt="Bakti Photo">
                  <div class="detail-image">
                     <h5 class="detail-text">{{ $survey->nama_bakti }}</h5>
                  </div>
               </div>
            @endfor
            <div class="container-image-long">
               <img src="http://ikatama95.test/{{ end($paths) }}" alt="Bakti Photo">
               <div class="detail-image">
                  <h5 class="detail-text">{{ $survey->nama_bakti == '-' ? '' : $survey->nama_bakti }}</h5>
               </div>
            </div>
         @endif
      </div>

   </div>
</body>

</html>
