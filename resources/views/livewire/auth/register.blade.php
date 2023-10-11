<form class="mb-3" wire:submit.prevent='register' id="registerForm">
   <div class="form-floating form-floating-outline mb-3">
      <input required type="text" class="form-control @error('name') is-invalid @enderror" id="name" autocomplete="on"
         wire:model.live="name" required />
      <label for="name">Nama<sup class="text-danger fw-bold">*</sup></label>
      @error('name')
         <div class="ms-2 mt-2 small text-danger">
            {{ $message }}
         </div>
      @enderror
   </div>
   <div class="form-floating form-floating-outline mb-3">
      <input required type="text" class="form-control @error('username') is-invalid @enderror" id="username" wire:model.live="username" placeholder="Masukkan username anda"
         required />
      <label for="username">Username (Opsional)</label>
      @error('username')
         <div class="ms-2 mt-2 small text-danger">
            {{ $message }}
         </div>
      @enderror
   </div>
   <div class="form-floating form-floating-outline mb-3">
      <input required type="email" class="form-control @error('email') is-invalid @enderror" id="email"
         wire:model.live="email" placeholder="Masukkan email anda" required />
      <label for="email">Email<sup class="text-danger fw-bold">*</sup></label>
      @error('email')
         <div class="ms-2 mt-2 small text-danger">
            {{ $message }}
         </div>
      @enderror
   </div>
   {{-- <input required type="hidden" wire:model.live="username" value="username"> --}}
   <div class="mb-3 form-password-toggle">
      <div class="input-group input-group-merge">
         <div class="form-floating form-floating-outline">
            <input required type="password" id="input-password" class="form-control @error('password') is-invalid @enderror"
               wire:model.live="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
               aria-describedby="password" required />
            <label for="password">Password<sup class="text-danger fw-bold">*</sup></label>
            @error('password')
               <div class="ms-2 mt-2 small text-danger">
                  {{ $message }}
               </div>
            @enderror
         </div>
         <span class="input-group-text cursor-pointer"><i class="mdi mdi-eye-off-outline"></i></span>
      </div>
   </div>
   <div class="mb-3 form-password-toggle">
      <div class="input-group input-group-merge">
         <div class="form-floating form-floating-outline">
            <input required type="password" id="input-password_confirmation"
               class="form-control @error('password') is-invalid @enderror" wire:model.live="password_confirmation"
               placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
               aria-describedby="password_confirmation" required />
            <label for="password">Konfirmasi Password<sup class="text-danger fw-bold">*</sup></label>
            @error('password_confirmation')
               <div class="ms-2 mt-2 small text-danger">
                  {{ $message }}
               </div>
            @enderror
         </div>
         <span class="input-group-text cursor-pointer"><i class="mdi mdi-eye-off-outline"></i></span>
      </div>
   </div>
   <div class="mb-3">
      <div class="form-check">
         <input required class="form-check-input" type="checkbox" id="terms-conditions" />
         <label class="form-check-label" for="terms-conditions">
            Saya setuju terhadap
            <a href="javascript:void(0);">Kebijakan dan aturan</a>
         </label>
      </div>
   </div>
   <button class="btn btn-primary d-grid w-100" wire:loading.attr="disabled" type="submit">
      Daftar akun
   </button>
   @push('scripts')
      <script>
         document.addEventListener("DOMContentLoaded", data => {
            const formElement = document.querySelector("#registerForm");
            formElement.addEventListener('submit', () => {
               Swal.fire({
                  title: 'Sedang Diproses',
                  html: 'Mengirim kode verifikasi ke alamat email <b>' + $('#email').val() + '</b> ..',
                  timer: 8000,
                  timerProgressBar: true,
                  allowOutsideClick: false,
                  didOpen: () => {
                     Swal.showLoading();
                  }
               }).then((result) => {
                  /*  if (result.dismiss === Swal.DismissReason.timer) {
                      //  console.log('Modal ditutup oleh timer');
                   } */
                  if (result.isConfirmed) {
                     // Livewire.dispatch('emailSended'); // emit event
                     Swal.fire(
                        'Kode verifikasi berhasil dikirimkan!',
                        'Silahkan cek inbox alamat email anda untuk melanjutkan proses registrasi.',
                        'success'
                     )
                  }
               });
            });
         });
      </script>
   @endpush
</form>
