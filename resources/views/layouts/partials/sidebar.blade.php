<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}"
   data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
   <!--begin::Wrapper-->
   <div id="kt_app_sidebar_wrapper" class="app-sidebar-wrapper hover-scroll-y my-5 my-lg-2" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
      data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_header" data-kt-scroll-wrappers="#kt_app_sidebar_wrapper" data-kt-scroll-offset="5px">
      <!--begin::Sidebar menu-->
      <div id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false"
         class="app-sidebar-menu-primary menu menu-column menu-rounded menu-sub-indention menu-state-bullet-primary px-6 mb-5">
         <x-sidebar.menu-item iconClass="ki-outline ki-home-2 fs-2" menuTitle="Beranda" routeName="dashboard" />

         {{-- <x-sidebar.accordion-item iconClass="fa-regular fa-newspaper fs-2" title="Laporan">
            <x-sidebar.sub-menu-item routeName="laporan.laporan-relawan" menuTitle="Laporan Relawan" tooltipText="Check out over 200 in-house components" />
            <x-sidebar.sub-menu-item routeName="laporan.cari-laporan" menuTitle="Cari Area" tooltipText="Check out the complete documentation" />
            <x-sidebar.sub-menu-item routeName="laporan.rekap-laporan" menuTitle="Rekap Laporan" tooltipText="Build your layout and export HTML for server side integration" />
         </x-sidebar.accordion-item> --}}

         <x-sidebar.accordion-item iconClass="fa-solid fa-cog fs-2" title="Konfigurasi">
            <x-sidebar.sub-menu-item routeName="pengaturan.website" menuTitle="Pengaturan Website" tooltipText="Menu untuk mengatur tampilan dan konfigurasi Website" />
            <x-sidebar.sub-menu-item routeName="pengaturan.user" menuTitle="Pengaturan User" tooltipText="Daftar User" />
         </x-sidebar.accordion-item>

      </div>
   </div>
   <!--end::Wrapper-->
</div>
