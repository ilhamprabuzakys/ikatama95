@push('breadcrumb')
   <!--begin::Toolbar-->
   <div id="kt_app_toolbar" class="app-toolbar pt-6 pb-2">
      <!--begin::Toolbar container-->
      <div id="kt_app_toolbar_container"
         class="app-container container-fluid d-flex align-items-stretch">
         <!--begin::Toolbar wrapper-->
         <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
               <!--begin::Title-->
               <h1
                  class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">
                  {{ __('Daftar User') }}</h1>
               <!--end::Title-->
               <!--begin::Breadcrumb-->
               <ol class="breadcrumb fw-semibold fs-7 my-0">
                  <!--begin::Item-->
                  <li class="breadcrumb-item text-muted">
                     <a href="{{ route('dashboard') }}"
                        class="text-muted text-hover-primary">Beranda</a>
                  </li>
                  <!--end::Item-->
                  <!--begin::Item-->
                  <li class="breadcrumb-item text-muted">Konfigurasi</li>
                  <!--end::Item-->
                  <!--begin::Item-->
                  <li class="breadcrumb-item text-muted">{{ $title }}</li>
                  <!--end::Item-->
               </ol>
               <!--end::Breadcrumb-->
            </div>

            <!--begin::Actions-->
            <div class="d-flex align-items-center gap-2 gap-lg-3">
               <!--begin::Filter-->
               <button type="button" class="btn btn-light-primary me-3"
                  data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                  <i class="ki-outline ki-filter fs-2"></i>Filter</button>
               <!--begin::Menu 1-->
               <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true">
                  <!--begin::Header-->
                  <div class="px-7 py-5">
                     <div class="fs-5 text-dark fw-bold">Filter Options</div>
                  </div>
                  <!--end::Header-->
                  <!--begin::Separator-->
                  <div class="separator border-gray-200"></div>
                  <!--end::Separator-->
                  <!--begin::Content-->
                  <div class="px-7 py-5" data-kt-user-table-filter="form">
                     <!--begin::Input group-->
                     <div class="mb-10">
                        <label class="form-label fs-6 fw-semibold">Role:</label>
                        <select class="form-select form-select-solid fw-bold"
                           data-kt-select2="true" data-placeholder="Select option"
                           data-allow-clear="true" data-kt-user-table-filter="role"
                           data-hide-search="true">
                           <option></option>
                           <option value="Administrator">Administrator</option>
                           <option value="Analyst">Analyst</option>
                           <option value="Developer">Developer</option>
                           <option value="Support">Support</option>
                           <option value="Trial">Trial</option>
                        </select>
                     </div>
                     <!--end::Input group-->
                     <!--begin::Input group-->
                     <div class="mb-10">
                        <label class="form-label fs-6 fw-semibold">Two Step Verification:</label>
                        <select class="form-select form-select-solid fw-bold"
                           data-kt-select2="true" data-placeholder="Select option"
                           data-allow-clear="true" data-kt-user-table-filter="two-step"
                           data-hide-search="true">
                           <option></option>
                           <option value="Enabled">Enabled</option>
                        </select>
                     </div>
                     <!--end::Input group-->
                     <!--begin::Actions-->
                     <div class="d-flex justify-content-end">
                        <button type="reset"
                           class="btn btn-light btn-active-light-primary fw-semibold me-2 px-6"
                           data-kt-menu-dismiss="true"
                           data-kt-user-table-filter="reset">Reset</button>
                        <button type="submit" class="btn btn-primary fw-semibold px-6"
                           data-kt-menu-dismiss="true"
                           data-kt-user-table-filter="filter">Apply</button>
                     </div>
                     <!--end::Actions-->
                  </div>
                  <!--end::Content-->
               </div>
               <!--end::Menu 1-->
               <!--end::Filter-->
               <!--begin::Export-->
               <button type="button" class="btn btn-light-primary me-3" data-bs-toggle="modal"
                  data-bs-target="#kt_modal_export_users">
                  <i class="ki-outline ki-exit-up fs-2"></i>Export</button>
               <!--end::Export-->
               <!--begin::Add user-->
               <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                  data-bs-target="#kt_modal_add_user">
                  <i class="ki-outline ki-plus fs-2"></i>Add User</button>
               <!--end::Add user-->
            </div>
            <!--end::Actions-->
            <!--end::Page title-->
         </div>
         <!--end::Toolbar wrapper-->
      </div>
      <!--end::Toolbar container-->
   </div>
   <!--end::Toolbar-->
@endpush
<div class="card border-0">
   <!--begin::Card header-->
   <div class="card-header border-0 pt-6">
      <!--begin::Card title-->
      <div class="card-title">
         <!--begin::Search-->
         <div class="d-flex align-items-center position-relative my-1">
            <i class="ki-outline ki-magnifier fs-3 position-absolute ms-5"></i>
            <input type="search" data-kt-user-table-filter="search"
               class="form-control form-control-solid w-250px ps-13"
               placeholder="Cari Pengguna" />
         </div>
         <!--end::Search-->
      </div>
      <!--begin::Card title-->
      <!--begin::Card toolbar-->
      <div class="card-toolbar">
         <!--begin::Group actions-->
         <div class="d-flex justify-content-end align-items-center d-none"
            data-kt-user-table-toolbar="selected">
            <div class="fw-bold me-5">
               <span class="me-2" data-kt-user-table-select="selected_count"></span>Selected
            </div>
            <button type="button" class="btn btn-danger"
               data-kt-user-table-select="delete_selected">Delete Selected</button>
         </div>
         <!--end::Group actions-->

      </div>
      <!--end::Card toolbar-->
   </div>
   <!--end::Card header-->
   <!--begin::Card body-->
   <div class="card-body py-4">
      <!--begin::Table-->
      <div class="table-responsive">
         <table class="table border-left align-middle table-row-dashed border-right" id="kt_table_users">
            <thead class="bg-secondary-subtle">
               <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                  <th class="w-10px ps-3">
                     <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                        <input class="form-check-input" type="checkbox" data-kt-check="true"
                           data-kt-check-target="#kt_table_users .form-check-input" value="1" />
                     </div>
                  </th>
                  <th class="min-w-125px">No</th>
                  <th class="min-w-125px">Nama</th>
                  <th class="min-w-125px">Nama Pengguna</th>
                  <th class="min-w-125px">Peranan</th>
                  <th class="min-w-125px">Status</th>
                  <th class="min-w-125px">Bergabung Pada</th>
                  <th class="text-center min-w-100px">Aksi</th>
               </tr>
            </thead>
            <tbody class="text-gray-600 fw-semibold">
               @forelse ($users as $user)
                  <tr class="">
                     <td class="ps-3">
                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                           <input class="form-check-input" type="checkbox" value="1" />
                        </div>
                     </td>
                     <td scope="row">{{ $loop->iteration }}</td>
                     <td>{{ $user->name }}</td>
                     <td>{{ $user->username }}</td>
                     <td>
                        <span class="badge badge-{{ getUserRoleBG($user->role) }}">{{ getUserRoleDetail($user->role) }}</span>
                     </td>
                     <td>
                        @php
                           $bg_status = '';
                           $status = '';
                           if ($user->is_active) {
                               $bg_status = 'primary';
                               $status = 'Aktif';
                           } else {
                               $bg_status = 'danger';
                               $status = 'Tidak Aktif';
                           }
                        @endphp
                        <span class="badge badge-light-{{ $bg_status }}">{{ $status }}</span>
                     </td>
                     <td>{{ $user->created_at->diffForHumans() }}</td>
                     <td class="  text-center">
                        <a href="details/{{ $user->id }}" class="btn btn-sm btn-primary btn-clean btn-icon btn-icon-md">
                           <i class="fa-solid fa-circle-info"></i>
                        </a>
                        <a href="javascript:void(0);" id="deleteUser" data-id="17" data-name="null" class="btn btn-sm btn-primary btn-clean btn-icon btn-icon-md" data-nik="">
                           <i class="fa fa-trash"></i>
                        </a>
                     </td>
                  </tr>
               @empty
                  <tr class="">
                     <td colspan="3" class="text-center">
                        <h5>Data Pengguna masih kosong</h5>
                     </td>
                  </tr>
               @endforelse
            </tbody>
         </table>
      </div>
      <!--end::Table-->
   </div>
   <!--end::Card body-->
</div>


@push('modals')
   <div wire:ignore.self class="modal fade" id="kt_modal_export_users" tabindex="-1" aria-hidden="true">
      <!--begin::Modal dialog-->
      <div class="modal-dialog modal-dialog-centered mw-650px">
         <!--begin::Modal content-->
         <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
               <!--begin::Modal title-->
               <h2 class="fw-bold">Ekspor Data Admin</h2>
               <!--end::Modal title-->
               <!--begin::Close-->
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

               <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
               <!--begin::Form-->
               <form id="kt_modal_export_users_form" class="form" action="#">
                  <!--begin::Input group-->
                  <div class="fv-row mb-10">
                     <!--begin::Label-->
                     <label class="fs-6 fw-semibold form-label mb-2">Pilih Peranan:</label>
                     <!--end::Label-->
                     <!--begin::Input-->
                     <select name="role" data-control="select2"
                        data-placeholder="Select a role" data-hide-search="true"
                        class="form-select form-select-solid fw-bold">
                        <option></option>
                        <option value="semua">Semua</option>
                        <option value="superadmin">Super Admin</option>
                        <option value="admin">Admin</option>
                     </select>
                     <!--end::Input-->
                  </div>
                  <!--end::Input group-->
                  <!--begin::Input group-->
                  <div class="fv-row mb-10">
                     <!--begin::Label-->
                     <label class="required fs-6 fw-semibold form-label mb-2">Pilih Format Ekspor:</label>
                     <!--end::Label-->
                     <!--begin::Input-->
                     <select name="format" data-control="select2"
                        data-placeholder="Pilih format hasil ekspor " data-hide-search="true"
                        class="form-select form-select-solid fw-bold">
                        <option></option>
                        <option value="excel">Excel</option>
                        <option value="pdf">PDF</option>
                        <option value="zip">ZIP</option>
                     </select>
                     <!--end::Input-->
                  </div>
                  <!--end::Input group-->
                  <!--begin::Actions-->
                  <div class="text-center">
                     <button type="reset" class="btn btn-danger me-3"
                        data-bs-dismiss="modal"><i class="fas fa-xmark me-2"></i>Batalkan</button>
                     <button type="submit" class="btn btn-primary"
                        data-kt-users-modal-action="submit">
                        <span class="indicator-label"><i class="fas fa-file-export me-2"></i>Ekspor Data</span>
                        <span class="indicator-progress">Please wait...
                           <span
                              class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                     </button>
                  </div>
                  <!--end::Actions-->
               </form>
               <!--end::Form-->
            </div>
            <!--end::Modal body-->
         </div>
         <!--end::Modal content-->
      </div>
      <!--end::Modal dialog-->
   </div>
   <div wire:ignore.self class="modal fade" id="kt_modal_add_user" tabindex="-1" aria-hidden="true">
      <!--begin::Modal dialog-->
      <div class="modal-dialog modal-dialog-centered mw-650px">
         <!--begin::Modal content-->
         <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_add_user_header">
               <!--begin::Modal title-->
               <h2 class="fw-bold">Undang Admin</h2>
               <!--end::Modal title-->
               <!--begin::Close-->
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

               <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
               <!--begin::Form-->
               <form id="kt_modal_add_user_form" class="form" action="#">
                  <!--begin::Scroll-->
                  <div class="d-flex flex-column scroll-y me-n7 pe-7"
                     id="kt_modal_add_user_scroll" data-kt-scroll="true"
                     data-kt-scroll-activate="{default: false, lg: true}"
                     data-kt-scroll-max-height="auto"
                     data-kt-scroll-dependencies="#kt_modal_add_user_header"
                     data-kt-scroll-wrappers="#kt_modal_add_user_scroll"
                     data-kt-scroll-offset="300px">
                     <!--begin::Input group-->
                     <div class="row mb-7">
                        <div class="col-4 d-flex align-items-center">
                           <label for="email" class="required form-label">Email</label>
                        </div>
                        <div class="col-8">
                           <!--begin::Input-->
                           <input type="email" name="user_name"
                              class="form-control mb-3 mb-lg-0"
                              placeholder="Full name" value="Emma Smith" />
                        </div>
                     </div>
                     <!--end::Input group-->
                     <!--begin::Input group-->
                     <div class="mb-7">
                        <!--begin::Label-->
                        <label class="required fw-semibold fs-6 mb-5">Peranan</label>
                        <!--end::Label-->
                        <!--begin::Roles-->
                        <!--begin::Input row-->
                        <div class="d-flex fv-row">
                           <!--begin::Radio-->
                           <div class="form-check form-check-custom form-check-solid">
                              <!--begin::Input-->
                              <input class="form-check-input me-3" name="user_role"
                                 type="radio" value="0" id="kt_modal_update_role_option_0"
                                 checked='checked' />
                              <!--end::Input-->
                              <!--begin::Label-->
                              <label class="form-check-label"
                                 for="kt_modal_update_role_option_0">
                                 <div class="fw-bold text-gray-800">Super Admin</div>
                                 <div class="text-gray-600">Mengelola <b>seluruh</b> data pada aplikasi.</div>
                              </label>
                              <!--end::Label-->
                           </div>
                           <!--end::Radio-->
                        </div>
                        <!--end::Input row-->
                        <div class='separator separator-dashed my-5'></div>
                        <!--begin::Input row-->
                        <div class="d-flex fv-row">
                           <!--begin::Radio-->
                           <div class="form-check form-check-custom form-check-solid">
                              <!--begin::Input-->
                              <input class="form-check-input me-3" name="user_role"
                                 type="radio" value="1"
                                 id="kt_modal_update_role_option_1" />
                              <!--end::Input-->
                              <!--begin::Label-->
                              <label class="form-check-label"
                                 for="kt_modal_update_role_option_1">
                                 <div class="fw-bold text-gray-800">Admin</div>
                                 <div class="text-gray-600">Hanya mengelola data yang berkaitan dengan <b>Relawan</b></div>
                              </label>
                              <!--end::Label-->
                           </div>
                           <!--end::Radio-->
                        </div>
                        <!--end::Input row-->
                        <!--end::Roles-->
                     </div>
                     <!--end::Input group-->
                  </div>
                  <!--end::Scroll-->
                  <!--begin::Actions-->
                  <div class="text-center pt-15">
                     <button type="reset" class="btn btn-danger me-3" data-bs-dismiss="modal"><i class="fas fa-xmark me-2"></i>Batalkan</button>
                     <button type="submit" class="btn btn-primary"
                        data-kt-users-modal-action="submit">
                        <span class="indicator-label"><i class="fas fa-save me-2"></i>Undang</span>
                        <span class="indicator-progress">Please wait...
                           <span
                              class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                     </button>
                  </div>
                  <!--end::Actions-->
               </form>
               <!--end::Form-->
            </div>
            <!--end::Modal body-->
         </div>
         <!--end::Modal content-->
      </div>
      <!--end::Modal dialog-->
   </div>
@endpush
