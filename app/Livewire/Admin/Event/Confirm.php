<?php

namespace App\Livewire\Admin\Event;

use App\Models\Event;
use Livewire\Component;

class Confirm extends Component
{
    public $events;

    public function render()
    {
        return view('livewire.admin.event.confirm');
    }

    public function mount()
    {
        $this->events = Event::where('is_confirmed', '=', 0)->get();;
    }

    public function selectEvent($id)
    {
        $event = Event::find($id);
        $this->dispatch('show-event', $event)->to(\App\Livewire\Admin\Map\Confirm::class);
    }
}
