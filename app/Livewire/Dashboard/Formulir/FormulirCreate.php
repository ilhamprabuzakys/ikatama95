<?php

namespace App\Livewire\Dashboard\Formulir;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;

#[Title('Buat Formulir')]
#[Layout('layouts.app')]
class FormulirCreate extends Component
{
    #[On('refresh')]
    public function render()
    {
        return view('livewire.dashboard.formulir.formulir-create', [
            'title' => 'Buat Formulir'
        ]);
    }
}
