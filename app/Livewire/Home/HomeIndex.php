<?php

namespace App\Livewire\Home;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;

#[Title('Sistem Informasi Pemberdayaan Masyarakat atau DAYAMAS')]
#[Layout('home.layouts.app')]
class HomeIndex extends Component
{
    public function render()
    {
        return view('livewire.home.home-index');
    }
}
