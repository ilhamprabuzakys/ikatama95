<!--  Large modal example -->
<div wire:ignore.self class="modal fade" id="editUserModal" tabindex="-1" role="dialog">
   <div class="modal-dialog modal-dialog-centered mw-650px">
      <div class="modal-content">
         <div class="modal-header">
            <h3 class="modal-title">Edit Data User <strong>{{ $old_name }}</strong></h3>
            <button type="button" wire:click="closeModal" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <form wire:submit.prevent="update">
            <div class="modal-body">
               <div class="row justify-content-between mb-2">
                  <div class="col-3">
                     <label for="title" class="form-label">Nama <sup class="text-danger">*</sup></label>
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
                     <label for="title" class="form-label">Email <sup class="text-danger">*</sup></label>
                  </div>
                  <div class="col-9">
                     <input type="email"
                        class="form-control @error('email')
                        is-invalid
                     @enderror" wire:model="email" id="emailEdit">
                     @error('email')
                        <div class="small ms-2 mt-1 text-danger">
                           {{ $message }}
                        </div>
                     @enderror
                  </div>
               </div>
               <div class="row justify-content-between mb-2">
                  <div class="col-3">
                     <label for="username" class="form-label">Username</label>
                  </div>
                  <div class="col-9">
                     <div class="input-group input-group-merge">
                        <input type="text" class="form-control" id="usernameEdit" disabled value="" @error('username')
                           is-invalid
                        @enderror
                           wire:model="username" />
                        <span class="input-group-text cursor-pointer usernameChange"><i class="fas fa-edit"></i></span>
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
                  @enderror" name="role" wire:model="role">
                        <option value='' disabled>--Pilih Role--</option>
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
                           <input type="password" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                              @error('new_password')
                           is-invalid
                        @enderror wire:model="new_password" />
                           <span class="input-group-text cursor-pointer"><i class="mdi mdi-eye-off-outline"></i></span>
                        </div>
                        @error('new_password')
                           <div class="small ms-2 mt-1 text-danger">
                              {{ $message }}
                           </div>
                        @enderror
                     </div>
                  </div>
               </div>
               <span class="text-muted mt-1">Lewati bagian ini, jika anda tidak ingin <strong>password</strong></span>
            </div>
            <div class="modal-footer">
               <button type="button" wire:click="closeModal" class="btn btn-light" data-bs-dismiss="modal">
                  <i class="fas fa-xmark fa-md me-2"></i>
                  Tutup</button>
               <button class="btn btn-primary px-2 not-allowed" type="submit">
                  <i class="fas fa-save fa-md me-2"></i>
                  Simpan Perubahan</button>
            </div>
         </form>
      </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@push('scripts')
   <script>
      $(document).ready(function() {
         $("#emailEdit").on('change', function(e) {
            var emailValue = $("#emailEdit").val();
            var username = emailValue.split('@')[0];

            $("#usernameEdit").val(username);
            @this.set('username', username);
         });

         $(".usernameChange").on('click', function(e) {
            var usernameInput = $("#usernameEdit");
            // Cek apakah input memiliki atribut disabled
            if (usernameInput.attr('disabled')) {
               // Hapus atribut disabled
               usernameInput.removeAttr('disabled');
            } else {
               // Tambahkan kembali atribut disabled
               usernameInput.attr('disabled', 'disabled');
            }
         });
      });
   </script>
@endpush
