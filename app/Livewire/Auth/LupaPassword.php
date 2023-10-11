<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('authentication.layouts.app')]
#[Title('Lupa Password')]
class LupaPassword extends Component
{
    public $email, $username, $input;

    protected function rules()
    {
        return [
            'input'    => 'required',
        ];
    }

    protected $messages = [
        'input.required' => 'Harap masukan alamat email atau username anda.',
    ];

    protected $validationAttributes = [
        'input' => 'Kredensial',
    ];


    public function render()
    {
        return view('livewire.auth.lupa-password');
    }

    public function processed()
    {
        dd('processed');
    }

    protected function failedLoginResponse($message)
    {
        $this->dispatch('swal:modal', [
            'icon' => 'error',
            'title' => 'Login Gagal',
            'text' => $message
        ]);

        session()->flash('fails', $message);
    }
}
