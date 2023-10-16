<div class="row px-4 my-5">
   @cannot('alumni')
   <div class="col-xl-6">
      <!--begin::Item-->
      <div class="d-flex align-items-center bg-light-warning rounded p-5">
        <!--begin::Svg Icon | path: icons/duotune/abstract/abs027.svg-->
        <span class="me-5">
           <i class="fa-solid fa-users text-warning fs-2"></i>
        </span>
        <!--end::Svg Icon-->
        <!--begin::Title-->
        <div class="flex-grow-1 me-2 text-center">
           <a href="{{ route('pengaturan.user') }}" class="fw-bold text-gray-800 text-hover-primary fs-6">Total User</a>
        </div>
        <!--end::Title-->
        <!--begin::Lable-->
        <span class="fw-bold text-warning py-1 fs-2 countVolu">{{ $c_user }}</span>
        <!--end::Lable-->
     </div>
     <!--end::Item-->
  </div>
   @endcannot

   <div class="{{ getRole() == 'admin' ? 'col-xl-6' : 'col-xl-12' }}">
      <!--begin::Item-->
      <div class="d-flex align-items-center bg-light-success rounded p-5">
         <!--begin::Svg Icon | path: icons/duotune/abstract/abs027.svg-->
         <span class="me-5">
            <i class="fa-solid fa-clipboard-list text-success fs-2"></i>
         </span>
         <!--end::Svg Icon-->
         <!--begin::Title-->
         <div class="flex-grow-1 me-2 text-center">
            <a href="{{ route('formulir.index') }}" class="fw-bold text-gray-800 text-hover-primary fs-6">Total Pengisian Formulir Alumni</a>
         </div>
         <!--end::Title-->
         <!--begin::Lable-->
         <span class="fw-bold text-success py-1 fs-2 countReports">{{ $c_pengisian }}</span>
         <!--end::Lable-->
      </div>
      <!--end::Item-->
   </div>

   @if(auth()->user()->surveyCount() < 1)
   <div class="col-xl-12 mt-5">
      <!--begin::Item-->
      <div class="d-flex align-items-center bg-light-danger  rounded p-5">
         <!--begin::Svg Icon | path: icons/duotune/abstract/abs027.svg-->
         <span class="me-5">
            <i class="fa-solid fa-clipboard-list text-danger fs-2"></i>
         </span>
         <!--end::Svg Icon-->
         <!--begin::Title-->
         <div class="flex-grow-1 me-2 text-center">
            <a href="{{ route('survey.isi') }}" class="fw-bold text-gray-800 text-hover-primary fs-6 d-block">Klik disini Untuk Mengisi Survey</a>
            <span class="text-gray-600 py-3">Anda masih belum mengisi survey IKATAMA 95 yang terbaru.</span>
         </div>
         <!--end::Title-->
         <!--begin::Lable-->
         <span class="fw-bold text-success py-1 fs-2 countReports"></span>
         <!--end::Lable-->
      </div>
      <!--end::Item-->
   </div>
   @endif
   {{-- <div class="col-xl-3">
         <!--begin::Item-->
         <div class="d-flex align-items-center bg-light-success rounded p-5">
            <!--begin::Svg Icon | path: icons/duotune/abstract/abs027.svg-->
            <span class="me-5">
               <i class="fa-solid fa-list-check text-success fs-2"></i>
            </span>
            <!--end::Svg Icon-->
            <!--begin::Title-->
            <div class="flex-grow-1 me-2 text-center">
               <a href="https://siparelnew.id/news-report?pencarian=Sudah%20Terbit" class="fw-bold text-gray-800 text-hover-primary fs-6">Total Laporan Sudah Terbit</a>
            </div>
            <!--end::Title-->
            <!--begin::Lable-->
            <span class="fw-bold text-success py-1 fs-2 countPublish">17</span>
            <!--end::Lable-->
         </div>
         <!--end::Item-->
   </div>
   <div class="col-xl-3">
      <div class="d-flex align-items-center bg-light-danger rounded p-5">
         <!--begin::Svg Icon | path: icons/duotune/abstract/abs027.svg-->
         <span class="me-5">
            <i class="fa-solid fa-list-check text-danger fs-2"></i>
         </span>
         <!--end::Svg Icon-->
         <!--begin::Title-->
         <div class="flex-grow-1 me-2 text-center">
            <a href="https://siparelnew.id/news-report?pencarian=Belum%20Terpublikasi" class="fw-bold text-gray-800 text-hover-primary fs-6">Laporan Belum Terpublikasi</a>
         </div>
         <!--end::Title-->
         <!--begin::Lable-->
         <span class="fw-bold text-danger py-1 fs-2 countNotPublish">34</span>
         <!--end::Lable-->
      </div>
   </div> --}}
</div>
