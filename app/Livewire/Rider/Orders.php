<?php

namespace App\Livewire\Rider;

use Livewire\Component;

class Orders extends Component
{
    public function render()
    {
        return view('livewire.rider.orders')->layout('layouts.rider');
    }
}
