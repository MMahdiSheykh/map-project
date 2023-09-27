<?php

namespace App\Livewire\User\Map;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class Navigation extends Component
{
    public $response;
    public $steps;

    public function render()
    {
        return view('livewire.user.map.navigation');
    }

    public function sendRequest()
    {
        $response = Http::withHeaders([
            'Api-Key' => env('NESHAN_API_SERVICES')
        ])->get('https://api.neshan.org/v4/direction', [
            'type' => 'car',
            'origin' => '35.73452966514623,51.352500915527344',
            'destination' => '35.661201536537,51.247444152832',
            'bearing' => '85',
        ]);

        $this->response = $response->json();
        $this->steps = data_get($response->json(), 'routes.0.legs.0.steps');
    }

    public function mount()
    {
        $this->sendRequest();
    }
}
