<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
   <!-- Bootstrap CSS v5.2.1 -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
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
   }

   .wrapper .main_content .box-motto hr {
      position: relative;
      border: none;
      height: 12px;
      width: 100px;
      background: #ffffff;
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
         <h2>IKATAMA 95</h2>
         <div class="card ms-3 rounded-5 bg-white" style="border: 2px dashed black; width: 250px; height: 275px; object-fit: cover;">
            <img src="{{ asset($survey->foto_terkini) }}" style="height: inherit" class="rounded-5"
               alt="">
            <div class="card-body">
            </div>
         </div>
         <img src="{{ asset('assets/images/favicon-polos-segitiga.png') }}"
            style="width: 150px; align-items: center; position: absolute;right: 25px;bottom: 10%;" alt="">
      </div>
      <div class="main_content">
         <div class="header">Welcome!! Have a nice day.</div>
         <div class="info">
            <h2>{{ $survey->nama }}</h2>
            <hr>
            <div class="table-responsive table-sm">
               <table class="table table-borderless">
                  <tbody>
                     <tr class="">
                        <td scope="row">Panggilan</td>
                        <td class="text-end">:</td>
                        <td class="ms-3">{{ $survey->panggilan }}</td>
                     </tr>
                     <tr class="">
                        <td scope="row">Tempat, Tgl. Lahir</td>
                        <td class="text-end">:</td>
                        <td class="ms-3">{{ $survey->tempat_lahir . ', ' . $survey->tanggal_lahir }}</td>
                     </tr>
                     <tr class="">
                        <td scope="row">Pangkat</td>
                        <td class="text-end">:</td>
                        <td class="ms-3">{{ $survey->pangkat }}</td>
                     </tr>
                     <tr class="">
                        <td scope="row">NRP</td>
                        <td class="text-end">:</td>
                        <td class="ms-3">{{ $survey->nrp }}</td>
                     </tr>
                     <tr class="">
                        <td scope="row">Status</td>
                        <td class="text-end">:</td>
                        <td class="ms-3">{{ $survey->status_kedinasan }}</td>
                     </tr>
                     <tr class="">
                        <td scope="row">Status Pernikahan</td>
                        <td class="text-end">:</td>
                        <td class="ms-3">{{ $survey->status_pernikahan }}</td>
                     </tr>
                     <tr class="">
                        <td scope="row">No. Telepon</td>
                        <td class="text-end">:</td>
                        <td class="ms-3">{{ $survey->no_telepon }}</td>
                     </tr>
                     <tr class="">
                        <td scope="row">Email</td>
                        <td class="text-end">:</td>
                        <td class="ms-3">{{ $survey->email }}</td>
                     </tr>
                     <tr class="">
                        <td scope="row">Alamat</td>
                        <td class="text-end">:</td>
                        <td class="ms-3">{{ $survey->alamat }}</td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>

         <div class="box-motto">
            <h2 class="text-white">Motto</h2>
            <hr>
            <p class="text-white">
               {{ $survey->motto }}
            </p>
         </div>
      </div>
   </div>

   <!-- Bootstrap JavaScript Libraries -->
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
      integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
      crossorigin="anonymous"></script>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
      integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz"
      crossorigin="anonymous"></script>
</body>

</html>
