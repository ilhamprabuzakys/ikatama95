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
   <!--begin::Card header-->
   <div class="card-header border-0 pt-6">
      <!--begin::Card toolbar-->
      <div class="card-toolbar">
         <!--begin::Group actions-->
         <div class="d-flex justify-content-end align-items-center d-none"
            data-kt-user-table-toolbar="selected">
            <div class="fw-bold me-5">
               <span class="me-2" data-kt-user-table-select="selected_count"></span>Selected
            </div>
            <button type="button" class="btn btn-danger"
               data-kt-user-table-select="delete_selected">Delete Selected</button>
         </div>
         <!--end::Group actions-->
      </div>
      <!--end::Card toolbar-->
   </div>
   <!--end::Card header-->
   <!--begin::Card body-->
   <div class="card-body py-4">
      <div id="surveyContainer"></div>
   </div>
   <!--end::Card body-->
</div>

@push('script')
   <script>
      $(document).ready(function() {
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

         $(function() {
            $("#surveyContainer").Survey({
               model: survey
            });
         });
      });
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
   <div wire:ignore.self class="modal fade" id="kt_modal_export_users" tabindex="-1" aria-hidden="true">
      <!--begin::Modal dialog-->
      <div class="modal-dialog modal-dialog-centered mw-650px">
         <!--begin::Modal content-->
         <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
               <!--begin::Modal title-->
               <h2 class="fw-bold">Ekspor Data Formulir</h2>
               <!--end::Modal title-->
               <!--begin::Close-->
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

               <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
               <!--begin::Form-->
               <form id="kt_modal_export_users_form" class="form" action="#">
                  <!--begin::Input group-->
                  <div class="fv-row mb-10">
                     <!--begin::Label-->
                     <label class="fs-6 fw-semibold form-label mb-2">Pilih Rentang waktu:</label>
                     <!--end::Label-->
                     <!--begin::Input-->
                     <select name="role" data-control="select2"
                        data-placeholder="Pilih rentang waktu" data-hide-search="true"
                        class="form-select form-select-solid fw-bold">
                        <option></option>
                        <option value="semua">Semua</option>
                        <option value="superadmin">Hari ini</option>
                        <option value="admin">Kemarin</option>
                        <option value="admin">Satu minggu ini</option>
                        <option value="admin">Satu bulan ini</option>
                        <option value="admin">Tiga bulan ini</option>
                     </select>
                     <!--end::Input-->
                  </div>
                  <!--end::Input group-->
                  <!--begin::Input group-->
                  <div class="fv-row mb-10">
                     <!--begin::Label-->
                     <label class="required fs-6 fw-semibold form-label mb-2">Pilih Format Ekspor:</label>
                     <!--end::Label-->
                     <!--begin::Input-->
                     <select name="format" data-control="select2"
                        data-placeholder="Select a format" data-hide-search="true"
                        class="form-select form-select-solid fw-bold">
                        <option></option>
                        <option value="excel">Excel</option>
                        <option value="pdf">PDF</option>
                        <option value="zip">ZIP</option>
                     </select>
                     <!--end::Input-->
                  </div>
                  <!--end::Input group-->
                  <!--begin::Actions-->
                  <div class="text-center">
                     <button type="reset" class="btn btn-danger me-3"
                        data-bs-dismiss="modal"><i class="fas fa-xmark me-2"></i>Batalkan</button>
                     <button type="submit" class="btn btn-primary"
                        data-kt-users-modal-action="submit">
                        <span class="indicator-label"><i class="fas fa-file-export me-2"></i>Ekspor Data</span>
                        <span class="indicator-progress">Please wait...
                           <span
                              class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                     </button>
                  </div>
                  <!--end::Actions-->
               </form>
               <!--end::Form-->
            </div>
            <!--end::Modal body-->
         </div>
         <!--end::Modal content-->
      </div>
      <!--end::Modal dialog-->
   </div>
   <div wire:ignore.self class="modal fade" id="kt_modal_add_user" tabindex="-1" aria-hidden="true">
      <!--begin::Modal dialog-->
      <div class="modal-dialog modal-dialog-centered mw-650px">
         <!--begin::Modal content-->
         <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_add_user_header">
               <!--begin::Modal title-->
               <h2 class="fw-bold">Undang Admin</h2>
               <!--end::Modal title-->
               <!--begin::Close-->
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

               <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
               <!--begin::Form-->
               <form id="kt_modal_add_user_form" class="form" action="#">
                  <!--begin::Scroll-->
                  <div class="d-flex flex-column scroll-y me-n7 pe-7"
                     id="kt_modal_add_user_scroll" data-kt-scroll="true"
                     data-kt-scroll-activate="{default: false, lg: true}"
                     data-kt-scroll-max-height="auto"
                     data-kt-scroll-dependencies="#kt_modal_add_user_header"
                     data-kt-scroll-wrappers="#kt_modal_add_user_scroll"
                     data-kt-scroll-offset="300px">
                     <!--begin::Input group-->
                     <div class="row mb-7">
                        <div class="col-4 d-flex align-items-center">
                           <label for="email" class="required form-label">Email</label>
                        </div>
                        <div class="col-8">
                           <!--begin::Input-->
                           <input type="email" name="user_name"
                              class="form-control mb-3 mb-lg-0"
                              placeholder="Full name" value="Emma Smith" />
                        </div>
                     </div>
                     <!--end::Input group-->
                     <!--begin::Input group-->
                     <div class="mb-7">
                        <!--begin::Label-->
                        <label class="required fw-semibold fs-6 mb-5">Peranan</label>
                        <!--end::Label-->
                        <!--begin::Roles-->
                        <!--begin::Input row-->
                        <div class="d-flex fv-row">
                           <!--begin::Radio-->
                           <div class="form-check form-check-custom form-check-solid">
                              <!--begin::Input-->
                              <input class="form-check-input me-3" name="user_role"
                                 type="radio" value="0" id="kt_modal_update_role_option_0"
                                 checked='checked' />
                              <!--end::Input-->
                              <!--begin::Label-->
                              <label class="form-check-label"
                                 for="kt_modal_update_role_option_0">
                                 <div class="fw-bold text-gray-800">Super Admin</div>
                                 <div class="text-gray-600">Mengelola <b>seluruh</b> data pada aplikasi.</div>
                              </label>
                              <!--end::Label-->
                           </div>
                           <!--end::Radio-->
                        </div>
                        <!--end::Input row-->
                        <div class='separator separator-dashed my-5'></div>
                        <!--begin::Input row-->
                        <div class="d-flex fv-row">
                           <!--begin::Radio-->
                           <div class="form-check form-check-custom form-check-solid">
                              <!--begin::Input-->
                              <input class="form-check-input me-3" name="user_role"
                                 type="radio" value="1"
                                 id="kt_modal_update_role_option_1" />
                              <!--end::Input-->
                              <!--begin::Label-->
                              <label class="form-check-label"
                                 for="kt_modal_update_role_option_1">
                                 <div class="fw-bold text-gray-800">Admin</div>
                                 <div class="text-gray-600">Hanya mengelola data yang berkaitan dengan <b>Relawan</b></div>
                              </label>
                              <!--end::Label-->
                           </div>
                           <!--end::Radio-->
                        </div>
                        <!--end::Input row-->
                        <!--end::Roles-->
                     </div>
                     <!--end::Input group-->
                  </div>
                  <!--end::Scroll-->
                  <!--begin::Actions-->
                  <div class="text-center pt-15">
                     <button type="reset" class="btn btn-danger me-3" data-bs-dismiss="modal"><i class="fas fa-xmark me-2"></i>Batalkan</button>
                     <button type="submit" class="btn btn-primary"
                        data-kt-users-modal-action="submit">
                        <span class="indicator-label"><i class="fas fa-save me-2"></i>Undang</span>
                        <span class="indicator-progress">Please wait...
                           <span
                              class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                     </button>
                  </div>
                  <!--end::Actions-->
               </form>
               <!--end::Form-->
            </div>
            <!--end::Modal body-->
         </div>
         <!--end::Modal content-->
      </div>
      <!--end::Modal dialog-->
   </div>
@endpush
