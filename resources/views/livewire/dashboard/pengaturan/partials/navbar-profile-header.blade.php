<!--begin::Details-->
<div class="d-flex flex-wrap flex-sm-nowrap">
   <!--begin: Pic-->
   <div class="me-7 mb-4">
      <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
         <img src="{{ asset(auth()->user()->avatar) }}" alt="image" />
         <div
            class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-body h-20px w-20px">
         </div>
      </div>
   </div>
   <!--end::Pic-->
   <!--begin::Info-->
   <div class="flex-grow-1">
      <!--begin::Title-->
      <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
         <!--begin::User-->
         <div class="d-flex flex-column">
            <!--begin::Name-->
            <div class="d-flex align-items-center mb-2">
               <a href="javascript:void(0);" class="text-gray-900 text-hover-primary fs-2 fw-bold me-2">{{ auth()->user()->name }}</a>
               <a href="javascript:void(0);">
                  <i class="ki-outline ki-verify fs-1 text-primary"></i>
               </a>
            </div>
            <!--end::Name-->
            <!--begin::Info-->
            <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
               <a href="javascript:void(0);"
                  class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                  <i class="ki-outline ki-profile-circle fs-4 me-2"></i>{{ getUserRoleDetail() }}</a>
               {{-- <a href="javascript:void(0);"
               class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
               <i class="ki-outline ki-geolocation fs-4 me-1"></i>SF, Bay Area</a> --}}
               @if (auth()->user()->email != null || auth()->user()->email != '')
                  <a href="javascript:void(0);"
                     class="d-flex align-items-center text-gray-400 text-hover-primary mb-2">
                     <i class="ki-outline ki-sms fs-4 me-1"></i>{{ auth()->user()->email }}</a>
               @endif
            </div>
            <!--end::Info-->
         </div>
         <!--end::User-->
         <!--begin::Actions-->
         <div class="d-flex my-4">
            <div class="me-0">
               <button class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary"
                  data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                  <i class="ki-solid ki-dots-horizontal fs-2x me-1"></i>
               </button>
               <!--begin::Menu 3-->
               <div
                  class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-3"
                  data-kt-menu="true">
                  <!--begin::Heading-->
                  <div class="menu-item px-3">
                     <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">
                        Aksi</div>
                  </div>
                  <!--end::Heading-->
                  <!--begin::Menu item-->
                  <div class="menu-item px-3">
                     <a href="javascript:void(0);" class="menu-link px-3">Cetak PDF</a>
                  </div>
                  <!--end::Menu item-->
               </div>
               <!--end::Menu 3-->
            </div>
            <!--end::Menu-->
         </div>
         <!--end::Actions-->
      </div>
      <!--end::Title-->
      <!--begin::Stats-->
      <div class="d-flex flex-wrap flex-stack">
         <!--begin::Wrapper-->
         <div class="d-flex flex-column flex-grow-1 pe-8">
            <!--begin::Stats-->
            <div class="d-flex flex-wrap">
               <!--begin::Stat-->
               <div
                  class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                  <!--begin::Number-->
                  <div class="d-flex align-items-center">
                     <i class="ki-outline ki-arrow-up fs-3 text-success me-2"></i>
                     <div class="fs-2 fw-bold" data-kt-countup="true"
                        data-kt-countup-value="1">0</div>
                  </div>
                  <!--end::Number-->
                  <!--begin::Label-->
                  <div class="fw-semibold fs-6 text-gray-400">Kuisoner</div>
                  <!--end::Label-->
               </div>
               <!--end::Stat-->
               <!--begin::Stat-->
               <div
                  class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                  <!--begin::Number-->
                  <div class="d-flex align-items-center">
                     <i class="ki-outline ki-arrow-down fs-3 text-danger me-2"></i>
                     <div class="fs-2 fw-bold" data-kt-countup="true"
                        data-kt-countup-value="{{ getPengisianKusioner() }}">0</div>
                  </div>
                  <!--end::Number-->
                  <!--begin::Label-->
                  <div class="fw-semibold fs-6 text-gray-400">Pengisian Kuisioner</div>
                  <!--end::Label-->
               </div>
               <!--end::Stat-->
               {{--  <!--begin::Stat-->
            <div
               class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
               <!--begin::Number-->
               <div class="d-flex align-items-center">
                  <i class="ki-outline ki-arrow-up fs-3 text-success me-2"></i>
                  <div class="fs-2 fw-bold" data-kt-countup="true"
                     data-kt-countup-value="60" data-kt-countup-prefix="%">0</div>
               </div>
               <!--end::Number-->
               <!--begin::Label-->
               <div class="fw-semibold fs-6 text-gray-400">Success Rate</div>
               <!--end::Label-->
            </div>
            <!--end::Stat--> --}}
            </div>
            <!--end::Stats-->
         </div>
         <!--end::Wrapper-->
         {{-- <!--begin::Progress-->
      <div class="d-flex align-items-center w-200px w-sm-300px flex-column mt-3">
         <div class="d-flex justify-content-between w-100 mt-auto mb-2">
            <span class="fw-semibold fs-6 text-gray-400">Profile Compleation</span>
            <span class="fw-bold fs-6">50%</span>
         </div>
         <div class="h-5px mx-3 w-100 bg-light mb-3">
            <div class="bg-success rounded h-5px" role="progressbar"
               style="width: 50%;" aria-valuenow="50" aria-valuemin="0"
               aria-valuemax="100"></div>
         </div>
      </div>
      <!--end::Progress--> --}}
      </div>
      <!--end::Stats-->
   </div>
   <!--end::Info-->
</div>
<!--end::Details-->
