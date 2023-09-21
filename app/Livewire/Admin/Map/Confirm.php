<?php

namespace App\Livewire\Admin\Map;

use App\Models\Event;
use Livewire\Component;

class Confirm extends Component
{
    public $events;

    public function render()
    {
        return view('livewire.admin.map.confirm');
    }

    public function deleteEvent($id)
    {
        $findEvent = Event::find($id);
        $findEvent->delete();
        return redirect()->route('admin.map');
    }
    public function confirmEvent($id)
    {
        $findEvent = Event::find($id);
        $findEvent->is_confirmed = 1;
        $findEvent->save();
        return redirect()->route('admin.map');
    }

    public function mount()
    {
        $this->events = Event::all();
    }
}
