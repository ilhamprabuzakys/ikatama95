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
                        style="background-image: url('{{ asset('assets/dist/assets/media/svg/avatars/blank.svg') }}')">
                        <!--begin::Preview existing avatar-->
                        <div class="image-input-wrapper w-125px h-125px"
                           @if ($this->avatar && is_object($this->avatar) && method_exists($this->avatar, 'temporaryUrl')) style="background-image: url('{{ $this->avatar->temporaryUrl() }}')"
                        @elseif ($user->avatar)
                        style="background-image: url('{{ asset($user->avatar) }}')"
                        @else
                        style="background-image: url('{{ asset('assets/dist/assets/media/svg/avatars/blank.svg') }}')" @endif>
                        </div>
                        <!--end::Preview existing avatar-->
                        <!--begin::Label-->
                        <label
                           class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                           data-kt-image-input-action="change" data-bs-toggle="tooltip"
                           title="Change avatar">
                           <i class="ki-outline ki-pencil fs-7"></i>
                           <!--begin::Inputs-->
                           <input type="file" name="avatar" wire:model.live='avatar' accept=".png, .jpg, .jpeg" />
                           <input type="hidden" name="avatar_remove" />
                           <!--end::Inputs-->
                        </label>
                        <!--end::Label-->
                        <!--begin::Cancel-->
                        <span
                           class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                           data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                           title="Cancel avatar" wire:click='cancelAvatar()'>
                           <i class="ki-outline ki-cross fs-2"></i>
                        </span>
                        <!--end::Cancel-->
                        <!--begin::Remove-->
                        <span
                           class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                           data-kt-image-input-action="remove" data-bs-toggle="tooltip"
                           title="Hapus avatar" wire:click='resetAvatarDefault()'>
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
                  @error('avatar')
                     <div class="text-danger ms-3 mt-1">
                        {{ $message }}
                     </div>
                  @enderror
               </div>
               <!--end::Input group-->
               <!--begin::Input group-->
               <div class="row mb-6">
                  <!--begin::Label-->
                  <label class="col-lg-4 col-form-label required fw-semibold fs-6">Nama</label>
                  <!--end::Label-->
                  <!--begin::Col-->
                  <div class="col-lg-8">
                     <!--begin::Row-->
                     <div class="row">
                        <!--begin::Col-->
                        <div class="col-lg-12 fv-row">
                           <input type="text" name="name"
                              class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                              placeholder="Nama anda" wire:model='name' />
                        </div>
                        <!--end::Col-->
                        @error('name')
                           <div class="text-danger ms-3 mt-1">
                              {{ $message }}
                           </div>
                        @enderror
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
                     <input type="text" name="phone" wire:model='phone'
                        class="form-control form-control-lg form-control-solid"
                        placeholder="Nomor telepon anda" />
                  </div>
                  <!--end::Col-->
                  @error('phone')
                     <div class="text-danger ms-3 mt-1">
                        {{ $message }}
                     </div>
                  @enderror
               </div>
               <!--end::Input group-->
               <!--begin::Input group-->
               <div class="row mb-6">
                  <!--begin::Label-->
                  <label class="col-lg-4 col-form-label fw-semibold fs-6">
                     <span class="">NRP</span>
                     <span class="ms-1" data-bs-toggle="tooltip"
                        title="Nomor Registrasi Pusat">
                        <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i>
                     </span>
                  </label>
                  <!--end::Label-->
                  <!--begin::Col-->
                  <div class="col-lg-8 fv-row">
                     <input type="number" name="phone" wire:model='nrp'
                        class="form-control form-control-lg form-control-solid"
                        placeholder="Nomor Registrasi Pusat" />
                  </div>
                  <!--end::Col-->
                  @error('nrp')
                     <div class="text-danger ms-3 mt-1">
                        {{ $message }}
                     </div>
                  @enderror
               </div>
               <!--end::Input group-->
               <!--begin::Input group-->
               <div class="row mb-6">
                  <!--begin::Label-->
                  <label class="col-lg-4 col-form-label fw-semibold fs-6">
                     <span class="">Tanggal Lahir</span>
                     <span class="ms-1" data-bs-toggle="tooltip"
                        title="Tanggal Lahir anda">
                        <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i>
                     </span>
                  </label>
                  <!--end::Label-->
                  <!--begin::Col-->
                  <div class="col-lg-8 fv-row">
                     <input type="date" wire:model='dob'
                        class="form-control form-control-lg form-control-solid"
                        placeholder="Tanggal Lahir anda" />
                  </div>
                  <!--end::Col-->
                  @error('dob')
                     <div class="text-danger ms-3 mt-1">
                        {{ $message }}
                     </div>
                  @enderror
               </div>
               <!--end::Input group-->
               <!--begin::Input group-->
               <div class="row mb-6">
                  <!--begin::Label-->
                  <label class="col-lg-4 col-form-label fw-semibold fs-6">
                     <span class="required">Pangkat</span>
                     <span class="ms-1" data-bs-toggle="tooltip"
                        title="Pangkat anda terakhir">
                        <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i>
                     </span>
                  </label>
                  <!--end::Label-->
                  <!--begin::Col-->
                  <div class="col-lg-8 fv-row">
                     <input type="text" name="pangkat" wire:model='pangkat'
                        class="form-control form-control-lg form-control-solid"
                        placeholder="AKPOL ..." />
                  </div>
                  <!--end::Col-->
                  @error('pangkat')
                     <div class="text-danger ms-3 mt-1">
                        {{ $message }}
                     </div>
                  @enderror
               </div>
               <!--end::Input group-->

               <!--begin::Input group-->
               {{-- <div class="row mb-6">
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
               </div> --}}
               <!--end::Input group-->
            </div>
            <!--end::Card body-->
            <!--begin::Actions-->
            <div class="card-footer d-flex justify-content-end py-6 px-9">
               <button type="reset" wire:click='resetField()'
                  class="btn btn-light btn-active-light-primary me-2"><i class="fas fa-xmark me-2"></i>Urungkan</button>
               <button type="button" wire:click='saveChanges()' class="btn btn-primary"
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
