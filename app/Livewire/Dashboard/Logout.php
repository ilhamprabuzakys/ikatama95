<?php

namespace App\Livewire\Dashboard;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;

#[Layout('layouts.app')]
class Logout extends Component
{
    public function render()
    {
        return view('livewire.dashboard.logout');
    }

    public function logout()
    {
        User::find(auth()->user()->id);

        // Logout user
        Auth::logout();

        // Invalidasi sesi dan regenerasi token
        session()->invalidate();
        session()->regenerateToken();

        // Redirect ke halaman login
        // $this->redirect('/');
        return redirect()->route('login');
    }
}
