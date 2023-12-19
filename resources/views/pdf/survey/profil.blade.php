<!DOCTYPE html>
<html>

<head>
   <style>
      /* Global CSS */
      @import url("https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css");

      * {
         margin: 0;
         padding: 0;
         box-sizing: border-box;
         list-style: none;
         text-decoration: none;
         font-family: sans-serif;
      }
   </style>
   <style>
      body {
         display: flex;
         flex-direction: column;
         height: 100%;
      }

      .rectangle {
         position: absolute;
         width: 181px;
         height: 100%;
         top: 0;
         left: 0;
         background-color: #eb9f0b;
      }

      .favicon-polos {
         position: absolute;
         width: 135px;
         height: 156px;
         top: 413px;
         left: 31px;
         object-fit: cover;
      }

      .text-wrapper {
         position: absolute;
         width: 130px;
         top: 798px;
         left: 26px;
         font-family: Impact;
         font-weight: 400;
         color: #00235d;
         font-size: 20px;
         letter-spacing: 0;
         line-height: normal;
         text-align: center;
      }

      .vector {
         position: absolute;
         width: 178px;
         height: 247px;
         top: 32px;
         left: 1px;
      }

      .overlap-2 {
         position: absolute;
         width: 70%;
         height: 330px;
         top: 607px;
         left: 224px;
         background-color: #00235d;
      }

      .text-wrapper-2 {
         position: absolute;
         width: 74px;
         top: 17px;
         left: 15px;
         font-family: sans-serif;
         font-weight: 600;
         color: #ffffff;
         font-size: 20px;
         letter-spacing: 0;
         line-height: normal;
      }

      .rectangle-3 {
         position: absolute;
         width: 55px;
         height: 5px;
         top: 43px;
         left: 16px;
         background-color: #ffce70;
      }

      .AKPOL-TR {
         position: absolute;
         width: 194px;
         height: 58px;
         top: 31px;
         right: 10px;
         object-fit: cover;
      }

      .img {
         position: absolute;
         width: 280px;
         height: 293px;
         top: 228px;
         left: 260px;
         object-fit: cover;
      }

      .overlap-3 {
         position: absolute;
         width: auto;
         height: 95px;
         top: 120px;
         left: 267px;
      }

      .text-wrapper-3 {
         position: relative;
         width: 470px;
         top: 0;
         left: 0;
         font-family: "Times New Roman";
         font-weight: 600;
         color: #000000;
         font-size: 24px;
         letter-spacing: 1;
         line-height: normal;
      }

      .rectangle-4 {
         position: relative;
         width: 137px;
         height: 11px;
         top: 0px;
         left: 2px;
         background-color: #ffce70;
      }

      .motto-box {
         margin-top: 50px;
         padding: 20px;
      }

      .motto-box p {
         color: white;
         font-family: sans-serif;
      }

      .info-box {
         margin-top: 10px;
         width: 500px;
      }


      .borderless {
         border: 0;
      }

      .table {
         font-family: sans-serif;
      }

      tr td:nth-child(3) {
         /* margin-left: 10px; */
         /* Atau jika Anda ingin memakai padding kiri, bisa ganti menjadi: */
         padding-left: 10px;
      }

      tr td:nth-child(1) {
         width: 150px;
      }

      .table td {
         padding: 7.5px 0;
         /* Memberikan padding 7.5px di atas dan di bawah agar totalnya menjadi 15px antar baris */
      }


      .rectangle-2 {
         position: absolute;
         width: 211px;
         height: 242px;
         top: 120px;
         left: 14px;
         background-color: #ffffff;
         border-radius: 25px;
         border: 3px dashed;
         border-color: #000000;
      }


      .rectangle-2 img {
         height: 100%;
         width: 100%;
         border-radius: 25px;
         object-fit: cover;
      }
   </style>
</head>

<body>
   {{-- <div class="overlap-wrapper">
      <div class="overlap">
         <div class="overlap-group">
           
         </div>
        
      </div>
   </div> --}}
   <div class="rectangle"></div>
   <img class="favicon-polos" src="http://ikatama95.test/assets/images/favicon-polos-segitiga.png" />
   <p class="text-wrapper">BAKTI PATRIATAMA 30 TAHUN UNTUk NEGERI</p>
   <img class="vector" src="http://ikatama95.test/assets/images/pdf/PAGE-PROFIL-MERAH.svg" />
   <div class="rectangle-2">
      <img src="http://ikatama95.test/{{ $survey->foto_terkini }}" alt="">
   </div>
   <div class="overlap-2">
      <div class="text-wrapper-2">Motto</div>
      <div class="rectangle-3"></div>
      <div class="motto-box">
         <p>{{ $survey->motto }}</p>
      </div>
   </div>
   <img class="AKPOL-TR" src="http://ikatama95.test/assets/images/AKPOL-95-TR.png" />
   <img class="img" src="http://ikatama95.test/assets/images/favicon-polos-segitiga-opacity.png" />
   <div class="overlap-3">
      <div class="text-wrapper-3">{{ $survey->nama }}</div>
      <div class="rectangle-4"></div>
      <div class="info-box">
         <table class="table">
            <tbody>
               <tr class="">
                  <td scope="row">Panggilan</td>
                  <td class="text-end">:</td>
                  <td>{{ $survey->panggilan }}</td>
               </tr>
               <tr class="">
                  <td scope="row">Tempat, Tgl. Lahir</td>
                  <td class="text-end">:</td>
                  <td>{{ $survey->tempat_lahir . ', ' . $survey->tanggal_lahir }}</td>
               </tr>
               <tr class="">
                  <td scope="row">Pangkat</td>
                  <td class="text-end">:</td>
                  <td>{{ $survey->pangkat }}</td>
               </tr>
               <tr class="">
                  <td scope="row">NRP</td>
                  <td class="text-end">:</td>
                  <td>{{ $survey->nrp }}</td>
               </tr>
               <tr class="">
                  <td scope="row">Status</td>
                  <td class="text-end">:</td>
                  <td>
                     {{ $survey->status_kedinasan }}
                  </td>
               </tr>
               <tr class="">
                  <td scope="row">Status Pernikahan</td>
                  <td class="text-end">:</td>
                  <td>{{ $survey->status_pernikahan }}</td>
               </tr>
               <tr class="">
                  <td scope="row" class="">No. Telepon</td>
                  <td class="text-end">:</td>
                  <td>{{ $survey->no_telepon }}</td>
               </tr>
               <tr class="">
                  <td scope="row" class="">Email</td>
                  <td class="text-end">:</td>
                  <td>{{ $survey->email }}</td>
               </tr>
               <tr class="">
                  <td scope="row" class="">Alamat</td>
                  <td class="text-end">:</td>
                  <td>{{ $survey->alamat }}</td>
               </tr>
            </tbody>
         </table>
      </div>
   </div>
</body>

</html>
