<?php

namespace App\Livewire\Survey;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;

#[Title('Pengisian Survey IKATAMA 95')]
#[Layout('survey.layouts.app')]
class IsiSurvey extends Component
{
    public function render()
    {
        return view('livewire.survey.isi-survey');
    }
}
