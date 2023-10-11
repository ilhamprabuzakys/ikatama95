<?php

namespace App\Livewire\Dashboard\Formulir;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;

#[Title('Daftar Formulir')]
#[Layout('layouts.app')]
class FormulirUpdate extends Component
{
    public function render()
    {
        return view('livewire.dashboard.formulir.formulir-update');
    }
}
