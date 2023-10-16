<div class="menu-item">
    <!--begin:Menu link-->
    <a class="menu-link {{ request()->url() == route($routeName) ? 'active' : '' }}" href="{{ route($routeName) }}" wire:navigate.hover>
        <span class="menu-icon">
            <i class="{{ $iconClass }}"></i>
        </span>
        <span class="menu-title">{{ $menuTitle }}</span>
    </a>
</div>
