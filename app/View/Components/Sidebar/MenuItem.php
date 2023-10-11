<?php

namespace App\View\Components\Sidebar;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MenuItem extends Component
{
    public $iconClass;
    public $menuTitle;
    public $routeName;

    /**
     * Create a new component instance.
     */
    public function __construct($iconClass, $menuTitle, $routeName)
    {
        $this->iconClass = $iconClass;
        $this->menuTitle = $menuTitle;
        $this->routeName = $routeName;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sidebar.menu-item');
    }
}
