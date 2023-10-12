<?php

namespace App\View\Components\Dashboard\Table;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PaginationDetail extends Component
{
    public $collection;
    public $paginate;
    
    public function __construct($collection, $paginate)
    {
        $this->collection = $collection;
        $this->paginate = $paginate;
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.table.pagination-detail');
    }
}
