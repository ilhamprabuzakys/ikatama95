<?php

namespace App\Livewire\Dashboard\Pengaturan;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;

#[Title('Pengaturan Keamanans')]
#[Layout('layouts.app')]
class PengaturanKeamanan extends Component
{
    public $current_password, $new_password, $confirmnew_password;

    public function rules()
    {
        return [
            'current_password' => ['required'],
            'new_password' => ['required'],
            'confirmnew_password' => ['required'],
        ];
    }

    public function updatePassword()
    {
        $current_password_is_valid = Hash::check($this->current_password, auth()->user()->password);

        if (!$current_password_is_valid) {
            return $this->addError('current_password', 'Password lama anda salah.');
        }
        
        if ($this->new_password != $this->confirmnew_password) {
            return $this->addError('confirmnew_password', 'Password baru anda tidak sama.');
        }

        $user = User::find(auth()->user()->id);
        $user->update([
            'password' => \bcrypt($this->new_password)
        ]);

        $this->dispatch('alert', [
            'title' => 'Berhasil',
            'message' => "Password anda <strong>berhasil</strong> diperbarui",
            'type' => 'success',
        ]);
    }


    public function render()
    {
        return view('livewire.dashboard.pengaturan.pengaturan-keamanan');
    }
}
