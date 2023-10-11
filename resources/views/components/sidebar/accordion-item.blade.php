<div data-kt-menu-trigger="click" class="menu-item menu-accordion show">
    <!--begin:Menu link-->
    <span class="menu-link">
        <span class="menu-icon">
            <i class="{{ $iconClass }}"></i>
        </span>
        <span class="menu-title">{{ $title }}</span>
        <span class="menu-arrow"></span>
    </span>
    <!--end:Menu link-->
    <!--begin:Menu sub-->
    <div class="menu-sub menu-sub-accordion">
        {{ $slot }}
    </div>
    <!--end:Menu sub-->
</div>
