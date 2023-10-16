@push('breadcrumb')
   <!--begin::Toolbar-->
   <div id="kt_app_toolbar" class="app-toolbar pt-6 pb-2">
      <!--begin::Toolbar container-->
      <div id="kt_app_toolbar_container"
         class="app-container container-fluid d-flex align-items-stretch">
         <!--begin::Toolbar wrapper-->
         <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
               <!--begin::Title-->
               <h1
                  class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">
                  {{ $title }}</h1>
               <!--end::Title-->
               <!--begin::Breadcrumb-->
               <ol class="breadcrumb fw-semibold fs-7 my-0">
                  <!--begin::Item-->
                  <li class="breadcrumb-item text-muted">
                     <a href="{{ route('dashboard') }}"
                        class="text-muted text-hover-primary">Beranda</a>
                  </li>
                  <!--end::Item-->
                  <!--begin::Item-->
                  <li class="breadcrumb-item text-muted">Formulir</li>
                  <!--end::Item-->
                  <!--begin::Item-->
                  <li class="breadcrumb-item text-muted">{{ $title }}</li>
                  <!--end::Item-->
               </ol>
               <!--end::Breadcrumb-->
            </div>

            <!--begin::Actions-->
            <div class="d-flex align-items-center gap-2 gap-lg-3">
               <!--begin::Export-->
               <button type="button" class="btn btn-light-success me-3" data-bs-toggle="modal"
                  data-bs-target="#exportHasilSurveyModal">
                  <i class="ki-outline ki-exit-up fs-2"></i>Export</button>
               <!--end::Export-->
               <!--begin::Add user-->
               <a href="{{ route('survey.isi') }}" class="btn btn-primary" target="_blank">
                  <i class="ki-outline ki-eye me-1 fs-3"></i>Lihat Formulir</a>
               <!--end::Add user-->
            </div>
            <!--end::Actions-->
            <!--end::Page title-->
         </div>
         <!--end::Toolbar wrapper-->
      </div>
      <!--end::Toolbar container-->
   </div>
   <!--end::Toolbar-->
@endpush
<div class="card border-0">
   <!--begin::Card header-->
   <div class="card-header border-0 pt-6">
      <!--begin::Card title-->
      <div class="card-title">
         <div class="d-flex align-items-center position-relative my-1 me-2">
            <select class="form-select form-select-solid" id="pageFilter" wire:model.live.200ms='paginate'>
               <option selected value="5">5</option>
               <option value="10">10</option>
               <option value="15">15</option>
            </select>
         </div>
         <!--begin::Search-->
         <div class="d-flex align-items-center position-relative my-1">
            <i class="ki-outline ki-magnifier fs-3 position-absolute ms-5"></i>
            <input type="search" data-kt-user-table-filter="search" wire:model.live.debounce.400ms='search'
               class="form-control form-control-solid w-250px ps-13"
               placeholder="Cari Formulir" />
         </div>
         <!--end::Search-->

         <!--begin::Filter Date-->
         <div class="d-flex align-items-center position-relative my-1 ms-5">
            <i wire:click="$dispatch('resetFilterDate')" class="fa fa-xmark text-danger fs-3 position-absolute ms-5" style="right: 10px; cursor:pointer;"></i>
            <input class="form-control form-control-solid w-300px ps-13" placeholder="Pilih jarak tanggal" id="filter_date" wire:model.live='filter_date' style="cursor:pointer;" />
            <i class="fa fa-calendar-alt fs-3 position-absolute" style="left: 5%;"></i>
         </div>
         <!--end::Filter Date-->
      </div>
      <!--begin::Card title-->
      <!--begin::Card toolbar-->
      <div class="card-toolbar">
         <!--begin::Group actions-->
         <div class="d-flex justify-content-end align-items-center {{ $downloadTarget == [] ? 'd-none' : '' }}"
            data-kt-user-table-toolbar="selected">
            <div class="fw-bold text-gray-700 me-5">
               <span class="me-2 text-danger" data-kt-user-table-select="selected_count">{{ count($downloadTarget) }}</span>Terpilih
            </div>
            <button type="button" class="btn btn-primary" wire:click='bulkDownload()'
               data-kt-user-table-select="delete_selected"><i class="fas fa-print me-2"></i>Unduh Data Terpilih</button>
         </div>
         <!--end::Group actions-->
      </div>
      <!--end::Card toolbar-->
   </div>
   <!--end::Card header-->
   <!--begin::Card body-->
   <div class="card-body py-4">
      @include('livewire.dashboard.formulir.formulir-index.table')
   </div>
   <!--end::Card body-->
   @include('livewire.dashboard.formulir.formulir-index.export')
</div>

@push('scripts')
   <script>
      var start = moment().subtract(29, "days");
      var end = moment();

      function cb(start, end) {
         $("#filter_date").html(start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY"));
      }

      $("#filter_date").daterangepicker({
         startDate: start,
         endDate: end,
         ranges: {
            "Today": [moment(), moment()],
            "Yesterday": [moment().subtract(1, "days"), moment().subtract(1, "days")],
            "Last 7 Days": [moment().subtract(6, "days"), moment()],
            "Last 30 Days": [moment().subtract(29, "days"), moment()],
            "This Month": [moment().startOf("month"), moment().endOf("month")],
            "Last Month": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf("month")]
         }
      }, cb);

      cb(start, end);

      $('#filter_date').on('change', function(e) {
         var data = $('#filter_date').val();
         @this.set('filter_date', data);
      });
      // $("#filter_date").daterangepicker();
      $('#filter_date').val('');

      Livewire.on('resetFilterDate', () => {
         @this.set('filter_date', '');
         $('#filter_date').val('');
      });

      $('#exportExcel').click(function(e) {
         Livewire.dispatch('swal:loading');
         console.log('ok..');
      });

      Livewire.on('startDownload', data => {
         // Swal.close();
         window.location.href = data[0].url; // Mulai unduhan setelah swal tertutup
         // console.log(data[0].url);
         Swal.fire({
            title: 'Mempersiapkan Unduhan...',
            didOpen: () => {
               Swal.showLoading();
            },
            allowOutsideClick: false,
            allowEscapeKey: false,
            showConfirmButton: false,
            timer: 6000, // misalnya, tunggu 2 detik sebelum mulai unduhan
            didClose: () => {
            }
         });
      });
      Livewire.on('downloadUrlNya', function() {
         console.log('nyampe ui');
         // var urls = @json($downloadUrls);
         // urls.forEach(function(url) {
         //    window.open(url, '_blank');
         // });
      });
   </script>
@endpush
