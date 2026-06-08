<?php

namespace App\Livewire\Rider;

use Livewire\Component;

class Profile extends Component
{
    public function render()
    {
        return view('livewire.rider.profile')->layout('layouts.rider');
    }
}
