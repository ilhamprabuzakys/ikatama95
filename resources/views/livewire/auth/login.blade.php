  <!--begin::Form-->
  <form class="form w-100" wire:submit.prevent='authenticate' id="sign_in_form">
     <!--begin::Heading-->
     <div class="text-center mb-11">
        <!--begin::Title-->
        <h1 class="text-dark fw-bolder mb-3">Masuk ke Aplikasi</h1>
        <!--end::Title-->
        <!--begin::Subtitle-->
        <div class="text-gray-500 fw-semibold fs-6">Masuk ke aplikasi Alumni AKPOL Angkatan 95 Patriatama atau <b>IKATAMA 95</b></div>
        <!--end::Subtitle=-->
     </div>
     <!--begin::Input group=-->
     <div class="fv-row mb-8">
        <!--begin::Email-->
        {{-- <input type="text" placeholder="Email" name="email" autocomplete="off" class="form-control bg-transparent" /> --}}
        <!--end::Email-->
        <div class="input-group">
           <span class="input-group-text" id="basic-addon1">
              <i class="fas fa-inbox fs-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
           </span>
           <input type="text" class="form-control" placeholder="Username atau NRP anda" wire:model='login' aria-label="Email anda" aria-describedby="basic-addon1" />
        </div>
     </div>
     <!--end::Input group=-->
     <div class="fv-row mb-3">
        <!--begin::Password-->
        {{-- <input type="password" placeholder="Password" name="password" autocomplete="off" class="form-control bg-transparent" /> --}}
        <!--end::Password-->
        <div class="input-group">
           <span class="input-group-text" id="basic-addon2">
              <i class="fas fa-calendar fs-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
           </span>
           <input type="text" class="form-control" wire:model='password' placeholder="Tanggal lahir anda - YYYY-MM-DD: 1973-07-01" aria-label="Password" aria-describedby="basic-addon2" />
        </div>
     </div>
     <!--end::Input group=-->
     <!--begin::Wrapper-->
     <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
        <div></div>
        <!--begin::Link-->
        <a href="{{ route('lupa-password') }}" wire:navigate class="link-primary">Lupa Password ?</a>
        <!--end::Link-->
     </div>
     <!--end::Wrapper-->
     <!--begin::Submit button-->
     <div class="d-grid mb-10">
        <button type="submit" id="sign_in_btn" class="btn btn-primary d-flex justify-content-center align-items-center">
           <!--begin::Indicator label-->
           <div wire:loading wire:target='authenticate'>
              <span class="spinner-border" role="status" aria-hidden="true"></span>
              <span class="visually-hidden">Loading...</span>
           </div>
           <i class="fas fa-sign-in-alt me-2"></i>
           <!--begin::Indicator label-->
           <span class="indicator-label">Masuk</span>
           <!--end::Indicator label-->
           <!--begin::Indicator progress-->
           <span class="indicator-progress">Please wait...
              <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
           <!--end::Indicator progress-->
        </button>
        <a href="{{ route('survey.isi') }}" id="survey_btn" class="btn btn-success mt-2 d-flex justify-content-center align-items-center">
           <i class="fas fa-file-pen me-2"></i>
           <!--begin::Indicator label-->
           <span class="indicator-label">Isi Survey Disini</span>
           <!--end::Indicator label-->
        </a>
     </div>
     <!--end::Submit button-->
     <!--begin::Sign up-->
     <div class="text-gray-500 text-center fw-semibold fs-6">Tidak tau cara untuk masuk? Unduh panduan masuknya
        <a href="{{ asset('panduan/Panduan Masuk ke aplikasi IKATAMA 95.pdf') }}" target="_blank" class="link-primary">disini</a>
     </div>
     <!--end::Sign up-->
  </form>
  <!--end::Form-->

  