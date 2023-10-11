  <!--begin::Form-->
  <form class="form w-100" wire:submit.prevent='authenticate' id="sign_in_form">
     <!--begin::Heading-->
     <div class="text-center mb-11">
        <!--begin::Title-->
        <h1 class="text-dark fw-bolder mb-3">Masuk ke Aplikasi</h1>
        <!--end::Title-->
        <!--begin::Subtitle-->
        <div class="text-gray-500 fw-semibold fs-6">Masuk ke Sistem Informasi Pemberdayaan Masyarakat atau <b>DAYAMAS</b></div>
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
              <i class="fas fa-inbox fs-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
           </span>
           <input type="text" class="form-control" placeholder="Email atau Username anda" wire:model='login' aria-label="Email anda" aria-describedby="basic-addon1" />
        </div>
     </div>
     <!--end::Input group=-->
     <div class="fv-row mb-3">
        <!--begin::Password-->
        {{-- <input type="password" placeholder="Password" name="password" autocomplete="off" class="form-control bg-transparent" /> --}}
        <!--end::Password-->
        <div class="input-group">
           <span class="input-group-text" id="basic-addon2">
              <i class="fas fa-lock fs-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
           </span>
           <input type="password" class="form-control" wire:model='password' placeholder="***********" aria-label="Password" aria-describedby="basic-addon2" />
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
        <button type="submit" id="sign_in_btn" class="btn btn-primary">
           <!--begin::Indicator label-->
           <div wire:loading wire:target='authenticate'>
              <span class="spinner-border" role="status" aria-hidden="true"></span>
              <span class="visually-hidden">Loading...</span>
           </div>
           <i class="fas fa-sign-in-alt fs-4 me-2"></i>
           <!--begin::Indicator label-->
           <span class="indicator-label">Masuk</span>
           <!--end::Indicator label-->
           <!--begin::Indicator progress-->
           <span class="indicator-progress">Please wait...
              <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
           <!--end::Indicator progress-->
        </button>
     </div>
     <!--end::Submit button-->
     <!--begin::Sign up-->
     <div class="text-gray-500 text-center fw-semibold fs-6">Bingung untuk login? Unduh panduan loginnya
        <a href="https://sipaba.uin-malang.ac.id/assets/other/2022-panduan-mahasantri.pdf" target="_blank" class="link-primary">disini</a>
     </div>
     <!--end::Sign up-->
  </form>
  <!--end::Form-->
