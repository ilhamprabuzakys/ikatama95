  <!--begin::Form-->
  <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form">
   <!--begin::Heading-->
   <div class="text-center mb-11">
      <!--begin::Title-->
      <h1 class="text-dark fw-bolder mb-3">Pulihkan akun anda</h1>
      <!--end::Title-->
      <!--begin::Subtitle-->
      <div class="text-gray-500 fw-semibold fs-6">Kami akan mengirim link pemulihan akun ke email anda.</div>
      <!--end::Subtitle=-->
   </div>
   <!--begin::Heading-->
   <!--begin::Input group=-->
   <div class="fv-row mb-8">
      <!--begin::Email-->
      {{-- <input type="text" placeholder="Email" name="email" autocomplete="off" class="form-control bg-transparent" /> --}}
      <!--end::Email-->
      <div class="input-group">
         <span class="input-group-text" id="basic-addon1">
            <i class="fas fa-question-circle fs-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
         </span>
         <input type="text" class="form-control" placeholder="Email atau Username anda" aria-label="Email anda" aria-describedby="basic-addon1" />
      </div>
   </div>
   <!--end::Input group=-->
   <!--begin::Wrapper-->
   {{-- <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
      <div></div>
      <!--begin::Link-->
      <span>
         Sudah ingat passwordnya? Login
         <a href="{{ route('lupa-password') }}" class="link-primary">disini</a>
      </span>
      <!--end::Link-->
   </div> --}}
   <!--end::Wrapper-->
   <!--begin::Submit button-->
   <div class="d-grid mb-10">
      <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
         <i class="fas fa-sign-in-alt fs-4 me-2"></i>
         <!--begin::Indicator label-->
         <span class="indicator-label">Pulihkan akun</span>
         <!--end::Indicator label-->
         <!--begin::Indicator progress-->
         <span class="indicator-progress">Please wait...
            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
         <!--end::Indicator progress-->
      </button>
   </div>
   <!--end::Submit button-->
   <!--begin::Sign up-->
   <div class="text-gray-500 text-center fw-semibold fs-6">Sudah ingat passwordnya? Masuk
      <a href="{{ route('login') }}" wire:navigate class="link-primary">disini</a>
   </div>
   <!--end::Sign up-->
</form>
<!--end::Form-->
