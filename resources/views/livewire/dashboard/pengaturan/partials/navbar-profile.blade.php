<!--begin::Navbar-->
<div class="card mb-5 mb-xl-10">
   <div class="card-body pt-9 pb-0">
      @persist('pengaturan-navbar-details')
         @include('livewire.dashboard.pengaturan.partials.navbar-profile-header')
      @endpersist

      @include('livewire.dashboard.pengaturan.partials.navbar-profile-navigation')
   </div>
</div>
<!--end::Navbar-->
