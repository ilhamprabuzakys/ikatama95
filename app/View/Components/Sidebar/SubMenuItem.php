<?php

namespace App\View\Components\Sidebar;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SubMenuItem extends Component
{
    public $routeName;
    public $menuTitle;
    public $tooltipText;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($routeName, $menuTitle, $tooltipText)
    {
        $this->routeName = $routeName;
        $this->menuTitle = $menuTitle;
        $this->tooltipText = $tooltipText;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sidebar.sub-menu-item');
    }
}
