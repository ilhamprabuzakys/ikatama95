<?php

namespace App\Livewire\Dashboard\Pengaturan;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;

#[Title('Pengaturan Profil')]
#[Layout('layouts.app')]
class PengaturanProfile extends Component
{
    public function render()
    {
        return view('livewire.dashboard.pengaturan.pengaturan-profile');
    }
}
