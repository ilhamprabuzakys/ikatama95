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
                     <label for="title" class="form-label">Nama</label>
                  </div>
                  <div class="col-9">
                     <input type="text"
                        class="form-control @error('name')
                        is-invalid
                     @enderror" wire:model="name">
                     @error('name')
                        <div class="small ms-2 mt-1 text-danger">
                           {{ $message }}
                        </div>
                     @enderror
                  </div>
               </div>
               <div class="row justify-content-between mb-2">
                  <div class="col-3">
                     <label for="add_nrp" class="form-label required">NRP</label>
                  </div>
                  <div class="col-9">
                     <input id="add_nrp" type="text"
                        class="form-control @error('nrp')
                        is-invalid
                     @enderror" wire:model="nrp">
                     @error('nrp')
                        <div class="small ms-2 mt-1 text-danger">
                           {{ $message }}
                        </div>
                     @enderror
                  </div>
               </div>
               <div class="row justify-content-between mb-2">
                  <div class="col-3">
                     <label for="add_dob" class="form-label required">Tanggal Lahir</label>
                  </div>
                  <div class="col-9">
                     <input id="add_dob" type="date"
                        class="form-control @error('dob')
                        is-invalid
                     @enderror" wire:model="dob">
                     @error('dob')
                        <div class="small ms-2 mt-1 text-danger">
                           {{ $message }}
                        </div>
                     @enderror
                  </div>
               </div>
               {{-- <div class="row justify-content-between mb-2">
                  <div class="col-3">
                     <label for="title" class="form-label">Nama<sup class="text-danger">*</sup></label>
                  </div>
                  <div class="col-9">
                     <input type="text"
                        class="form-control @error('name')
                        is-invalid
                     @enderror" wire:model="name">
                     @error('name')
                        <div class="small ms-2 mt-1 text-danger">
                           {{ $message }}
                        </div>
                     @enderror
                  </div>
               </div> --}}
               {{-- <div class="row justify-content-between mb-2"> --}}
                  {{-- <div class="col-3">
                     <label for="title" class="form-label">Email</label>
                  </div>
                  <div class="col-9">
                     <input type="email"
                        class="form-control @error('email')
                        is-invalid
                     @enderror" wire:model.live="email" id="emailAdd">
                     @error('email')
                        <div class="small ms-2 mt-1 text-danger">
                           {{ $message }}
                        </div>
                     @enderror
                  </div>
                  <input type="hidden" name="username" value="">
               </div>
               <div class="row justify-content-between mb-2">
                  <div class="col-3">
                     <label for="username" class="form-label">Username</label>
                  </div>
                  <div class="col-9">
                     <div class="input-group input-group-merge">
                        <input type="text" class="form-control" id="usernameAdd" disabled value="" @error('username')
                           is-invalid
                        @enderror
                           wire:model.live="username" />
                        <span class="input-group-text cursor-pointer usernameChange addUsername"><i class="fas fa-edit"></i></span>
                     </div>
                     @error('username')
                        <div class="small ms-2 mt-1 text-danger">
                           {{ $message }}
                        </div>
                     @enderror
                  </div>
               </div>
               <div class="row justify-content-between mb-2">
                  <div class="col-3">
                     <label for="role" class="form-label">Role<sup class="text-danger">*</sup></label>
                  </div>
                  <div class="col-9">
                     <select class="form-select @error('role')
                     is-invalid
                  @enderror" name="role" id="role" wire:model="role">
                        <option value='' selected>--Pilih Role--</option>
                        @foreach ($roles as $role)
                           <option value="{{ $role->key }}">{{ $role->label }}</option>
                        @endforeach
                     </select>
                  </div>
                  @error('role')
                     <div class="small ms-2 mt-1 text-danger">
                        {{ $message }}
                     </div>
                  @enderror
               </div>
               <div class="row justify-content-between mb-2">
                  <div class="col-3">
                     <label for="password" class="form-label">Password</label>
                  </div>
                  <div class="col-9">
                     <div class="form-password-toggle">
                        <div class="input-group input-group-merge">
                           <input type="password" class="form-control" id="passwordAdd" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                              @error('password')
                           is-invalid
                        @enderror wire:model.lazy="password" />
                           <span class="input-group-text cursor-pointer" id="passwordAddBTN"><i class="fa fa-eye"></i></span>
                        </div>
                        @error('password')
                           <div class="small ms-2 mt-1 text-danger">
                              {{ $message }}
                           </div>
                        @enderror
                     </div>
                  </div>
               </div>
               <span class="text-muted mt-1">Jika anda mengosongkan bagian ini, password akan otomatis diset ke <strong>password123</strong></span> --}}
               <div class="text-center pt-15">
                  <button type="reset" wire:click='closeModal()' class="btn btn-danger me-3" data-bs-dismiss="modal"><i class="fas fa-xmark me-2"></i>Batalkan</button>
                  <button type="submit" wire:click='store()' class="btn btn-primary"
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

@push('scripts')
   <script>
      $(document).ready(function() {
         $("#emailAdd").on('change', function(e) {
            var emailValue = $("#emailAdd").val();
            var username = emailValue.split('@')[0];

            $("#usernameAdd").val(username);
            @this.set('username', username);
         });

         $(".usernameChange.addUsername").on('click', function(e) {
            var usernameInput = $("#usernameAdd");
            // Cek apakah input memiliki atribut disabled
            if (usernameInput.attr('disabled')) {
               // Hapus atribut disabled
               usernameInput.removeAttr('disabled');
            } else {
               // Tambahkan kembali atribut disabled
               usernameInput.attr('disabled', 'disabled');
            }
         });

         $('#passwordAddBTN').click(function(e) {
            e.preventDefault();
            var passwordInput = $("#passwordAdd");
            var icon = $("#passwordAddBTN i");

            if (passwordInput.attr('type') === 'password') {
               console.log('password ke text');
               passwordInput.attr('type', 'text');
               icon.removeClass('fa-eye');
               icon.addClass('fa-eye-slash');
            } else if (passwordInput.attr('type') === 'text') {
               console.log('text ke password');
               passwordInput.attr('type', 'password');
               icon.removeClass('fa-eye-slash');
               icon.addClass('fa-eye');
            }
         });
      });
   </script>
@endpush
