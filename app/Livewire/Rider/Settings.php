<?php

namespace App\Livewire\Rider;

use Livewire\Component;

class Settings extends Component
{
    public function render()
    {
        return view('livewire.rider.settings')->layout('layouts.rider');
    }
}
