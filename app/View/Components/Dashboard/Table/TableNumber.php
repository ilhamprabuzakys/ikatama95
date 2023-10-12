<?php

namespace App\View\Components\Dashboard\Table;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TableNumber extends Component
{
    public $data;
    public $iteration;
    public $paginate;
    
    public function __construct($data, $iteration, $paginate)
    {
        $this->data = $data;
        $this->iteration = $iteration;
        $this->paginate = $paginate;
    }
    

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.table.table-number');
    }
}
