<div wire.ignore.self class="modal fade" id="exportUserModal" tabindex="-1" aria-hidden="true">
   <!--begin::Modal dialog-->
   <div class="modal-dialog modal-dialog-centered mw-650px">
      <!--begin::Modal content-->
      <div class="modal-content">
         <!--begin::Modal header-->
         <div class="modal-header">
            <!--begin::Modal title-->
            <h2 class="fw-bold">Ekspor Data User</h2>
            <!--end::Modal title-->
            <!--begin::Close-->
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            <!--end::Close-->
         </div>
         <!--end::Modal header-->
         <!--begin::Modal body-->
         <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
            <!--begin::Form-->
            <form id="kt_modal_export_users_form" class="form">
               <!--begin::Input group-->
               <div class="fv-row mb-10">
                  <!--begin::Label-->
                  <label class="fs-6 fw-semibold form-label mb-2">Pilih Tipe User:</label>
                  <!--end::Label-->
                  <!--begin::Input-->
                  <select wire:model='export_role'
                     data-placeholder="Pilih role"
                     class="form-select form-select-solid fw-bold">
                     <option></option>
                     <option value="semua" selected>Semua</option>
                     @foreach ($roles as $role)
                     <option value="{{ $role->key }}">{{ $role->label }}</option>
                     @endforeach
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
                  <select wire:model='export_format'
                     data-placeholder="Pilih format hasil ekspor"
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
                  <button type="button" wire:click='exportUser()' class="btn btn-primary">
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