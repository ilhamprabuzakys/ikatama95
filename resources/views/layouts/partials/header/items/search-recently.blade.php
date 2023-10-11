  <!--begin::Item-->
  <div class="d-flex align-items-center mb-5">
     <!--begin::Symbol-->
     <div class="symbol symbol-40px me-4">
        <span class="symbol-label bg-light">
           <i class="fas fa-newspaper fs-2 text-primary"></i>
        </span>
     </div>
     <!--end::Symbol-->
     <!--begin::Title-->
     <div class="d-flex flex-column">
        <a wire:navigate href="{{ route('formulir.index') }}" class="fs-6 text-gray-800 text-hover-primary fw-semibold">Daftar Formulir</a>
        <span class="fs-7 text-muted fw-semibold">{{ route('formulir.index') }}</span>
     </div>
     <!--end::Title-->
  </div>
  <!--end::Item-->
  <!--begin::Item-->
  <div class="d-flex align-items-center mb-5">
     <!--begin::Symbol-->
     <div class="symbol symbol-40px me-4">
        <span class="symbol-label bg-light">
           <i class="fas fa-store-alt fs-2 text-primary"></i>
        </span>
     </div>
     <!--end::Symbol-->
     <!--begin::Title-->
     <div class="d-flex flex-column">
        <a wire:navigate href="{{ route('pengaturan.website') }}" class="fs-6 text-gray-800 text-hover-primary fw-semibold">Pengaturan Website</a>
        <span class="fs-7 text-muted fw-semibold">{{ route('pengaturan.website') }}</span>
     </div>
     <!--end::Title-->
  </div>
  <!--end::Item-->
  <!--begin::Item-->
  <div class="d-flex align-items-center mb-5">
     <!--begin::Symbol-->
     <div class="symbol symbol-40px me-4">
        <span class="symbol-label bg-light">
           <i class="fas fa-users fs-2 text-primary"></i>
        </span>
     </div>
     <!--end::Symbol-->
     <!--begin::Title-->
     <div class="d-flex flex-column">
        <a wire:navigate href="{{ route('pengaturan.user') }}" class="fs-6 text-gray-800 text-hover-primary fw-semibold">Pengaturan User</a>
        <span class="fs-7 text-muted fw-semibold">{{ route('pengaturan.user') }}</span>
     </div>
     <!--end::Title-->
  </div>
  <!--end::Item-->
