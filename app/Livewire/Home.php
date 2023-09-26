<?php

namespace App\Livewire;

use App\Models\Event;
use Livewire\Component;

class Home extends Component
{
    public $events;

    public function render()
    {
        return view('livewire.home');
    }

    public function mount()
    {
        $this->events = Event::where('is_confirmed', true)->get();
    }
}
