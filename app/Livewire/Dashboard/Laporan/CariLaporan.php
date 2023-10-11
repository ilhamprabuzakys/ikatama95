<?php

namespace App\Livewire\Dashboard\Laporan;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;

#[Title('Cari Area')]
#[Layout('layouts.app')]
class CariLaporan extends Component
{
    public function render()
    {
        return view('livewire.dashboard.laporan.cari-laporan');
    }
}
