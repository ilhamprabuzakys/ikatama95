<div>
   @include('livewire.dashboard.pengaturan.partials.navbar-profile')

   <!--begin::Sign-in Method-->
   <div class="card mb-5 mb-xl-10">
      <!--begin::Card header-->
      <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
         data-bs-target="#kt_account_signin_method">
         <div class="card-title m-0">
            <h3 class="fw-bold m-0">Keamanan Akun</h3>
         </div>
      </div>
      <!--end::Card header-->
      <!--begin::Content-->
      <div id="kt_account_settings_signin_method" class="collapse show">
         <!--begin::Card body-->
         <div class="card-body border-top p-9">
            <!--begin::Email Address-->
            <div class="d-flex flex-wrap align-items-center">
               <!--begin::Label-->
               <div id="kt_signin_email">
                  <div class="fs-6 fw-bold mb-1">Alamat Email</div>
                  @if(auth()->user()->email == '' || auth()->user()->email == null)
                  <div class="fw-semibold text-gray-600">Anda belum mengatur alamat email anda.</div>                     
                  @else   
                  <div class="fw-semibold text-gray-600">{{ auth()->user()->email }}</div>                     
                  @endif
               </div>
               <!--end::Label-->
               <!--begin::Edit-->
               <div id="kt_signin_email_edit" class="flex-row-fluid d-none">
                  <!--begin::Form-->
                  <form id="kt_signin_change_email" class="form" novalidate="novalidate">
                     <div class="row mb-6">
                        <div class="col-lg-6 mb-4 mb-lg-0">
                           <div class="fv-row mb-0">
                              <label for="emailaddress" class="form-label fs-6 fw-bold mb-3">Masukan Alamat Email Baru</label>
                              <input type="email"
                                 class="form-control form-control-lg form-control-solid"
                                 id="emailaddress" placeholder="Email Address" name="emailaddress"
                                 value="support@keenthemes.com" />
                           </div>
                        </div>
                        <div class="col-lg-6">
                           <div class="fv-row mb-0">
                              <label for="confirmemailpassword"
                                 class="form-label fs-6 fw-bold mb-3">Konfirmasi Password</label>
                              <input type="password"
                                 class="form-control form-control-lg form-control-solid"
                                 name="confirmemailpassword" id="confirmemailpassword" />
                           </div>
                        </div>
                     </div>
                     <div class="d-flex">
                        <button id="kt_signin_submit" type="button"
                           class="btn btn-primary me-2 px-6"><i class="fas fa-check-square me-2"></i>Perbarui Email</button>
                        <button id="kt_signin_cancel" type="button"
                           class="btn btn-color-gray-400 btn-active-light-primary px-6"><i class="fas fa-xmark me-2"></i>Batalkan</button>
                     </div>
                  </form>
                  <!--end::Form-->
               </div>
               <!--end::Edit-->
               <!--begin::Action-->
               <div id="kt_signin_email_button" class="ms-auto">
                  @if(auth()->user()->email == '' || auth()->user()->email == null)
                  <button class="btn btn-light btn-active-light-primary">Atur Email</button>
                  @else   
                  <button class="btn btn-light btn-active-light-primary">Ganti Email</button>
                  @endif
               </div>
               <!--end::Action-->
            </div>
            <!--end::Email Address-->
            <!--begin::Separator-->
            <div class="separator separator-dashed my-6"></div>
            <!--end::Separator-->
            <!--begin::Password-->
            <div class="d-flex flex-wrap align-items-center mb-10">
               <!--begin::Label-->
               <div id="kt_signin_password">
                  <div class="fs-6 fw-bold mb-1">Password</div>
                  <div class="fw-semibold text-gray-600">************</div>
               </div>
               <!--end::Label-->
               <!--begin::Edit-->
               {{-- <div id="kt_signin_password_edit" class="flex-row-fluid d-none">
                  <!--begin::Form-->
                  <form id="kt_signin_change_password" class="form" novalidate="novalidate">
                     <div class="row mb-1">
                        <div class="col-lg-4">
                           <div class="fv-row mb-0">
                              <label for="currentpassword"
                                 class="form-label fs-6 fw-bold mb-3">Password saat ini</label>
                              <input type="password"
                                 class="form-control form-control-lg form-control-solid"
                                 name="currentpassword" id="currentpassword" />
                           </div>
                        </div>
                        <div class="col-lg-4">
                           <div class="fv-row mb-0">
                              <label for="newpassword" class="form-label fs-6 fw-bold mb-3">Password baru</label>
                              <input type="password"
                                 class="form-control form-control-lg form-control-solid"
                                 name="newpassword" id="newpassword" />
                           </div>
                        </div>
                        <div class="col-lg-4">
                           <div class="fv-row mb-0">
                              <label for="confirmpassword"
                                 class="form-label fs-6 fw-bold mb-3">Konfirmasi Password</label>
                              <input type="password"
                                 class="form-control form-control-lg form-control-solid"
                                 name="confirmpassword" id="confirmpassword" />
                           </div>
                        </div>
                     </div>
                     <div class="form-text mb-5">Password minimal 8 karakter</div>
                     <div class="d-flex">
                        <button id="kt_password_submit" type="button"
                           class="btn btn-primary me-2 px-6"><i class="fas fa-check-double me-2"></i>Perbarui Password</button>
                        <button id="kt_password_cancel" type="button"
                           class="btn btn-color-gray-400 btn-active-light-primary px-6"><i class="fas fa-xmark me-2"></i>Batalkan</button>
                     </div>
                  </form>
                  <!--end::Form-->
               </div> --}}
               <!--end::Edit-->
               <!--begin::Action-->
               <div id="kt_signin_password_button" class="ms-auto">
                  <button class="btn btn-light btn-active-light-primary" data-bs-toggle="modal"
                  data-bs-target="#gantiPassword">Ganti Password</button>
               </div>
               <!--end::Action-->
            </div>
            <!--end::Password-->

            {{-- Modal Ganti Password --}}
            <div wire:ignore.self class="modal fade" id="createUserModal" tabindex="-1" aria-hidden="true">
               <!--begin::Modal dialog-->
               <div class="modal-dialog modal-dialog-centered mw-650px">
                  <!--begin::Modal content-->
                  <div class="modal-content">
                     <!--begin::Modal header-->
                     <div class="modal-header" id="kt_modal_add_user_header">
                        <!--begin::Modal title-->
                        <h2 class="fw-bold">Tambah User</h2>
                        <!--end::Modal title-->
                        <!--begin::Close-->
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            
                        <!--end::Close-->
                     </div>
                     <!--end::Modal header-->
                     <!--begin::Modal body-->
                     <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                        <div class="modal-body">
                           <div class="row justify-content-between mb-2">
                              <div class="col-3">
                                 <label for="title" class="form-label">Password Saat Ini</label>
                              </div>
                              <div class="col-9">
                                 <input type="password"
                                    class="form-control @error('current_password')
                                    is-invalid
                                 @enderror" wire:model="current_password">
                                 @error('current_password')
                                    <div class="small ms-2 mt-1 text-danger">
                                       {{ $message }}
                                    </div>
                                 @enderror
                              </div>
                           </div>
                           <div class="row justify-content-between mb-2">
                              <div class="col-3">
                                 <label for="title" class="form-label">Password Baru</label>
                              </div>
                              <div class="col-9">
                                 <input type="password"
                                    class="form-control @error('new_password')
                                    is-invalid
                                 @enderror" wire:model="new_password">
                                 @error('new_password')
                                    <div class="small ms-2 mt-1 text-danger">
                                       {{ $message }}
                                    </div>
                                 @enderror
                              </div>
                           </div>

                           <div class="row justify-content-between mb-2">
                              <div class="col-3">
                                 <label for="title" class="form-label">Konfirmasi Password Baru</label>
                              </div>
                              <div class="col-9">
                                 <input type="password"
                                    class="form-control @error('confirmnew_password')
                                    is-invalid
                                 @enderror" wire:model="confirmnew_password">
                                 @error('confirmnew_password')
                                    <div class="small ms-2 mt-1 text-danger">
                                       {{ $message }}
                                    </div>
                                 @enderror
                              </div>
                           </div>
                        
                           <div class="text-center pt-15">
                              <button type="reset" wire:click='closeModal()' class="btn btn-danger me-3" data-bs-dismiss="modal"><i class="fas fa-xmark me-2"></i>Batalkan</button>
                              <button type="submit" wire:click='updatePassword()' class="btn btn-primary"
                                 data-kt-users-modal-action="submit">
                                 <span class="indicator-label"><i class="fas fa-save me-2"></i>Simpan</span>
                                 <span class="indicator-progress">Please wait...
                                    <span
                                       class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                              </button>
                           </div>
                           <!--end::Form-->
                        </div>
                        <!--end::Modal body-->
                     </div>
                     <!--end::Modal content-->
                  </div>
                  <!--end::Modal dialog-->
               </div>
            </div><!-- /.modal -->            


            {{--  <!--begin::Notice-->
          <div
             class="notice d-flex bg-light-primary rounded border-primary border border-dashed p-6">
             <!--begin::Icon-->
             <i class="ki-outline ki-shield-tick fs-2tx text-primary me-4"></i>
             <!--end::Icon-->
             <!--begin::Wrapper-->
             <div class="d-flex flex-stack flex-grow-1 flex-wrap flex-md-nowrap">
                <!--begin::Content-->
                <div class="mb-3 mb-md-0 fw-semibold">
                   <h4 class="text-gray-900 fw-bold">Secure Your Account</h4>
                   <div class="fs-6 text-gray-700 pe-7">Two-factor authentication adds an extra
                      layer of security to your account. To log in, in addition you'll need to
                      provide a 6 digit code</div>
                </div>
                <!--end::Content-->
                <!--begin::Action-->
                <a href="#" class="btn btn-primary px-6 align-self-center text-nowrap"
                   data-bs-toggle="modal"
                   data-bs-target="#kt_modal_two_factor_authentication">Enable</a>
                <!--end::Action-->
             </div>
             <!--end::Wrapper-->
          </div>
          <!--end::Notice--> --}}
         </div>
         <!--end::Card body-->
      </div>
      <!--end::Content-->
   </div>
   <!--end::Sign-in Method-->
</div>
