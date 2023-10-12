{{-- Logout Modal --}}
<div class="modal fade" tabindex="-1" id="logoutModal">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">Keluar untuk akhiri sesi</h5>

            {{-- <!--begin::Close-->
            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
               <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
            </div>
            <!--end::Close--> --}}
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>

         <div class="modal-body">
            <p class="mb-0">Apakah anda yakin ingin keluar? Jika iya maka klik tombol Keluar.</p>
         </div>

         <div class="modal-footer">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">
               <i class="fas fa-xmark me-2"></i>Batalkan</button>
            @livewire('dashboard.logout')
         </div>
      </div>
   </div>
</div>
