<!--begin::Form-->
<form class="form w-100" wire:submit.prevent='authenticate' id="loginForm">
   <!--begin::Heading-->
   <div class="text-center mb-11">
      <!--begin::Title-->
      <h1 class="text-dark fw-bolder mb-3">Masuk</h1>
      <!--end::Title-->
      <!--begin::Subtitle-->
      <div class="text-gray-500 fw-semibold fs-6">Masuk ke SIPARELNEW dan kelola Laporan Kegiatan anda!</div>
      <!--end::Subtitle=-->
   </div>
   <!--begin::Heading-->
   <!--begin::Input group=-->
   <div class="fv-row mb-8">
      <!--begin::Email-->
      <input type="text" placeholder="Email atau Username" wire:model.live="input" autocomplete="on" class="form-control bg-transparent" />
      <!--end::Email-->
   </div>
   <!--end::Input group=-->
   <div class="fv-row mb-3">
      <!--begin::Password-->
      <input type="password" placeholder="Password" wire:model.live="password" autocomplete="on" class="form-control bg-transparent" />
      @error('password')
         <div class="invalid-feedback">
            {{ $errors->first('password') }}
         </div>
      @enderror
      <!--end::Password-->
   </div>
   <!--end::Input group=-->
   <!--begin::Wrapper-->
   <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
      <div class="form-check form-check-custom form-check-inline form-check-solid mt-3">
         <input class="form-check-input" type="checkbox" value="1" id="remember" wire:model='remember' />
         <label class="form-check-label" for="remember">
            Ingat saya
         </label>
      </div>
      <!--begin::Link-->
      <a href="../../demo39/dist/authentication/layouts/overlay/reset-password.html" class="link-primary">
         {{ __('Lupa Password?') }}
      </a>
      <!--end::Link-->
   </div>
   <!--end::Wrapper-->
   <!--begin::Submit button-->
   <div class="d-grid mb-10">
      <button type="submit" class="btn btn-primary">
         <!--begin::Indicator label-->
         <div wire:loading wire:target='authenticate'>
            <span class="spinner-border" role="status" aria-hidden="true"></span>
            <span class="visually-hidden">Loading...</span>
        </div>
         <span class="indicator-label">Masuk</span>
         <!--end::Indicator label-->
         <!--begin::Indicator progress-->
         <span class="indicator-progress">Please wait...
            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
         <!--end::Indicator progress-->
      </button>
   </div>
   <!--end::Submit button-->
   <!--end::Sign up-->
</form>
<!--end::Form-->

@push('js')
   <script>
      //   $('#kt_sign_in_submit').click(function(e) {
      //      Swal.fire({
      //         text: "Here's a basic example of SweetAlert!",
      //         icon: "success",
      //         buttonsStyling: false,
      //         confirmButtonText: "Ok, got it!",
      //         customClass: {
      //            confirmButton: "btn btn-primary"
      //         }
      //      });
      //   });
     /*  $(document).ready(function() {
         document.querySelector("#loginForm").addEventListener("submit", () => {
            Swal.fire({
               title: 'Sedang Diproses',
               html: 'Mencoba untuk login...',
               timer: 8000,
               icon: "question",
               timerProgressBar: true,
               allowOutsideClick: false,
               didOpen: () => {
                  Swal.showLoading();
               }
            }).then((result) => {
               if (result.dismiss === Swal.DismissReason.timer) {
                  //  console.log('Modal ditutup oleh timer');
               }
            });
         });
      }); */
   </script>
@endpush
