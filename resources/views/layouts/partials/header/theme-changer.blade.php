<!--begin::Menu toggle-->
<a href="javascript:void(0);" class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px" data-kt-menu-trigger="{default:'click', lg: 'click'}"
data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
<i class="ki-duotone ki-night-day theme-light-show fs-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span
      class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span></i> <i
   class="ki-duotone ki-moon theme-dark-show fs-1"><span class="path1"></span><span class="path2"></span></i></a>
<!--begin::Menu toggle-->

<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold py-4 fs-base w-150px me-5"
   data-kt-menu="true" data-kt-element="theme-mode-menu">
   @persist('thene-changer')
      <!--begin::Menu item-->
      <div class="menu-item px-3 my-0">
         <a href="javascript:void(0);" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="light">
            <span class="menu-icon" data-kt-element="icon">
               <i class="ki-duotone ki-night-day fs-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span
                     class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span></i>
            </span>
            <span class="menu-title">
               Terang
            </span>
         </a>
      </div>
      <!--end::Menu item-->

      <!--begin::Menu item-->
      <div class="menu-item px-3 my-0">
         <a href="javascript:void(0);" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="dark">
            <span class="menu-icon" data-kt-element="icon">
               <i class="ki-duotone ki-moon fs-2"><span class="path1"></span><span class="path2"></span></i> </span>
            <span class="menu-title">
               Gelap
            </span>
         </a>
      </div>
      <!--end::Menu item-->

      <!--begin::Menu item-->
      <div class="menu-item px-3 my-0">
         <a href="javascript:void(0);" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="system">
            <span class="menu-icon" data-kt-element="icon">
               <i class="ki-duotone ki-screen fs-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i> </span>
            <span class="menu-title">
               Sistem
            </span>
         </a>
      </div>
      <!--end::Menu item-->
   @endpersist
</div>
