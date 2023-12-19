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

      .sidebar-kuning {
         width: 138px;
         top: 0;
         left: 0;
         background-color: #eb9f0b;
         position: absolute;
         height: 100%
            /* Disesuaikan dengan tinggi dari .div */
      }

      .sidebar-biru {
         width: 32px;
         top: 0;
         left: 138px;
         background-color: #00235d;
         position: absolute;
         height: 100%
            /* Disesuaikan dengan tinggi dari .div */
      }

      .logo-segitiga {
         position: absolute;
         width: 40px;
         height: 46px;
         top: 13px;
         right: 174px;
         /* Pindah dari left ke right */
         object-fit: cover;
      }

      .akpol-tr {
         position: absolute;
         width: 174px;
         height: 48px;
         top: 11px;
         right: 0;
         /* Pindah dari left ke right */
         object-fit: cover;
      }

      .logo-opacity-tengah {
         position: absolute;
         width: 362px;
         height: 376px;
         top: 30%;
         left: 37%;
         object-fit: cover;
      }

      /* Data Anak */
      .text-end {
         text-align: end;
      }

      .container-anak .data-anak:first-child {
         margin-top: 80px !important;
      }

      .container-anak .data-anak:last-child {
         margin-bottom: 80px !important;
      }


      .data-anak {
         margin-left: 200px;
         padding: 10px;
         display: flex;
         align-items: start;
         background: rgba(235, 159, 11, 0.06);
         margin-bottom: 10px;
         height: 180px;
      }

      .data-anak .info-anak {
         /* Bungkus detail anak */
         z-index: 9;
         margin-left: 20px;
         /* Memberi jarak antara gambar dan detail */
      }

      .profil-anak {
         width: auto;
         height: 100%;
      }

      .data-anak hr {
         width: 60%;
         margin-top: 5px;
         margin-bottom: 5px;
      }

      .borderless {
         border: 0;
      }

      tr td:nth-child(3) {
         /* margin-left: 10px; */
         /* Atau jika Anda ingin memakai padding kiri, bisa ganti menjadi: */
         padding-left: 10px;
      }
   </style>
</head>

<body>
   <div class="sidebar-kuning"></div>
   <div class="sidebar-biru"></div>
   <img class="logo-segitiga" src="http://ikatama95.test/assets/images/favicon-polos-segitiga.png" />
   <img class="akpol-tr" src="http://ikatama95.test/assets/images/AKPOL-95-TR.png" />
   <img class="logo-opacity-tengah" src="http://ikatama95.test/assets/images/favicon-polos-segitiga-opacity.png" />

   <div class="container-anak">
      @if (
          $survey->nama_anak_pertama ||
              $survey->foto_anak_pertama ||
              $survey->tempat_lahir_anak_pertama ||
              $survey->tanggal_lahir_anak_pertama ||
              $survey->jenis_kelamin_anak_pertama ||
              $survey->pekerjaan_anak_pertama ||
              $survey->alamat_anak_pertama ||
              $survey->motto_anak_pertama)
         <div class="data-anak">
            <img src="{{ $survey->foto_anak_pertama ? 'http://ikatama95.test/' . $survey->foto_anak_pertama : 'http://ikatama95.test/assets/images/avatar/avatar-1.png' }}" alt="" class="profil-anak">
            <div class="info-anak">
               <h3>{{ $survey->nama_anak_pertama ?? 'Nama anak tidak diisi' }}</h3>
               <hr>
               <table class="table borderless">
                  <tbody>
                     <tr class="">
                        <td scope="row">Tempat Tanggal Lahir</td>
                        <td><span class="text-end">:</span></td>
                        <td>
                           @if ($survey->tempat_lahir_anak_pertama || $survey->tanggal_lahir_anak_pertama)
                              {{ $survey->tempat_lahir_anak_pertama ?? '' . ', ' . $survey->tanggal_lahir_anak_pertama ?? '' }}
                           @endif
                        </td>
                     </tr>
                     <tr class="">
                        <td scope="row">Jenis Kelamin</td>
                        <td><span class="text-end">:</span></td>
                        <td>{{ $survey->jenis_kelamin_anak_pertama }}</td>
                     </tr>
                     {{-- <tr class="">
                     <td scope="row">Status Dl. Keluarga</td>
                     <td><span class="text-end">:</span></td>
                     <td>Anak Kandung</td>
                  </tr> --}}
                     <tr class="">
                        <td scope="row">Pekerjaan</td>
                        <td><span class="text-end">:</span></td>
                        <td>{{ $survey->pekerjaan_anak_pertama }}</td>
                     </tr>
                     <tr class="">
                        <td scope="row">Alamat</td>
                        <td><span class="text-end">:</span></td>
                        <td>{{ $survey->alamat_anak_pertama }}</td>
                     </tr>
                     <tr class="">
                        <td scope="row">Motto</td>
                        <td><span class="text-end">:</span></td>
                        <td>{{ $survey->motto_anak_pertama }}</td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>
      @endif
      @if (
          $survey->nama_anak_kedua ||
              $survey->foto_anak_kedua ||
              $survey->tempat_lahir_anak_kedua ||
              $survey->tanggal_lahir_anak_kedua ||
              $survey->jenis_kelamin_anak_kedua ||
              $survey->pekerjaan_anak_kedua ||
              $survey->alamat_anak_kedua ||
              $survey->motto_anak_kedua)
         <div class="data-anak">
            <img src="{{ $survey->foto_anak_kedua ? 'http://ikatama95.test/' . $survey->foto_anak_kedua : 'http://ikatama95.test/assets/images/avatar/avatar-1.png' }}" alt="" class="profil-anak">
            <div class="info-anak">
               <h3>{{ $survey->nama_anak_kedua ?? 'Nama anak tidak diisi' }}</h3>
               <hr>
               <table class="table borderless">
                  <tbody>
                     <tr class="">
                        <td scope="row">Tempat Tanggal Lahir</td>
                        <td><span class="text-end">:</span></td>
                        <td>
                           @if ($survey->tempat_lahir_anak_kedua || $survey->tanggal_lahir_anak_kedua)
                              {{ $survey->tempat_lahir_anak_kedua ?? '' . ', ' . $survey->tanggal_lahir_anak_kedua ?? '' }}
                           @endif
                        </td>
                     </tr>
                     <tr class="">
                        <td scope="row">Jenis Kelamin</td>
                        <td><span class="text-end">:</span></td>
                        <td>{{ $survey->jenis_kelamin_anak_kedua }}</td>
                     </tr>
                     {{-- <tr class="">
                     <td scope="row">Status Dl. Keluarga</td>
                     <td><span class="text-end">:</span></td>
                     <td>Anak Kandung</td>
                  </tr> --}}
                     <tr class="">
                        <td scope="row">Pekerjaan</td>
                        <td><span class="text-end">:</span></td>
                        <td>{{ $survey->pekerjaan_anak_kedua }}</td>
                     </tr>
                     <tr class="">
                        <td scope="row">Alamat</td>
                        <td><span class="text-end">:</span></td>
                        <td>{{ $survey->alamat_anak_kedua }}</td>
                     </tr>
                     <tr class="">
                        <td scope="row">Motto</td>
                        <td><span class="text-end">:</span></td>
                        <td>{{ $survey->motto_anak_kedua }}</td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>
      @endif
      
      @if (
          $survey->nama_anak_ketiga ||
              $survey->foto_anak_ketiga ||
              $survey->tempat_lahir_anak_ketiga ||
              $survey->tanggal_lahir_anak_ketiga ||
              $survey->jenis_kelamin_anak_ketiga ||
              $survey->pekerjaan_anak_ketiga ||
              $survey->alamat_anak_ketiga ||
              $survey->motto_anak_ketiga)
         <div class="data-anak">
            <img src="{{ $survey->foto_anak_ketiga ? 'http://ikatama95.test/' . $survey->foto_anak_ketiga : 'http://ikatama95.test/assets/images/avatar/avatar-1.png' }}" alt="" class="profil-anak">
            <div class="info-anak">
               <h3>{{ $survey->nama_anak_ketiga ?? 'Nama anak tidak diisi' }}</h3>
               <hr>
               <table class="table borderless">
                  <tbody>
                     <tr class="">
                        <td scope="row">Tempat Tanggal Lahir</td>
                        <td><span class="text-end">:</span></td>
                        <td>
                           @if ($survey->tempat_lahir_anak_ketiga || $survey->tanggal_lahir_anak_ketiga)
                              {{ $survey->tempat_lahir_anak_ketiga ?? '' . ', ' . $survey->tanggal_lahir_anak_ketiga ?? '' }}
                           @endif
                        </td>
                     </tr>
                     <tr class="">
                        <td scope="row">Jenis Kelamin</td>
                        <td><span class="text-end">:</span></td>
                        <td>{{ $survey->jenis_kelamin_anak_ketiga }}</td>
                     </tr>
                     {{-- <tr class="">
                     <td scope="row">Status Dl. Keluarga</td>
                     <td><span class="text-end">:</span></td>
                     <td>Anak Kandung</td>
                  </tr> --}}
                     <tr class="">
                        <td scope="row">Pekerjaan</td>
                        <td><span class="text-end">:</span></td>
                        <td>{{ $survey->pekerjaan_anak_ketiga }}</td>
                     </tr>
                     <tr class="">
                        <td scope="row">Alamat</td>
                        <td><span class="text-end">:</span></td>
                        <td>{{ $survey->alamat_anak_ketiga }}</td>
                     </tr>
                     <tr class="">
                        <td scope="row">Motto</td>
                        <td><span class="text-end">:</span></td>
                        <td>{{ $survey->motto_anak_ketiga }}</td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>
      @endif
      
      @if (
          $survey->nama_anak_keempat ||
              $survey->foto_anak_keempat ||
              $survey->tempat_lahir_anak_keempat ||
              $survey->tanggal_lahir_anak_keempat ||
              $survey->jenis_kelamin_anak_keempat ||
              $survey->pekerjaan_anak_keempat ||
              $survey->alamat_anak_keempat ||
              $survey->motto_anak_keempat)
         <div class="data-anak">
            <img src="{{ $survey->foto_anak_keempat ? 'http://ikatama95.test/' . $survey->foto_anak_keempat : 'http://ikatama95.test/assets/images/avatar/avatar-1.png' }}" alt="" class="profil-anak">
            <div class="info-anak">
               <h3>{{ $survey->nama_anak_keempat ?? 'Nama anak tidak diisi' }}</h3>
               <hr>
               <table class="table borderless">
                  <tbody>
                     <tr class="">
                        <td scope="row">Tempat Tanggal Lahir</td>
                        <td><span class="text-end">:</span></td>
                        <td>
                           @if ($survey->tempat_lahir_anak_keempat || $survey->tanggal_lahir_anak_keempat)
                              {{ $survey->tempat_lahir_anak_keempat ?? '' . ', ' . $survey->tanggal_lahir_anak_keempat ?? '' }}
                           @endif
                        </td>
                     </tr>
                     <tr class="">
                        <td scope="row">Jenis Kelamin</td>
                        <td><span class="text-end">:</span></td>
                        <td>{{ $survey->jenis_kelamin_anak_keempat }}</td>
                     </tr>
                     {{-- <tr class="">
                     <td scope="row">Status Dl. Keluarga</td>
                     <td><span class="text-end">:</span></td>
                     <td>Anak Kandung</td>
                  </tr> --}}
                     <tr class="">
                        <td scope="row">Pekerjaan</td>
                        <td><span class="text-end">:</span></td>
                        <td>{{ $survey->pekerjaan_anak_keempat }}</td>
                     </tr>
                     <tr class="">
                        <td scope="row">Alamat</td>
                        <td><span class="text-end">:</span></td>
                        <td>{{ $survey->alamat_anak_keempat }}</td>
                     </tr>
                     <tr class="">
                        <td scope="row">Motto</td>
                        <td><span class="text-end">:</span></td>
                        <td>{{ $survey->motto_anak_keempat }}</td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>
      @endif
      
      @if (
          $survey->nama_anak_kelima ||
              $survey->foto_anak_kelima ||
              $survey->tempat_lahir_anak_kelima ||
              $survey->tanggal_lahir_anak_kelima ||
              $survey->jenis_kelamin_anak_kelima ||
              $survey->pekerjaan_anak_kelima ||
              $survey->alamat_anak_kelima ||
              $survey->motto_anak_kelima)
         <div class="data-anak">
            <img src="{{ $survey->foto_anak_kelima ? 'http://ikatama95.test/' . $survey->foto_anak_kelima : 'http://ikatama95.test/assets/images/avatar/avatar-1.png' }}" alt="" class="profil-anak">
            <div class="info-anak">
               <h3>{{ $survey->nama_anak_kelima ?? 'Nama anak tidak diisi' }}</h3>
               <hr>
               <table class="table borderless">
                  <tbody>
                     <tr class="">
                        <td scope="row">Tempat Tanggal Lahir</td>
                        <td><span class="text-end">:</span></td>
                        <td>
                           @if ($survey->tempat_lahir_anak_kelima || $survey->tanggal_lahir_anak_kelima)
                              {{ $survey->tempat_lahir_anak_kelima ?? '' . ', ' . $survey->tanggal_lahir_anak_kelima ?? '' }}
                           @endif
                        </td>
                     </tr>
                     <tr class="">
                        <td scope="row">Jenis Kelamin</td>
                        <td><span class="text-end">:</span></td>
                        <td>{{ $survey->jenis_kelamin_anak_kelima }}</td>
                     </tr>
                     {{-- <tr class="">
                     <td scope="row">Status Dl. Keluarga</td>
                     <td><span class="text-end">:</span></td>
                     <td>Anak Kandung</td>
                  </tr> --}}
                     <tr class="">
                        <td scope="row">Pekerjaan</td>
                        <td><span class="text-end">:</span></td>
                        <td>{{ $survey->pekerjaan_anak_kelima }}</td>
                     </tr>
                     <tr class="">
                        <td scope="row">Alamat</td>
                        <td><span class="text-end">:</span></td>
                        <td>{{ $survey->alamat_anak_kelima }}</td>
                     </tr>
                     <tr class="">
                        <td scope="row">Motto</td>
                        <td><span class="text-end">:</span></td>
                        <td>{{ $survey->motto_anak_kelima }}</td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>
      @endif
   </div>
</body>

</html>
