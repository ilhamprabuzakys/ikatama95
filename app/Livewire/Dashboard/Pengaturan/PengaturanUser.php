<?php

namespace App\Livewire\Dashboard\Pengaturan;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Validation\Rules\Unique;

#[Title('Pengaturan User')]
#[Layout('layouts.app')]
class PengaturanUser extends Component
{
    public $users;
    public $email, $role, $user_id;

    public function mount()
    {
        $this->users = User::latest('created_at')->get();
    }

    public function render()
    {
        return view('livewire.dashboard.pengaturan.pengaturan-user', [
            'title' => 'Pengaturan User'
        ]);
    }

    public function store()
    {
        $validatedData = $this->validate([
            'role' => 'required',
            'email' => ['required', 'email', 'not_in:' . auth()->user()->email, Rule::unique('users')->ignore($this->user_id)],
        ], [
            'email.required' => 'Alamat email harus terisi.',
            'email.email' => 'Alamat email harus berformat email, contoh: @gmail.com, @yahoo.com.',
            'email.unique' => 'Alamat email ini telah digunakan oleh pengguna lain.',
            'role.required' => 'Peranan harus dipilih.',
        ]);
        $validatedData['username'] = Str::before($validatedData['email'], '@');
        User::create($validatedData);
        
    }
}
