<?php

namespace App\Livewire\User\Map;

use App\Models\Event;
use Livewire\Attributes\On;
use Livewire\Component;

class Create extends Component
{
    public $events;

    public function render()
    {
        return view('livewire.user.map.create');
    }

    public function mount()
    {
        $this->events = Event::all()->where('is_confirmed', true);
    }

    public function confirmDelete($id)
    {
        $this->dispatch('confirm-delete', $id);
    }

    #[On('delete-event')]
    public function deleteEvent($id)
    {
        Event::find($id[0])->delete();

        $this->js('alert("رویداد شما با موفقیت حذف شد!")');
        return redirect(route('event.create'));
    }
}
