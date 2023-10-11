<div class="app-navbar-item ms-2 ms-lg-6 me-lg-8" id="kt_header_user_menu_toggle">
   <!--begin::Menu wrapper-->
   <div class="cursor-pointer symbol symbol-circle symbol-30px symbol-lg-45px" data-kt-menu-trigger="{default: 'click', lg: 'click'}" data-kt-menu-attach="parent"
      data-kt-menu-placement="bottom-end">
      <img src="{{ asset(auth()->user()->avatar) }}" alt="user" />
   </div>
   <!--begin::User account menu-->
   <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true">
      <!--begin::Menu item-->
      <div class="menu-item px-3">
         <div class="menu-content d-flex align-items-center px-3">
            <!--begin::Avatar-->
            <div class="symbol symbol-50px me-5">
               <img alt="Logo" src="{{ asset(auth()->user()->avatar) }}" />
            </div>
            <!--end::Avatar-->
            <!--begin::Username-->
            <div class="d-flex flex-column">
               <div class="fw-bold d-flex align-items-center fs-6">{{ auth()->user()->name }}
               </div>
               <div><span class="badge badge-light-success fw-bold fs-8 px-2 py-1 my-2">{{ getUserRoleShort() }}</span></div>
               <span class="fw-semibold text-muted text-hover-primary fs-7">{{ auth()->user()->email }}</span>
            </div>
            <!--end::Username-->
         </div>
      </div>
      <!--end::Menu item-->
      <!--begin::Menu separator-->
      <div class="separator my-2"></div>
      <!--end::Menu separator-->

      <x-header.menu-item routeName="pengaturan.profile" menuTitle="Profile Saya" />
      <x-header.menu-item routeName="pengaturan.keamanan" menuTitle="Keamanan" />


      <!--begin::Menu separator-->
      <div class="separator my-2"></div>
      <!--end::Menu separator-->

      <div class="menu-item px-5">
         <a href="javascript:;" class="menu-link px-5" data-bs-toggle="modal" data-bs-target="#logoutModal">Keluar</a>
      </div>

   </div>
   <!--end::User account menu-->
   <!--end::Menu wrapper-->
</div>
