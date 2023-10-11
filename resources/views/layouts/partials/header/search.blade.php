<div id="kt_header_search" class="header-search d-flex align-items-center w-300px w-lg-350px" data-kt-search-keypress="true" data-kt-search-min-length="2" data-kt-search-enter="enter"
   data-kt-search-layout="menu" data-kt-search-responsive="true" data-kt-menu-trigger="auto" data-kt-menu-permanent="true" data-kt-menu-placement="bottom-start">
   <!--begin::Tablet and mobile search toggle-->
   <div data-kt-search-element="toggle" class="search-toggle-mobile d-flex d-lg-none align-items-center">
      <div class="d-flex">
         <i class="ki-outline ki-magnifier fs-1 fs-1"></i>
      </div>
   </div>
   <!--end::Tablet and mobile search toggle-->
   <!--begin::Form(use d-none d-lg-block classes for responsive search)-->
   <form data-kt-search-element="form" class="d-none d-lg-block w-100 position-relative mb-5 mb-lg-0" autocomplete="off">
      <!--begin::Hidden input(Added to disable form autocomplete)-->
      <input type="hidden" />
      <!--end::Hidden input-->
      <!--begin::Icon-->
      <i class="ki-outline ki-magnifier search-icon fs-2 text-gray-500 position-absolute top-50 translate-middle-y ms-5"></i>
      <!--end::Icon-->
      <!--begin::Input-->
      <input type="text" class="search-input form-control form-control border-0 h-lg-45px ps-13" name="search" value="" placeholder="Pencarian..."
         data-kt-search-element="input" />
      <!--end::Input-->
      <!--begin::Spinner-->
      <span class="search-spinner position-absolute top-50 end-0 translate-middle-y lh-0 d-none me-5" data-kt-search-element="spinner">
         <span class="spinner-border h-15px w-15px align-middle text-gray-400"></span>
      </span>
      <!--end::Spinner-->
      <!--begin::Reset-->
      <span class="search-reset btn btn-flush btn-active-color-primary position-absolute top-50 end-0 translate-middle-y lh-0 d-none me-4" data-kt-search-element="clear">
         <i class="ki-outline ki-cross fs-2 fs-lg-1 me-0"></i>
      </span>
      <!--end::Reset-->
   </form>
   <!--end::Form-->
   <!--begin::Menu-->
   <div data-kt-search-element="content" class="menu menu-sub menu-sub-dropdown py-7 px-7 overflow-hidden w-300px w-md-350px">
      <!--begin::Wrapper-->
      <div data-kt-search-element="wrapper">
         <!--begin::Recently viewed-->
         <div data-kt-search-element="results" class="d-none">
            <!--begin::Items-->
            <div class="scroll-y mh-200px mh-lg-350px">
               <!--begin::Category title-->
               <h3 class="fs-5 text-muted m-0 pt-5 pb-5" data-kt-search-element="category-title">Hasil pencarian</h3>
               <!--end::Category title-->
               @include('layouts.partials.header.items.search-result')
            </div>
            <!--end::Recently viewed-->
            <!--begin::Recently viewed-->
            <div class="" data-kt-search-element="main">
               <!--begin::Heading-->
               <div class="d-flex flex-stack fw-semibold mb-4">
                  <!--begin::Label-->
                  <span class="text-muted fs-6 me-2">Pencarian Terkini:</span>
                  <!--end::Label-->
                  <!--begin::Toolbar-->
                  {{-- <div class="d-flex" data-kt-search-element="toolbar">
                                 <!--begin::Preferences toggle-->
                                 <div data-kt-search-element="preferences-show" class="btn btn-icon w-20px btn-sm btn-active-color-primary me-2 data-bs-toggle="
                                    title="Show search preferences">
                                    <i class="ki-outline ki-setting-2 fs-2"></i>
                                 </div>
                                 <!--end::Preferences toggle-->
                                 <!--begin::Advanced search toggle-->
                                 <div data-kt-search-element="advanced-options-form-show" class="btn btn-icon w-20px btn-sm btn-active-color-primary me-n1" data-bs-toggle="tooltip"
                                    title="Show more search options">
                                    <i class="ki-outline ki-down fs-2"></i>
                                 </div>
                                 <!--end::Advanced search toggle-->
                              </div> --}}
                  <!--end::Toolbar-->
               </div>
               <!--end::Heading-->
               <!--begin::Items-->
               <div class="scroll-y mh-200px mh-lg-325px">
                  @include('layouts.partials.header.items.search-recently')
               </div>
               <!--end::Items-->
            </div>
            <!--end::Recently viewed-->
            <!--begin::Empty-->
            <div data-kt-search-element="empty" class="text-center d-none">
               <!--begin::Icon-->
               <div class="pt-10 pb-10">
                  <i class="ki-outline ki-search-list fs-4x opacity-50"></i>
               </div>
               <!--end::Icon-->
               <!--begin::Message-->
               <div class="pb-15 fw-semibold">
                  <h3 class="text-gray-600 fs-5 mb-2">Pencarian tidak ditemukan</h3>
                  <div class="text-muted fs-7">Coba lagi dengan kata kunci yang lain</div>
               </div>
               <!--end::Message-->
            </div>
            <!--end::Empty-->
         </div>
         <!--end::Wrapper-->
         <!--begin::Preferences-->
         <form data-kt-search-element="advanced-options-form" class="pt-1 d-none">
            <!--begin::Heading-->
            <h3 class="fw-semibold text-dark mb-7">Advanced Search</h3>
            <!--end::Heading-->
            <!--begin::Input group-->
            <div class="mb-5">
               <input type="text" class="form-control form-control-sm form-control-solid" placeholder="Contains the word" name="query" />
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="mb-5">
               <!--begin::Radio group-->
               <div class="nav-group nav-group-fluid">
                  <!--begin::Option-->
                  <label>
                     <input type="radio" class="btn-check" name="type" value="has" checked="checked" />
                     <span class="btn btn-sm btn-color-muted btn-active btn-active-primary">All</span>
                  </label>
                  <!--end::Option-->
                  <!--begin::Option-->
                  <label>
                     <input type="radio" class="btn-check" name="type" value="users" />
                     <span class="btn btn-sm btn-color-muted btn-active btn-active-primary px-4">Users</span>
                  </label>
                  <!--end::Option-->
                  <!--begin::Option-->
                  <label>
                     <input type="radio" class="btn-check" name="type" value="orders" />
                     <span class="btn btn-sm btn-color-muted btn-active btn-active-primary px-4">Orders</span>
                  </label>
                  <!--end::Option-->
                  <!--begin::Option-->
                  <label>
                     <input type="radio" class="btn-check" name="type" value="projects" />
                     <span class="btn btn-sm btn-color-muted btn-active btn-active-primary px-4">Projects</span>
                  </label>
                  <!--end::Option-->
               </div>
               <!--end::Radio group-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="mb-5">
               <input type="text" name="assignedto" class="form-control form-control-sm form-control-solid" placeholder="Assigned to" value="" />
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="mb-5">
               <input type="text" name="collaborators" class="form-control form-control-sm form-control-solid" placeholder="Collaborators" value="" />
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="mb-5">
               <!--begin::Radio group-->
               <div class="nav-group nav-group-fluid">
                  <!--begin::Option-->
                  <label>
                     <input type="radio" class="btn-check" name="attachment" value="has" checked="checked" />
                     <span class="btn btn-sm btn-color-muted btn-active btn-active-primary">Has attachment</span>
                  </label>
                  <!--end::Option-->
                  <!--begin::Option-->
                  <label>
                     <input type="radio" class="btn-check" name="attachment" value="any" />
                     <span class="btn btn-sm btn-color-muted btn-active btn-active-primary px-4">Any</span>
                  </label>
                  <!--end::Option-->
               </div>
               <!--end::Radio group-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="mb-5">
               <select name="timezone" aria-label="Select a Timezone" data-control="select2" data-placeholder="date_period" class="form-select form-select-sm form-select-solid">
                  <option value="next">Within the next</option>
                  <option value="last">Within the last</option>
                  <option value="between">Between</option>
                  <option value="on">On</option>
               </select>
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="row mb-8">
               <!--begin::Col-->
               <div class="col-6">
                  <input type="number" name="date_number" class="form-control form-control-sm form-control-solid" placeholder="Lenght" value="" />
               </div>
               <!--end::Col-->
               <!--begin::Col-->
               <div class="col-6">
                  <select name="date_typer" aria-label="Select a Timezone" data-control="select2" data-placeholder="Period" class="form-select form-select-sm form-select-solid">
                     <option value="days">Days</option>
                     <option value="weeks">Weeks</option>
                     <option value="months">Months</option>
                     <option value="years">Years</option>
                  </select>
               </div>
               <!--end::Col-->
            </div>
            <!--end::Input group-->
            <!--begin::Actions-->
            <div class="d-flex justify-content-end">
               <button type="reset" class="btn btn-sm btn-light fw-bold btn-active-light-primary me-2" data-kt-search-element="advanced-options-form-cancel">Cancel</button>
               <a href="../../demo39/dist/pages/search/horizontal.html" class="btn btn-sm fw-bold btn-primary" data-kt-search-element="advanced-options-form-search">Search</a>
            </div>
            <!--end::Actions-->
         </form>
         <!--end::Preferences-->
         <!--begin::Preferences-->
         <form data-kt-search-element="preferences" class="pt-1 d-none">
            <!--begin::Heading-->
            <h3 class="fw-semibold text-dark mb-7">Search Preferences</h3>
            <!--end::Heading-->
            <!--begin::Input group-->
            <div class="pb-4 border-bottom">
               <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid flex-stack">
                  <span class="form-check-label text-gray-700 fs-6 fw-semibold ms-0 me-2">Projects</span>
                  <input class="form-check-input" type="checkbox" value="1" checked="checked" />
               </label>
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="py-4 border-bottom">
               <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid flex-stack">
                  <span class="form-check-label text-gray-700 fs-6 fw-semibold ms-0 me-2">Targets</span>
                  <input class="form-check-input" type="checkbox" value="1" checked="checked" />
               </label>
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="py-4 border-bottom">
               <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid flex-stack">
                  <span class="form-check-label text-gray-700 fs-6 fw-semibold ms-0 me-2">Affiliate Programs</span>
                  <input class="form-check-input" type="checkbox" value="1" />
               </label>
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="py-4 border-bottom">
               <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid flex-stack">
                  <span class="form-check-label text-gray-700 fs-6 fw-semibold ms-0 me-2">Referrals</span>
                  <input class="form-check-input" type="checkbox" value="1" checked="checked" />
               </label>
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="py-4 border-bottom">
               <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid flex-stack">
                  <span class="form-check-label text-gray-700 fs-6 fw-semibold ms-0 me-2">Users</span>
                  <input class="form-check-input" type="checkbox" value="1" />
               </label>
            </div>
            <!--end::Input group-->
            <!--begin::Actions-->
            <div class="d-flex justify-content-end pt-7">
               <button type="reset" class="btn btn-sm btn-light fw-bold btn-active-light-primary me-2" data-kt-search-element="preferences-dismiss">Cancel</button>
               <button type="submit" class="btn btn-sm fw-bold btn-primary">Save Changes</button>
            </div>
            <!--end::Actions-->
         </form>
         <!--end::Preferences-->
      </div>
      <!--end::Menu-->
   </div>
