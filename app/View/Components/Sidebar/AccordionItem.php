<?php

namespace App\View\Components\Sidebar;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AccordionItem extends Component
{
    public $iconClass;
    public $title;

    /**
     * Create a new component instance.
     *
     * @param  string  $iconClass
     * @param  string  $title
     * @return void
     */
    public function __construct($iconClass, $title)
    {
        $this->iconClass = $iconClass;
        $this->title = $title;
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sidebar.accordion-item');
    }
}
