 <!--begin::Navs-->
 <ul
    class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">
    <!--begin::Nav item-->
    <li class="nav-item mt-2">
       <a class="nav-link text-active-primary ms-0 me-10 py-5 {{ request()->url() == route('pengaturan.profile') ? 'active' : '' }}" wire:navigate
          href="{{ route('pengaturan.profile') }}">Pengaturan Profil</a>
    </li>
    <!--end::Nav item-->
    <!--begin::Nav item-->
    <li class="nav-item mt-2">
       <a class="nav-link text-active-primary ms-0 me-10 py-5 {{ request()->url() == route('pengaturan.keamanan') ? 'active' : '' }}" wire:navigate
          href="{{ route('pengaturan.keamanan') }}">Pengaturan Keamanan</a>
    </li>
    <!--end::Nav item-->
    {{--  <!--begin::Nav item-->
 <li class="nav-item mt-2">
    <a class="nav-link text-active-primary ms-0 me-10 py-5"
       href="">Aktivitas Saya</a>
 </li>
 <!--end::Nav item--> --}}
 </ul>
 <!--begin::Navs-->
