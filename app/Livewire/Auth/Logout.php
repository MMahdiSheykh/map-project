<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Logout extends Component
{
    public function render()
    {
        return view('livewire.auth.logout');
    }

    public function perform()
    {
        Session::flush();

        Auth::logout();

        return redirect('login');
    }
}
