<script>
   $("#hasilSurvey").addClass('d-none');
   // $("#cardInformation").addClass('d-none');
   $(document).ready(function() {
      initializeSurvey();
   });

   Livewire.on('download', response => {
      const url = window.URL.createObjectURL(new Blob([response.data]));
      const link = document.createElement('a');
      link.href = url;
      link.setAttribute('download', 'hasil-survey.pdf');
      document.body.appendChild(link);
      link.click();
      link.remove();
      window.URL.revokeObjectURL(url);
   });

   Livewire.on('openTab', function(event) {
      window.open(event.detail, '_blank');
   });

   function initializeSurvey() {
      let isAuthenticated = @json(auth()->check());

      const surveyJson = {
         "title": "ALUMNI AKPOL 95 'PATRIATAMA'",
         "logoPosition": "right",
         // "completedHtml": "<h3>Terimakasih sudah mengisi Survey Ini.</h3>",
         "loadingHtml": "<h3>Memuat Survey...</h3>",
         "pages": [{
               "name": "page1",
               "elements": [{
                     "type": "file",
                     "name": "foto_taruna",
                     "title": "FOTO TARUNA",
                     "hideNumber": true,
                     "isRequired": true,
                     "requiredErrorText": "File harus disertakan",
                     "acceptedTypes": ".jpg, .png",
                     "waitForUpload": true,
                     "maxSize": 2000000,
                     "needConfirmRemoveFile": true
                  },
                  {
                     "type": "text",
                     "name": "nama",
                     "title": "NAMA",
                     "description": "GUNAKAN HURUF KAPITAL",
                     "hideNumber": true,
                     "isRequired": true,
                     "requiredErrorText": "Nama harus diisi"
                  },
                  {
                     "type": "text",
                     "name": "panggilan",
                     "title": "PANGGILAN",
                     "hideNumber": true,
                     "isRequired": true,
                     "requiredErrorText": "Panggilan harus diisi"
                  },
                  {
                     "type": "text",
                     "name": "tempat_lahir",
                     "title": "TEMPAT LAHIR",
                     "hideNumber": true,
                     "isRequired": true,
                     "requiredErrorText": "Tempat Lahir harus diisi"
                  },
                  {
                     "type": "text",
                     "name": "tanggal_lahir",
                     "title": "TANGGAL LAHIR",
                     "hideNumber": true,
                     "isRequired": true,
                     "requiredErrorText": "Tanggal Lahir harus diisi",
                     "inputType": "date"
                  },
                  {
                     "type": "radiogroup",
                     "name": "pangkat",
                     "title": "PANGKAT",
                     "hideNumber": true,
                     "isRequired": true,
                     "requiredErrorText": "Pangkat harus diisi",
                     "choices": [
                        "JENDRAL POLISI",
                        "KOMISARIS JENDRAL POLISI",
                        "INSPEKTUR JENDERAL POLISI",
                        "BRIGADIR JENDERAL POLISI",
                        "KOMISARIS BESAR POLISI",
                        "AJUN KOMISARIS BESAR POLISI",
                        "KOMISARIS POLISI",
                        "AJUN KOMISARIS POLISI",
                        "INSPEKTUR POLISI SATU",
                        "INSPEKTUR POLISI DUA"
                     ],
                     "showOtherItem": true,
                     "otherText": "Yang lain: ",
                     "showClearButton": true
                  },
                  {
                     "type": "text",
                     "name": "nrp",
                     "title": "NRP",
                     "hideNumber": true,
                     "isRequired": true,
                     "requiredErrorText": "NRP harus diisi",
                     "inputType": "number",
                     "step": 0
                  },
                  {
                     "type": "radiogroup",
                     "name": "status_kedinasan",
                     "title": "STATUS KEDINASAN",
                     "hideNumber": true,
                     "isRequired": true,
                     "requiredErrorText": "Status Kedinasan harus diisi",
                     "choices": [
                        "Aktif",
                        "Tidak Aktif"
                     ],
                     "showOtherItem": true,
                     "otherText": "Yang lain:",
                     "showClearButton": true
                  },
                  {
                     "type": "radiogroup",
                     "name": "status_pernikahan",
                     "title": "STATUS PERNIKAHAN",
                     "hideNumber": true,
                     "isRequired": true,
                     "requiredErrorText": "Status Pernikahan harus diisi",
                     "choices": [
                        "Kawin",
                        "Belum Kawin",
                        "Cerai Hidup",
                        "Cerai Mati"
                     ],
                     "showOtherItem": true,
                     "otherText": "Yang lain:",
                     "showClearButton": true
                  },
                  {
                     "type": "text",
                     "name": "jumlah_anak",
                     "title": "JUMLAH ANAK",
                     "hideNumber": true,
                     "isRequired": true,
                     "requiredErrorText": "Jumlah anak harus diisi",
                     "inputType": "number"
                  },
                  {
                     "type": "text",
                     "name": "no_telepon",
                     "title": "NO TELEPON",
                     "hideNumber": true,
                     "isRequired": true,
                     "requiredErrorText": "No Telepon harus diisi",
                     "inputType": "number"
                  },
                  {
                     "type": "text",
                     "name": "email",
                     "title": "EMAIL",
                     "hideNumber": true,
                     "isRequired": true,
                     "requiredErrorText": "Email harus diisi",
                     "inputType": "email"
                  },
                  {
                     "type": "comment",
                     "name": "alamat",
                     "title": "ALAMAT",
                     "hideNumber": true,
                     "isRequired": true,
                     "requiredErrorText": "Alamat harus diisi"
                  },
                  {
                     "type": "text",
                     "name": "motto",
                     "title": "MOTTO",
                     "hideNumber": true,
                     "requiredErrorText": "Motto harus diisi"
                  },
                  {
                     "type": "file",
                     "name": "foto_terkini",
                     "title": "FOTO TERKINI",
                     "hideNumber": true,
                     "isRequired": true,
                     "acceptedTypes": ".jpg",
                     "waitForUpload": true,
                     "maxSize": 2000000,
                     "needConfirmRemoveFile": true
                  },
                  {
                     "type": "text",
                     "name": "narasi_personal",
                     "title": "NARASI PERSONAL",
                     "hideNumber": true,
                     "isRequired": true,
                     "requiredErrorText": "Narasi Personal harus diisi"
                  },
                  {
                     "type": "file",
                     "name": "foto_kolase_album_taruna",
                     "title": "KOLASE ALBUM TARUNA",
                     "hideNumber": true,
                     "allowMultiple": true,
                     "acceptedTypes": ".jpg, .png",
                     "waitForUpload": true,
                     "maxSize": 2000000,
                     "needConfirmRemoveFile": true
                  }
               ]
            },
            {
               "name": "DATA KELUARGA",
               "elements": [{
                     "type": "file",
                     "name": "foto_keluarga",
                     "title": "FOTO KELUARGA",
                     "hideNumber": true,
                     "isRequired": true,
                     "requiredErrorText": "Foto keluarga harus disertakan",
                     "acceptedTypes": ".jpg, .png",
                     "waitForUpload": true,
                     "maxSize": 2000000,
                     "needConfirmRemoveFile": true
                  },
                  {
                     "type": "text",
                     "name": "narasi_keluarga",
                     "title": "NARASI KELUARGA",
                     "hideNumber": true,
                     "isRequired": true,
                     "requiredErrorText": "Narasi keluarga harus diisi"
                  },
                  {
                     "type": "file",
                     "name": "foto_anak_pertama",
                     "title": "FOTO ANAK PERTAMA",
                     "description": "DATA ANAK TIDAK WAJIB DIISI SEMUANYA, DAN DAPAT DIISI SESUAI KEBUTUHAN.",
                     "hideNumber": true,
                     "acceptedTypes": ".jpg, .png",
                     "waitForUpload": true,
                     "maxSize": 2000000,
                     "needConfirmRemoveFile": true,
                     "allowCameraAccess": true
                  },
                  {
                     "type": "text",
                     "name": "nama_anak_pertama",
                     "title": "NAMA ANAK PERTAMA",
                     "description": "Gunakan huruf kapital",
                     "hideNumber": true
                  },
                  {
                     "type": "text",
                     "name": "tempat_lahir_anak_pertama",
                     "title": "TEMPAT LAHIR ANAK PERTAMA",
                     "hideNumber": true
                  },
                  {
                     "type": "text",
                     "name": "tanggal_lahir_anak_pertama",
                     "title": "TANGGAL LAHIR ANAK PERTAMA",
                     "hideNumber": true,
                     "inputType": "date"
                  },
                  {
                     "type": "radiogroup",
                     "name": "jenis_kelamin_anak_pertama",
                     "title": "JENIS KELAMIN ANAK PERTAMA",
                     "hideNumber": true,
                     "choices": [{
                           "value": "Laki-Laki",
                           "text": "LAKI-LAKI"
                        },
                        {
                           "value": "Perempuan",
                           "text": "PEREMPUAN"
                        }
                     ],
                     "showClearButton": true
                  },
                  {
                     "type": "text",
                     "name": "pekerjaan_anak_pertama",
                     "title": "PEKERJAAN ANAK PERTAMA",
                     "hideNumber": true
                  },
                  {
                     "type": "text",
                     "name": "alamat_anak_pertama",
                     "title": "ALAMAT ANAK PERTAMA",
                     "hideNumber": true
                  },
                  {
                     "type": "text",
                     "name": "motto_anak_pertama",
                     "title": "MOTTO ANAK PERTAMA",
                     "hideNumber": true
                  },
                  {
                     "type": "file",
                     "name": "foto_anak_kedua",
                     "title": "FOTO ANAK KEDUA",
                     "hideNumber": true,
                     "acceptedTypes": ".jpg",
                     "waitForUpload": true,
                     "maxSize": 2000000,
                     "needConfirmRemoveFile": true
                  },
                  {
                     "type": "text",
                     "name": "nama_anak_kedua",
                     "title": "NAMA ANAK KEDUA",
                     "description": "Gunakan huruf kapital",
                     "hideNumber": true
                  },
                  {
                     "type": "text",
                     "name": "tempat_lahir_anak_kedua",
                     "title": "TEMPAT LAHIR ANAK KEDUA",
                     "hideNumber": true
                  },
                  {
                     "type": "text",
                     "name": "tanggal_lahir_anak_kedua",
                     "title": "TANGGAL LAHIR ANAK KEDUA",
                     "hideNumber": true,
                     "inputType": "date"
                  },
                  {
                     "type": "radiogroup",
                     "name": "jenis_kelamin_anak_kedua",
                     "title": "JENIS KELAMIN ANAK KEDUA",
                     "hideNumber": true,
                     "choicesFromQuestion": "jenis_kelamin_anak_pertama",
                     "showClearButton": true
                  },
                  {
                     "type": "text",
                     "name": "pekerjaan_anak_kedua",
                     "title": "PEKERJAAN ANAK KEDUA",
                     "hideNumber": true
                  },
                  {
                     "type": "text",
                     "name": "alamat_anak_kedua",
                     "title": "ALAMAT ANAK KEDUA",
                     "hideNumber": true
                  },
                  {
                     "type": "text",
                     "name": "motto_anak_kedua",
                     "title": "MOTTO ANAK KEDUA",
                     "hideNumber": true
                  },
                  {
                     "type": "file",
                     "name": "foto_anak_ketiga",
                     "title": "FOTO ANAK KETIGA",
                     "hideNumber": true,
                     "acceptedTypes": ".jpg",
                     "waitForUpload": true,
                     "maxSize": 2000000,
                     "needConfirmRemoveFile": true
                  },
                  {
                     "type": "text",
                     "name": "nama_anak_ketiga",
                     "title": "NAMA ANAK KETIGA",
                     "description": "Gunakan huruf kapital",
                     "hideNumber": true
                  },
                  {
                     "type": "text",
                     "name": "tempat_lahir_anak_ketiga",
                     "title": "TEMPAT LAHIR ANAK KETIGA",
                     "hideNumber": true
                  },
                  {
                     "type": "text",
                     "name": "tanggal_lahir_anak_ketiga",
                     "title": "TANGGAL LAHIR ANAK KETIGA",
                     "hideNumber": true,
                     "inputType": "date"
                  },
                  {
                     "type": "radiogroup",
                     "name": "jenis_kelamin_anak_ketiga",
                     "title": "JENIS KELAMIN ANAK KETIGA",
                     "hideNumber": true,
                     "choicesFromQuestion": "jenis_kelamin_anak_pertama",
                     "showClearButton": true
                  },
                  {
                     "type": "text",
                     "name": "pekerjaan_anak_ketiga",
                     "title": "PEKERJAAN ANAK KETIGA",
                     "hideNumber": true
                  },
                  {
                     "type": "text",
                     "name": "alamat_anak_ketiga",
                     "title": "ALAMAT ANAK KETIGA",
                     "hideNumber": true
                  },
                  {
                     "type": "text",
                     "name": "motto_anak_ketiga",
                     "title": "MOTTO ANAK KETIGA",
                     "hideNumber": true
                  },
                  {
                     "type": "file",
                     "name": "foto_anak_keempat",
                     "title": "FOTO ANAK KEEMPAT",
                     "hideNumber": true,
                     "acceptedTypes": ".jpg",
                     "waitForUpload": true,
                     "maxSize": 200000,
                     "needConfirmRemoveFile": true
                  },
                  {
                     "type": "text",
                     "name": "nama_anak_keempat",
                     "title": "NAMA ANAK KEEMPAT",
                     "description": "Gunakan huruf kapital",
                     "hideNumber": true
                  },
                  {
                     "type": "text",
                     "name": "tempat_lahir_anak_keempat",
                     "title": "TEMPAT LAHIR ANAK KEEMPAT",
                     "hideNumber": true
                  },
                  {
                     "type": "text",
                     "name": "tanggal_lahir_anak_keempat",
                     "title": "TANGGAL LAHIR ANAK KEEMPAT",
                     "hideNumber": true,
                     "inputType": "date"
                  },
                  {
                     "type": "radiogroup",
                     "name": "jenis_kelamin_anak_keempat",
                     "title": "JENIS KELAMIN ANAK KEEMPAT",
                     "hideNumber": true,
                     "choicesFromQuestion": "jenis_kelamin_anak_pertama",
                     "showClearButton": true
                  },
                  {
                     "type": "text",
                     "name": "alamat_anak_keempat",
                     "title": "ALAMAT ANAK KEEMPAT",
                     "hideNumber": true
                  },
                  {
                     "type": "text",
                     "name": "pekerjaan_anak_keempat",
                     "title": "PEKERJAAN ANAK KEEMPAT",
                     "hideNumber": true
                  },
                  {
                     "type": "text",
                     "name": "motto_anak_keempat",
                     "title": "MOTTO ANAK KEEMPAT",
                     "hideNumber": true
                  },
                  {
                     "type": "file",
                     "name": "foto_anak_kelima",
                     "title": "FOTO ANAK KELIMA",
                     "hideNumber": true,
                     "acceptedTypes": ".jpg",
                     "waitForUpload": true,
                     "maxSize": 2000000,
                     "needConfirmRemoveFile": true
                  },
                  {
                     "type": "text",
                     "name": "nama_anak_kelima",
                     "title": "NAMA ANAK KELIMA",
                     "description": "Gunakan huruf kapital",
                     "hideNumber": true
                  },
                  {
                     "type": "text",
                     "name": "tempat_lahir_anak_kelima",
                     "title": "TEMPAT LAHIR ANAK KELIMA",
                     "hideNumber": true
                  },
                  {
                     "type": "text",
                     "name": "tanggal_lahir_anak_kelima",
                     "title": "TANGGAL LAHIR ANAK KELIMA",
                     "hideNumber": true,
                     "inputType": "date"
                  },
                  {
                     "type": "radiogroup",
                     "name": "question1",
                     "title": "JENIS KELAMIN ANAK KELIMA",
                     "hideNumber": true,
                     "choicesFromQuestion": "jenis_kelamin_anak_pertama",
                     "showClearButton": true
                  },
                  {
                     "type": "text",
                     "name": "pekerjaan_anak_kelima",
                     "title": "PEKERJAAN ANAK KELIMA",
                     "hideNumber": true
                  },
                  {
                     "type": "text",
                     "name": "alamat_anak_kelima",
                     "title": "ALAMAT ANAK KELIMA",
                     "hideNumber": true
                  },
                  {
                     "type": "text",
                     "name": "motto_anak_kelima",
                     "title": "MOTTO ANAK KELIMA",
                     "hideNumber": true
                  }
               ],
               "title": "DATA KELUARGA"
            },
            {
               "name": "BAKTI KARYA PATRIATAMA",
               "elements": [{
                     "type": "file",
                     "name": "foto_bakti_akpol",
                     "title": "FOTO BAKTI AKPOL 95",
                     "description": "MAKSIMAL 5 FOTO",
                     "hideNumber": true,
                     "allowMultiple": true,
                     "acceptedTypes": ".jpg, .png",
                     "waitForUpload": true,
                     "maxSize": 2000000,
                     "needConfirmRemoveFile": true
                  },
                  {
                     "type": "text",
                     "name": "nama_bakti",
                     "title": "NAMA BAKTI",
                     "hideNumber": true
                  },
                  {
                     "type": "text",
                     "name": "narasi_bakti_akpol",
                     "title": "NARASI BAKTI AKPOL 95",
                     "hideNumber": true
                  },
                  {
                     "type": "file",
                     "name": "foto_berkarya_patriatama",
                     "title": "FOTO BERKARYA UNTUK PATRIATAMA",
                     "description": "MAKSIMAL 5 FOTO",
                     "hideNumber": true,
                     "acceptedTypes": ".jpg, .png",
                     "allowMultiple": true,
                     "waitForUpload": true,
                     "maxSize": 2000000,
                     "needConfirmRemoveFile": true
                  },
                  {
                     "type": "text",
                     "name": "nama_karya",
                     "title": "NAMA KARYA",
                     "hideNumber": true
                  },
                  {
                     "type": "text",
                     "name": "narasi_berkarya_untuk_patriatama",
                     "title": "NARASI BERKARYA UNTUK PATRIATAMA",
                     "hideNumber": true
                  }
               ],
               "title": "BAKTI KARYA PATRIATAMA"
            }
         ],
         "showTitle": false,
         "showQuestionNumbers": "off",
         "widthMode": "responsive",
         "fitToContainer": true
      };

      const themeJson = {
         "isPanelless": false,
         "cssVariables": {
            "--sjs-general-backcolor": "rgba(255, 255, 255, 1)",
            "--sjs-general-backcolor-dark": "rgba(239, 239, 239, 1)",
            "--sjs-general-backcolor-dim": "rgba(245, 245, 245, 1)",
            "--sjs-general-backcolor-dim-light": "rgba(255, 255, 255, 1)",
            "--sjs-general-backcolor-dim-dark": "rgba(237, 237, 237, 1)",
            "--sjs-general-forecolor": "rgba(0, 0, 0, 0.91)",
            "--sjs-general-forecolor-light": "rgba(0, 0, 0, 0.45)",
            "--sjs-general-dim-forecolor": "rgba(0, 0, 0, 0.91)",
            "--sjs-general-dim-forecolor-light": "rgba(0, 0, 0, 0.45)",
            "--sjs-primary-backcolor": "#1A5FB4",
            "--sjs-primary-backcolor-light": "rgba(26, 95, 180, 0.1)",
            "--sjs-primary-backcolor-dark": "rgba(23, 83, 158, 1)",
            "--sjs-primary-forecolor": "rgba(255, 255, 255, 1)",
            "--sjs-primary-forecolor-light": "rgba(255, 255, 255, 0.25)",
            "--sjs-base-unit": "8px",
            "--sjs-corner-radius": "5px",
            "--sjs-secondary-backcolor": "rgba(255, 152, 20, 1)",
            "--sjs-secondary-backcolor-light": "rgba(255, 152, 20, 0.1)",
            "--sjs-secondary-backcolor-semi-light": "rgba(255, 152, 20, 0.25)",
            "--sjs-secondary-forecolor": "rgba(255, 255, 255, 1)",
            "--sjs-secondary-forecolor-light": "rgba(255, 255, 255, 0.25)",
            "--sjs-shadow-small": "0px 0px 0px 2px rgba(0, 0, 0, 0.07)",
            "--sjs-shadow-medium": "0px 0px 0px 2px rgba(0, 0, 0, 0.08),0px 2px 6px 0px rgba(0, 0, 0, 0.04)",
            "--sjs-shadow-large": "0px 8px 16px 0px rgba(0, 0, 0, 0.08)",
            "--sjs-shadow-inner": "0px 0px 0px 2px rgba(0, 0, 0, 0.1)",
            "--sjs-border-light": "rgba(0, 0, 0, 0.1)",
            "--sjs-border-default": "rgba(0, 0, 0, 0.1)",
            "--sjs-border-inside": "rgba(0, 0, 0, 0.16)",
            "--sjs-special-red": "rgba(229, 10, 62, 1)",
            "--sjs-special-red-light": "rgba(229, 10, 62, 0.1)",
            "--sjs-special-red-forecolor": "rgba(255, 255, 255, 1)",
            "--sjs-special-green": "rgba(25, 179, 148, 1)",
            "--sjs-special-green-light": "rgba(25, 179, 148, 0.1)",
            "--sjs-special-green-forecolor": "rgba(255, 255, 255, 1)",
            "--sjs-special-blue": "rgba(67, 127, 217, 1)",
            "--sjs-special-blue-light": "rgba(67, 127, 217, 0.1)",
            "--sjs-special-blue-forecolor": "rgba(255, 255, 255, 1)",
            "--sjs-special-yellow": "rgba(255, 152, 20, 1)",
            "--sjs-special-yellow-light": "rgba(255, 152, 20, 0.1)",
            "--sjs-special-yellow-forecolor": "rgba(255, 255, 255, 1)",
            "--sjs-article-font-xx-large-fontSize": "64px",
            "--sjs-article-font-xx-large-textDecoration": "none",
            "--sjs-article-font-xx-large-fontWeight": "700",
            "--sjs-article-font-xx-large-fontStyle": "normal",
            "--sjs-article-font-xx-large-fontStretch": "normal",
            "--sjs-article-font-xx-large-letterSpacing": "0",
            "--sjs-article-font-xx-large-lineHeight": "64px",
            "--sjs-article-font-xx-large-paragraphIndent": "0px",
            "--sjs-article-font-xx-large-textCase": "none",
            "--sjs-article-font-x-large-fontSize": "48px",
            "--sjs-article-font-x-large-textDecoration": "none",
            "--sjs-article-font-x-large-fontWeight": "700",
            "--sjs-article-font-x-large-fontStyle": "normal",
            "--sjs-article-font-x-large-fontStretch": "normal",
            "--sjs-article-font-x-large-letterSpacing": "0",
            "--sjs-article-font-x-large-lineHeight": "56px",
            "--sjs-article-font-x-large-paragraphIndent": "0px",
            "--sjs-article-font-x-large-textCase": "none",
            "--sjs-article-font-large-fontSize": "32px",
            "--sjs-article-font-large-textDecoration": "none",
            "--sjs-article-font-large-fontWeight": "700",
            "--sjs-article-font-large-fontStyle": "normal",
            "--sjs-article-font-large-fontStretch": "normal",
            "--sjs-article-font-large-letterSpacing": "0",
            "--sjs-article-font-large-lineHeight": "40px",
            "--sjs-article-font-large-paragraphIndent": "0px",
            "--sjs-article-font-large-textCase": "none",
            "--sjs-article-font-medium-fontSize": "24px",
            "--sjs-article-font-medium-textDecoration": "none",
            "--sjs-article-font-medium-fontWeight": "700",
            "--sjs-article-font-medium-fontStyle": "normal",
            "--sjs-article-font-medium-fontStretch": "normal",
            "--sjs-article-font-medium-letterSpacing": "0",
            "--sjs-article-font-medium-lineHeight": "32px",
            "--sjs-article-font-medium-paragraphIndent": "0px",
            "--sjs-article-font-medium-textCase": "none",
            "--sjs-article-font-default-fontSize": "16px",
            "--sjs-article-font-default-textDecoration": "none",
            "--sjs-article-font-default-fontWeight": "400",
            "--sjs-article-font-default-fontStyle": "normal",
            "--sjs-article-font-default-fontStretch": "normal",
            "--sjs-article-font-default-letterSpacing": "0",
            "--sjs-article-font-default-lineHeight": "28px",
            "--sjs-article-font-default-paragraphIndent": "0px",
            "--sjs-article-font-default-textCase": "none",
            "--sjs-question-background": "rgba(255, 255, 255, 1)"
         },
         "themeName": "doubleborder",
         "colorPalette": "light"
      };


      if (isAuthenticated) {
         let user = @json(auth()->user());
         // Update nilai default dalam surveyJson
         surveyJson.pages[0].elements.find(element => element.name === "nama").defaultValue = user.name;
         surveyJson.pages[0].elements.find(element => element.name === "email").defaultValue = user.email;
      }

      const survey = new Survey.Model(surveyJson);
      survey.focusFirstQuestionAutomatic = false;
      survey.applyTheme(themeJson);

      function alertResults(sender) {
         const results = JSON.stringify(sender.data);
         @this.dispatch('storeSurvey', {
            results: results
         });
         $("#cardInformation").removeClass('d-none');
         $("#hasilSurvey").removeClass('d-none');
      }

      survey.onComplete.add(alertResults);

      $("#surveyContainer").Survey({
         model: survey
      });

   }
</script>
