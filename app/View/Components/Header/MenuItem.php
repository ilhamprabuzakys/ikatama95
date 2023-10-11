<?php

namespace App\View\Components\Header;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MenuItem extends Component
{
    public $routeName, $menuTitle;
    /**
     * Create a new component instance.
     */
    public function __construct($routeName, $menuTitle)
    {
        $this->routeName = $routeName;
        $this->menuTitle = $menuTitle;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.header.menu-item');
    }
}
