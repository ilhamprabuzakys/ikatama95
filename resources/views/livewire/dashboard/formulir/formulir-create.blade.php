@push('breadcrumb')
   <!--begin::Toolbar-->
   <div id="kt_app_toolbar" class="app-toolbar pt-6 pb-2">
      <!--begin::Toolbar container-->
      <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
         <!--begin::Toolbar wrapper-->
         <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
               <!--begin::Title-->
               <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">{{ $title }}</h1>
               <!--end::Title-->
               <!--begin::Breadcrumb-->
               <ol class="breadcrumb  fw-semibold fs-7 my-0">
                  <!--begin::Item-->
                  <li class="breadcrumb-item text-muted">
                     <a href="{{ route('dashboard') }}" wire:navigate class="text-muted text-hover-primary">Beranda</a>
                  </li>
                  <!--end::Item-->
                  <!--begin::Item-->
                  <li class="breadcrumb-item text-muted">
                     <a href="{{ route('formulir.index') }}" wire:navigate class="text-muted text-hover-primary">Daftar Formulir</a>
                  </li>
                  <!--end::Item-->
                  <!--begin::Item-->
                  <li class="breadcrumb-item text-muted">{{ $title }}</li>
                  <!--end::Item-->
               </ol>
               <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
            <!--begin::Actions-->
            <div class="d-flex align-items-center gap-2 gap-lg-3">
               <a href="{{ route('formulir.index') }}" wire:navigate class="btn btn-flex btn-outline btn-color-gray-700 btn-active-color-primary bg-body h-40px fs-7 fw-bold">Kembali</a>
               <button type="button" id="refreshBTN" class="btn btn-flex btn-outline btn-color-primary btn-active-color-primary bg-body h-40px fs-7 fw-bold"><i
                     class="fas fa-refresh me-2"></i>Reload survey</button>
               <a class="btn btn-flex btn-outline btn-color-primary btn-active-color-primary bg-body h-40px fs-7 fw-bold" wire:click="refresh">
                  <i
                     class="fas fa-refresh me-2"></i>Reload survey</a>
               <button type="button" class="btn btn-flex btn-primary h-40px fs-7 fw-bold" data-bs-toggle="modal">Simpan Formulir</button>
            </div>
            <!--end::Actions-->
         </div>
         <!--end::Toolbar wrapper-->
      </div>
      <!--end::Toolbar container-->
   </div>
   <!--end::Toolbar-->
@endpush
<div class="card border-0">
   <!--begin::Card body-->
   <div class="card-body">
      <div id="surveyContainer"></div>
   </div>
   <!--end::Card body-->
</div>

@push('script')
   <script>
      Livewire.on('reloadSurvey', () => {
         console.log('menginisaliasi survey kembali..')
         const elemen = document.querySelector('[routeName="formulir.create"]');
         // Menambahkan aksi klik ke elemen
         elemen.addEventListener('click', function() {
            // Lakukan sesuatu ketika elemen diklik
            console.log('Elemen diklik');
            // Anda dapat menambahkan kode lain di sini sesuai kebutuhan
         });
      });

      $('#refreshBTN').on('click', function() {
         console.log('Refresh');
         Livewire.dispatch('reloadSurvey');
      });

      document.addEventListener('livewire:navigated', () => {
         initializeSurvey();
      });

      // Livewire.on('reloadSurvey', () => {
      //    console.log('menginisaliasi survey kembali..')
      //    const elemen = document.querySelector('[routeName="formulir.create"]');
      //    // Menambahkan aksi klik ke elemen
      //    elemen.addEventListener('click', function() {
      //       // Lakukan sesuatu ketika elemen diklik
      //       console.log('Elemen diklik');
      //       // Anda dapat menambahkan kode lain di sini sesuai kebutuhan
      //    });
      // });

      $(document).ready(function() {
         initializeSurvey();
      });

      function initializeSurvey() {
         const surveyJson = {
            elements: [{
               name: "FirstName",
               title: "Enter your first name:",
               type: "text"
            }, {
               name: "LastName",
               title: "Enter your last name:",
               type: "text"
            }]
         };

         const survey = new Survey.Model(surveyJson);
         survey.focusFirstQuestionAutomatic = false;

         function alertResults(sender) {
            const results = JSON.stringify(sender.data);
            alert(results);
         }

         survey.onComplete.add(alertResults);

         $("#surveyContainer").Survey({
            model: survey
         });
      }
   </script>
@endpush


@push('style')
   {{-- Survey JS --}}
   {{--  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <link href="https://unpkg.com/survey-jquery/defaultV2.min.css" type="text/css" rel="stylesheet">
   <script type="text/javascript" src="https://unpkg.com/survey-jquery/survey.jquery.min.js"></script> --}}
   {{-- End Survey JS --}}
@endpush

@push('modals')
   @include('livewire.dashboard.formulir.formulir-create.modals')
@endpush
