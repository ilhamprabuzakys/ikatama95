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
                  {{ __('Daftar User') }}</h1>
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
                  <li class="breadcrumb-item text-muted">Konfigurasi</li>
                  <!--end::Item-->
                  <!--begin::Item-->
                  <li class="breadcrumb-item text-muted">{{ $title }}</li>
                  <!--end::Item-->
               </ol>
               <!--end::Breadcrumb-->
            </div>

            <!--begin::Actions-->
            <div class="d-flex align-items-center gap-2 gap-lg-3">
               <!--begin::Filter-->
               <button type="button" class="btn btn-light-primary me-3"
                  data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                  <i class="ki-outline ki-filter fs-2"></i>Filter</button>
               <!--begin::Menu 1-->
               <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true">
                  <!--begin::Header-->
                  <div class="px-7 py-5">
                     <div class="fs-5 text-dark fw-bold">Opsi Filter</div>
                  </div>
                  <!--end::Header-->
                  <!--begin::Separator-->
                  <div class="separator border-gray-200"></div>
                  <!--end::Separator-->
                  <!--begin::Content-->
                  <div class="px-7 py-5" data-kt-user-table-filter="form">
                     <!--begin::Input group-->
                     <div class="mb-10">
                        <label class="form-label fs-6 fw-semibold">Role:</label>
                        <select class="form-select form-select-solid"
                           data-allow-clear="true" id="filter_role"
                           data-hide-search="true" wire:model='filter_role'>
                           <option selected value="">-- Semua --</option>
                           @foreach ($roles as $role)
                              <option value="{{ $role->key }}">{{ $role->label }}</option>
                           @endforeach
                        </select>
                     </div>
                     <!--end::Input group-->
                     <!--begin::Input group-->
                     <div class="mb-10">
                        <label class="form-label fs-6 fw-semibold">Status Akun</label>
                        <select class="form-select form-select-solid"
                           data-allow-clear="true" id="filter_status_akun"
                           data-hide-search="true" wire:model='filter_status_akun'>
                           <option selected value="">-- Semua --</option>
                           <option value="1">Aktif</option>
                           <option value="0">Tidak Aktif</option>
                        </select>
                     </div>
                     <!--end::Input group-->
                     <!--begin::Actions-->
                     <div class="d-flex justify-content-end">
                        <button type="button"
                           class="btn btn-light btn-active-light-primary fw-semibold me-2 px-6"
                           data-kt-menu-dismiss="true" id="resetFilter"
                           data-kt-user-table-filter="reset"><i class="fas fa-xmark me-2"></i>Reset</button>
                        <button type="button" class="btn btn-primary fw-semibold px-6"
                           data-kt-menu-dismiss="true"
                           data-kt-user-table-filter="filter" id="applyFilter"><i class="fas fa-save me-2"></i>Terapkan</button>
                     </div>
                     <!--end::Actions-->
                  </div>
                  <!--end::Content-->
               </div>
               <!--end::Menu 1-->
               <!--end::Filter-->
               <!--begin::Export-->
               {{-- <button type="button" class="btn btn-light-success me-3" data-bs-toggle="modal"
                  data-bs-target="#exportUserModal">
                  <i class="ki-outline ki-exit-up fs-2"></i>Export</button> --}}
               <!--end::Export-->
               <!--begin::Add user-->
               <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                  data-bs-target="#createUserModal">
                  <i class="ki-outline ki-plus fs-2"></i>Tambah User</button>
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
         <!--begin::Search-->
         <div class="d-flex align-items-center position-relative my-1 me-2">
            <select class="form-select form-select-solid" id="pageFilter" wire:model.live.200ms='paginate'>
               <option selected value="5">5</option>
               <option value="10">10</option>
               <option value="15">15</option>
            </select>
         </div>
         <!--end::Search-->
         <!--begin::Search-->
         <div class="d-flex align-items-center position-relative my-1">
            <i class="ki-outline ki-magnifier fs-3 position-absolute ms-5"></i>
            <input type="search" data-kt-user-table-filter="search" wire:model.live.debounce.400ms='search'
               class="form-control form-control-solid w-500px ps-13"
               placeholder="Cari Pengguna" />
         </div>
         <!--end::Search-->
      </div>
      <!--begin::Card title-->
      <!--begin::Card toolbar-->
      <div class="card-toolbar">
         <!--begin::Group actions-->
         <div class="d-flex justify-content-end align-items-center {{ $deleteTarget == [] ? 'd-none' : '' }}"
            data-kt-user-table-toolbar="selected">
            <div class="fw-bold text-gray-700 me-5">
               <span class="me-2 text-danger" data-kt-user-table-select="selected_count">{{ count($deleteTarget) }}</span>Terpilih
            </div>
            <button type="button" class="btn btn-danger" wire:click='bulkDelete()'
               data-kt-user-table-select="delete_selected"><i class="fas fa-trash-alt me-2"></i>Hapus Data Terpilih</button>
         </div>
         <!--end::Group actions-->

      </div>
      <!--end::Card toolbar-->
   </div>
   <!--end::Card header-->
   <!--begin::Card body-->
   <div class="card-body py-4">
      @include('livewire.dashboard.pengaturan.pengaturan-user.table')
   </div>
   <!--end::Card body-->

   @include('livewire.dashboard.pengaturan.pengaturan-user.export')
   @include('livewire.dashboard.pengaturan.pengaturan-user.edit')
   @include('livewire.dashboard.pengaturan.pengaturan-user.create')
</div>


@push('scripts')
   <script>
      // Skrip Pengaturan User
      let startDatePicker = $("#start_date").flatpickr({
         dateFormat: "Y-m-d",
         altInput: true,
         altFormat: "d F Y",
         onChange: function(selectedDates, dateStr, instance) {
            let endDate = endDatePicker.selectedDates[0];

            if (selectedDates.length && endDate && selectedDates[0] > endDate) {
               // Jika tanggal awal melebihi tanggal akhir, kosongkan tanggal akhir
               endDatePicker.clear();
            }

            // Atur minDate untuk end_date berdasarkan tanggal awal yang dipilih
            endDatePicker.set('minDate', selectedDates[0] || "today");
         }
      });

      let endDatePicker = $("#end_date").flatpickr({
         dateFormat: "Y-m-d",
         altInput: true,
         altFormat: "d F Y"
      });

      $('#start_date').on('change', function(e) {
         var data = $('#start_date').val();
         @this.set('start_date', data);
      });
      $('#end_date').on('change', function(e) {
         var data = $('#end_date').val();
         @this.set('end_date', data);
      });

      // Terapkan Dropdown Filter
      $('#applyFilter').on('click', function(e) {
         @this.set('filter_status_akun', $('#filter_status_akun').val());
         @this.set('filter_role', $('#filter_role').val());

         console.log('status akun: ' + $('#filter_status_akun').val());
         console.log('role:' + $('#filter_role').val());
      });

      // Reset Dropdown Filter
      $('#resetFilter').click(function(e) {
         @this.set('filter_status_akun', '');
         @this.set('filter_role', '');

         // // Menghilangkan parameter query string "role" dan "akun" dari URL
         // const currentURL = window.location.href;
         // const newURL = currentURL.replace(/[\?&](role|akun)=\w*/g, '');
         // // Redirect ke URL baru tanpa parameter tersebut
         // window.location.href = newURL;
      });


      $('#resetDateFilter').click(function(e) {
         @this.set('start_date', '');
         @this.set('end_date', '');
         startDatePicker.clear();
         endDatePicker.clear();
      });

      $('#resetFilter, #applyFilter').on('click', function() {
         $(this).closest('.dropdown-menu').prev('.dropdown-toggle').dropdown('toggle');
      });
   </script>
@endpush


{{-- @push('modals')
@include('livewire.dashboard.pengaturan.pengaturan-user.modals')
@endpush --}}