<!--begin:Menu item-->
<div class="menu-item">
    <!--begin:Menu link-->
    <a class="menu-link {{ request()->url() == route($routeName) ? 'active' : '' }}"
       href="{{ route($routeName) }}"
       title="{{ $tooltipText }}"
       data-bs-toggle="tooltip"
       data-bs-trigger="hover"
       data-bs-dismiss="click"
       data-bs-placement="right"
       wire:navigate.hover>
        <span class="menu-bullet">
            <span class="bullet bullet-dot"></span>
        </span>
        <span class="menu-title">{{ $menuTitle }}</span>
    </a>
    <!--end:Menu link-->
</div>
<!--end:Menu item-->
