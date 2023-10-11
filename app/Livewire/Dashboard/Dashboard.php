<?php

namespace App\Livewire\Dashboard;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;

#[Title('Beranda')]
#[Layout('layouts.app')]
class Dashboard extends Component
{
    public $c_user;

    public function mount() {
        $this->c_user = User::count();
    }
    
    public function render()
    {
        return view('livewire.dashboard.dashboard');
    }
}
