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
               <div id="kt_signin_password_edit" class="flex-row-fluid d-none">
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
               </div>
               <!--end::Edit-->
               <!--begin::Action-->
               <div id="kt_signin_password_button" class="ms-auto">
                  <button class="btn btn-light btn-active-light-primary">Ganti Password</button>
               </div>
               <!--end::Action-->
            </div>
            <!--end::Password-->
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
