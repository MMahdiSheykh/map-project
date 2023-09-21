<?php

namespace App\Livewire\User\Event;

use App\Models\Event;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Create extends Component
{
    #[Rule('required|max:40|min:3|unique:events', as: 'نام')]
    public $name = '';

    #[Rule('required|max:255|min:10', as: 'آدرس')]
    public $address = '';

    #[Rule('required|max:255|min:10', as: 'توضیحات')]
    public $description = '';

    #[Rule('required', message: 'لطفا نقطه ای را که میخواهید رویداد در آنجا ایجاد شود را بر روی نقشه مشخص کنید!')]
    public $latlng;

    public function render()
    {
        return view('livewire.user.event.create');
    }

    public function createEvent()
    {
        $this->validate();

        Event::create([
            'name' => $this->name,
            'address' => $this->address,
            'description' => $this->description,
            'lat' => $this->latlng['lat'],
            'lng' => $this->latlng['lng'],
            'user_id' => auth()->user()->id,
        ]);

        $this->js("alert('رویداد شما پس از تایید ادمین در نقشه نمایش داده خواهد شد!')");
    }

    #[On('setLatlng')]
    public function setLatlng($latlng)
    {
        $this->latlng = $latlng;
    }
}
