<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
</head>
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
      background-color: #ffffff;
   }

   .wrapper {
      display: flex;
      position: relative;
   }

   .wrapper .sidebar {
      width: 200px;
      height: 100%;
      background: #ed9f17;
      padding: 30px 0px;
      position: fixed;
   }

   .wrapper .sidebar h2 {
      color: #fff;
      text-transform: uppercase;
      text-align: center;
      margin-bottom: 30px;
   }

   .wrapper .sidebar ul li {
      padding: 15px;
      border-bottom: 1px solid #bdb8d7;
      border-bottom: 1px solid rgba(0, 0, 0, 0.05);
      border-top: 1px solid rgba(255, 255, 255, 0.05);
   }

   .wrapper .sidebar ul li a {
      color: #bdb8d7;
      display: block;
   }

   .wrapper .sidebar ul li a .fas {
      width: 25px;
   }

   .wrapper .sidebar ul li:hover {
      background-color: #594f8d;
   }

   .wrapper .sidebar ul li:hover a {
      color: #fff;
   }

   .wrapper .sidebar .social_media {
      position: absolute;
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
      display: flex;
   }

   .wrapper .sidebar .social_media a {
      display: block;
      width: 40px;
      background: #594f8d;
      height: 40px;
      line-height: 45px;
      text-align: center;
      margin: 0 5px;
      color: #bdb8d7;
      border-top-left-radius: 5px;
      border-top-right-radius: 5px;
   }

   .wrapper .main_content {
      width: 100%;
      margin-left: 200px;
      background-image: url("http://ikatama95.test/assets/images/favicon-polos-segitiga-opacity.png");
      background-color: #fff;
      background-repeat: no-repeat;
      /* background-position: calc(50% - 100px) calc(50% - 15px); */
      background-position: center;

   }


   .wrapper .main_content .header {
      padding: 20px;
      background: #fff;
      color: #717171;
      border-bottom: 1px solid #e0e4e8;
   }

   .wrapper .main_content .info {
      margin: 20px 200px 20px 200px;
      color: #717171;
      line-height: 25px;
   }

   .wrapper .main_content .info div {
      margin-bottom: 20px;
   }

   .wrapper .main_content .info h2 {
      font-family: 'Times New Roman', Times, serif;
      text-transform: uppercase;
   }

   .wrapper .main_content .info hr {
      position: relative;
      border: none;
      height: 12px;
      width: 300px;
      background: #ffcf7c;
   }

   .wrapper .main_content .box-motto {
      margin: 20px 200px 20px 200px;
      padding: 20px;
      color: #717171;
      line-height: 25px;
      background-color: #0a235c;
      width: 40%;
      height: 30%;
   }

   .wrapper .main_content .box-motto hr {
      position: relative;
      border: none;
      height: 5px;
      width: 100px;
      background: #ffcf7c;
   }

   td.ms-3 {
      margin-left: 8px;
   }

   @media (max-height: 500px) {
      .social_media {
         display: none !important;
      }
   }
</style>

<body>
   <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>

   <div class="wrapper">
      <div class="sidebar">
         {{-- <h2>IKATAMA 95</h2> --}}
         <div class="" style="border: 2px dashed black;
         width: 250px;
         height: 275px;
         object-fit: cover;
         border-radius: 25px;
         margin-left: 20px;">
            <img src="{{ asset($survey->foto_terkini) }}" style="
               height: 272px;
  width: 248px;
  max-width: 250px;
  border-radius: 25px;
            "
               alt="">
            <div class="card-body">
            </div>
         </div>
         <img src="{{ asset('assets/images/favicon-polos-segitiga.png') }}"
            style="width: 150px;
            align-items: center;
            position: relative;
            margin: 40px 25px 0 25px;" alt="">
      </div>
      <div class="main_content">
         {{-- <div class="header">Welcome!! Have a nice day.</div> --}}
         <div class="info">
            <h2>{{ $survey->nama }}</h2>
            <hr>
            <div class="table-responsive table-sm">
               <table class="table table-borderless">
                  <tbody>
                     <tr class="">
                        <td scope="row">Panggilan</td>
                        <td class="text-end">:</td>
                        <td><span style="margin-left: 10px">{{ $survey->panggilan }}</span></td>
                     </tr>
                     <tr class="">
                        <td scope="row">Tempat, Tgl. Lahir</td>
                        <td class="text-end">:</td>
                        <td><span style="margin-left: 10px">{{ $survey->tempat_lahir . ', ' . $survey->tanggal_lahir }}</span></td>
                     </tr>
                     <tr class="">
                        <td scope="row">Pangkat</td>
                        <td class="text-end">:</td>
                        <td><span style="margin-left: 10px">{{ $survey->pangkat }}</span></td>
                     </tr>
                     <tr class="">
                        <td scope="row">NRP</td>
                        <td class="text-end">:</td>
                        <td><span style="margin-left: 10px">{{ $survey->nrp }}</span></td>
                     </tr>
                     <tr class="">
                        <td scope="row">Status</td>
                        <td class="text-end">:</td>
                        <td><span style="margin-left: 10px">{{ $survey->status_kedinasan }}</span></td>
                     </tr>
                     <tr class="">
                        <td scope="row">Status Pernikahan</td>
                        <td class="text-end">:</td>
                        <td><span style="margin-left: 10px">{{ $survey->status_pernikahan }}</span></td>
                     </tr>
                     <tr class="">
                        <td scope="row">No. Telepon</td>
                        <td class="text-end">:</td>
                        <td><span style="margin-left: 10px">{{ $survey->no_telepon }}</span></td>
                     </tr>
                     <tr class="">
                        <td scope="row">Email</td>
                        <td class="text-end">:</td>
                        <td><span style="margin-left: 10px">{{ $survey->email }}</span></td>
                     </tr>
                     <tr class="">
                        <td scope="row">Alamat</td>
                        <td class="text-end">:</td>
                        <td><span style="margin-left: 10px">{{ $survey->alamat }}</span></td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>

         <div class="box-motto">
            <h2 style="color: #fff">Motto</h2>
            <hr>
            <p style="color: #dadada">
               {{ $survey->motto }}
            </p>
         </div>
      </div>
   </div>
</body>

</html>
