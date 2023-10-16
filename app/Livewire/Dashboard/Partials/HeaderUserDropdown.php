<?php

namespace App\Livewire\Dashboard\Partials;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('Judul')]
#[Layout('layouts.app')]
class HeaderUserDropdown extends Component
{
    #[On('refresh')]
    public function render()
    {
        return view('livewire.dashboard.partials.header-user-dropdown');
    }
}
