<?php

namespace App\Livewire\Dashboard\Pengaturan;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;

#[Title('Pengaturan Admin')]
#[Layout('layouts.app')]
class PengaturanRelawan extends Component
{
    public function render()
    {
        return view('livewire.dashboard.pengaturan.pengaturan-relawan');
    }
}
