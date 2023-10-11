{{-- @push('breadcrumb')
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
                  Account Settings</h1>
               <!--end::Title-->
               <!--begin::Breadcrumb-->
               <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                  <!--begin::Item-->
                  <li class="breadcrumb-item text-muted">
                     <a href="../../demo39/dist/index.html"
                        class="text-muted text-hover-primary">Home</a>
                  </li>
                  <!--end::Item-->
                  <!--begin::Item-->
                  <li class="breadcrumb-item">
                     <span class="bullet bg-gray-400 w-5px h-2px"></span>
                  </li>
                  <!--end::Item-->
                  <!--begin::Item-->
                  <li class="breadcrumb-item text-muted">Pages</li>
                  <!--end::Item-->
                  <!--begin::Item-->
                  <li class="breadcrumb-item">
                     <span class="bullet bg-gray-400 w-5px h-2px"></span>
                  </li>
                  <!--end::Item-->
                  <!--begin::Item-->
                  <li class="breadcrumb-item text-muted">Account</li>
                  <!--end::Item-->
               </ul>
               <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
            <!--begin::Actions-->
            <div class="d-flex align-items-center gap-2 gap-lg-3">
               <a href="#"
                  class="btn btn-flex btn-outline btn-color-gray-700 btn-active-color-primary bg-body h-40px fs-7 fw-bold"
                  data-bs-toggle="modal" data-bs-target="#kt_modal_view_users">Add Member</a>
               <a href="#" class="btn btn-flex btn-primary h-40px fs-7 fw-bold" data-bs-toggle="modal"
                  data-bs-target="#kt_modal_create_campaign">New Campaign</a>
            </div>
            <!--end::Actions-->
         </div>
         <!--end::Toolbar wrapper-->
      </div>
      <!--end::Toolbar container-->
   </div>
   <!--end::Toolbar-->
@endpush --}}
<div>
   @include('livewire.dashboard.pengaturan.partials.navbar-profile')
   <!--begin::Basic info-->
   <div class="card mb-5 mb-xl-10">
      <!--begin::Card header-->
      <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
         data-bs-target="#kt_account_profile_details" aria-expanded="true"
         aria-controls="kt_account_profile_details">
         <!--begin::Card title-->
         <div class="card-title m-0">
            <h3 class="fw-bold m-0">Detail Profil</h3>
         </div>
         <!--end::Card title-->
      </div>
      <!--begin::Card header-->
      <!--begin::Content-->
      <div id="kt_account_settings_profile_details" class="collapse show">
         <!--begin::Form-->
         <form id="kt_account_profile_details_form" class="form">
            <!--begin::Card body-->
            <div class="card-body border-top p-9">
               <!--begin::Input group-->
               <div class="row mb-6">
                  <!--begin::Label-->
                  <label class="col-lg-4 col-form-label fw-semibold fs-6">Foto Profil</label>
                  <!--end::Label-->
                  <!--begin::Col-->
                  <div class="col-lg-8">
                     <!--begin::Image input-->
                     <div class="image-input image-input-outline" data-kt-image-input="true"
                        style="background-image: url('assets/dist/assets/media/svg/avatars/blank.svg')">
                        <!--begin::Preview existing avatar-->
                        <div class="image-input-wrapper w-125px h-125px"
                           style="background-image: url('{{ asset(auth()->user()->avatar) }}')"></div>
                        <!--end::Preview existing avatar-->
                        <!--begin::Label-->
                        <label
                           class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                           data-kt-image-input-action="change" data-bs-toggle="tooltip"
                           title="Change avatar">
                           <i class="ki-outline ki-pencil fs-7"></i>
                           <!--begin::Inputs-->
                           <input type="file" name="avatar" accept=".png, .jpg, .jpeg" />
                           <input type="hidden" name="avatar_remove" />
                           <!--end::Inputs-->
                        </label>
                        <!--end::Label-->
                        <!--begin::Cancel-->
                        <span
                           class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                           data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                           title="Cancel avatar">
                           <i class="ki-outline ki-cross fs-2"></i>
                        </span>
                        <!--end::Cancel-->
                        <!--begin::Remove-->
                        <span
                           class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                           data-kt-image-input-action="remove" data-bs-toggle="tooltip"
                           title="Remove avatar">
                           <i class="ki-outline ki-cross fs-2"></i>
                        </span>
                        <!--end::Remove-->
                     </div>
                     <!--end::Image input-->
                     <!--begin::Hint-->
                     <div class="form-text">Format yang diizinkan: png, jpg, jpeg.</div>
                     <!--end::Hint-->
                  </div>
                  <!--end::Col-->
               </div>
               <!--end::Input group-->
               <!--begin::Input group-->
               <div class="row mb-6">
                  <!--begin::Label-->
                  <label class="col-lg-4 col-form-label required fw-semibold fs-6">Nama Lengkap</label>
                  <!--end::Label-->
                  <!--begin::Col-->
                  <div class="col-lg-8">
                     <!--begin::Row-->
                     <div class="row">
                        <!--begin::Col-->
                        <div class="col-lg-12 fv-row">
                           <input type="text" name="fname"
                              class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                              placeholder="Nama lengkap" value="Max" />
                        </div>
                        <!--end::Col-->
                        {{-- <!--begin::Col-->
                        <div class="col-lg-6 fv-row">
                           <input type="text" name="lname"
                              class="form-control form-control-lg form-control-solid"
                              placeholder="Last name" value="Smith" />
                        </div>
                        <!--end::Col--> --}}
                     </div>
                     <!--end::Row-->
                  </div>
                  <!--end::Col-->
               </div>
               <!--end::Input group-->
               <!--begin::Input group-->
               <div class="row mb-6">
                  <!--begin::Label-->
                  <label class="col-lg-4 col-form-label fw-semibold fs-6">
                     <span class="required">Nomor Telepon</span>
                     <span class="ms-1" data-bs-toggle="tooltip"
                        title="Nomor telepon harus aktif Whatsapp">
                        <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i>
                     </span>
                  </label>
                  <!--end::Label-->
                  <!--begin::Col-->
                  <div class="col-lg-8 fv-row">
                     <input type="number" name="phone"
                        class="form-control form-control-lg form-control-solid"
                        placeholder="Nomor telepon anda" value="085162783743" />
                  </div>
                  <!--end::Col-->
               </div>
               <!--end::Input group-->
               <!--begin::Input group-->
               <div class="row mb-6">
                  <!--begin::Label-->
                  <label class="col-lg-4 col-form-label fw-semibold fs-6">
                     <span class="required">NIP</span>
                     <span class="ms-1" data-bs-toggle="tooltip"
                        title="Nomor Induk Pegawai">
                        <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i>
                     </span>
                  </label>
                  <!--end::Label-->
                  <!--begin::Col-->
                  <div class="col-lg-8 fv-row">
                     <input type="number" name="phone"
                        class="form-control form-control-lg form-control-solid"
                        placeholder="Nomor Induk Pegawai" />
                  </div>
                  <!--end::Col-->
               </div>
               <!--end::Input group-->
               <!--begin::Input group-->
               <div class="row mb-6">
                  <!--begin::Label-->
                  <label class="col-lg-4 col-form-label fw-semibold fs-6">
                     <span class="required">NIK</span>
                     <span class="ms-1" data-bs-toggle="tooltip"
                        title="Nomor Induk Kependudukan">
                        <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i>
                     </span>
                  </label>
                  <!--end::Label-->
                  <!--begin::Col-->
                  <div class="col-lg-8 fv-row">
                     <input type="number" name="phone"
                        class="form-control form-control-lg form-control-solid"
                        placeholder="Nomor Induk Kependudukan" />
                  </div>
                  <!--end::Col-->
               </div>
               <!--end::Input group-->

               <!--begin::Input group-->
               <div class="row mb-6">
                  <!--begin::Label-->
                  <label
                     class="col-lg-4 col-form-label fw-semibold fs-6">Jenis Kelamin</label>
                  <!--end::Label-->
                  <!--begin::Col-->
                  <div class="col-lg-8 fv-row">
                     <!--begin::Options-->
                     <div class="d-flex align-items-center mt-3">

                        <div class="form-check form-check-inline form-check-custom form-check-primary form-check-solid">
                            <input class="form-check-input" name="gender" type="radio" value="L" checked id="flexCheckboxLg" />
                            <label class="form-check-label" for="flexCheckboxLg">
                               Pria
                            </label>
                         </div>
                        
                         <div class="form-check form-check-inline form-check-custom form-check-danger form-check-solid">
                            <input class="form-check-input" name="gender" type="radio" value="P" id="flexCheckboxLg" />
                            <label class="form-check-label" for="flexCheckboxLg">
                               Wanita
                            </label>
                         </div>

                     </div>
                     <!--end::Options-->
                  </div>
                  <!--end::Col-->
               </div>
               <!--end::Input group-->
            </div>
            <!--end::Card body-->
            <!--begin::Actions-->
            <div class="card-footer d-flex justify-content-end py-6 px-9">
               <button type="reset"
                  class="btn btn-light btn-active-light-primary me-2"><i class="fas fa-xmark me-2"></i>Urungkan</button>
               <button type="submit" class="btn btn-primary"
                  id="kt_account_profile_details_submit"><i class="fas fa-save me-2"></i>Simpan Perubahan</button>
            </div>
            <!--end::Actions-->
         </form>
         <!--end::Form-->
      </div>
      <!--end::Content-->
   </div>
   <!--end::Basic info-->

</div>
